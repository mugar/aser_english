<?php
class PaiementsController extends AppController {

	var $name = 'Paiements';
	function silhouette_payment($id,$montant){
		//delete first all paiements
		$this->Paiement->deleteAll(array('Paiement.facture_id'=>$id));
		
		$paiement['Paiement']['montant']=$montant;
		$paiement['Paiement']['date']=date('Y-m-d');
		$paiement['Paiement']['mode_paiement']='cash';
		$paiement['Paiement']['reference']='silhouette_paie';
		$paiement['Paiement']['type']='cash';
		$paiement['Paiement']['facture_id']=$id;
		$this->add($paiement,true,false);
		$this->redirect(array('controller'=>'factures','action'=>'view/'.$id));
	}
	
	function index() {
		$this->set('paiements', $this->paginate());
	}
	
	function edit(){
		
	}
	 function payment($chambre='yes',$date1=null,$monnaie='',$pyt='no',$mode='',$personnelId=null){
	 	if($date1!=null){
			$cond['Paiement.date']=$date1;
			if($mode!='all')
				$cond['Paiement.mode_paiement']=$mode;
			$list=$this->Product->factures($date1,$date1);
		//	exit(debug($list));
			if($pyt!='all'){
				if($pyt=='yes'){
					$factCond['OR']=array('Facture.date'=>$date1,'Facture.id'=>$list);
				}
				else {
					$factCond['Facture.date !=']=$date1;
					$factCond['NOT']=array('Facture.id'=>$list);
				}
			}
			if($personnelId!=null){
				$cond['Paiement.personnel_id']=$personnelId;
			}
			$cond['OR']=array(array('Paiement.monnaie'=>$monnaie),
							array('Facture.monnaie'=>$monnaie,'Paiement.montant_equivalent'=>null));
			$date2=$date1;
		}
		else {
			if(!empty($this->data['Paiement']['mode_paiement'])){
		 		$cond['Paiement.mode_paiement']=$date1=$this->data['Paiement']['mode_paiement'];
		 	}
		 	if(!empty($this->data['Paiement']['date1'])){
		 		$cond['Paiement.date >=']=$date1=$this->data['Paiement']['date1'];
		 	}
			else {
				$cond['Paiement.date >=']=$date1=date('Y-m-d');
			}
			if(!empty($this->data['Paiement']['date2'])){
		 		$cond['Paiement.date <=']=$date2=$this->data['Paiement']['date2'];
		 	}
			else {
				$cond['Paiement.date <=']=$date2=date('Y-m-d');
			}
			if(!empty($this->data['Paiement']['monnaie'])){
				$monnaie=$this->data['Paiement']['monnaie'];
		 		$cond['OR']=array(array('Paiement.monnaie'=>$monnaie),
							array('Facture.monnaie'=>$monnaie,'Paiement.montant_equivalent'=>null));
		 	}
			else {
				$monnaie=($chambre=='yes')?'USD':'BIF';
				$cond['OR']=array(array('Paiement.monnaie'=>$monnaie),
							array('Facture.monnaie'=>$monnaie,'Paiement.montant_equivalent'=>null));
			}
			if(!empty($this->data['Paiement']['compagnie'])){
		 		$factCond['Tier.compagnie']=$this->data['Paiement']['compagnie'];
		 	}
			$cond['AND']=array(0=>array('OR'=>$cond['OR']),
							1=>array('OR'=>array('Facture.operation'=>array('Reservation','Service','Location'),
									'Personnel.fonction_id'=>array('4')
									))
							);
			unset($cond['OR']);
				
			if($chambre=='yes'){
				$this->loadModel('Reservation');
				//$factCond['Facture.operation']='Reservation';
			}
			$factCond['Facture.tier_id !=']=null;
		}
	//	exit(debug($cond));
		$factCond['Facture.etat !=']='annulee';
		$factures=$this->Paiement->Facture->find('list',array('conditions'=>$factCond,
																'fields'=>array('Facture.id','Facture.id'),
																'recursive'=>0
													));
		$cond['Facture.id']=$factures;
	 	$pyts=$this->Paiement->Facture->Paiement->find('all',array('fields'=>array('Paiement.*',
	 															'Facture.numero',
	 															'Facture.id',
	 															'Facture.monnaie',
	 															'Personnel.name',
	 															'Facture.date',
	 															'Facture.operation'
	 															),
	 											'conditions'=>$cond,
	 											'order'=>array('Paiement.date'),
	 											));
	
		foreach($pyts as $key=>$pyt){
			if($chambre=='yes'){
				$resInfo=$this->Reservation->find('first',array('conditions'=>array('Reservation.facture_id'=>$pyt['Facture']['id']),
															'fields'=>array('Chambre.name')
															));
			
				$pyts[$key]['chambre']=$resInfo['Chambre']['name'];
			}
			$client=$this->Paiement->Facture->find('first',array('conditions'=>array('Facture.id'=>$pyt['Facture']['id']),
															'fields'=>array('Tier.name','Tier.id','Tier.compagnie')
															));
			if(!empty($client)){
				$pyts[$key]['client']=$client['Tier'];
			}
		}
	//	exit(debug($pyts));
		$sumPyts=$this->Paiement->find('all',array('fields'=>array('sum(Paiement.montant) as montant',
																	'sum(Paiement.montant_equivalent) as montant_equivalent',
	 															'Facture.monnaie',
	 															'Paiement.monnaie'
	 															),
	 											'conditions'=>$cond,
	 											'group'=>array('Facture.monnaie','Paiement.monnaie')
	 											));
		$this->set(compact('pyts','date1','date2','sumPyts','chambre','monnaie'));
	 }
	
	function _date_checker($date){
		if($date>date('Y-m-d'))
			exit(json_encode(array('success'=>false,'msg'=>'La date donnée est incorrecte!')));
	}
	
	function mass_payment(){
	//exit(debug($this->data));
		
		$this->_date_checker($this->data['Paiement']['date']);
		//transfer part
		if($this->data['Paiement']['mode_paiement']=='transfer'){
			$search=$this->Paiement->Facture->find('first',array('fields'=>array('Facture.id',
																				'Facture.montant',
																				'Facture.etat'
																			),
															'conditions'=>array('Facture.numero'=>$this->data['Paiement']['facture_transfer'],
																				'Facture.date'=>$this->data['Paiement']['date_facture'],
																				'Facture.operation'=>'Reservation',
																				
																			),
															'recursive'=>0,
													)
											);
			if(empty($search)){
				exit(json_encode(array('success'=>false,'msg'=>'La facture d\'ou il faut tirer le paiement n\'existe pas!')));
			}
			else {
				$transfer=$this->data;
				$transfer['Paiement']['montant']=-1*$this->data['Paiement']['montant'];
				$transfer['Paiement']['facture_id']=$search['Facture']['id'];
				$transfer['Paiement']['id']=null;
				$this->Paiement->save($transfer);
				$this->Product->update_facture($search['Facture']['id'],$search['Facture']['montant'],$search['Facture']['etat'],null,false);
			}
		}	

		$pytTotal=$this->data['Paiement']['montant'];
		$pytEquiTotal=(!empty($this->data['Paiement']['montant_equivalent']))?$this->data['Paiement']['montant_equivalent']:0;
		if(($pytEquiTotal>0)&&($pytTotal!=$pytEquiTotal)){
			if($pytTotal>=$pytEquiTotal){
				$taux=$pytTotal/$pytEquiTotal;
				$op='/';
			}
			else {
				$taux=$pytEquiTotal/$pytTotal;
				$op='*';
			}
		}		
		
		foreach($this->data['Id'] as $value){
			if($value!=0) {
				$facture=$this->Paiement->Facture->find('first',array('conditions'=>array('Facture.id'=>$value),
																		'fields'=>array('Facture.reste',
																						'Facture.monnaie',
																						)
																		)
															);
				
				$this->data['Paiement']['montant']=(($facture['Facture']['reste']<=$pytTotal)&&($this->data['rows']>1))?$facture['Facture']['reste']:$pytTotal;
				$pytTotal-=$this->data['Paiement']['montant'];
				
				if($this->data['Paiement']['montant']>0){
					if(($pytEquiTotal>0)&&($pytTotal!=$pytEquiTotal)){
						$this->data['Paiement']['montant_equivalent']=($op=='/')?
																	round($this->data['Paiement']['montant']/$taux,2):
																	$this->data['Paiement']['montant']*$taux;
					}	
				
					$this->data['Paiement']['facture_id']=$facture['Facture']['id'];
					$this->add($this->data,false);
				}
			}	
		}
		exit(json_encode(array('success'=>true,'msg'=>'ok')));
	}
	
	function add($data=array(),$single=true,$exit=true) {
		//getting the date
		$data=(!empty($this->data))?($this->data):($data);
		
		
		$this->_date_checker($this->data['Paiement']['date']);
		
		if($data['Paiement']['type']=='remboursement'){
			$data['Paiement']['montant']=$data['Paiement']['montant']*-1;
			$data['Paiement']['mode_paiement']='remboursement';
		}
		//facture details
		$facture=$this->Paiement->Facture->find('first',array('fields'=>array('Facture.id',
																			'Facture.montant',
																			'Facture.etat',
																			'Facture.reste',
																			'Facture.journal_id',
																			'Facture.operation'
																			),
															'conditions'=>array('Facture.id'=>$data['Paiement']['facture_id']),
															'recursive'=>0,
													)
											);
		if($single&&($data['Paiement']['montant']>$facture['Facture']['reste'])){
			if($exit)
				exit(json_encode(array('success'=>false,'msg'=>'Paiement trop elevée!')));
			else 
				return false;
		}
		//journal stuff si c'est une caissiere qui fait l'operation
		if(($this->Auth->user('fonction_id')==2)){
			$journal=$this->Product->journal();
			$data['Paiement']['journal_id']=$journal['id'];
			$data['Paiement']['date']=$journal['date'];
		}
		else {
			$data['Paiement']['journal_id']=$facture['Facture']['journal_id'];
		}
		//saving ...
		$data['Paiement']['id']=null;
		if(!$this->Paiement->save($data)) exit(json_encode(array('success'=>false,'msg'=>'Failed to save the Payment')));

		//updating bill state		
		if($facture['Facture']['operation']!='Vente'){
			$this->Product->update_facture($facture['Facture']['id'],$facture['Facture']['montant'],$facture['Facture']['etat'],null,false);
		}
		if($single&&$exit){
			exit(json_encode(array('success'=>true,'msg'=>'ok!')));
		}
	}
	
	function recu($ids,$clientId){
		$ids=explode(',',$ids);
		$pyts=$this->Paiement->find('all',array('fields'=>array('Paiement.*',
																'Personnel.name',
																'Facture.operation',
																'Facture.numero',
																'Facture.monnaie',
																'Facture.id'
																),
												'conditions'=>array('Paiement.id'=>$ids),
												'order'=>array('Paiement.date','Facture.id','Paiement.id')
												)
									);
		$client=$this->Paiement->Facture->find('first',array('fields'=>array('Tier.*'),
																		'conditions'=>array('Tier.id'=>$clientId),
																		)
														);
		$facture=$recu=true;
		$this->Product->company_info();
		$referer=$this->referer();
		$this->set(compact('pyts','client','facture','recu','referer'));
	}
	
	function delete() {
		foreach($this->data['Id'] as $value){
			if($value!=0) {
				$pyt=$this->Paiement->find('first',array('fields'=>array('Paiement.id',
																		'Facture.id',
																		'Facture.montant',
																		'Facture.etat',
																		),
																		'conditions'=>array('Paiement.id'=>$value),
																		)
														);
				$this->Paiement->delete($pyt['Paiement']['id']);
				//update the bill
				$this->Product->update_facture($pyt['Facture']['id'],$pyt['Facture']['montant'],$pyt['Facture']['etat'],null,false);
			}	
		}
		//some logics
		exit(json_encode(array('success'=>true)));
	}
}
?>