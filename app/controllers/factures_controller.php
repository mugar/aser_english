<?php
class FacturesController extends AppController {

	var $name = 'Factures';

	/**
	* checks the availability of an aserb number
	*/

	function check_aserb_number_availability($id,$desired_number){
		$facture=$this->Facture->find('first',array('fields'=>array('Facture.id',
                                    'Facture.operation',
                                    'Facture.date',
                                    ),
                            'conditions'=>array('Facture.id'=>$id),
                      )); 
		$cond['Facture.aserb_num']=$desired_number;
		if(Configure::read('aser.facturation_cyclique')){
				$cond['Facture.operation']=$facture['Facture']['operation'];
				$cond['Facture.id !=']=$id;
			
				$date_parts=explode('-',$facture['Facture']['date']);
				$year=$date_parts[0];
			
				$cond['year(Facture.date)']=$year;
		}

		$search=$this->Facture->find('first',array(
														'recursive'=>-1,
														'fields'=>array('Facture.aserb_num'),
														'conditions'=>$cond
													));
		if(empty($search)){
			$facture['Facture']['aserb_num']=$desired_number;
			if($this->Facture->save($facture)){
				exit(json_encode(array('success'=>true)));
			}
			else {
				exit(json_encode(array('success'=>false,'msg'=>'Probleme avec l enregistrement du numero')));
			}
		}
		else {
				exit(json_encode(array('success'=>false,'msg'=>'Numero non disponible')));
		}
	}
	
	/**
	* reports of all aserb_numbers
	*/

	function aserb_report(){
		$cond['Facture.etat !=']='annulee';
		$cond['Facture.aserb_num >']=0;
		
    if(!empty($this->data['Facture']['date1'])){
    	$date1=$this->data['Facture']['date1'];
      $cond['OR'][]=array('Facture.aserb_date >='=>$date1,'Facture.date >='=>$date1);
    }
    else {
    	$date1=date('Y-m-d');
    	$cond['OR'][]=array('Facture.aserb_date >='=>$date1,'Facture.date >='=>$date1);
    }
    
    if(!empty($this->data['Facture']['date2'])){
    	$date2=$this->data['Facture']['date2'];
      $cond['OR'][]=array('Facture.aserb_date <='=>$date2,'Facture.date <='=>$date2);
    }
    else {
    	$date2=date('Y-m-d');
      $cond['OR'][]=array('Facture.aserb_date <='=>$date2,'Facture.date <='=>$date2);
    }
    if(!empty($this->data['Tier']['compagnie'])){
      $cond['Tier.compagnie']=$this->data['Tier']['compagnie'];
    }
    if(!empty($this->data['Facture']['tier_id'])){
      $cond['Facture.tier_id']=$this->data['Facture']['tier_id'];
    }
    //  exit(debug($cond));
    $factures=$this->Facture->find('all',array('fields'=>array('Facture.*',
                                    'Tier.name',
                                    'Tier.compagnie'
                                    ),
                            'conditions'=>$cond,
                      )); 
                  
         
    $this->set(compact('factures','date1','date2'));
	}
	/**
	* generate aserb number
	*/
	function generate_aserb_number($id){
		$facture = $this->Facture->find('first',array('conditions'=>array('Facture.id'=>$id),'recursive'=>-1));
		if(!empty($facture['Facture']['aserb_num'])){
			exit(json_encode(array('success'=>true,'no'=>$facture['Facture']['aserb_num'])));
		}
		else {
			if(Configure::read('aser.facturation_cyclique')){
				$cond['Facture.operation']=$facture['Facture']['operation'];
				$cond['Facture.aserb_num !=']=null;
				$cond['Facture.id !=']=$id;
			
				$date_parts=explode('-',$facture['Facture']['date']);
				$year=$date_parts[0];
			
				$cond['year(Facture.date)']=$year;
			}
			else {
				$cond = array();
			}

			$last=$this->Facture->find('first',array('order'=>array('Facture.aserb_num desc'),
														'recursive'=>-1,
														'fields'=>array('Facture.aserb_num'),
														'conditions'=>$cond
													));
			if(empty($last)){
				$no=1;
			}
			else {
				$no=$last['Facture']['aserb_num']+1;
			}
			$facture['Facture']['aserb_num']=$no;
			$facture['Facture']['aserb_date']=date('Y-m-d');

			if($this->Facture->save($facture)){
				exit(json_encode(array('success'=>true,'no'=>$facture['Facture']['aserb_num'])));	
			}
			else exit(json_encode(array('success'=>false,'msg'=>"Problème avec l'enregistrement du numero")));
		}
		
	}

	/**
	* quick function for setting the observation of a bill
	*/

	function set_observation($id,$obs){
		$facture = $this->Facture->find('first',array('fields'=>array('Facture.id'),
																								'conditions'=>array('Facture.id'=>$id)
																								));
		if(!empty($facture)){
			$facture['Facture']['observation']=$obs;
			if($this->Facture->save($facture)) exit(json_encode(array('success'=>true)));
			else exit(json_encode(array('success'=>false, 'msg'=>'Problème avec l\'enregistrement de l\'observation')));
		}
		else exit(json_encode(array('success'=>false, 'msg'=>'Cette facture n\'existe pas!')));
	}
	/**
	*
	*/
	function _reorder_part($lastNumCond,$reorderCond,$orderBy){
	//	debug($lastNumCond);
	//	debug($reorderCond);
	//	exit();
		$this->Facture->setDataSource('aserb'); //setting up the right database.
		$last=$this->Facture->find('first',array('order'=>array($orderBy.' desc'),
														'recursive'=>-1,
														'fields'=>array('Facture.numero'),
														'conditions'=>$lastNumCond
													));
		$no=(empty($last))?1:$last['Facture']['numero']+1;
		$reorderCond['Facture.numero >=']=$no; //reorder the bills after the last one used as a reference.
	//	exit(debug($no));		
		$factures=$this->Facture->find('all',array('fields'=>array('Facture.id','Facture.numero'),
												'conditions'=>$reorderCond,
												'order'=>array('Facture.date asc')
												));
		foreach($factures as $facture){
			$facture['Facture']['numero']=$no;
			$this->Facture->save($facture);
			$no++;
		}
	}
	/**
	 *  this function helps in reordering all the bills
	 * 1. per month and per operation/model
	 * 2. per set of ids. 
	 * used in the context of aser B
	 */
	function reorder($month,$year,$operations=array(),$dates=array()){
		$this->autoRender=false;
		if(empty($operations)){
			$models=array('Vente','Location','Service');
			foreach($models as $model){
				$lastNumCond=array('Facture.operation'=>$model,
								'Facture.date <'=>$year.'-'.$month.'-01',
								'year(Facture.date)'=>$year
								);
				$reorderCond=array('month(Facture.date)'=>$month,
								'year(Facture.date)'=>$year,
								'Facture.operation'=>$model
								);
				$orderBy='Facture.numero';
				$this->_reorder_part($lastNumCond,$reorderCond,$orderBy);
			}
		}
		else {
			foreach ($operations as $operation => $ids) {
				$firstDate=min($dates);
	//			exit(debug($firstDate));
				$date_parts=explode('-',$firstDate);
				$sameCond=array('Facture.operation'=>$operation,
								'year(Facture.date)'=>$date_parts[0]
								);
				$lastNumCond=array('Facture.date <='=>$firstDate,'NOT'=>array('Facture.id'=>$ids))+$sameCond;
				$reorderCond=$sameCond;
				$orderBy='Facture.date';
				$this->_reorder_part($lastNumCond,$reorderCond,$orderBy);
			}
		}
		return true;
	}


	/**
	 * this function is for silhouette also
	 * it helps to display on one page all the bills for a given date
	 */
	function show_bills(){
		if(empty($this->data)){
			$date=date('Y-m-d');
		}
		else {
			if(Configure::read('aser.silhouette'))
				$date=(strtotime($this->data['Facture']['date'])>=strtotime('2013-06-04'))?$this->data['Facture']['date']:'2013-06-04';
			else 
				$date=$this->data['Facture']['date'];	
		}
		if(Configure::read('aser.silhouette'))
			$factureIds=$this->silhouette($date);
		else  {
			$factureIds=$this->Facture->find('list',array('conditions'=>array('Facture.operation'=>'Vente',
																			'Facture.date'=>$date	
																			),
														'fields'=>array('Facture.id','Facture.id')
														));
		}
	//	exit(debug($factureIds));
		$factures=$this->Facture->find('all',array('fields'=>array('Facture.*','Personnel.name','Journal.*'),
												'order'=>array('Facture.numero'),
												'conditions'=>array('Facture.id'=>$factureIds),
												));
		foreach($factures as $key=>$facture){
			$factures[$key]['Facture']['ventes']=$this->Facture->Vente->find('all',array('fields'=>array('Produit.name','Vente.*'),
															'conditions'=>array('Vente.facture_id'=>$facture['Facture']['id'])
															));
			
		}
	//	if(!empty($factures)) exit(debug($factures));
		$thermal=$this->Conf->find('thermal');
		$header=$this->Conf->find('header');
		$footer=$this->Conf->find('footer');
		$tel=$this->Conf->find('tel');
		$web=$this->Conf->find('web');
		$this->set(compact(
						'date',
						'factures',
						'thermal',
						'footer',
						'header',
						'tel',
						'web'
						));
		$this->Product->company_info();
		$this->autoRender=true;
	}
	
	/**
	 * this function is for silhouette only
	 */
	function silhouette($showDate=null){
		$this->autoRender=false;
		
		$cond['Facture.operation']='Vente';
		$cond['Facture.montant >']=0;

		if($showDate)
			$cond['Facture.date']=$showDate;
		else if(empty($this->data)){
			$cond['Facture.date >=']=date('Y-m').'-01';
			$cond['Facture.date <=']=date('Y-m-d');
		}
		else {
			$cond['Facture.date >=']=(strtotime($this->data['Facture']['date1'])>=strtotime('2013-06-04'))?$this->data['Facture']['date1']:'2013-06-04';
			$cond['Facture.date <=']=$this->data['Facture']['date2'];
		}
		$factures=$this->Facture->find('list',array('fields'=>array('Facture.id','Facture.montant','Facture.date'),
												'conditions'=>$cond,
												'order'=>array('Facture.date','Facture.id'),
													
													));

		//search limits
		$limit_start_date = '2015-08-12'; //date from which the limits take effect.
		$limit_below_limit = (strtotime($cond['Facture.date >='])>=strtotime($limit_start_date))?
												$cond['Facture.date >=']:$limit_start_date;

		$this->loadModel('Limit');
		$limits = $this->Limit->find('list',array('fields'=>array('Limit.date','Limit.montant'),
																							'conditions'=>array('Limit.date >='=>$limit_below_limit,
																																	'Limit.date <='=>$cond['Facture.date <=']
																																)
																							));
		set_time_limit(240);    //4minutes
		ini_set('memory_limit', '256M');
		$data=array();
		$totalGeneral=0;
		$factureIds=array();
		foreach($factures as $date=>$facture){
			$totalPerDay=0;
			$numero=1;
			if($date<'2014-02-17'){
				$limit=260000;
			}
			else if(($date>='2014-02-17')&&($date<'2014-07-01')){
				$limit=300000;
			}
			else if(($date>='2014-07-01')&&($date<$limit_start_date)){
					$limit=800000;
			}
			else {
				$limit=$limits[$date];
			}
			foreach($facture as $id=>$montant){
				if(($totalPerDay+$montant)<=$limit){
					$data[$date][$id]['numero']=$numero;
					$data[$date][$id]['montant']=$montant;
					$numero++;
					$totalPerDay+=$montant;
					$factureIds[]=$id;
				}
				else 
					continue;	
			}
			$data[$date]['total']=$totalPerDay;
			$totalGeneral+=$totalPerDay;
		}
	//	exit(debug($data));
		
		$this->Product->company_info();
		if($showDate) return $factureIds;
		else
			$this->autoRender=true;
		$this->set(compact('data','totalPerDay','totalGeneral'));
		
	}
	
	function _changeDate($id){
		$reservation=$this->Facture->Reservation->find('first',array('fields'=>array('Facture.id','Facture.date','Reservation.depart'),
		                                                   'conditions'=>array('Facture.id'=>$id),
		                                                   'order'=>array('Reservation.depart desc')
		                                                   ));
		 $facture['Facture']['id']=$reservation['Facture']['id'];
		 $facture['Facture']['date_emission']=$this->Product->increase_date($reservation['Reservation']['depart']);
		 $this->Facture->save($facture);
	}
	
	function cancel_aserb_bill($id){
		$this->Facture->setDataSource('default');
		$facture=$this->Facture->find('first',array('fields'=>array('Facture.id','Facture.aserb_num'),
												'conditions'=>array('Facture.id'=>$id)
												));	
		$this->Facture->setDataSource('aserb');
		$last=$this->Facture->find('first',array('fields'=>array('Facture.id','Facture.aserb_num'),
												'order'=>array('Facture.numero desc'),
												'conditions'=>array('Facture.operation'=>'Reservation')
												));	
		if(empty($last)||($facture['Facture']['aserb_num']==-1)||($facture['Facture']['aserb_num']>=$last['Facture']['aserb_num'])){
			$this->Facture->delete($id); //deleting the bill in the aserb database
			// resetting fields in aser database
			$facture['Facture']['inclure']=0;
			$facture['Facture']['aserb_num']=0;
			$facture['Facture']['id']=$id;
			$this->Facture->setDataSource('default');
			$this->Facture->save($facture);
			$this->Session->setFlash('Copie effacee!');
		}
		else {
			$this->Session->setFlash('Impossible d\'effacer la facture car elle n\'est pas la derniere!');
		}
		$this->redirect($this->referer());
	}
	
	function aserb_bill($id,$type,$no=0){
		$conditions['Facture.id']=$id;
		//changing the facture date to equal the date of depart 
		$this->_changeDate($id);
		$facture=$this->_factureFind('first',$conditions,'Reservation');
		$success=true;
		
		if(in_array($facture['Facture']['etat'],array('bonus','annulee'))){
			$success=false;
		}
		else if($type=='SEARCH'){ 
			$this->Facture->Reservation->setDataSource('default');
			$this->Facture->Paiement->setDataSource('default');
			$reservation=$this->Facture->Reservation->find('first',array('fields'=>array('Reservation.etat'),
																'conditions'=>array('Reservation.facture_id'=>$id),
																'order'=>array('Reservation.depart desc')
																));
			if(in_array($reservation['Reservation']['etat'],array('partie','credit'))){
				$cond['Paiement.facture_id']=$id;
				if(strtotime(date('Y-m-d'))>=strtotime('2014-03-01')){
					$cond['Paiement.mode_paiement']=array('cash','visa');
				}
				else {
					$cond['Paiement.mode_paiement']=array('cash');
				}
				$paiements=$this->Facture->Paiement->find('all',array('fields'=>array('sum(Paiement.montant) as montant'),
																					'conditions'=>$cond
																						));	
				$type=(isset($paiements[0])&&($paiements[0]['Paiement']['montant']>=$facture['Facture']['montant']))?
														'CASH':'AUTRE';	
			}
			else {
				$success=false;
			}
		}
		
		if($success){
			if(($no==-1)||(($type=='CASH')&&($facture['Facture']['inclure']==0))){
				$this->Facture->setDataSource('default');
				$facture['Facture']['id']=$id;
			 	$facture['Facture']['aserb_num']=-1;
			 	$facture['Facture']['inclure']=0;
				$this->Facture->save($facture);
			
				//delete the b copy if any
				$this->Facture->setDataSource('aserb');
				$this->Facture->delete($id); //delete the bill
				$this->Facture->Reservation->setDataSource('aserb');
				$this->Facture->Reservation->delete(array('Reservation.facture_id'=>$id)); //delete the attached reservation
				
				$no=''; //not number to be set
	
			}
			else {
				if($no==0)
					$no=$this->Product->facture_number($id,'Reservation','','aserb');
				else {
					$this->Facture->setDataSource('aserb');
					//extracting the year part of the facture date
					$date_parts=explode('-', $facture['Facture']['date']);
					$search=$this->Facture->find('first',array('fields'=>array('Facture.numero'),
															'conditions'=>array('Facture.numero'=>$no,
																				'Facture.operation'=>'Reservation',
																				'year(Facture.date)'=>$date_parts[0]
																				)
															));
					if(!empty($search))
						exit(json_encode(array('success'=>false,'msg'=>'Numero deja assigne')));
				}
				$this->_saveBBill($facture, $no);
				
			}
		}	
		exit(json_encode(array('success'=>$success,'numero'=>$no)));
	}
	
	function _saveBBill($facture,$num=null){
			$facture['Facture']['numero']=($num)?$num:$facture['Facture']['numero'];
			//marking each bill send
			//*
			$this->Facture->setDataSource('default');
			$aserA['Facture']['inclure']=1;
			$aserA['Facture']['aserb_num']=$facture['Facture']['numero'];
			$aserA['Facture']['id']=$facture['Facture']['id'];
			$this->Facture->save($aserA);
			//*/
			//starting the copie towards aser B
			$this->Facture->setDataSource('aserb');
			$this->Facture->save($facture);
			foreach($facture as $model=>$data){
				if(in_array($model,array('Personnel','Journal','Tier'))){
					if(!empty($data['id'])){
						$this->Facture->$model->setDataSource('aserb');
						if(!$this->Facture->$model->save(array($model=>$data))){
							exit('IN saveBBill Failed to save '.$model);
						}
					}
				}
				else { 
					switch($model){
						case 'Paiement':
							foreach($data as $row){
								$this->Facture->$model->setDataSource('aserb');
								if(!$this->Facture->$model->save(array($model=>$row))){
									exit('IN saveBBill Failed to save paiement');
								}
							}
							break;
						case 'Vente':
							foreach($data as $row){
								$this->Facture->$model->setDataSource('aserb');
								if(!$this->Facture->$model->save(array($model=>$row))){
									exit('IN saveBBill Failed to save vente');
								}
								//saving produit
								$this->Facture->$model->Produit->setDataSource('aserb');
								if(!$this->Facture->$model->Produit->save($row)){
									exit('IN saveBBill Failed to save produit');
								}
							}
							break;
						
						case 'Reservation':
							foreach($data as $row){
								$this->Facture->$model->setDataSource('aserb');
								if(!$this->Facture->$model->save(array($model=>$row))){
									exit('IN saveBBill Failed to save Reservation');
								}
								//saving chambre
								$this->Facture->$model->Chambre->setDataSource('aserb');
								if(!$this->Facture->$model->Chambre->save($row)){
									exit('IN saveBBill Failed to save chambre');
								}
							}
							break;
						case 'Location':
							foreach($data as $row){
								$this->Facture->$model->setDataSource('aserb');
								if(!$this->Facture->$model->save(array($model=>$row))){
									exit('IN saveBBill Failed to save Location');
								}
								//saving salle
								$this->Facture->$model->Salle->setDataSource('aserb');
								if(!$this->Facture->$model->Salle->save($row)){
									exit('IN saveBBill Failed to save salle');
								}
							}
							break;
						case 'Service':
							foreach($data as $row){
								$this->Facture->$model->setDataSource('aserb');
								if(!$this->Facture->$model->save(array($model=>$row))){
									exit('IN saveBBill Failed to save service');
								}
								//saving service
								$this->Facture->$model->TypeService->setDataSource('aserb');
								if(!$this->Facture->$model->TypeService->save($row)){
									exit('IN saveBBill Failed to save type service');
								}
							}
							break;
					}
				}
			}	
	}
	
	function _factureFind($scope,$conditions,$operation=array()){
		//setting up the contain array accoring to the operation/model value
		$contain=array(
					'Tier',
					'Paiement',
					);
		switch($operation){
			case 'Vente':
				$contain=array_merge($contain,array(
					'Personnel',
					'Journal',
					'Vente'=>array('Produit'),
					));
				break;
			case 'Reservation':
				$contain=array_merge($contain,array(
					'Reservation'=>array('Chambre')
					));
				break;
			case 'Service':
				$contain=array_merge($contain,array(
					'Service'=>array('TypeService'),
					));
				break;
			case 'Location':
				$contain=array_merge($contain,array(
					'Location'=>array('Salle'),
					));
		}
		//setting the right database to aser A or default
		$this->Facture->setDataSource('default'); 
		$this->Facture->Personnel->setDataSource('default');
		$this->Facture->Vente->setDataSource('default');
		$this->Facture->Vente->Produit->setDataSource('default');
		$this->Facture->Location->setDataSource('default');
		$this->Facture->Location->Salle->setDataSource('default');
		$this->Facture->Service->setDataSource('default');
		$this->Facture->Service->TypeService->setDataSource('default');
		$this->Facture->Tier->setDataSource('default');
		$this->Facture->Journal->setDataSource('default');
		$this->Facture->Paiement->setDataSource('default');
		$this->Facture->Reservation->setDataSource('default');
		$this->Facture->Reservation->Chambre->setDataSource('default');
		
		//fetching the bills
		$conditions['Facture.operation']=$operation;
		$factures=$this->Facture->find($scope,array('recursive'=>2,
												'order'=>array('Facture.numero asc'),
												'conditions'=>$conditions,
												'contain'=>$contain
												));
		/*
		if($operation=='Location'){
			exit(debug($conditions));
		}
		//*/
		return $factures;
		
	}
	
	/**
	* this functions is used to aserb bills. expect those of reservations. 
	* it is usually used prior to a copy, in other to remove previous ones. 
	*/
	function delete_aserb_bills($deleteCond){
		//deleting already copied bills in B
			$this->Facture->setDataSource('aserb');
			$this->Facture->deleteAll($deleteCond);
			//deleting ventes bills in B
			$this->Facture->Vente->setDataSource('aserb');
			$this->Facture->Vente->deleteAll($deleteCond);
			//deleting services bills in B
			$this->Facture->Service->setDataSource('aserb');
			$this->Facture->Service->deleteAll($deleteCond);
			//deleting locations bills in B
			$this->Facture->Location->setDataSource('aserb');
			$this->Facture->Location->deleteAll($deleteCond);
			//deleting reservations bills in B
			$this->Facture->Reservation->setDataSource('aserb');
			$this->Facture->Reservation->deleteAll($deleteCond);
			//deleting paiements bills in B
			$this->Facture->Paiement->setDataSource('aserb');
			$this->Facture->Paiement->deleteAll($deleteCond);
	}

	function aserb($month=null,$year=null,$totalDesire=0,$action='approximer'){
		$this->autoRender = false;
		$facturesIds=array();
		if(!$month||!$year){
			$response='exit';
			$date1=date('Y-m',strtotime(date("Y-m", strtotime(date('Y-m').'-01')) . " -1 month")).'-01';
			$date2=date('Y-m',strtotime(date("Y-m", strtotime(date('Y-m').'-01')) . " -1 month")).'-31';
		}
		else {
			$response='redirect';
			$date1=$year.'-'.$month.'-01';
			$date2=$year.'-'.$month.'-31';
		}
		$cond=array('Facture.operation'=>'Vente',
					'Facture.date >='=>$date1,
					'Facture.date <='=>$date2,
					'Facture.etat'=>array('payee','credit')
					);
		$factures=$this->Facture->find('all',array('fields'=>array('sum(Facture.montant) as montant','Facture.date','Facture.operation'),
													'conditions'=>$cond,
													'group'=>array('Facture.date'),
													'order'=>array('Facture.date')
													));	
		
		$totalMensuelle=0;
		foreach($factures as $facture){
			$totalMensuelle+=$facture['Facture']['montant'];
		}
		
		$totalToRemove=($totalDesire<=$totalMensuelle)?$totalMensuelle-$totalDesire:0;
		$totalObtenue=0;
		$dates=array();
		foreach($factures as $facture){
			$dates[$facture['Facture']['date']]['montant']=$facture['Facture']['montant'];
			$dates[$facture['Facture']['date']]['pourcentage']=$dates[$facture['Facture']['date']]['montant']/$totalMensuelle;
			$dates[$facture['Facture']['date']]['montant_a_enlever']=round($totalToRemove*$dates[$facture['Facture']['date']]['pourcentage']);
			$dates[$facture['Facture']['date']]['montant_a_garder']=$dates[$facture['Facture']['date']]['montant']-$dates[$facture['Facture']['date']]['montant_a_enlever'];
			$totalObtenue+=$dates[$facture['Facture']['date']]['montant_a_garder'];
		}
		
		$factures=$this->Facture->find('list',array('fields'=>array('Facture.id','Facture.montant','Facture.date'),
												'conditions'=>$cond,
												'order'=>array('Facture.date','Facture.id'),
													
													));
		
		set_time_limit(240);    //4minutes
		ini_set('memory_limit', '256M');
		$data=array();
		$totalGeneral=0;
		foreach($factures as $date=>$facture){
			$limit=$dates[$date]['montant_a_garder'];
			$totalPerDay=0;
			$numero=1;
			foreach($facture as $id=>$montant){
				if(($totalPerDay+$montant)<=$limit){
					$facturesIds[]=$id;
					$totalPerDay+=$montant;
				}
				else 
					continue;	
			}
			$data[$date]['total']=$totalPerDay;
			$totalGeneral+=$totalPerDay;
		}
		//exit(debug($facturesIds));
		if($action=='approximer'){
			exit(json_encode(array('success'=>true,'total_got'=>$totalGeneral)));
		}
		
		if(($totalGeneral>0)&&($action!='approximer')){
			$deleteCond=array(
							'Facture.date >='=>$date1,
							'Facture.date <='=>$date2,
							'Facture.operation'=>array('Vente','Service','Location')
							);
			$this->delete_aserb_bills($deleteCond); //deleting previously created bills.
		}
		
		//conditions for searching bills to copy to B
		$conditions=array(
					'Facture.date >='=>$date1,
					'Facture.date <='=>$date2,
					);
		$operations=array('Vente','Location','Service');
		
		//increasing the memory and timeout time
		set_time_limit(240);    //4minutes
		ini_set('memory_limit', '256M');
		
		//looping through the operation to copy bills operation or model by model
		foreach($operations as $operation){
			if($operation=='Vente'){
				$conditions['Facture.id']=$facturesIds;
			}
			else {
				unset($conditions['Facture.id']);
			}
			$factures=$this->_factureFind('all', $conditions,$operation);
			//copying each bill with its related info
			foreach($factures as $i=>$facture){
				$this->_saveBBill($facture);		
			}
		}
		//reordering copied bills
		$this->reorder($month, $year);
		if($response=='exit'){
			CakeLog::write('aserb','BILLS COPIED!');						
			exit('JOB DONE!');	
		}
		else {
			$msg='Le montant total des factures restaurant copiées est environ '.$totalGeneral;
			exit(json_encode(array('success'=>true,'msg'=>$msg)));
		}
		//*/
	}
	
	function credit($id=null){
		$show_less = false;
		if(is_null($id)){
			$cond=array('Facture.etat'=>array('credit','avance'),
					'Facture.monnaie'=>array('BIF','USD'),
					'Facture.reste >'=>0, 
					'Facture.montant >'=>0
					);
		}
		else {
			$cond['Facture.tier_id']=$id;
			$cond['Facture.etat !=']='annulee';
			$tierInfo=$this->Facture->Tier->find('first',array('conditions'=>array("Tier.id"=>$id),
															'fields'=>array("Tier.name"),
																'recursive'=>-1
																));
		}
		if(!empty($this->data['Facture']['numero'])){
			$cond['Facture.numero']=$this->data['Facture']['numero'];
		}
		if(!empty($this->data['Facture']['date1'])){
			$cond['Facture.date >=']=$date1=$this->data['Facture']['date1'];
		}
		else if(Configure::read('aser.belair')){
			$cond['Facture.date >=']=$date1='2015-06-01';	
		}
		if(!empty($this->data['Facture']['date2'])){
			$cond['Facture.date <=']=$date2=$this->data['Facture']['date2'];
		}
		if(!empty($this->data['Facture']['tier_id'])&&($this->data['Facture']['tier_id']!=0)){
			$cond['Tier.id']=$tierId=$this->data['Facture']['tier_id'];
		}
		if(!empty($this->data['Tier']['compagnie'])){
			$cond['Tier.compagnie']='%'.$this->data['Tier']['compagnie'].'%';
		}
		if(!empty($this->data['Tier']['compagnie'])){
			$cond['Tier.compagnie']='%'.$this->data['Tier']['compagnie'].'%';
		}
		if(!empty($this->data['Facture']['show_less'])){
			$show_less = $this->data['Facture']['show_less'];
		}

		
		$factures=$this->Facture->find('all',array('fields'=>array('Facture.montant',
														'Facture.reste',
														'Facture.date',
														'Facture.observation',
														'Facture.monnaie',
														'Facture.numero',
														'Facture.id',
														'Facture.etat',
														'Tier.id',
														'Tier.name',
														'Tier.compagnie',
														'Tier.telephone'
														),
										'conditions'=>$cond,
										'order'=>array('Tier.name','Facture.date')
										));
		
		
		

		/*								
		foreach($factures as $facture){
			$this->Product->update_facture($facture['Facture']['id'],$facture['Facture']['montant'],$facture['Facture']['etat'],null,false);
		}
		//*/ 		
		$referer=$this->referer();
		$this->set(compact('factures','referer','date1','date2','tierId','id','tierInfo','show_less'));						
	}
	
	function bonus(){
		if(!empty($this->data['factures'])){
		  $trace['Trace']['model']='Facture';
			foreach($this->data['factures'] as $id){
				$ids[]=$id;
				$facture=$this->Facture->find('first',array('fields'=>array('Facture.id'),
												'conditions'=>array('Facture.etat'=>'credit',
																	'Facture.id'=>$id,
																	)
												));
				$facture['Facture']['etat']='bonus';
				$facture['Facture']['observation']=$this->data['obs'];
				$this->Facture->save($facture);
				
				//enregistrement de la trace
				$trace['Trace']['id']=null;
				$trace['Trace']['model_id']=$id;
				$trace['Trace']['operation']='Changement de l\'état. De crédit à bonus';
				$trace['Trace']['operation'].=' Raison du changement : '.$this->data['obs'];
				$this->Facture->Trace->save($trace);
			}
			exit(json_encode(array('success'=>true,'msg'=>'ok')));
		}
	}
	
	/**
	*	This function include aser A bills into B 
	*/
	function inclure(){
		if(!empty($this->data['factures'])){
			$operations=array();
			//in this first loop I want to group all ids by operation.
			foreach($this->data['factures'] as $params){
				if(!isset($operations[$params[1]])){
					$operations[$params[1]]=array();
				}
				$operations[$params[1]][]=$params[0];
			}
			//removing the olds ones first
			$this->delete_aserb_bills(array('Facture.id'=>$this->data['ids']));

			if($this->data['action']==1){
				//in this second loop I want to copy bills to B one operation after the other.
				foreach($operations as $operation=>$ids){
					$conditions['Facture.id']=$ids;
					$factures=$this->_factureFind('all', $conditions,$operation);
					//copying each bill with its related info
					foreach($factures as $i=>$facture){
						$this->_saveBBill($facture);		
					}
				}
			}
			//reordering the bills.
			$this->reorder(null,null,$operations,$this->data['dates']);
		}
		exit(json_encode(array('success' =>true)));
	}
	
	function _depenses($months,$parts1,$parts2){
		$cond['Operation.model']='Type';
		$cond['Operation.monnaie']='BIF';
		$cond['Type.type']='depense';
		$cond['Operation.common regexp']='(Caiss)';
		$this->loadModel('Operation');
		foreach($months as $month=>$value){
			$cond['Operation.date >=']=($month<10)?($parts1[0].'-0'.$month.'-01'):($parts1[0].'-'.$month.'-01');
			$cond['Operation.date <=']=($month<10)?($parts2[0].'-0'.$month.'-31'):($parts2[0].'-'.$month.'-31');
			$operations=$this->Operation->find('all',array('conditions'=>$cond,
													'fields'=>array('sum(Operation.debit) as debit',
																	),
													));
			$months[$month]+=(isset($operations[0]))?$operations[0]['Operation']['debit']:0;
		}
		$depenses=array();
		foreach($months as $month=>$value){
			$depenses[]=$value*1;
		}
		return $depenses;	
	}

	function _ventes($months,$monnaie,$parts1,$parts2,$devise){
		foreach($months as $month=>$value){
			$days=cal_days_in_month(CAL_GREGORIAN,$month,$parts2[0]);
			$date1=($month<10)?($parts1[0].'-0'.$month.'-01'):($parts1[0].'-'.$month.'-01');
			$date2=($month<10)?($parts2[0].'-0'.$month.'-'.$days):($parts2[0].'-'.$month.'-'.$days);
						
			$cond['Facture.etat']=array('payee','avance','credit','excedent','bonus');
			$cond['OR']=array(array('Facture.date >='=>$date1,'Facture.date <='=>$date2),
								array('Facture.id'=>$this->Product->factures($date1, $date2))
						);
			$cond['NOT']=array('Facture.monnaie'=>array('','EUR'));
			if($monnaie!=''){
				$cond['Facture.monnaie']=$monnaie;
				$devise['USD']=1;
			}
			$factures=$this->Facture->find('all',array('fields'=>array('Facture.montant',
																	'Facture.operation',
																	'Facture.monnaie'
																),
														'conditions'=>$cond,
														)
												);
			foreach($factures as $key=>$facture){
				if($facture['Facture']['operation']=='Reservation'){
					$this->Product->extract_amount($facture,$date1,$date2);
					if($facture['Facture']['montant']>0){
						$factures[$key]=$facture;
					}
					else {
						unset($factures[$key]);
					}
				}
				$months[$month]+=$facture['Facture']['montant']*$devise[$facture['Facture']['monnaie']];
			}
		}
		$Yaxis=array();
		foreach($months as $month=>$value){
			$Yaxis[]=$value;
		}
		return $Yaxis;	
	}
	
	function chart(){
		$devise['USD']=$taux=$this->Conf->find('taux_usd');
		if (!empty($this->data)) {
			$date1=$this->data['Facture']['date1'];
			$date2=$this->data['Facture']['date2'];
			$devise['USD']=$taux=$this->data['Facture']['taux'];
		}
		
		$parts1=explode('-',$date1);
		$parts2=explode('-',$date2);
		$devise['BIF']=1;
		$months=array();
		for($i=($parts1[1]*1);$i<=($parts2[1]*1);$i++){
			$months[$i]=0;
		}
		//monthly report
		$title='Courbe d\'évolution mensuelle ';
		switch($this->data['Facture']['choix']){
			case 'BIF_USD':
				$series[]=$this->_ventes($months,'', $parts1, $parts2,$devise);
				$labels[]='BIF + USD';
				$title.='des ventes en BIF & USD';
				break;
			case 'BIF':
				$series[]=$this->_ventes($months,'BIF', $parts1, $parts2,$devise);
				$labels[]='BIF';
				$title.='des ventes en BIF';
				break;
			case 'USD':
				$series[]=$this->_ventes($months,'USD', $parts1, $parts2,$devise);
				$labels[]='USD';
				$title.='des ventes en USD';
				break;
			case 'depenses':
				$series[]=$this->_depenses($months, $parts1, $parts2);
				$labels[]='Dépenses';
				$title.='des dépenses en BIF';
				break;
			case 'BIF_depenses':
				$series[]=$this->_ventes($months,'BIF', $parts1, $parts2,$devise);
				$series[]=$this->_depenses($months, $parts1, $parts2);
				$labels[]='Ventes en BIF';
				$labels[]='Dépenses';
				$title.='des ventes et des dépenses en BIF';
				break;
		}
		$Xaxis=array();
		foreach($months as $month=>$value){
			$Xaxis[]=$this->Product->giveMonth($month);
		}
		exit(json_encode(array('success'=>true,'Xaxis'=>$Xaxis,'series'=>$series,'labels'=>$labels,'title'=>$title)));
	}
	
	function cash($date=null){
		if($date==null){
			if(!empty($this->data['Facture']['date'])){
				$date=$this->data['Facture']['date'];
			}
			else {
				$date=date('Y-m-d');
			}
		}
		//conds
		$pytCond['Facture.monnaie !=']='';
		$pytCond['Facture.etat']=array('en_cours','cloturer','payee','credit','avance','excedent');
		$factCond=$pytCond;
		$pytCond['Paiement.date']=$date;
		$pytCond['NOT']=array('Paiement.mode_paiement'=>array('','transfer'));
		//search all bills corresponding to reservations that are active for this date
		$factures=$this->Product->factures($date, $date);
		$factCond['OR']=array('Facture.date'=>$date,'Facture.id'=>$factures);
		
		$persCond=array();
		$personnelId=null;
		if((!empty($this->data['Facture']['personnel_id'])&&($this->data['Facture']['personnel_id']!=0))){
			$personnelId=$this->data['Facture']['personnel_id'];
		}
		else if($this->Auth->user('fonction_id')==2){
			$personnelId=$this->Auth->user('id');
		}
		if($personnelId){
			$persCond['Personnel.id']=$personnelId;
			$journals=$this->Facture->Journal->find('list',array('fields'=>array('Journal.id','Journal.id'),
														'conditions'=>array('Journal.personnel_id'=>$personnelId,
																			'Journal.date'=>$date
																			)
														));		
			$factCond['Facture.journal_id']=$journals;	
			$factCond['Facture.operation']='Vente';	
		}
		
		$this->Product->cash($persCond,$pytCond,$factCond,$date);		
		$personnels=$this->Facture->Personnel->find('list',array('conditions'=>array('Personnel.fonction_id'=>2)));
		$personnels[0]='';
		$this->set('personnels',$personnels);
	}

	function monthly(){
		if(!empty($this->data['Facture']['date1'])){
			$date1=$this->data['Facture']['date1'];
		}
		else {
			$date1=date('Y-m').'-01';
		}
		if(!empty($this->data['Facture']['date2'])){
			$date2=$this->data['Facture']['date2'];
		}
		else {
			$date2=date('Y-m-').'31';
		}
		$days=$this->Product->diff($date1,$date2)+1;
		$datas=array();
		
		$total['ca_BIF']=$total['ca_USD']=0;
		$total['credit_BIF']=$total['credit_USD']=0;
		$total['pyt_BIF']=$total['pyt_USD']=$total['pyt_EUR']=0;
		$total['bonus_BIF']=$total['bonus_USD']=0;
		
		for($i=0;$i<$days; $i++){
			$datas[$i]['date']=$date=$this->Product->increase_date($date1,$i);
			$datas[$i]['ca_BIF']=$datas[$i]['ca_USD']=0;
			$datas[$i]['credit_BIF']=$datas[$i]['credit_USD']=0;
			$datas[$i]['pyt_BIF']=$datas[$i]['pyt_USD']=$datas[$i]['pyt_EUR']=0;
			$datas[$i]['bonus_BIF']=$datas[$i]['bonus_USD']=0;
		
			$factures=$this->Facture->find('all',array('fields'=>array('Facture.montant',
																	'Facture.reste',
																	'Facture.monnaie',
																	'Facture.etat',
																	'Facture.operation'
																	),
																	'conditions'=>array('OR'=>array('Facture.date'=>$date,
																									'Facture.id'=>$this->Product->factures($date,$date)
																									),
																						'Facture.monnaie !='=>'',
																						// 'Facture.operation !='=>'Reservation',
																						// 'Facture.monnaie'=>'USD',
																						'Facture.etat'=>array('payee','credit','bonus','avance','excedent')
																						),
																	));
		
			
			foreach($factures as $key=>$facture){
				if(($facture['Facture']['etat']=='bonus')&&($facture['Facture']['operation']!='Reservation')){
					$datas[$i]['bonus_'.$facture['Facture']['monnaie']]+=$facture['Facture']['montant'];
				}
				else {
					if($facture['Facture']['operation']=='Reservation'){
						$etat=$facture['Facture']['etat'];
						$this->Product->extract_amount($facture,$date,$date);
						if($etat=='bonus'){
							$facture['Facture']['etat']='bonus';
							$datas[$i]['bonus_'.$facture['Facture']['monnaie']]+=$facture['Facture']['montant'];
						}
						if($facture['Facture']['montant']>0){
							$factures[$key]=$facture;
						}
						else {
							unset($factures[$key]);
						}
					}
					$facture['Facture']['deposit']=0;
					if($facture['Facture']['reste']<0){
						$facture['Facture']['deposit']=abs($facture['Facture']['reste']);
						$facture['Facture']['reste']=0;
					}
					$datas[$i]['ca_'.$facture['Facture']['monnaie']]+=$facture['Facture']['montant'];
					$datas[$i]['credit_'.$facture['Facture']['monnaie']]+=$facture['Facture']['reste'];
				}
			}
				//if ($date == '2015-12-02') exit(debug($factures));
			$pyts=$this->Facture->Paiement->find('all',array('fields'=>array('Paiement.montant',
																		'Paiement.monnaie',
																		'Paiement.montant_equivalent',
																		'Paiement.mode_paiement',
																		'Facture.monnaie',
																		'Facture.date',
																		'Paiement.date' 
																	),
																	'conditions'=>array('Paiement.date'=>$date,
																						'Facture.monnaie !='=>'',
																						'NOT'=>array('Paiement.mode_paiement'=>array('','transfer','remboursement')),
																						'Facture.etat'=>array('payee','credit','bonus','avance','excedent')
																						),
																	));
																	
			foreach($pyts as $pyt){
				if(($pyt['Paiement']['mode_paiement']=='cheque')&&($pyt['Paiement']['monnaie']=='EUR')){
					continue;
				}
				if(!empty($pyt['Paiement']['montant_equivalent'])){
					$datas[$i]['pyt_'.$pyt['Paiement']['monnaie']]+=$pyt['Paiement']['montant_equivalent'];
				}
				else {
					$datas[$i]['pyt_'.$pyt['Facture']['monnaie']]+=$pyt['Paiement']['montant'];
				}											
			}
				
			$total['name']='TOTAL';
		 	$total['ca_BIF']+=$datas[$i]['ca_BIF'];
		 	$total['ca_USD']+=$datas[$i]['ca_USD'];
		 	$total['credit_BIF']+=$datas[$i]['credit_BIF'];
		 	$total['credit_USD']+=$datas[$i]['credit_USD'];
			$total['bonus_BIF']+=$datas[$i]['bonus_BIF'];
			$total['pyt_BIF']+=$datas[$i]['pyt_BIF'];
			$total['pyt_USD']+=$datas[$i]['pyt_USD'];
			$total['pyt_EUR']+=$datas[$i]['pyt_EUR'];
		}
		$monnaies=$this->monnaies;
		$monnaies['']='';	
	//	exit(debug($datas));
		$this->set(compact('year','month','datas','total','date1','date2','monnaie','monnaies'));	
	}
	
	function _date_format($date){
		$parts=explode('-',$date);
		return $parts[2].'/'.$parts[1].'/'.$parts[0];
	}
	
	function create_facture(){
		$this->autoRender=false;
		$this->Product->create_facture($this->data);
	}
	
	function remove_facture($factureId,$model,$obs=''){
		$this->autoRender=false;
		$this->Product->remove_facture($factureId,$model,$obs);
	}
	
	function date_emission($id,$date){
		$this->autoRender=false;
		$this->Facture->save(array('id'=>$id,'date_emission'=>$date));
		exit(json_encode(array('success'=>true,'msg'=>'ok','date'=>$this->_date_format($date))));
	}
	
	function edit(){
		//getting the parameters
		$factureId=$this->data['Facture']['id'];
		$clientId=$this->data['Facture']['tier_id'];
	
		//setting the trace parameters
		$trace['Trace']['id']=null;
		$trace['Trace']['model_id']=$factureId;
		$trace['Trace']['model']='Facture';
		$trace['Trace']['operation']='';
		
		$facture=$this->Facture->find('first',array('fields'=>array('Facture.*',
																	'Tier.name',
																	'Tier.id',
																	),
													'conditions'=>array('Facture.id'=>$factureId),
													));
		
		if($clientId!=$facture['Tier']['id']){
			//saving the new client
			$facture['Facture']['tier_id']=$clientId;
		
			//updating the attached records
			$model=$facture['Facture']['operation'];
			$records=$this->Facture->$model->find('all',array('fields'=>array($model.'.id'),
															'conditions'=>array($model.'.facture_id'=>$factureId),
															));
			foreach($records as $record){
				$record[$model]['tier_id']=$clientId;
				$this->Facture->$model->save($record);
			}
			
			//reduction stuff handling
			$clientInfo=$this->Facture->Tier->find('first',array('fields'=>array('Tier.reduction','Tier.name'),
													'conditions'=>array('Tier.id'=>$clientId),
													));
			$this->Product->bill_total($facture['Facture']['id'],$clientInfo['Tier']['reduction'],true,$facture['Facture']['etat']);
			
			//trace stuff
			$trace['Trace']['operation'].='Changement de client. De "'.$facture['Tier']['name'].'" à "'.$clientInfo['Tier']['name'].'"';
		}
		
		if($this->data['Facture']['date']!=$facture['Facture']['date']){
			//trace stuff
			$trace['Trace']['operation'].='Changement de la date de création. De "'.$this->Product->formatDate($facture['Facture']['date']).'" à "'.$this->Product->formatDate($this->data['Facture']['date']).'"';
			$facture['Facture']['date']=$this->data['Facture']['date'];
		}
		if(!empty($this->data['Facture']['date_emission'])&&($this->data['Facture']['date_emission']!=$facture['Facture']['date_emission'])){
			//trace stuff
			$trace['Trace']['operation'].='Changement de la date d\'émission. De "'.$this->Product->formatDate($facture['Facture']['date_emission']).'" à "'.$this->Product->formatDate($this->data['Facture']['date_emission']).'"';
			
			
			$facture['Facture']['date_emission']=$this->data['Facture']['date_emission'];
		}
		
		if(isset($this->data['Facture']['tva_incluse'])&&($this->data['Facture']['tva_incluse']!=$facture['Facture']['tva_incluse'])){
			
			if(!$this->data['Facture']['tva_incluse']){
				//calcul de la nouvelle tva 
				$this->data['Facture']['tva']=$this->Product->tva($facture['Facture']['montant'],$this->data['Facture']['tva_incluse']);
				//actualisation des totaux
				$this->data['Facture']['montant']=$facture['Facture']['montant']+$this->data['Facture']['tva'];
				$this->data['Facture']['original']=$facture['Facture']['original']+$this->data['Facture']['tva'];
				$this->data['Facture']['reste']=$facture['Facture']['reste']+$this->data['Facture']['tva'];
			}
			else {
				//actualisation des totaux
				$this->data['Facture']['montant']=$facture['Facture']['montant']-$facture['Facture']['tva'];
				$this->data['Facture']['original']=$facture['Facture']['original']-$facture['Facture']['tva'];
				$this->data['Facture']['reste']=$facture['Facture']['reste']-$facture['Facture']['tva'];
				//calcul de la nouvelle tva 
				$this->data['Facture']['tva']=$this->Product->tva($this->data['Facture']['montant'],$this->data['Facture']['tva_incluse']);
			}
			$trace['Trace']['operation'].='Changement tva de '.$facture['Facture']['tva_incluse'].' a '.$this->data['Facture']['tva_incluse'];
		}
		
		$facture['Facture']=$this->data['Facture'];
		$this->Facture->save($this->data);
		$this->Facture->Trace->save($trace);
		exit(json_encode(array('success'=>true,'msg'=>'succès !')));
	}
	
	function multi_remove(){
		$this->autoRender=false;
		if(!empty($this->data)){
			$model='Reservation';
			foreach($this->data['Id'] as $value){
				if($value!=0) {
					$this->Product->remove_facture($value,$model);
				}	
			}
		}
	}
	
	function declaration($month=null,$year=null){
		if(empty($this->data)){
			$date1=date('Y-m',strtotime(date("Y-m", strtotime(date('Y-m').'-01')) . " -1 month")).'-01';
			$date2=date('Y-m',strtotime(date("Y-m", strtotime(date('Y-m').'-01')) . " -1 month")).'-31';
		}
		else {
			$month=$this->data['Facture']['mois']['month'];
			$year=$this->data['Facture']['annee']['year'];
			$date1=$year.'-'.$month.'-01';
			$date2=$year.'-'.$month.'-31';
		}
		
		$conditions['Facture.date >=']=$date1;
		$conditions['Facture.date <=']=$date2;
		if(Configure::read('aser.database')!='aserb')
			$conditions['Facture.inclure']=1;
		$conditions['Facture.etat']=array('payee','credit');
	//	$conditions['Facture.monnaie !=']='';
		$conditions['Facture.montant >']=0;
		
		
		$models=array('Reservation'=>'Hébergement',
					'Vente'=>'Restaurant',
					'Location'=>'Salles de Conférences',
					'Service'=>'Divers'
					);
		foreach($this->facturationMonnaies as $monnaie){
				$totals['montant'][$monnaie]=0;
				$totals['tva'][$monnaie]=0;
				$totals['htva'][$monnaie]=0;
			}	
		
		$datas=array();
		foreach($models as $key=>$model){
			$conditions['Facture.operation']=$key;
			$factures=$this->Facture->find('all',array('fields'=>array('Facture.id',
																	'Facture.numero',
																	'Facture.montant',
																	'Facture.tva',
																	'Tier.id',
																	'Tier.name',
																	'Facture.monnaie',
																	'Facture.operation'
																	),
												'conditions'=>$conditions,
												'order'=>array('Facture.numero')
																	));
			foreach($this->facturationMonnaies as $monnaie){
				$total['montant'][$monnaie]=0;
				$total['tva'][$monnaie]=0;
				$total['htva'][$monnaie]=0;
			}	
			
			foreach($factures as $facture){
				if(!isset($total['montant'][$facture['Facture']['monnaie']]))
					continue;
				$total['montant'][$facture['Facture']['monnaie']]+=$facture['Facture']['montant'];
				$total['tva'][$facture['Facture']['monnaie']]+=$facture['Facture']['tva'];
				$total['htva'][$facture['Facture']['monnaie']]+=$facture['Facture']['montant']-$facture['Facture']['tva'];
			}

			$datas[$key]=array('factures'=>$factures,'total'=>$total);
			
			foreach($this->facturationMonnaies as $monnaie){
				$totals['montant'][$monnaie]+=$total['montant'][$monnaie];
				$totals['tva'][$monnaie]+=$total['tva'][$monnaie];
				$totals['htva'][$monnaie]+=$total['htva'][$monnaie];
			}	
		}
		
		if(!empty($this->data['Facture']['xls'])&& ($this->data['Facture']['xls']==1)){
			$excelData=array();
			$i=0;
			foreach($models as $model=>$service){
				$excelData[$i]['Client']=$service;
				$excelData[$i]['Numero']='';
				$excelData[$i]['Htva_(BIF)']='';
				$excelData[$i]['Htva_(USD)']='';
				$excelData[$i]['Tva_(BIF)']='';
				$excelData[$i]['Tva_(USD)']='';
				$excelData[$i]['Montant_(BIF)']='';
				$excelData[$i]['Montant_(USD)']='';
				$i++;
				if(!empty($datas[$model]['factures'])){
					foreach($datas[$model]['factures'] as $facture){
						$excelData[$i]['Client']=(empty($facture['Tier']['name']))?'PASSANT':$facture['Tier']['name'];
						$excelData[$i]['Numero']=$facture['Facture']['numero'];
						if($facture['Facture']['monnaie']=='BIF'){
							$excelData[$i]['Htva_(BIF)']=$facture['Facture']['montant']-$facture['Facture']['tva'];
							$excelData[$i]['Htva_(USD)']=0;
							$excelData[$i]['Tva_(BIF)']=$facture['Facture']['tva'];
							$excelData[$i]['Tva_(USD)']=0;
							$excelData[$i]['Montant_(BIF)']=$facture['Facture']['montant'];
							$excelData[$i]['Montant_(USD)']=0;
						}
						else {
							$excelData[$i]['Htva_(BIF)']=0;
							$excelData[$i]['Htva_(USD)']=$facture['Facture']['montant']-$facture['Facture']['tva'];
							$excelData[$i]['Tva_(BIF)']=0;
							$excelData[$i]['Tva_(USD)']=$facture['Facture']['tva'];
							$excelData[$i]['Montant_(BIF)']=0;
							$excelData[$i]['Montant_(USD)']=$facture['Facture']['montant'];
						}
						$i++;
					}
				}
				
			}
		//	exit(debug($excelData));
			$this->set(compact('excelData'));
			$this->layout='ajax';
			$this->render('export_conso');
		}
		$parts=explode('-',$date2);
		$month=(int) $parts[1];
		$year=$parts[0];
		$this->Product->company_info();
		$this->set(compact('month','year','datas','models','totals'));
	}
	
	function rapport($date1=null,$date2=null,$monnaie='',$bonus='no'){
		$factures=$sum=array();
		$goOn=false;
		foreach(array('USD','BIF') as $currency){ // use of currency instead of monnaie to avoid confict
			$sum['montant_'.$currency]=$sum['reste_'.$currency]=$sum['deposit_'.$currency]=0;
		}
		if(($date1!=null)&&($date2!=null)){
			$factureConditions['OR']=array(array('Facture.date >='=>$date1,'Facture.date <='=>$date2),
										array('Facture.id'=>$this->Product->factures($date1, $date2))
										);
			$factureConditions['Facture.monnaie']=$monnaie;
			if($bonus=='no'){
				$factureConditions['Facture.etat']=array('credit','avance');
			}
			else {
				$factureConditions['Facture.etat']=array('bonus');
			}
			$goOn=true;
		}
		else if(!empty($this->data)){
			if($this->data['Facture']['numero']!='') {
				$factureConditions['Facture.numero']=$this->data['Facture']['numero'];
			}
			if(!empty($this->data['Facture']['tier_id'])&&($this->data['Facture']['tier_id'][0]!=0)) {
				$factureConditions['Facture.tier_id']=$this->data['Facture']['tier_id'];
			}
			if($this->data['Tier']['compagnie']!='') {
				$factureConditions['Tier.compagnie like']='%'.$this->data['Tier']['compagnie'].'%';
			}
		//	exit(debug($this->data));
			if($this->data['Facture']['etat'][0]!='toutes') {
				$factureConditions['Facture.etat']=$this->data['Facture']['etat'];
			}
			else {
				$factureConditions['Facture.etat !=']='annulee';
			}
			
			if($this->data['Facture']['operation']!='') {
		 		$factureConditions['Facture.operation like']=$this->data['Facture']['operation'].'%';
			}
			if(isset($this->data['Facture']['personnel_id'])&&($this->data['Facture']['personnel_id']!=0)) {
		 		$factureConditions['Facture.personnel_id']=$this->data['Facture']['personnel_id'];
			}
		 	if(($this->data['Facture']['date1']!='')&&($this->data['Facture']['date2']!='')) {
		 		$date1=$this->data['Facture']['date1'];
				$date2=$this->data['Facture']['date2'];
		 		$factureConditions['OR']=array(array('Facture.date >='=>$date1,'Facture.date <='=>$date2),
										array('Facture.id'=>$this->Product->factures($date1, $date2))
										);
				
			}
			$factureConditions['Facture.monnaie']=$monnaie=$this->data['Facture']['monnaie'];
			$goOn=true;
		}
	
		if($goOn){
			if(!empty($this->data['Facture']['export'])&&($this->data['Facture']['export']==1)){
				$factureConditions['Facture.operation like']='Vente %';
			}
			if(empty($this->data['Facture']['export'])){

				$factures=$this->Facture->find('all',array('fields'=>array('Facture.*','Tier.name','Tier.id','Personnel.name'),
														'conditions'=>$factureConditions,
														'order'=>array('Facture.date')
														)
												);
				
				foreach($factures as $key=>$facture){
					if($facture['Facture']['operation']=='Reservation'){
						$etat=$facture['Facture']['etat'];
						if(!empty($date1)&&!empty($date2)){
							$this->Product->extract_amount($facture,$date1,$date2);
						}
						$facture['Facture']['etat']=($etat=='bonus')?'bonus':$facture['Facture']['etat'];
						if($facture['Facture']['montant']>0){
							$factures[$key]=$facture;
						}
						else {
							unset($factures[$key]);
						}
					}
					$facture['Facture']['deposit']=0;
					if($facture['Facture']['reste']<0){
						$facture['Facture']['deposit']=abs($facture['Facture']['reste']);
						$facture['Facture']['reste']=0;
					}
					if(isset($factureConditions['Facture.etat'])&&
					!in_array($facture['Facture']['etat'],$factureConditions['Facture.etat'])
					){
						unset($factures[$key]);
						continue;
					}
					$sum['montant_'.$facture['Facture']['monnaie']]+=$facture['Facture']['montant'];
					$sum['reste_'.$facture['Facture']['monnaie']]+=$facture['Facture']['reste'];
					$sum['deposit_'.$facture['Facture']['monnaie']]+=$facture['Facture']['deposit'];
					$factures[$key]=$facture;
				}
			//	exit(debug($factures));
			}
			
			//Pie chart stuff pour les serveurs
			if(!empty($this->data['Facture']['export'])&& ($this->data['Facture']['export']==1)){
				$factureConditions['Facture.operation like']='Vente';
			
				$facturesParPersonnel=$this->Facture->find('all',array('fields'=>array('sum(Facture.montant) as montant',
																					'Personnel.name',
																					'count(Facture.id) as total'),
														'group'=>'Facture.personnel_id',
														'conditions'=>$factureConditions,
														'order'=>'Personnel.name'
														)
											);
				if(!empty($facturesParPersonnel)){
					$legend=array();
					$value=array();
					$i=0;
					foreach($facturesParPersonnel as $key=>$facture){
					//serveur stuff
						
						$legend[]=$facture['Personnel']['name'];
						$value[]=$facture['Facture']['total'];
					}
					$this->set(compact('legend','value','date1','date2'));
					$this->layout='ajax';
					$this->render('par_serveur');
				}	
			}
		}
		$serveurs = $this->Facture->Personnel->find('list',array('conditions'=>array('Personnel.fonction_id'=>array(1,2),
																					'Personnel.actif'=>'oui',
																						),
																	'order'=>array('Personnel.name asc')
																	)
														);
		$serveurs[0]='';
	
		$this->set(compact('factures','sum','tiers','date1','date2','serveurs','monnaie'));
			
	}
	
	function index() {
		$factureConditions=$this->Session->read('factureConditions');
		if((empty($this->data))&&(empty($factureConditions))) {
			$this->set('factures', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$factureConditions=array();
			if($this->data['Facture']['id']!='') {
				$factureConditions['Facture.id']=$this->data['Facture']['id'];
			}
			if($this->data['Facture']['numero']!='') {
				$factureConditions['Facture.numero']=$this->data['Facture']['numero'];
			}
			if($this->data['Facture']['monnaie']!='') {
		 		$serviceConditions['Facture.monnaie']=$this->data['Facture']['monnaie'];
			}
			if($this->data['Facture']['linked']!='') {
				$factureConditions['Facture.linked']=$this->data['Facture']['linked'];
			}
			if($this->data['Facture']['tier_id']!=0) {
				$factureConditions['Facture.tier_id']=$this->data['Facture']['tier_id'];
			}
			if($this->data['Tier']['compagnie']!='') {
				$factureConditions['Tier.compagnie']=$this->data['Tier']['compagnie'];
			}
			if(($this->data['Facture']['etat']!='')&&($this->data['Facture']['etat']!='non_nul')) {
				$factureConditions['Facture.etat']=($this->data['Facture']['etat']=='en_cours')?array('en_cours','cloturer'):$this->data['Facture']['etat'];
			}
			elseif($this->data['Facture']['etat']=='non_nul'){
				$factureConditions['Facture.etat !=']='annulee';
			}
			
			if($this->data['Facture']['operation']!='') {
		 		$factureConditions['Facture.operation']=$this->data['Facture']['operation'];
			}
			if($this->data['Facture']['montant']!='') {
		 		$factureConditions['Facture.montant']=$this->data['Facture']['montant'];
			}
			if($this->data['Facture']['monnaie']!='') {
		 		$factureConditions['Facture.monnaie']=$this->data['Facture']['monnaie'];
			}
			if($this->data['Facture']['date1']!='') {
		 		$factureConditions['Facture.date >=']=$this->data['Facture']['date1'];
				
			}
		 	if($this->data['Facture']['date2']!='') {
		 		$factureConditions['Facture.date <=']=$this->data['Facture']['date2'];
				
			}
			
			$this->set('factures', $this->paginate($factureConditions));
			$this->Session->write('factureConditions',$factureConditions);
		}
		else {
			$this->set('factures', $this->paginate($factureConditions));
		}
	}
	function _room(&$facture){
		$info=$this->Facture->Reservation->find('first',array('conditions'=>array('Reservation.arrivee <='=>$facture['Facture']['date'],
																			'Reservation.depart >='=>$facture['Facture']['date'],
																			'Reservation.etat !='=>'annulee',
																			'Reservation.tier_id'=>$facture['Facture']['tier_id']
																			),
														'fields'=>array('Chambre.name')
													));	
		if(!empty($info['Chambre']['name']))
			$facture['Tier']['chambre']=$info['Chambre']['name'];
	}
	
	
	function view($id,$type='standard',$export_to_xls=0) {
		$ids[]=$id;
		$facture=$this->Facture->find('first',array('fields'=>array('Facture.*','Tier.*','Personnel.name'),
													'conditions'=>array('Facture.id'=>$id),
													));
		if(!empty($facture['Tier'])){
			$this->_room($facture);
		}
		if (empty($facture)) {
			$this->Session->setFlash('Cette facture n\'existe pas !');
			$this->redirect($this->referer());
		}
		$parts=explode(' ',$facture['Facture']['operation']);
		$model=$parts[0];
		$fields=array();
		switch($model){
			case 'Proforma':
				$fields=array('Proforma.*','Produit.name');
				break;
			case 'Reservation':
				if($facture['Facture']['etat']!='annulee')
					$this->redirect(array('controller'=>'reservations','action'=>'facture_globale/'.$id));
				else
					$fields=array('Reservation.*','Chambre.name','Facture.date');
				break;
			case 'Vente':
				$fields=array('Vente.*','Produit.name','Facture.date');
				break;
			case 'Service':
				$fields=array('Service.*','TypeService.name');
				break;
			case 'Location':
				$fields=array('Location.*','Salle.name','Salle.montant');
				break;
		}
		
		$modelInfos=($model=='Buanderie')?array():$this->Facture->$model->find('all',array('fields'=>$fields,
															'conditions'=>array($model.'.facture_id'=>$id)
															)
												);
		if($model=='Vente'){
			$journalInfo=$this->Facture->Journal->find('first',array('fields'=>array('Personnel.name','Journal.date',
																		'Journal.numero','Journal.id'
																		),
														'conditions'=>array('Journal.id'=>$facture['Facture']['journal_id'])
														));
			$this->set('journalInfo',$journalInfo);
		}
		$typeAppareils=array();
		
		if($model=='Service'){
			if(Configure::read('aser.mahanaim')){
				$InServices=array();
				foreach($modelInfos as $modelInfo){
					$typeAppareils[$modelInfo['Service']['type_service_id']]=$modelInfo['TypeService']['name'];
				}
			}	
			//pre fill the data for modification of the service
			if(isset($modelInfos[0]['Service'])){
				$this->data['Service']=$modelInfos[0]['Service'];
			}
		}
		
		
		
		$nature=(($model=='Proforma')||($facture['Facture']['etat']=='proforma'))?('Proforma'):('');
		if($model=='Location'){
			$this->loadModel('LocationExtra');
			$locationInfo=$modelInfos[0];
			$location=array();
			if($locationInfo['Location']['location']!=0){
				//$periode='<br/>(Pour la période du '.$this->_date_format($locationInfo['Location']['arrivee']).' au '.$this->_date_format($locationInfo['Location']['depart']).')';
				//$location[0]['LocationExtra']['name']='Location de la salle '.$locationInfo['Salle']['name'].' '.$periode;
				$location[0]['LocationExtra']['name']='Salle : '.$locationInfo['Salle']['name'];
				$location[0]['LocationExtra']['heure']=null;
				$location[0]['LocationExtra']['quantite']=$this->Product->diff($locationInfo['Location']['arrivee'],$locationInfo['Location']['depart'])+1;
				$location[0]['LocationExtra']['PU']=$locationInfo['Location']['PU'];
				$location[0]['LocationExtra']['montant']=$locationInfo['Location']['location'];
				$location[0]['LocationExtra']['monnaie']=$locationInfo['Location']['monnaie'];
			}
			$conditions['LocationExtra.location_id']=$locationInfo['Location']['id'];
			
			if(in_array($type,array('standard','globale'))){
				$conditions['LocationExtra.extra']=array('oui','resto');
			}
			elseif($type=='proforma'){
				$conditions['LocationExtra.extra']=array('oui','non');
			}
			$modelInfos=$this->LocationExtra->find('all',array('conditions'=>$conditions,
													'recursive'=>-1,
													'fields'=>array('LocationExtra.*')
													)
											);	
			$modelInfos=array_merge_recursive($modelInfos,$location);
			if($type=='proforma'){
				$total=0;
				foreach($modelInfos as $service){
					$total+=$service['LocationExtra']['montant'];
				}
				$facture['Facture']['montant']=$total;
				$nature='Proforma';
			}
			if($type=='standard'){
				$total=0;
				foreach($modelInfos as $service){
					$total+=$service['LocationExtra']['montant'];
				}
				$facture['Facture']['montant']=$total;
				$nature='';
			}
			$ventes=$services=array();
			if($type=='globale'){
				$total=0;
				$ventes=$this->Facture->Vente->find('all',array('fields'=>array('Vente.quantite',
																					'Vente.montant',
																					'Produit.name',
																					'Vente.PU',
																					'Facture.etat',
																					'Facture.id'
																					),
																	'conditions'=>array('Facture.date >='=>$locationInfo['Location']['arrivee'],
																						'Facture.date <='=>$locationInfo['Location']['depart'],
																						'Facture.etat'=>array('payee','excedent','avance','bonus','credit'),
																						'Facture.tier_id'=>$facture['Tier']['id'],
																						),
																	));
				foreach($ventes as $vente){
					$total+=$vente['Vente']['montant'];
					$ids[]=$vente['Facture']['id'];
				}

				$services=$this->Facture->Service->find('all',array('fields'=>array(
																					'Service.montant',
																					'Service.description',
																					'Facture.id'
																					),
																	'conditions'=>array('Facture.date >='=>$locationInfo['Location']['arrivee'],
																						'Facture.date <='=>$locationInfo['Location']['depart'],
																						'Facture.etat'=>array('payee','excedent','avance','bonus','credit'),
																						'Facture.tier_id'=>$facture['Tier']['id'],
																						),
																	));
				foreach($services as $key=>$service){
					$total+=$service['Service']['montant'];
					$ids[]=$service['Facture']['id'];
				}
				foreach($modelInfos as $extra){
					$total+=$extra['LocationExtra']['montant'];
				}
				$facture['Facture']['montant']=$total;
				$nature='Globale';
			}
			//after determination of the right amount of the bill, we calculate the tva
			$facture['Facture']['tva']=$this->Product->tva($total,$facture['Facture']['tva_incluse']);
			if(!$facture['Facture']['tva_incluse']){
				$facture['Facture']['montant']=$total+$facture['Facture']['tva'];
				//determination du reste
				$pyts=$this->Facture->Paiement->find('all',array('fields'=>array('sum(Paiement.montant) as montant'),
																'conditions'=>array('Paiement.facture_id'=>$facture['Facture']['id'])
																));
				$facture['Facture']['reste']=(!empty($pyts[0]['Paiement']['montant']))?
												$facture['Facture']['montant']-$pyts[0]['Paiement']['montant']:
												$facture['Facture']['montant'];
			}
		}
		
		$pyts=$this->Facture->Paiement->find('all',array('fields'=>array('Paiement.*',
																		'Facture.id',
																		'Facture.numero',
																		'Facture.operation',
																		'Facture.monnaie',
																		'Facture.date',
																		'Personnel.name'
																		),
															'conditions'=>array('Paiement.facture_id'=>$ids)
															)
												);
		$sumPyts=$this->Facture->Paiement->find('all',array('fields'=>array('sum(Paiement.montant) as montant',
																			'sum(Paiement.montant_equivalent) as montant_equivalent',
	 																		'Facture.monnaie',
	 																		'Paiement.monnaie'
																			),
															'conditions'=>array('Paiement.facture_id'=>$ids),
															'group'=>array('Paiement.monnaie')
												));
		$tiers=$this->Facture->Tier->find('list',array('conditions'=>array('Tier.actif'=>1),
													'order'=>array('Tier.name')
													));
		//grouping all pos extras according to gpe comptable
		if($model=='Vente')
			$venteCptables=$this->Product->gpeCptable(array(0=>array('Facture'=>array('id'=>$id))));
		else 
			$venteCptables=array();
		
		$data['company_info']=$this->Product->company_info();
		$warning=$this->Conf->find('warning');
		$signature=$this->Conf->find('signature');
	//	exit(debug($signature));
		$referer=$this->referer();
		$this->set(compact('facture',
						'pytSum',
						'model',
						'modelInfos',
						'pyts',
						'sumPyts',
						'tiers',
						'nature',
						'warning',
						'ventes',
						'type',
						'signature',
						'services',
						'referer',
						'id',
						'venteCptables',
						'typeAppareils',
						'locationInfo'
			));
	//*
		if($export_to_xls){
			$data['signature']=$signature;
			$data['Facture']=$facture['Facture'];
			$data['Facture']['numero']=($export_to_xls==2)?$data['Facture']['aserb_num']:$data['Facture']['numero'];
			$data['model']=$model;
			$data['nature']=$nature;
			$data['Tier']=$facture['Tier'];
			$data['modelInfos']=$modelInfos;
			$data['ventes']=(!empty($ventes))?$ventes:array();
			$data['services']=(!empty($services))?$services:array();
			$filename=$this->Product->bill2xls($data);
			$this->redirect('/files/'.$filename);
		//*/
		}
	}

	/*
	function add() {
		if (!empty($this->data)) {
			$this->Facture->create();
			if ($this->Facture->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'facture'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'facture'));
			}
		}
	}
*/
	
}
?>
