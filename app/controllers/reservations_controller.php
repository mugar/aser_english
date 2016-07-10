<?php
class ReservationsController extends AppController {

	var $name = 'Reservations';
	var $uses = array('Reservation','Chambre');
	/**
	* this function's job is fetch the details of the last 
	* reservation made by a client.
	*/
	function last_reservation($tier_id){
		$reservation=$this->Reservation->find('first',array('fields'=>array('Reservation.depart',
																		'Chambre.name',
																		'Reservation.PU','Reservation.monnaie'
																			),
														'conditions'=>array('Reservation.tier_id'=>$tier_id,
																			'Reservation.etat !='=>'canceled'
																			),
														'order'=>array('Reservation.arrivee desc')
														));
		$text='';
		if(!empty($reservation)){
			$text.='Chambre : '.$reservation['Chambre']['name']."\n";
			$text.='Tarif : '.$reservation['Reservation']['PU'].' '.$reservation['Reservation']['monnaie']."\n";
			$text.='Départ : '.$this->Product->increase_date($reservation['Reservation']['depart']);

		}
		exit(json_encode(array('text'=>$text)));

	}

	function index(){
		$this->redirect(array('action'=>'tabella'));
	}
	function arrivals(){
	
		$cond['Reservation.etat !=']='canceled';
		if(!empty($this->data['Reservation']['date1'])){
			$cond['Reservation.arrivee >=']=$date1=$this->data['Reservation']['date1'];
		}
		else {
			$cond['Reservation.arrivee >=']=$date1=date('Y-m-d');
		}
		
		if(!empty($this->data['Reservation']['date2'])){
			$cond['Reservation.arrivee <=']=$date2=$this->data['Reservation']['date2'];
		}
		else {
			$cond['Reservation.arrivee <=']=$date2=date('Y-m-d',strtotime(' + 6 days'));
		}
		if(!empty($this->data['Tier']['compagnie'])){
			$cond['Tier.compagnie']=$this->data['Tier']['compagnie'];
		}
		//	exit(debug($cond));
		$reservations=$this->Reservation->find('all',array('fields'=>array('Reservation.*',
																		'Chambre.name',
																		'Tier.name',
																		'Tier.compagnie'
																		),
														'conditions'=>$cond,
											));	
		$total['RWF']=$total['USD']=0;									
		foreach($reservations as $i=>$reservation){
			$total[$reservation['Reservation']['monnaie']]+=$reservation['Reservation']['montant'];
			$reservations[$i]['Reservation']['depart']=$this->Product->increase_date($reservation['Reservation']['depart']);
		}					
		$this->set(compact('total','reservations','date1','date2'));
	}
	
	function confirmation($id,$action=0){
		$this->autoRender=false;
		$reservation=$this->Reservation->find('first',array('fields'=>array('Reservation.*',
																	),
													'conditions'=>array(
																		'Reservation.id'=>$id,
																		),
													'contain'=>array('Chambre'=>array('fields'=>array('id'),
																					'TypeChambre'=>array('fields'=>array('name'))),
																	'Tier',
														)			
													));
		$this->Product->company_info();
		$this->set(compact('reservation','id','action'));
		if($action==2){
			$this->Email->reset();  
			$this->Email->sendAs = 'html'; // both = html + plain text  
			$this->Email->to ='mugarmug@gmail.com';  
			$this->Email->from = 'info@martha.com';  
			$this->Email->replyTo = 'info@martha.com';
			$this->Email->return = 'info@martha.com';  
			$this->Email->subject = 'your amazing subject here';  
			$this->Email->template= 'default'; 
			$this->set(compact('reservation','id'));
			
			$this->Email->_createboundary();
			$this->Email->__header[] = 'MIME-Version: 1.0';
			
			if($this->Email->send()){
				exit('ok');
			}
			else 
				exit('failed!');
			
		}
		else {
			$this->render('confirmation');
		}
	}
	
	function beforeFilter(){
		parent::beforeFilter();
		if(in_array($this->params['action'],array('facture_globale','tabella'))){
			$typeChambres=$typeChambres1=$this->Reservation->Chambre->TypeChambre->find('list');
			$typeChambres1[0]='';
			$this->set(compact('typeChambres','typeChambres1'));	
		}
	}
	
	function auto_demi_journee(){
		$this->autoRender=false;
		$reservations=$this->Reservation->find('all',array('fields'=>array('Reservation.id',
																	),
													'conditions'=>array(
																		'Reservation.facture_id !='=>null,
																		'Reservation.etat'=>'arrivee',
																		'Reservation.demi'=>null,
																		'Reservation.depart'=>date('Y-m-d',strtotime('-1 day'))
																		),
													));
	//	exit(debug($reservations));
		foreach($reservations as $reservation){
			$this->demi($reservation['Reservation']['id'],true,50);
		}
		CakeLog::write('demi_journee','Job done!');						
		exit('JOB DONE!');					
	}
	
	function calcul_factures(){
		$this->autoRender=false;
		$factures=$this->Reservation->find('all',array('fields'=>array('Reservation.facture_id',
																	'Facture.etat'
																	),
													'conditions'=>array('Reservation.facture_id !='=>null,
																		'Reservation.etat'=>'arrivee'
																		),
													'group'=>array('Reservation.facture_id')
													));
		$this->Product->factureMontantRes($factures);
		CakeLog::write('cron','Job done!');						
		exit('JOB DONE!');					
	}
	
	function hosted(){
		if(!empty($this->data['Reservation']['mois']['month'])){
			$mois=$this->data['Reservation']['mois']['month'];
		}
		else {
			$mois=date('m');
		}
		if(!empty($this->data['Reservation']['annee']['year'])){
			$annee=$this->data['Reservation']['annee']['year'];
		}
		else {
			$annee=date('Y');
		}
		$nationalites=$this->Reservation->find('all',array('conditions'=>array(
																	'Reservation.etat'=>array('partie','arrivee','credit'),
																	'OR'=>array(array('month(Reservation.arrivee)'=>$mois,
																					'year(Reservation.arrivee)'=>$annee,
																					),
																				array('month(Reservation.depart)'=>$mois,
																					'year(Reservation.depart)'=>$annee,
																					)
																				),
																	),
												'fields'=>array('count(Reservation.pax) as pax',
																'Tier.nationalite'
																),
												'group'=>array('Tier.nationalite')
												));
		$this->set(compact('mois','annee','nationalites'));
	}
	
	/**
	 * generate the list of rooms to clean
	 * 
	 */
	 function rooms_to_clean($date=null){
	 if(!empty($this->data['Reservation']['date'])){
			$date=$this->data['Reservation']['date'];
		}
		else if(is_null($date)){
			$date=date('Y-m-d');
		}
		$prev_date=$this->Product->increase_date($date,-1);
		$reservations=$this->Reservation->find('all',array('fields'=>array('Reservation.arrivee',
																			'Reservation.depart',
																			'Chambre.name',
																			'Chambre.id'
																			),
																'conditions'=>array('Reservation.arrivee <'=>$date,
																					'OR'=>array('Reservation.depart >='=>$date,
																								'Reservation.depart >='=>$prev_date
																								),
																					'Reservation.etat'=>array('arrivee','partie','credit','changee')
																				   ),
																'order'=>array('Chambre.name asc')
																				
																)
												);
		$bed_sheet_duration=$this->Conf->find('recouche');
		$a_blanc=$recouche=$recouche_a_blanc=array(); 
		foreach($reservations as $reservation){
			//using the real date de depart.
			$reservation['Reservation']['depart']=$this->Product->increase_date($reservation['Reservation']['depart']);
			//calcul des nuitees deja consome
			$nuitee=$this->Product->diff($reservation['Reservation']['arrivee'],$date)+1;
			if($reservation['Reservation']['depart']==$date) {
				if(!in_array($reservation['Chambre']['name'],$a_blanc)){
					$a_blanc[$reservation['Chambre']['id']]=$reservation['Chambre']['name']; //nettoyage a blanc. quand le client quitte l'hotel
				}
			}
			//verifie si c'est un recouche a blanc.quand le client vient de passer x jours dans l'hotel sans chgt de draps.
			elseif(($nuitee%$bed_sheet_duration)==0) {
				if(!in_array($reservation['Chambre']['name'],$recouche_a_blanc)){
					$recouche_a_blanc[$reservation['Chambre']['id']]=$reservation['Chambre']['name']; 
				}					
			}
			else { //recouche. quand le client reste a l'hotel.simple ballayage
				if(!in_array($reservation['Chambre']['name'],$recouche)){
					$recouche[$reservation['Chambre']['id']]=$reservation['Chambre']['name']; 
				}	 //counter 
			}
		}
		$rooms_to_clean = $a_blanc+$recouche_a_blanc+$recouche;
		sort($rooms_to_clean);
		$this->set(compact('rooms_to_clean',
						'a_blanc',
						'recouche',
						'recouche_a_blanc',
						'date',
						'bed_sheet_duration'
						));
	}
	/**
	 * Generate the occupation table
	 */
	function etat_occupation($mode='full',$date=null){
		if(!empty($this->data['Reservation']['date'])){
			$date=$this->data['Reservation']['date'];
		}
		else if(is_null($date)){
			$date=date('Y-m-d');
		}
		$mode=(!empty($this->data['Reservation']['mode']))?($this->data['Reservation']['mode']):$mode;
		
		$chambres=$this->Reservation->Chambre->find('all',array('fields'=>array('Chambre.id','Chambre.name'),
																				//	'conditions'=>array('Chambre.operationnelle'=>'yes'),
																					'order'=>'Chambre.name asc'
																					)
																		);
		$vacante=$departures=$arrivals=0;
		$occupee=0;
		$reservee=0;
		$usd=$bif=0;
		$departuresDetails=array();
		foreach($chambres as $key=>$chambre){
			$available=true;
			$reservations=$this->Reservation->find('all',array('fields'=>array('Reservation.*','Chambre.name',
																			'Facture.id',
																			'Facture.numero',
																			'Facture.etat',
																			'Tier.name',
																			'Tier.nationalite',
																			'Tier.id',
																			'Tier.compagnie'
																			),
																'conditions'=>array('Reservation.chambre_id'=>$chambre['Chambre']['id'],
																				'NOT'=>array('Reservation.etat'=>array('canceled'))
																				),
																'order'=>array('Reservation.depart asc')
																				
																)
																			
																);
			foreach($reservations as $reservation){
				if(($date<=$reservation['Reservation']['depart'])and($date>=$reservation['Reservation']['arrivee'])) {
					$chambres[$key]['Reservation']=$reservation['Reservation'];
					$chambres[$key]['Tier']=$reservation['Tier'];
					$chambres[$key]['Facture']=$reservation['Facture'];
					$chambres[$key]['Reservation']['depart']=$this->Product->increase_date($reservation['Reservation']['depart']);
					$chambres[$key]['Reservation']['nuitee']=$this->Product->diff($reservation['Reservation']['arrivee'],$chambres[$key]['Reservation']['depart']);
					if(in_array($reservation['Reservation']['etat'],array('arrivee','partie','changee','credit'))){
						$occupee++;	
						if($reservation['Reservation']['monnaie']=='USD'){
							$usd+=$reservation['Reservation']['PU'];
						}
						else {
							$bif+=$reservation['Reservation']['PU'];
						}
					}
					else {
						$reservee++;
					} 
					if($reservation['Reservation']['arrivee']==$date){
						$arrivals++;
						$arrivalsList=(isset($arrivalsList))?($arrivalsList.', '.$reservation['Chambre']['name']):$reservation['Chambre']['name'];
					}
					$available=false;												
					break;
				}
				if(($this->Product->increase_date($reservation['Reservation']['depart'])==$date)&&
					!in_array($reservation['Reservation']['etat'],array('confirmee','en_attente'))
				 ){
					$departures++;
					$departuresList=(isset($departuresList))?($departuresList.', '.$reservation['Chambre']['name']):$reservation['Chambre']['name'];
					$pyts=$this->Reservation->Facture->Paiement->find('all',array('fields'=>array('sum(Paiement.montant) as montant',
																						),
																				'conditions'=>array('Paiement.facture_id'=>$reservation['Reservation']['facture_id'],
																									'Paiement.date'=>$date
																						)
																		));
					$reservation['paiements']=(!empty($pyts))?$pyts[0]['Paiement']['montant']:0;
					$departuresDetails[]=$reservation;
				}
			}
			if($available){
				$vacante++;
			}
		}
		
		$pyts=$this->Reservation->Facture->Paiement->find('all',array('fields'=>array('Paiement.montant',
																						'Paiement.montant_equivalent',
																						'Paiement.monnaie',
																						'Facture.monnaie',
																						'Facture.operation',
																						'Paiement.mode_paiement'
																						),
																				'conditions'=>array('Paiement.date'=>$date,
																									'Facture.etat'=>array('paid','excedent','half_paid'),
																									'OR'=>array('Facture.operation'=>array('Reservation','Service','Location'),
																												'Personnel.fonction_id'=>array('4'),
																												),
																									'NOT'=>array('Paiement.mode_paiement'=>array('remboursement','transfer'))
																						)
																		));
		$total['USD']=$total['RWF']=$total['EUR']=0;  
		foreach($this->monnaies as $monnaie){
			$detailPyts[$monnaie.'_cash']=0;
			$detailPyts[$monnaie.'_cheque']=0;
			$detailPyts[$monnaie.'_visa']=0;
		}
		foreach($pyts as $pyt){
			if(!empty($pyt['Paiement']['montant_equivalent'])){
				$total[$pyt['Paiement']['monnaie']]+=$pyt['Paiement']['montant_equivalent'];
				$detailPyts[$pyt['Paiement']['monnaie'].'_'.$pyt['Paiement']['mode_paiement']]+=$pyt['Paiement']['montant_equivalent'];
			}
			else {
				$total[$pyt['Facture']['monnaie']]+=$pyt['Paiement']['montant'];
				$detailPyts[$pyt['Facture']['monnaie'].'_'.$pyt['Paiement']['mode_paiement']]+=$pyt['Paiement']['montant'];
			}
		}
		$this->set(compact('date',
						'chambres',
						'vacante',
						'occupee',
						'reservee',
						'usd',
						'bif',
						'factures',
						'sum',
						'personnels',
						'departures',
						'arrivals',
						'departuresList',
						'arrivalsList',
						'departuresDetails',
						'total',
						'detailPyts',
						'mode'
						));
	}
	
	/*
	 * special monthly report
	 */
	 
	 function monthly($date1=null,$date2=null){
	 	$reservations=array();
		$order = (Configure::read('aser.aserb')) ? 'Facture.aserb_num asc' :'Reservation.arrivee asc';
		$total['RWF']=0;
		$total['USD']=0;
		$pers=$extras=0;
		$etat='partie';
		if($date1&&$date2){
			$this->data['Reservation']['date1']=$date1;
			$this->data['Reservation']['date2']=$date2;
		}
	 	if(!empty($this->data['Reservation']['date1'])&&!empty($this->data['Reservation']['date2'])){
	 		$date1=$this->data['Reservation']['date1'];
	 		$date2=($this->data['Reservation']['date2']>date('Y-m-d'))?date('Y-m-d'):$this->data['Reservation']['date2'];
			
			if(!empty($this->data['Tier']['compagnie'])){
				$cond1['Tier.compagnie like']='%'.$this->data['Tier']['compagnie'].'%';
				$cond2['Tier.compagnie like']='%'.$this->data['Tier']['compagnie'].'%';
				$cond3['Tier.compagnie like']='%'.$this->data['Tier']['compagnie'].'%';
				$cond4['Tier.compagnie like']='%'.$this->data['Tier']['compagnie'].'%';
			}
		//	switch($this->data['Reservation']['booking']){
		//		case 'encaissees':
					$cond1['OR']=$cond2['OR']=$cond3['OR']=$cond4['OR']=array(array('Reservation.etat'=>'arrivee'),
											 								 array('Reservation.etat'=>'partie'),
											 								 array('Reservation.etat'=>'credit')
																			);
					$cond1['OR']=$cond2['OR']=$cond3['OR']=$cond4['OR']=array('Reservation.facture_id !='=>null);
			/*
					break;
				case 'attendues':
					$cond1['OR']=$cond2['OR']=$cond3['OR']=$cond4['OR']=array(array('Reservation.etat'=>'confirmee'),
											  								array('Reservation.etat'=>'en_attente')
																		);
					$cond1['OR']=$cond2['OR']=$cond3['OR']=$cond4['OR']=array('Reservation.facture_id'=>null);
					break;	
			}
			//*/
			if(!empty($this->data['Reservation']['bills'])){
				switch($this->data['Reservation']['bills']){
					case 'paid':
						$cond1['Facture.etat']=$cond2['Facture.etat']=$cond3['Facture.etat']=$cond4['Facture.etat']=array('paid','excedent');
						break;
					case 'recouvrement':
						$cond1['Facture.etat']=$cond2['Facture.etat']=$cond3['Facture.etat']=$cond4['Facture.etat']=array('credit','half_paid');
						$cond1['Reservation.etat']=$cond2['Reservation.etat']=$cond3['Reservation.etat']=$cond4['Reservation.etat']=array('partie','credit');
						break;
					case 'in_progress':
						$cond1['Facture.etat']='credit';
						$cond2['Facture.etat']='credit';
						$cond3['Facture.etat']='credit';
						$cond4['Facture.etat']='credit';

						$cond1['Reservation.etat']='arrivee';
						$cond2['Reservation.etat']='arrivee';
						$cond3['Reservation.etat']='arrivee';
						$cond4['Reservation.etat']='arrivee';
						break;
					default :
						break;
				}
			}
			//first part reservation totaly included in the search periode
			$cond1['Reservation.arrivee >=']=$date1;
			$cond1['Reservation.depart <=']=$date2;
			$part1=$this->Reservation->find('all',array('conditions'=>$cond1,
														'order'=>$order,
														'fields'=>array('Reservation.montant',
																		'Reservation.monnaie',
																		'Reservation.PU',
																		'Reservation.demi',
																		'Reservation.tauxDemi',
																		'Chambre.name',
																		'Reservation.arrivee',
																		'Reservation.depart',
																		'Tier.name',
																		'Tier.id',
																		'Tier.compagnie',
																		'Reservation.etat',
																		'Facture.id',
																		'Facture.numero',
																		'Facture.etat',
																		'Facture.aserb_num',
																		'Facture.montant'
																	)
													)
										);
			foreach($part1 as $key=>$reservation){
			if(!in_array($reservation['Reservation']['etat'],array('canceled','en_attente','confirmee'))){
				$duree=$this->Product->diff($reservation['Reservation']['arrivee'], $reservation['Reservation']['depart'])+1;		
				$montant=$duree*$reservation['Reservation']['PU'];
				$part1[$key]['Reservation']['montant']=($reservation['Reservation']['demi']==1)
														?($montant+($reservation['Reservation']['PU']*($reservation['Reservation']['tauxDemi']/100)))
														:($montant);
					$total[$reservation['Reservation']['monnaie']]+=	$part1[$key]['Reservation']['montant'];
				}
				//extras stuff
				$extras1=$this->Reservation->Facture->find('all',array('fields'=>array('sum(Facture.montant) as montant'),
																'conditions'=>array('Facture.tier_id'=>$reservation['Tier']['id'],
																					'NOT'=>array('Facture.operation'=>array('Reservation','Proforma')),
																					'Facture.etat !='=>'canceled',
																					'Facture.date >='=>$reservation['Reservation']['arrivee'],
																					'Facture.date <='=>$this->Product->increase_date($reservation['Reservation']['depart'])
																					)
																)
												);
			
				$part1[$key]['extras']=(!empty($extras1[0]['Facture']['montant']))?($extras1[0]['Facture']['montant']):(0);
				$extras+=$part1[$key]['extras'];
			}
			//reservations qui s'etende au dela du mois de deux cotes'
			$cond2['Reservation.arrivee <']=$date1;
			$cond2['Reservation.depart >']=$date2;
			$part2=$this->Reservation->find('all',array('conditions'=>$cond2,
														'order'=>$order,
														'fields'=>array('Reservation.PU',
																	'Reservation.monnaie',
																		'Reservation.demi',
																		'Reservation.tauxDemi',
																		'Tier.name',
																		'Tier.id',
																		'Tier.compagnie',
																		'Chambre.name',
																		'Reservation.etat',
																		'Facture.id',
																		'Facture.numero',
																		'Facture.etat',
																		'Facture.aserb_num',
																		'Facture.montant'
																		
																	)
													)
										);
			foreach($part2 as $key=>$reservation){
				$part2[$key]['Reservation']['arrivee']=$date1;
				$part2[$key]['Reservation']['depart']=$date2;
				$duree=$this->Product->diff($date1, $date2)+1;		
				$montant=$duree*$reservation['Reservation']['PU'];
				$part2[$key]['Reservation']['montant']=(false)
														?($montant+($reservation['Reservation']['PU']*($reservation['Reservation']['tauxDemi']/100)))
														:($montant);
															

				if(!in_array($reservation['Reservation']['etat'],array('canceled','en_attente','confirmee'))){
					$total[$reservation['Reservation']['monnaie']]+=$part2[$key]['Reservation']['montant'];
				}
				
				$extras2=$this->Reservation->Facture->find('all',array('fields'=>array('sum(Facture.montant) as montant'),
																'conditions'=>array('Facture.tier_id'=>$reservation['Tier']['id'],
																					'NOT'=>array('Facture.operation'=>array('Reservation','Proforma')),
																					'Facture.etat !='=>'canceled',
																					'Facture.date >='=>$date1,
																					'Facture.date <='=>$date2
																					)
																)
													);
				$part2[$key]['extras']=(!empty($extras2[0]['Facture']['montant']))?($extras2[0]['Facture']['montant']):(0);
				
				$extras+=$part2[$key]['extras'];
			}
			//reservations dont l'arrivee e avant le mois mais qui finit quand meme dans ce mois'
			$cond3['Reservation.arrivee <']=$date1;
			$cond3['Reservation.depart <=']=$date2;
			$cond3['Reservation.depart >=']=$date1;
			$part3=$this->Reservation->find('all',array('conditions'=>$cond3,
														'order'=>$order,
														'fields'=>array('Reservation.PU',
																		'Reservation.monnaie',
																		'Reservation.depart',
																		'Reservation.etat',
																		'Reservation.demi',
																		'Reservation.tauxDemi',
																		'Tier.name',
																		'Tier.id',
																		'Tier.compagnie',
																		'Chambre.name',
																		'Facture.id',
																		'Facture.numero',
																		'Facture.etat',
																		'Facture.aserb_num',
																		'Facture.montant'
																	)
													)
										);	
			foreach($part3 as $key=>$reservation){
				$part3[$key]['Reservation']['arrivee']=$date1;
				$duree=$this->Product->diff($date1, $reservation['Reservation']['depart'])+1;		
				$montant=$duree*$reservation['Reservation']['PU'];
				$part3[$key]['Reservation']['montant']=($reservation['Reservation']['demi']==1)
														?($montant+($reservation['Reservation']['PU']*($reservation['Reservation']['tauxDemi']/100)))
														:($montant);
			if(!in_array($reservation['Reservation']['etat'],array('canceled','en_attente','confirmee'))){
					$total[$reservation['Reservation']['monnaie']]+=$part3[$key]['Reservation']['montant'];
				}
				$extras3=$this->Reservation->Facture->find('all',array('fields'=>array('sum(Facture.montant) as montant'),
																'conditions'=>array('Facture.tier_id'=>$reservation['Tier']['id'],
																					'NOT'=>array('Facture.operation'=>array('Reservation','Proforma')),
																					'Facture.etat !='=>'canceled',
																					'Facture.date >='=>$date1,
																					'Facture.date <='=>$reservation['Reservation']['depart']
																					)
																)
													);
				$part3[$key]['extras']=(!empty($extras3[0]['Facture']['montant']))?($extras3[0]['Facture']['montant']):(0);
				$extras+=$part3[$key]['extras'];
			}
			
			// qui commence dans ce mois e fini ailleur
			$cond4['Reservation.arrivee >=']=$date1;
			$cond4['Reservation.arrivee <=']=$date2;
			$cond4['Reservation.depart >']=$date2;
			$part4=$this->Reservation->find('all',array('conditions'=>$cond4,
														'order'=>$order,
														'fields'=>array('Reservation.PU',
																		'Reservation.monnaie',
																		'Reservation.arrivee',
																		'Reservation.demi',
																		'Reservation.tauxDemi',
																		'Reservation.etat',
																		'Tier.name',
																		'Tier.id',
																		'Tier.compagnie',
																		'Chambre.name',
																		'Reservation.etat',
																		'Facture.id',
																		'Facture.numero',
																		'Facture.etat',
																		'Facture.aserb_num',
																		'Facture.montant'
																		)
														)
										);	
			foreach($part4 as $key=>$reservation){
				$part4[$key]['Reservation']['depart']=$date2;
				$duree=$this->Product->diff($reservation['Reservation']['arrivee'], $date2)+1;		
				$montant=$duree*$reservation['Reservation']['PU'];
				$part4[$key]['Reservation']['montant']=(false) //demi only works pour une reservation qui finit dans ce mois
														?($montant+($reservation['Reservation']['PU']*($reservation['Reservation']['tauxDemi']/100)))
														:($montant);
				if(!in_array($reservation['Reservation']['etat'],array('canceled','en_attente','confirmee'))){
					$total[$reservation['Reservation']['monnaie']]+=$part4[$key]['Reservation']['montant'];
				}
				$extras4=$this->Reservation->Facture->find('all',array('fields'=>array('sum(Facture.montant) as montant'),
																'conditions'=>array('Facture.tier_id'=>$reservation['Tier']['id'],
																					'NOT'=>array('Facture.operation'=>array('Reservation','Proforma')),
																					'Facture.etat !='=>'canceled',
																					'Facture.date >='=>$reservation['Reservation']['arrivee'],
																					'Facture.date <='=>$date2
																					)
																)
													);
				$part4[$key]['extras']=(!empty($extras4[0]['Facture']['montant']))?($extras4[0]['Facture']['montant']):(0);
				$extras+=$part4[$key]['extras'];
			
				
			}
			$reservations=array_merge_recursive($part1,$part2,$part3,$part4);
		
			if(Configure::read('aser.aserb')&&in_array($this->Auth->user('fonction_id'),array(3))){
				usort($reservations, "self::cmp");
				if(strtotime(date('Y-m-d'))>=strtotime('2014-03-01')){
					$cond['Paiement.mode_paiement']=array('cash','visa');
				}
				else {
					$cond['Paiement.mode_paiement']=array('cash');
				}
				foreach($reservations as $key=>$reservation){
					$cond['Paiement.facture_id']=$reservation['Facture']['id'];
					$paiements=$this->Reservation->Facture->Paiement->find('all',array('fields'=>array('sum(Paiement.montant) as montant'),
																					'conditions'=>$cond,
																						));
					$reservations[$key]['Facture']['type']=(isset($paiements[0])&&($paiements[0]['Paiement']['montant']>=$reservations[$key]['Facture']['montant']))?
														'Cash':'Autre';									
				}
			}
			//	exit(debug($reservations));
	 	}
		$this->set(compact('reservations','total','date1','date2','pers','extras'));
	 }

	function cmp($a, $b)
	{
    	return  $a['Facture']['aserb_num']-$b['Facture']['aserb_num'];
	}
	function client($id=null,$resId=null){
		if(empty($this->data)){
				$this->data=$this->Reservation->Tier->find('first',array('fields'=>array('Tier.*'),
																 				'conditions'=>array('Tier.id'=>$id)
																				)
																);
				$reservation=null;
				$model='Reservation';
				if($resId){
					$resInfo=$reservation=$this->Reservation->find('first',array('fields'=>array('Reservation.*'),
														'conditions'=>array('Reservation.id'=>$resId),
														'recursive'=>-1
															));	
					$this->data['Reservation']=$resInfo['Reservation'];
					
				}
				$this->set(compact('reservation','model'));
			
		}
		else {
			//saving tier data
			//exit(debug($this->data));
			//if the tier has been changed no need to update the tier info
			if(!isset($this->data['Reservation']['new_tier_id'])||($this->data['Reservation']['new_tier_id']==0)){
				$this->Reservation->Tier->save($this->data);
			}
			else {
				$this->data['Reservation']['tier_id']=$this->data['Reservation']['new_tier_id'];
			}
			//saving reservation data
		//	exit(debug($this->data));
			$this->Reservation->save($this->data);
			
			exit(json_encode(array('success'=>true,'msg'=>'Informations enregistrées !')));
			
		}
	}
	
	
	
	function occupation($days,$cur_month,$cur_year){
		$allRooms=count($this->Reservation->Chambre->find('all',array('fields'=>array('Chambre.id'))));
		$mean=$hosted=$in=0;
		$ids=array();
		for($i=1;$i<=$days;$i++){
			$cur_day=($i<10)?('0'.$i):($i);
			$month=($cur_month<10)?('0'.$cur_month):($cur_month);
			$data['Reservation']['arrivee']=$cur_year.'-'.$month.'-'.$cur_day; 
			$data['Reservation']['depart']=$cur_year.'-'.$month.'-'.$cur_day;
			$results=$this->_checker($data,true);
			$occupation['journalier'][]=($results['not_available']/$allRooms)*100;
			$occupation['in'][]=$results['in'];
			$occupation['hosted'][]=$results['hosted'];
			$mean=$mean+$results['not_available'];
			$ids=array_merge($ids,$results['ids']);
		/*	
		 if($data['Reservation']['arrivee']=='2012-01-11'){
				die(debug($this->Reservation->find('all',array('conditions'=>array('Reservation.id'=>$results['ids'],
																	'Reservation.etat'=>'arrivee'
																	),
												'fields'=>array('Reservation.*',
																)
												))));
			}
		//*/
		}
		$occupation['mensuelle']=round((($mean/$days)/$allRooms)*100,2);
		
		//hebergement stuff
		$intotal=$this->Reservation->find('all',array('conditions'=>array('Reservation.id'=>$ids,
																	'Reservation.etat'=>'arrivee'
																	),
												'fields'=>array('count(Reservation.id) as id',
																)
												));
		$hostedtotal=$this->Reservation->find('all',array('conditions'=>array('Reservation.id'=>$ids,
																	'Reservation.etat'=>array('partie','arrivee')
																	),
												'fields'=>array('count(Reservation.id) as id',
																)
												));
		$occupation['in-total']=$intotal[0]['Reservation']['id'];
		$occupation['hosted-total']=$hostedtotal[0]['Reservation']['id'];
		
		if($this->RequestHandler->isAjax()){
			$this->layout="ajax";
			$this->set(compact('occupation','days'));
			$this->render('occupation');
		}
		else {
			return $occupation;
		}
	}
	
	function facture_globale($factureId,$payee='no',$detailed=1,$export_to_xls=0){
		$reservation=$this->Reservation->Facture->find('first',array('fields'=>array('Facture.*','Tier.*'),
																'conditions'=>array(
																					'Facture.id'=>$factureId,
																					)
																)
													);
		if($reservation['Facture']['etat']=='canceled'){
				$this->redirect(array('controller'=>'factures','action'=>'view/'.$reservation['Facture']['id']));
		}

		$modelInfos=$this->Reservation->find('all',array('fields'=>array('Reservation.*','Chambre.name','Chambre.type_chambre_id'),
															'conditions'=>array('Reservation.facture_id'=>$factureId),
															'order'=>array('Reservation.arrivee')
															)
												);
		//getting the list of rooms from the array of reservations
		foreach($modelInfos as $chambre){
			$chambres[]=$chambre['Chambre']['name'];
		}						
		$chambres=implode('&',$chambres);
		
		$arrivee=$modelInfos[0]['Reservation']['arrivee'];
		$depart=$modelInfos[count($modelInfos)-1]['Reservation']['depart'];
		
		
		$tierId=$reservation['Tier']['id'];
		//determining which departure date to use for extras 
		$departPlus1=$this->Product->increase_date($depart);
		$search=$this->Reservation->find('first',array('fields'=>array('Reservation.id'),
															'conditions'=>array('Reservation.tier_id'=>$tierId,
																				'Reservation.arrivee'=>$departPlus1,
																				'Reservation.etat !='=>'canceled'
																			),
															)
												);
		$depart=(empty($search))?$departPlus1:$depart;
			
		$pyts=$this->Reservation->Facture->Paiement->find('all',array('fields'=>array('Paiement.*',
																					'Personnel.name',
																					'Facture.id',
																					'Facture.numero',
																					'Facture.monnaie',
																					'Facture.operation',
																					'Facture.date',
																					),
																'conditions'=>array('Facture.tier_id'=>$tierId,
																					'OR'=>array(array('Facture.date >='=>$arrivee,
																									'Facture.date <='=>$depart,
																									'Facture.operation !='=>'Reservation'
																									),
																								array('Facture.id'=>$reservation['Facture']['id'])
																								)
																					),
																'order'=>array('Facture.operation',
																				'Facture.id',
																				'Paiement.date',
																				'Paiement.id',
																			)			
																)
													);
		$synthesePyts=$this->Product->synthese_pyts($pyts);
		$sumPyts=$this->Reservation->Facture->Paiement->find('all',array('fields'=>array('sum(Paiement.montant) as montant',
																					'sum(Paiement.montant_equivalent) as montant_equivalent',
	 																				'Facture.monnaie',
	 																				'Paiement.monnaie'
																					),
																		'conditions'=>array('Facture.tier_id'=>$tierId,
																						'OR'=>array(array('Facture.date >='=>$arrivee,
																									'Facture.date <='=>$depart,
																									'Facture.operation !='=>'Reservation'
																									),
																								array('Facture.id'=>$reservation['Facture']['id'])
																								)
																						),
																		'group'=>array('Facture.monnaie','Paiement.monnaie')
																));
		$cond['Facture.tier_id']=$tierId;
		
		$cond['Facture.date >=']=(empty($this->data['Reservation']['date1']))?$arrivee:$this->data['Reservation']['date1'];
		$cond['Facture.date <=']=(empty($this->data['Reservation']['date2']))?$depart:$this->data['Reservation']['date2'];
		
		$cond['Facture.etat']=($payee=='yes')?array('credit','half_paid','paid','in_progress','printed'):array('credit','half_paid','in_progress','printed');
		
			$this->Product->company_info();
			
			$cond['Facture.operation !=']='Reservation';
			
			$extras_factures=$this->Reservation->Facture->find('all',array('fields'=>array('Facture.*'),
																'conditions'=>$cond,
																'contain'=>array('Service'=>array('fields'=>array('Service.id','Service.type_service_id'),
																								'limit'=>1
																								))
																)
													);
			//exit(debug($extras_factures));
			//grouping all pos extras according to gpe comptable
			$ventes=$this->Product->gpeCptable($extras_factures);
			
			$sums=$this->Reservation->Facture->find('all',array('fields'=>array('Facture.*',
																						'sum(Facture.montant) as montant',
																						'sum(Facture.reste) as reste',
																						'sum(Facture.tva) as tva',
																						),		
																'conditions'=>$cond,
																'group'=>array('Facture.monnaie')
																)
												);
			$devise['RWF']=$usd=($this->Conf->find('taux_usd')>0)?$this->Conf->find('taux_usd'):1;
			$devise['USD']=1;
			$total_usd=0;
			foreach($sums as $sum){
				if(isset($devise[$sum['Facture']['monnaie']])){
					$total_usd+=round($sum['Facture']['reste']/$devise[$sum['Facture']['monnaie']]);
				}
			}
			$taux_tva=$this->Conf->find('tva');
			$modePaiements=$this->modePaiements;
			$modePaiements['transfer']='Transfer';
			$modeImpression=array(''=>'')+$this->modePaiements+array('credit'=>'credit','combinaison'=>'combinaison');
			$this->set(compact(
							'synthesePyts',
							'ventes',
							'usd',
							'total_usd',
							'reservation',
							'extras_factures',
							'modelInfos',
							'total',
							'tva',
							'reste',
							'sums',
							'factureId',
							'taux_tva',
							'extras',
							'paid',
							'pyts',
							'sumPyts',
							'modePaiements',
							'arrivee',
							'depart',
							'chambres',
							'detailed'
							)
					);
			if($export_to_xls){
				$data['company_info']=$this->Product->company_info();
				$data['signature']=$this->Conf->find('signature');
				$data['Facture']=$reservation['Facture'];
				$data['Facture']['numero']=($export_to_xls==2)?$data['Facture']['aserb_num']:$data['Facture']['numero'];
				$data['extras']=$extras_factures;
				$data['model']='Reservation';
				$data['nature']='';
				$data['Tier']=$reservation['Tier'];
				$data['modelInfos']=$modelInfos;
				$filename=$this->Product->bill2xls($data);
				$this->redirect('/files/'.$filename);
			}
	}
	
	function room_changer($id,$old,$new,$date,$pu=null){
		$newRoom=$this->Reservation->Chambre->find('first',array('fields'=>array('Chambre.id',
																							'TypeChambre.id',
																							'TypeChambre.montant',
																							),
																				'conditions'=>array('Chambre.name'=>$new
																				)
																	));
		$old_res=$this->Reservation->find('first',array('fields'=>array('Reservation.*','Facture.etat','Facture.monnaie'),
																		'conditions'=>array('Reservation.id'=>$id
																		)
																	));
		$date=($old_res['Reservation']['arrivee']>=$date) ? $old_res['Reservation']['arrivee']:$date;
		if(($date<$old_res['Reservation']['arrivee'])||($old_res['Reservation']['depart']<$date)){
			exit(json_encode(array('success'=>false,'msg'=>'Cette Date du '.$this->Product->tofrench($date).' incorrecte!')));
		}
		$old_depart=$old_res['Reservation']['depart'];
		//checking again if the room is available. this is required when the user gives a date different than today
		if($date!=date('Y-m-d')){
			$data['Chambre']['id']=$newRoom['Chambre']['id'];
			$data['Reservation']['arrivee']=$date;
			$data['Reservation']['depart']=$old_depart;
			if($this->_conflict($data)){
				exit(json_encode(array('success'=>false,'msg'=>"La chambre $new n'est pas disponible à partir du $date.")));
			}
		}
		$old_state=$old_res['Reservation']['etat'];
		$old_res['Reservation']['etat']='changee';
		//removing any demi journée 
		$demi=$old_res['Reservation']['demi'];
		$old_res['Reservation']['demi']=0;
		$old_res['Reservation']['depart']=$this->Product->increase_date($date,-1);
		$nuitee=$this->Product->diff($old_res['Reservation']['arrivee'], $old_res['Reservation']['depart'])+1;		
		$old_res['Reservation']['montant']=$old_res['Reservation']['PU']*$nuitee;
		if($old_res['Reservation']['montant']<=0){
			$this->Reservation->delete($id);
		}
		else {
			$this->Reservation->save($old_res);
		}
		//creating the new reservation
		$new_res=$old_res;
		$new_res['Reservation']['id']=null;
		$new_res['Reservation']['chambre_id']=$newRoom['Chambre']['id'];
		$new_res['Reservation']['arrivee']=$date;
		$new_res['Reservation']['depart']=$old_depart;
		$new_res['Reservation']['etat']=$old_state;
		$nuitee=$this->Product->diff($new_res['Reservation']['arrivee'], $new_res['Reservation']['depart'])+1;	
		if(empty($pu)){
			$pu = ($old_res['Facture']['monnaie']=='RWF') ? $old_res['Reservation']['PU'] : $newRoom['TypeChambre']['montant'];
		}
		$new_res['Reservation']['PU']=$pu;	
		$new_res['Reservation']['montant']=$new_res['Reservation']['PU']*$nuitee;
		$new_res['Reservation']['demi']=$demi;
		$new_res['Reservation']['montant']=($new_res['Reservation']['demi']==1)?
											($new_res['Reservation']['montant']+($new_res['Reservation']['PU']*($new_res['Reservation']['tauxDemi']/100))):
											$new_res['Reservation']['montant'];
		
		$this->Reservation->save($new_res);
		$newId=$this->Reservation->id;
		
		//updating the bill
		
		if(!empty($old_res['Reservation']['facture_id'])){
			$this->Product->factureMontantRes(array(0=>$old_res));
		}
		
		//tracing stuff old room
		$trace['Trace']['model_id']=$id;
		$trace['Trace']['model']='Reservation';
		$trace['Trace']['operation']='Délogement : de la chambre '.$old.' à la chambre '.$new;
		$this->Reservation->Trace->save($trace);
		
		//tracing stuff new room
		$trace['Trace']['model_id']=$newId;
		$trace['Trace']['id']=null;
		$this->Reservation->Trace->save($trace);
		
		exit(json_encode(array('success'=>true)));
																	
	}
	
	function departure_changer($id,$depart,$room,$updateBooking,$arrivee=''){
		//go back one date 
		$depart=$this->Product->increase_date($depart,-1);
		//fetching the reservation info
		$info=$this->Reservation->find('first',array('conditions'=>array('Reservation.id'=>$id),
													'fields'=>array('Reservation.*','Facture.etat')
													));
		//saving the old dates
		$old_arrivee=$info['Reservation']['arrivee'];
		$old_depart=$info['Reservation']['depart'];
		
		if($info['Reservation']['etat']!='partie'){
		
			$chambre=$this->Reservation->Chambre->find('first',array('conditions'=>array('Chambre.name'=>$room),
																				'fields'=>array('Chambre.id')
																				)
																	);
			$data['Reservation']['depart']=$depart;
			if(($arrivee!='')&&($info['Reservation']['etat']=='arrivee')){
				exit(json_encode(array('success'=>false,'msg'=>"Impossible de changer la date d'arrivée! Car la Personne est déjà arrivée.")));
			}
			$data['Reservation']['arrivee']=($arrivee!='')?$arrivee:$info['Reservation']['arrivee'];
			if($depart<$data['Reservation']['arrivee']){
				exit(json_encode(array('success'=>false,'msg'=>"Erreur ! Date de départ inférieure à la date d'arrivée")));
			}
			$data['Reservation']['id']=$id;
			$data['Chambre']['id']=$chambre['Chambre']['id'];
			if(!$this->_conflict($data)){
				if($updateBooking=='yes'){
					$nuitee=$this->Product->diff($data['Reservation']['arrivee'], $depart)+1;		
					$old_montant=$info['Reservation']['montant'];				
					$info['Reservation']['montant']=$info['Reservation']['PU']*$nuitee;
					$info['Reservation']['montant']=($info['Reservation']['demi']==1)?
												($info['Reservation']['montant']+($info['Reservation']['PU']*($info['Reservation']['tauxDemi']/100))):
												$info['Reservation']['montant'];
					$info['Reservation']['depart']=$depart;
					$info['Reservation']['arrivee']=$data['Reservation']['arrivee'];
					$this->Reservation->save($info);
					//updating the bill if any 
					if(!empty($info['Reservation']['facture_id'])){
						$this->Product->factureMontantRes(array(0=>$info));
					}
						//tracing stuff
					$trace['Trace']['model_id']=$id;
					$trace['Trace']['model']='Reservation';
					$trace['Trace']['operation']='Changement des dates: De '.$this->Product->formatDate($old_arrivee).' -> '.
												$this->Product->formatDate($old_depart).' --à-- '.
												$this->Product->formatDate($info['Reservation']['arrivee']).' -> '.
												$this->Product->formatDate($info['Reservation']['depart']);
					$this->Reservation->Trace->save($trace);
				}
				exit(json_encode(array('success'=>true)));
			}
			else 	exit(json_encode(array('success'=>false,'msg'=>"Erreur ! Conflit entre réservations.")));
		}
		else {
			exit(json_encode(array('success'=>false,'msg'=>'Réservation non modifiable!')));
		}	
	}


	/**
	 * This function adds a half day
	 */
	function demi($id,$auto=false,$tauxDemi=0){
		$info=$this->Reservation->find('first',array(
												'fields'=>array('Reservation.*','Facture.etat'),
												'conditions'=>array('Reservation.id'=>$id)));
		if(!$tauxDemi&&!$auto&&($info['Reservation']['demi']==0)){
			exit(json_encode(array('success'=>false)));
		}
		$demiPu=$info['Reservation']['PU']*($tauxDemi/100);		
		$old_montant=($this->Product->diff($info['Reservation']['arrivee'], $info['Reservation']['depart'])+1)*$info['Reservation']['PU'];			
		$info['Reservation']['montant']=($info['Reservation']['demi']==0)?$old_montant+$demiPu:$old_montant;
		if($info['Reservation']['demi']==0){
			$msg='Demi journée ajoutée.';
			$info['Reservation']['tauxDemi']=$tauxDemi;
			$info['Reservation']['demi']=1;
		}
		else {
			
			$msg='Demi journée enlevée.';
			$info['Reservation']['tauxDemi']=0;
			$info['Reservation']['demi']=0;
		}
		$this->Reservation->save($info);
			//updating the bill if any 
		if(!empty($info['Reservation']['facture_id'])){
			$this->Product->factureMontantRes(array(0=>$info));
		}
		if(!$auto){
			//tracing stuff
			$trace['Trace']['model_id']=$id;
			$trace['Trace']['model']='Reservation';
			$trace['Trace']['operation']=$msg;
			$this->Reservation->Trace->save($trace);
			exit(json_encode(array('success'=>true,'msg'=>$msg)));
		}
	}
	/**
	 * This function update a booking's state
	 */
	function state_updater($id,$state,$obs='',$force=0,$heure=""){
		$update['Reservation']['id']=$id;
		$info=$this->Reservation->find('first',array('fields'=>array('Reservation.etat',
																'Facture.etat',
																'Reservation.facture_id',
																'Reservation.id'
																),
													'conditions'=>array('Reservation.id'=>$id)));
													
		//prevent any modification if the customer has already left
		$fonction=$this->Auth->user('fonction_id');
		if((in_array($info['Reservation']['etat'],array('partie','credit')))&&(!in_array($fonction,array(3,5)))){
			exit(json_encode(array('success'=>false,'msg'=>'Réservation non modifiable!')));
		}	
		$factureId=$info['Reservation']['facture_id'];
		
		if(($state=='partie')&&!in_array($info['Facture']['etat'],array('paid','excedent'))){
			if($force==1){
				$state='credit';
			}
			else 
				exit(json_encode(array('success'=>true,'confirm'=>true,
				'msg'=>'Ce client n\'a pas encore tout payée. Voulez vous vraiment continuer?')));
		}
		$info['Reservation']['etat']=$state;
		
		if(($state=='canceled')&&($factureId!=null)&&(!in_array($fonction,array(3,5)))){
			exit(json_encode(array('success'=>false,'msg'=>'Vous n\'avez pas le droit d\'annuler la réservation')));
		}
		
		//annuler la facture aussi if any
		if(($state=='canceled')&&($factureId)){
			$this->Product->remove_facture($factureId,'Reservation',$obs);
		}
		else if($state=='canceled'){
			$this->Reservation->delete($id);
		}
		else {
			if(in_array($state,array('partie','credit'))){
				$info['Reservation']['observation']=$obs;
				if(($heure!='')&&($heure!='undefined')){
					$time=explode('.',$heure);
					$info['Reservation']['heure_depart']['hour']=$time[0];
					$info['Reservation']['heure_depart']['min']=$time[1];
					$info['Reservation']['heure_depart']['meridian']=$time[2];
				}
				else 
					$info['Reservation']['heure_depart']=date('H:i:s');
			}
			$this->Reservation->save($info);
		}
		
		//tracing stuff
		$trace['Trace']['model_id']=$id;
		$trace['Trace']['model']='Reservation';
		$trace['Trace']['operation']='Changement de l\'etat : de '.$info['Reservation']['etat'].' à '.$state;
		$this->Reservation->Trace->save($trace);
		exit(json_encode(array('success'=>true,'state'=>$state)));
	}
	
	
	function _search_key($datas,$chambre){
		foreach($datas as $key=>$data){
			if(preg_match('#^'.$chambre.'_#i', $key)){
				return $key;
			}
		}
	}
	/*
	 * This function tabella will handle all tasks related to the display of bookings for a given year,month 
	 * Will receive parameters likes year/month to display and much more I hope!
	 */
	 
	function tabella($month=null,$year=null) {
	//setting up values for current month & year
		$month=($month!='10')?str_replace('0','',$month)*1:10;
		if(($month==null)||($month<=0)||($month>12)||($year==null)||($year<=0)) { //roomsDetails invalid values
			$cur_month=date('n');
			$cur_year=date('Y');
		}
		else {
			$cur_month=$month;
			$cur_year=$year;
		}
		//setting up the first day of the current month in mysql format
		$month_first_day=(in_array($cur_month,array(10,11,12)))?($cur_year.'-'.$cur_month.'-01'):($cur_year.'-0'.$cur_month.'-01'); 
	//setting up values for previous month & year
		if(($cur_month-1)==0) {
			$prev_month=12;	
			$prev_year=(($cur_year-1)==0)?($cur_year):($cur_year-1);
		}
		else {
			$prev_month=$cur_month-1;
			$prev_year=$cur_year;
		}
	//setting up values for next month & year
		if(($cur_month+1)==13) {
			$next_month=1;	
			$next_year=$cur_year+1;
		}
		else {
			$next_month=$cur_month+1;
			$next_year=$cur_year;
		}
		$days=cal_days_in_month(CAL_GREGORIAN,$cur_month,$cur_year); //to get how manys days within the current month
		
		$mois=(in_array($cur_month,array(10,11,12)))?$cur_month:'0'.$cur_month; 
		
		$reservations=$this->Reservation->find('all',array('fields'=>array('Reservation.id',
																			'Reservation.arrivee',
																			'Reservation.depart',
																			'Reservation.etat',
																			'Reservation.facture_id',
																			'Chambre.name',
																			'Chambre.id',
																			'Tier.name',
																			'Tier.id'
																			),
															'order'=>'Reservation.arrivee asc',
															'conditions'=>array('Reservation.etat !='=>'canceled',
																				'Reservation.chambre_id !='=>null,
																				'Reservation.montant >='=>0,
																				'Reservation.arrivee !='=>'0000-00-00',
																				'Reservation.depart !='=>'0000-00-00',
																			//
																				'OR'=>array(array('month(Reservation.arrivee)'=>$mois,
																								'year(Reservation.arrivee)'=>$cur_year,
																								),
																						array('month(Reservation.depart)'=>$mois,
																							'year(Reservation.depart)'=>$cur_year,
																							),
																						array('Reservation.depart >'=>$cur_year.'-'.$mois.'-'.$days,
																							'Reservation.arrivee <'=>$cur_year.'-'.$mois.'-01',
																						),
																						)
																				)
															)
												);
		
		$roomsDetails=array();
		$chambres=$this->Chambre->find('all',array('fields'=>array('Chambre.name',
																'TypeChambre.name',
																'Chambre.propre',
																'Chambre.etage'
																),
												  'order'=>'Chambre.name asc',
												  'conditions'=>array(
												  				//	'Chambre.type_chambre_id'=>1,
												  				//	'Chambre.id'=>1,
												  				//	'Chambre.operationnelle'=>'yes'
												  					)
													)
									);
		foreach( $chambres as $chambre){
			$roomsDetails[$chambre['Chambre']['name'].'_'.$chambre['TypeChambre']['name'].'_'.$chambre['Chambre']['etage']]=array();
		}
		$i=0;
		foreach($reservations as $reservation){
			
			$details['etat']=$reservation['Reservation']['etat'];
			$details['tier_name']=$reservation['Tier']['name'];		
			$details['tier_id']=$reservation['Tier']['id'];			
			$details['reservation_id']=$reservation['Reservation']['id'];		
			$details['facture_id']=(!empty($reservation['Reservation']['facture_id']))?($reservation['Reservation']['facture_id']):(0);	
			$details['arrivee']=$reservation['Reservation']['arrivee'];
			$details['depart']=$reservation['Reservation']['depart'];
			if($this->_search_key($roomsDetails, $reservation['Chambre']['name'])==''){
				continue;
			}
			$roomsDetails[$this->_search_key($roomsDetails, $reservation['Chambre']['name'])][$i]=$details;
			$i++;
		}
		//test for displaying rooms with problems
		$rooms=$this->Chambre->find('all',array('fields'=>array('Chambre.name',
																'Chambre.message',
															'TypeChambre.name',
															'Chambre.etage'
															),
												  'order'=>'Chambre.name asc',
												  'conditions'=>array(
												  					'Chambre.operationnelle'=>'no'
												  					)
													)
									);
		$details['etat']='disabled';
		$details['tier_id']=null;			
		$details['reservation_id']=null;		
		$details['facture_id']=null;	
		$details['arrivee']=date('Y-m-d');
		$details['depart']=$cur_year.'-'.$mois.'-'.$days;
		foreach($rooms as $room){
			$details['tier_name']=$room['Chambre']['message'];
			$position=count($roomsDetails[$room['Chambre']['name'].'_'.$room['TypeChambre']['name'].'_'.$room['Chambre']['etage']]);		
			$roomsDetails[$room['Chambre']['name'].'_'.$room['TypeChambre']['name'].'_'.$room['Chambre']['etage']][$position]=$details;
		}
	//	die(debug($roomsDetails));
		//taux d'occupation calculeus
		$occupation=$this->occupation($days, $cur_month, $cur_year);
		$chambres1 = $this->Reservation->Chambre->find('list',array('order'=>'Chambre.name asc'));
		$etats=array('en_attente'=>'Pending',
					'confirmee'=>'Confirmed',
					'arrivee'=>'Checked IN',
					'partie'=>'Checked OUT',
					'changee'=>'Switched',
					'credit'=>'Not Payed'
					);
		$this->set(compact('etats',
							'days',
						   'roomsDetails',
						   'next_month',
						   'prev_month',
						   'next_year',
						   'prev_year',
						   'cur_month',
						   'cur_year',
						   'month_first_day',
						   'occupation',
						   'tiers',
						   'typeChambres',
						   'chambres1',
						   'etages',
						   'typeServices'
						   )
				);
	}
	
	function availability($id=0,$remote_params=''){
		header('content-type: application/json; charset=utf-8');
		header("access-control-allow-origin: *");
		//recieving and handling remote parameters
		if($remote_params!=''){
			$params=explode(';',$remote_params);
			$this->data['Reservation']['arrivee']=$params[0];
			$this->data['Reservation']['depart']=$params[1];
			$this->data['Reservation']['type_chambre_id']=$params[2];
		} 
		//*/
		if($id>0){
			$this->data=$this->Reservation->find('first',array('fields'=>array('Reservation.arrivee',
																'Reservation.depart',
																	),
																'conditions'=>array('Reservation.id'=>$id
																					)
																));
			$date=date('Y-m-d');
			$this->data['Reservation']['arrivee']=($this->data['Reservation']['arrivee']>=$date)?
																						$this->data['Reservation']['arrivee']
																						:$date; //consider availabiliy from today or from arrival date only if it is in the future
			unset($this->data['Reservation']['id']);
			
		}
		if(is_null($id)&&($this->data['Reservation']['arrivee']>$this->data['Reservation']['depart'])){
			exit(json_encode(array('success'=>false,'msg'=>'Erreur! La date d\'arrivée est supérieure à la date de départ.')));
		}
		else if(is_null($id)&&($this->data['Reservation']['arrivee']<date('Y-m-d'))){
			exit(json_encode(array('success'=>false,'msg'=>'Erreur! La date d\'arrivée doit être supérieure ou égale à la date actuelle.')));
		}
		$results=$this->_checker($this->data,true);
		
	//	$conds['NOT']=array('Chambre.id'=>$results['rooms']);
		$conds['Chambre.operationnelle']='yes';
		if(!empty($this->data['Reservation']['type_chambre_id'])){
				$conds['Chambre.type_chambre_id']=$this->data['Reservation']['type_chambre_id'];
		}
		if(!empty($this->data['Reservation']['etage'])){
			$conds['Chambre.etage']=$this->data['Res`ervation']['etage'];
		}
		
		$allRooms=$this->Reservation->Chambre->find('all',array('fields'=>array('Chambre.id','Chambre.name','TypeChambre.name'),
																'conditions'=>$conds,
																'order'=>array('Chambre.name desc')
																));
		$freeRooms=array();
		foreach($allRooms as $room){
			if(!in_array($room['Chambre']['id'], $results['rooms'])){
				$freeRooms[$room['Chambre']['name']]=$room['Chambre']['name'].' - '.$room['TypeChambre']['name'];
			}
		}
		$results['freeRooms']=$freeRooms;
		$results['available']=count($results['freeRooms']);
		$results['success']=true;
		die(json_encode($results));
	}
	
	function _checker($data,$one=false){
		if (!empty($data)) {
			$arrivee=$data['Reservation']['arrivee'];
			$depart=$data['Reservation']['depart'];
			$conditions=array();
			$conditions['Reservation.etat !=']='canceled';
			$condRooms=array();
			$condRooms['Chambre.operationnelle']='yes';
			if(!empty($data['Reservation']['id'])){
				$conditions['Reservation.id !=']=$data['Reservation']['id'];
			}
		//*/
			
			$reservations=$this->Reservation->find('all',array('fields'=>array('Reservation.id',
																			'Reservation.arrivee',
																			'Reservation.depart',
																			'Reservation.etat',
																			'Reservation.chambre_id'
																			),
															'conditions'=>$conditions
															));
			
			$notAvailable=0;
			$in=$hosted=0;
			$rooms=$ids=array();
			$i=array();
			if(!$one){ //one pour day basis on fait <= ou >= on tient compte d'un seul jour
				foreach($reservations as $reservation) {
					if(($arrivee<$reservation['Reservation']['depart'])and($depart>$reservation['Reservation']['arrivee'])) {
						$i[]=$reservation['Reservation']['id'];
						if(!in_array($reservation['Reservation']['chambre_id'],$rooms)){
							$rooms[]=$reservation['Reservation']['chambre_id'];
							$notAvailable++;
						}
					}
				}
			}
			else {
				foreach($reservations as $reservation) {
					if(($arrivee<=$reservation['Reservation']['depart'])and($depart>=$reservation['Reservation']['arrivee'])) {
						
						//hebergement stuff
						if($reservation['Reservation']['etat']=='arrivee'){
							$in++;
						}
						if(in_array($reservation['Reservation']['etat'],array('partie','arrivee'))){
							$hosted++;
						}
						$ids[]=$reservation['Reservation']['id'];
						//we save in the list only the rooms not available for the period. and we avoid repeating some rooms
						if(!in_array($reservation['Reservation']['chambre_id'],$rooms)){
							$rooms[]=$reservation['Reservation']['chambre_id'];
							$notAvailable++;
						}
					}
				}
			}
			$allRooms=count($this->Reservation->Chambre->find('all',array('fields'=>array('Chambre.id'),
																						'conditions'=>$condRooms
																						)));
			$available=(($allRooms-$notAvailable)<0)?(0):($allRooms-$notAvailable); //Don't want to show up negative results
			$results['available']=$available;
			$results['not_available']=$notAvailable;
			$results['rooms']=$rooms;
			$results['allRooms']=$allRooms;
			$results['in']=$in;
			$results['hosted']=$hosted;
			$results['ids']=$ids;
			$results['i']=$i;
			//*
			if(!empty($data['Reservation']['chambre_id'])){
				$reservations=$this->Reservation->find('all',array('fields'=>array('Reservation.arrivee','Reservation.depart','Reservation.chambre_id'),
																			'conditions'=>array('Reservation.chambre_id'=>$this->data['Reservation']['chambre_id'],
																								'Reservation.etat !='=>'canceled'
																								)
																			)
																);
				foreach($reservations as $reservation){
					if(($arrivee<$reservation['Reservation']['depart'])and($depart>$reservation['Reservation']['arrivee'])) {
						$results['available']=0;
					}
				}
			}
		//*/
		//	die(debug($results));
			return $results;
		}
	}

	
	
	
	
	function _conflict($data){
		$return=false;
		if(isset($data['Reservation']['id'])){
			$conditions['Reservation.id !=']=$data['Reservation']['id'];
		}
		$conditions['Reservation.etat !=']='canceled';
		$conditions['Reservation.chambre_id']=$data['Chambre']['id'];
		$reservations=$this->Reservation->find('all',array('fields'=>array('Reservation.arrivee','Reservation.depart','Reservation.chambre_id'),
																			'conditions'=>$conditions
																			)
																);
		foreach($reservations as $reservation){
			if(($data['Reservation']['arrivee']<=$reservation['Reservation']['depart'])and($data['Reservation']['depart']>=$reservation['Reservation']['arrivee'])) {
					$return=true;
					break;
			}
		}
		
		return $return;
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->Reservation->set($this->data);
			if(!$this->Reservation->validates()){
				exit(json_encode(array('success'=>false,'msg'=>'Impossible d\'enregistrer données incorrectes !')));
			}
			//expecting only single cad one by one booking not multi booking
			$chambreDetails=$this->Chambre->find('first',array('fields'=>array('Chambre.id',
																			'Chambre.type_chambre_id',
																			'TypeChambre.montant',
																			'TypeChambre.monnaie',
																			),
														'conditions'=>array('Chambre.name'=>$this->data['Reservation']['room']),
														)
											);
			$this->data['Reservation']['type_chambre_id']=$chambreDetails['Chambre']['type_chambre_id'];
			$this->data['Chambre']['id']=$chambreDetails['Chambre']['id'];
			$this->data['Reservation']['chambre_id']=$chambreDetails['Chambre']['id'];
			$this->data['Reservation']['PU_standard']=$chambreDetails['TypeChambre']['montant'];
			//to use the other departure date for crossing month booking period
			$this->data['Reservation']['depart']=(!empty($this->data['Reservation']['autre_depart']))?
												($this->Product->increase_date($this->data['Reservation']['autre_depart'],-1)):													
												($this->data['Reservation']['depart']);
			if($this->data['Reservation']['depart']<$this->data['Reservation']['arrivee']){
				exit(json_encode(array('success'=>false,'msg'=>'Période sélectionnée incorrecte!')));
			}									
			//check for conflict
			if(!$this->_conflict($this->data)){
					//Detemination du montant
				$nuitee=$this->Product->diff($this->data['Reservation']['arrivee'], $this->data['Reservation']['depart'])+1;
				if(empty($this->data['Reservation']['PU'])){
					$this->data['Reservation']['PU']=$chambreDetails['TypeChambre']['montant'];
					$this->data['Reservation']['monnaie']=$chambreDetails['TypeChambre']['monnaie'];
				}										
				$this->data['Reservation']['montant']=$this->data['Reservation']['PU']*$nuitee;
				$this->Reservation->save($this->data);
					
				//tracing stuff
				$trace['Trace']['model_id']=$this->Reservation->id;
				$trace['Trace']['model']='Reservation';
				$trace['Trace']['operation']='Création de la réservation avec l\'état : '.$this->data['Reservation']['etat'];
				$this->Reservation->Trace->save($trace);
					
				exit(json_encode(array('id'=>$this->Reservation->id,'success'=>true)));
									
			}
			else 
				die(json_encode(array('success'=>false,'msg'=>'Ressources insuffisante pour cette reservation !')));
				
		} 
	}

	function price_updater($id,$pu,$monnaie){
		$info=$this->Reservation->find('first',array('conditions'=>array('Reservation.id'=>$id),
													'fields'=>array('Reservation.*','Facture.etat')
													));
	
		if($info['Reservation']['etat']!='partie'){
			$nuitee=$this->Product->diff($info['Reservation']['arrivee'], $info['Reservation']['depart'])+1;		
			$old_montant=$info['Reservation']['montant'];
			$old_pu=$info['Reservation']['PU'];
			$old_monnaie=$info['Reservation']['monnaie'];
			$info['Reservation']['montant']=$pu*$nuitee;
			$info['Reservation']['monnaie']=$monnaie;
			$info['Reservation']['PU']=$pu;
			//demi journéé handling
			$info['Reservation']['montant']=($info['Reservation']['demi']==1)?
											($info['Reservation']['montant']+($info['Reservation']['PU']*($info['Reservation']['tauxDemi']/100))):
											$info['Reservation']['montant'];
			$this->Reservation->save($info);
			//updating the bill if any 
			if(!empty($info['Reservation']['facture_id'])){
				$this->Product->factureMontantRes(array(0=>$info),$monnaie);
			}
			//tracing stuff
			$trace['Trace']['model_id']=$id;
			$trace['Trace']['model']='Reservation';
			$trace['Trace']['operation']="Changement du PU : de $old_pu $old_monnaie à $pu $monnaie";
			$this->Reservation->Trace->save($trace);
			
			exit(json_encode(array('success'=>true,'msg'=>'Changement réussi !')));
		}
		else {
			exit(json_encode(array('success'=>false,'msg'=>'Réservation non modifiable!')));
		}
	}
	
}
?>