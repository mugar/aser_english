<?php
class ServicesController extends AppController {

	var $name = 'Services';

	//documents stuff
	function beforeFilter(){
		parent::beforeFilter();
		if(in_array($this->params['action'], array('add','edit')))
			$this->set('monnaies',$this->facturationMonnaies);
	}
	
	function gerer($factureId=0){
	//	exit(debug($this->data));
		
		if(!empty($this->data['Vente'])){
		//	exit(debug($this->data));
			$factureId=$this->data['facture_id'];
			//deleting the data already stored first
			if($factureId!=0)
				$this->Service->deleteAll(array('Service.facture_id'=>$factureId));
			//saving now the new data
			$montantTotal=0;
			foreach($this->data['Vente'] as $service){
				$serv['Service']['type_service_id']=$this->data['type_service_id'];
				$serv['Service']['facture_id']=$factureId;
				$serv['Service']['description']=$service['description'];
				$serv['Service']['montant']=$service['montant'];
				$this->Service->save($serv);
				unset($this->Service->id);
				
				$montantTotal+=$serv['Service']['montant']; //calcul du montant total de la facture
			}
			$facture['montant']=$facture['original']=$montantTotal;
			$facture['reste']=0;
			$facture['etat']='credit';
			$facture['date']=$this->data['date'];
			$facture['tier_id']=$this->data['tier_id'];
			$facture['operation']='Service';
			$facture['id']=($factureId==0)?null:$factureId;
			
			$this->Service->Facture->save(array('Facture'=>$facture)); //updating or creating the bill
			$this->render();
		
		}
		else if(empty($this->data)&&!$factureId) {
			$typeServices=$this->Service->TypeService->find('list',array(
													'conditions'=>array(),
													'order'=>array('TypeService.name')
														));
			$services=array();
			if($factureId)
				$services=$this->Service->find('all',array('conditions'=>array('Service.facture_id'=>$factureId),
															'fields'=>array('Service.montant','Service.description'),
															));
			$this->set(compact('typeServices','services'));
		}
	}

	function rapport($date1=null,$date2=null){
		if($date1&$date2){
			$this->data['Facture']['date1']=$date1;
			$this->data['Facture']['date2']=$date2;
			$this->data['NOT']=array('Facture.etat'=>array('canceled','proforma'));
		}
		//Building conditions
		$conditions=array();
		$date1=$date2=null;
		if(!empty($this->data['Facture']['date1'])){
			$conditions['Facture.date >=']=$date1=$this->data['Facture']['date1'];
		}
		if(!empty($this->data['Facture']['date2'])){
			$conditions['Facture.date <=']=$date2=$this->data['Facture']['date2'];
			
		}
		if(isset($this->data['Vente']['tier_id'])&&($this->data['Vente']['tier_id']!=0)) {
			$conditions['Service.tier_id']=$this->data['Vente']['tier_id'];
		}
		if(isset($this->data['Vente']['type_service_id'])&&($this->data['Vente']['type_service_id'][0]!=0)) {
	 		$conditions['Service.type_service_id']=$this->data['Vente']['type_service_id'];
		}
		
		if(isset($this->data['Facture']['numero'])&&($this->data['Facture']['numero']!='toutes')) {
	 		$conditions['Facture.numero like']='%'.$this->data['Facture']['numero'].'%';
		}
		if(isset($this->data['Facture']['monnaie'])&&($this->data['Facture']['monnaie']!='')) {
	 		$conditions['Facture.monnaie']=$this->data['Facture']['monnaie'];
		}
		if(isset($this->data['Facture']['etat'])&&($this->data['Facture']['etat']!='toutes')) {
	 		$conditions['Facture.etat']=$this->data['Facture']['etat'];
		}
		else {
			$conditions['Facture.etat !=']='canceled';
		}
		//exit(debug($conditions));
		$groupServices=$this->Service->find('all',array('fields'=>array(
																	'TypeService.name',
																	'Facture.numero',
																	'Facture.id',
																	'Facture.etat',
																	'Facture.date',
																	'Tier.name',
																	'Service.*'
																	),
													'conditions'=>$conditions,
													'order'=>'Facture.date asc'
													)
										);
		
		$sum=$this->Service->find('all',array('fields'=>array('sum(Service.montant) as montant',
															'Service.monnaie'
															),
													'group'=>array('Service.monnaie'),
													'conditions'=>$conditions,
													)
										);

		
		
		$typeServices = $this->Service->TypeService->find('list',array('order'=>'name'));
		$typeServices[0]='toutes';
		$tiers = $this->Service->Tier->find('list',array('conditions'=>array('Tier.type'=>array('client','polyvalent'),
																			'Tier.actif'=>1
																			)
																));
		$tiers[0]='toutes';
		$this->set(compact('typeServices','tiers','groupServices','sum','date1','date2'));
	}
	
	

	function index($date=null) {
		$date=(is_null($date))?(date('Y-m-d')):($date);
		$fonction=$this->Auth->user('fonction_id');
		//fetching the bills
		if(in_array($fonction,array(2,4))){
			$cond1['Facture.personnel_id']=$this->Auth->user('id');
		}
		$cond1['Facture.operation']='Service';
		$cond1['Facture.date']=$date;
	
		$factures=$this->Service->Facture->find('all',array('fields'=>array('Facture.*','Tier.name','Personnel.name'
																),
													'conditions'=>$cond1,
													'order'=>'Facture.id desc'
													)
										);
		if($this->RequestHandler->isAjax()){
			$this->set(compact('factures'));
			$this->layout="ajax";
			$this->render('list_factures');
		}
		else {
			$type_services = $this->Service->TypeService->find('list',array( 'fields'=>array('TypeService.id','TypeService.full_name'),
																	'order'=>array('TypeService.name asc'),
																	)
													);
			}
			$thermal=$this->Conf->find('thermal');
			$change=$this->Conf->find('change');
		
		
			$personnels = $this->Service->Personnel->find('list',array('conditions'=>array('Personnel.fonction_id'=>2,//caissier fonction
																						'Personnel.actif'=>'yes',
																						),
																	'order'=>array('Personnel.name asc')
																	)
														);
			
			$personnels[0]='';
			
			// exit(debug($type_services));
			$this->set(compact('type_services',
								'personnels',
								'factures',
								'sections',
								'date',
								'thermal',
								'change',
								'tiers',
								'fonction'
								));
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'service'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('service', $this->Service->read(null, $id));
	}
	function facturation(){
	//	exit(debug($this->data));
		$this->Service->save($this->data);
		//getting data for billing
		$data['Id'][0]=$this->Service->id;
		$data['Facture']['etat']='credit';
		if(isset($this->data['Facture']['id'])){
			$data['Facture']['id']=$this->data['Facture']['id']; // this one is set only when modifying the service 
		}
		$data['Facture']['date']=$this->data['Vente']['date'];
		$data['Document']['model']='Service';
		$this->Product->create_facture($data);
	}
	
	function removal($factureId,$consoId,$quantite,$reduction,$obs=''){
		$stockFailureMsg="Stock error";
		if($consoId=='facture'){
			$ventes=$this->Service->find('all',array('fields'=>array('Service.historique_id','Service.acc'),
													'conditions'=>array('Service.facture_id'=>$factureId)
													)
												);
			//product stuff
			foreach($ventes as $vente){
				if(Configure::read('aser.connexion')){
					if(!empty($vente['Service']['historique_id'])){
						if(!$this->Product->productHistoryDelete($vente['Service']['historique_id'],'Historique'))
							exit(json_encode(array('success'=>false,'msg'=>$stockFailureMsg)));

						if(!$this->Product->productHistoryDelete($vente['Service']['acc'],'Service'))
							exit(json_encode(array('success'=>false,'msg'=>$stockFailureMsg)));
					}
				}
			}
			//annulation de la facture 
			if(!$this->Service->Facture->save(array('Facture'=>array('id'=>$factureId,
																'observation'=>$obs,
																'classee'=>1,
																'etat'=>'canceled'
																)
										)))
			{ 
				exit(json_encode(array('success'=>false,'msg'=>'Unable to save the invoice!')));
			}

			//trace stuff
			$trace['Trace']['model_id']=$factureId;
			$trace['Trace']['model']='Facture';
			$trace['Trace']['operation']='Cancellation of the invoice. Reason : "'.$obs.'"';
			$this->Service->Facture->Trace->save($trace);
			
			exit(json_encode(array('success'=>true,
								)
						)
			);
		}
		elseif($consoId!=0) {
			$fields=array('Service.*',
						'Facture.date'
						);
			$vente=$this->Service->find('first',array('fields'=>$fields,
													'conditions'=>array('Service.id'=>$consoId)
													)
												);
			$old_quantite=$vente['Service']['quantite'];
			if($old_quantite<$quantite){
				exit(json_encode(array('success'=>false,'msg'=>'The quantity is too high!')));
			}
			//useful to track orders deleted after being sent to the kitchen.
			if($vente['Service']['quantite']<$vente['Service']['printed']){
				$this->_create_vente_efface($vente,$quantite,$obs);
			}

			$vente['Service']['quantite']-=$quantite;
			$vente['Service']['montant']=$vente['Service']['quantite']*$vente['Service']['PU'];
			
			//useful to track orders deleted after being sent to the kitchen.
			if($vente['Service']['quantite']<$vente['Service']['printed']){
				$old_printed=$vente['Service']['printed'];
				$vente['Service']['printed']=$vente['Service']['quantite'];
				$qte_printed_removed=	$old_printed-$vente['Service']['printed'];
				$this->_create_vente_efface($vente,$qte_printed_removed,$obs);
			}
	
			if(($old_quantite-$quantite)>0){
				if(Configure::read('aser.connexion')){		
					//stock part
					$return=$this->Product->stock($vente,'credit');
					if(!$return['success'])
						exit(json_encode(array('success'=>false,'msg'=>$stockFailureMsg)));

					//acc
					if(!empty($vente['Service']['acc'])){
						$acc=$this->Service->find('first',array('fields'=>$fields,
															'conditions'=>array('Service.id'=>$vente['Service']['acc'])
															)
													);
						if(!empty($acc)){
							$return=$this->Product->stock($acc,'credit');
							if(!$return['success'])
								exit(json_encode(array('success'=>false,'msg'=>$stockFailureMsg)));
						}
					}
				}
					//vente part
				if(!$this->Service->save($vente))
					exit(json_encode(array('success'=>false,'msg'=>"Unable to save the product")));
			}
			else {
				if(Configure::read('aser.connexion')){
					if(!empty($vente['Service']['historique_id'])){
						if(!$this->Product->productHistoryDelete($vente['Service']['historique_id'],'Historique'))
							exit(json_encode(array('success'=>false,'msg'=>$stockFailureMsg)));

						if(!$this->Product->productHistoryDelete($vente['Service']['acc'],'Service'))
							exit(json_encode(array('success'=>false,'msg'=>$stockFailureMsg)));
					}
				}
				$deleteMsg="Unable to delete the product.";
				//vente part
				if(!$this->Service->delete($consoId))
					exit(json_encode(array('success'=>false,'msg'=>$deleteMsg)));		
				//gestion des accompagnents
				if(!is_null($vente['Service']['acc'])){
					if(!$this->Service->delete($vente['Service']['acc']))
						exit(json_encode(array('success'=>false,'msg'=>$deleteMsg)));	
				}
			}
			//$sum=$this->Product->bill_total($factureId, $reduction);
			//fetching the info of the updated bill
			$facture=$this->Service->Facture->find('first',array('conditions'=>array('Facture.id'=>$factureId),
																		'fields'=>array('Facture.original',
																						'Facture.montant',
																						'Facture.reste',
																						'Facture.avance_beneficiaire as avance'
																				),
																		'recursive'=> -1
																));
			
			exit(json_encode(array('success'=>true,
									'quantite'=>$vente['Service']['quantite'],
									'PT'=>$vente['Service']['montant'],
									)
									+
							$facture['Facture']
						)
			);
		}
		else {
				exit(json_encode(array('success'=>false,
										'msg'=>'Click on the product to select it.'
								)
						)
			);
		}
	}
	
	function add($nembeteplus=0){
		//date to use
		$date = date('Y-m-d');

		//initializing some variables.
		$failToSaveMsg="Failed to save this sale.";
		$data['Service']['date']=$date;
		$data['Service']['quantite']=$this->data['Vente']['quantite'];
		$data['Service']['type_service_id']=$this->data['Vente']['produit_id'];

		//setting up the reduction in vente array. this will force the bill when updated 
		//on aftersave callback to recalculate the reduction
		$this->data['Vente']['reduction']=0; //ignoring for now reduction stuff
		//getting the montant to use
		$type_service=$this->Service->TypeService->find('first',array('fields'=>array(
																			'TypeService.montant',
																			'TypeService.id'
																			),
																	'conditions'=>array('TypeService.id'=>$data['Service']['type_service_id'])
																	)
													);
		if(empty($this->data['Vente']['PU'])){							
				$data['Service']['PU']=$type_service['TypeService']['montant'];
		}
		$montant=$data['Service']['montant']=$data['Service']['PU']*$data['Service']['quantite'];
		
		
		//look for a previous vente to add up to. or create a new if none else with same details (produit_id, PU) is found.
		$found=false;
		if($this->data['Vente']['factureId']!='creation'){
			$factureId=$this->data['Vente']['factureId'];
			$conditions['Service.facture_id']=$factureId;
			$conditions['Service.type_service_id']=$data['Vente']['type_service_id'];
			
			$search=$this->Service->find('first',array('fields'=>array('Service.id',
																	'Service.quantite',
																	'Service.printed',
																	'Service.type_service_id',
																	'Service.montant',
																	'Service.PU',
																	'Facture.date'
																	),
														'conditions'=>$conditions,
														)
										);
										
			if(!empty($search)){
				$found=true;
				$printed=$search['Service']['printed'];
				//j'essaie d'empecher qu'on ajoute un produit avec un PU different du premier
				if($this->data['Vente']['PU']!=$search['Service']['PU']){
					exit(json_encode(array('success'=>false,'msg'=>'The unit price must be the same as the previous one!')));
				}
				
				$data['Service']['id']=$consoId=$search['Service']['id'];
				$data['Service']['quantite']+=$search['Service']['quantite'];
				$data['Service']['montant']+=$search['Service']['montant'];
				
			}
														
		}
	//	*/
		//if no similar vente is found.
		if(!$found){
			$consoId=null;
			$printed=0;
		}

	

		//facture stuff
		$factureNum=null;
		if($this->data['Vente']['factureId']=='creation'){
			$facture['Facture']['etat']='in_progress';
			$facture['Facture']['tva_incluse']=1;
			$facture['Facture']['date']=$date;
			$facture['Facture']['tier_id']=($this->data['Vente']['tier_id']=='null')?NULL:$this->data['Vente']['tier_id'];
			$facture['Facture']['reduction']=$this->data['Vente']['reduction'];
			$facture['Facture']['monnaie']=Configure::read('aser.default_currency');
			$facture['Facture']['operation']='Service';	
			$facture['Facture']['personnel_id']=$this->Auth->user('id');
			
			if(!$this->Service->Facture->save($facture)) exit(json_encode(array('success'=>false,'msg'=>"Failed to create the invoice.")));
			$factureId=$this->Service->Facture->id;
			//determining the facture's display number
			$factureNum=$this->Product->facture_number($factureId,'Service');
			
			//trace stuff
			$trace['Trace']['model_id']=$factureId;
			$trace['Trace']['model']='Facture';
			$trace['Trace']['operation']='Creation of the invoice with the state : in_progress';
			$this->Service->Facture->Trace->save($trace);
		}
		else {
			$factureId=$this->data['Vente']['factureId'];
		}
	
		
		$this->data['Vente']['id']=$consoId; //quand on ajoute to an existing vente
		if(!$this->Service->save($this->data)) exit(json_encode(array('success'=>false,'msg'=>$failToSaveMsg)));

		$consoId=$this->Service->id; //quand on cree un nouveau
		

		//fetching the bill with updated totals for display.
		$facture=$this->Service->Facture->find('first',array('fields'=>array('Facture.original','Facture.montant','Facture.reduction',
																		'Facture.reste','Facture.avance_beneficiaire'
																			),
															'conditions'=>array('Facture.id'=>$factureId)
															));
		//json response array
		$response=array('success'=>true,
						'factureId'=>$factureId,
						'factureNum'=>$factureNum,
						'personnel_name'=>$this->Auth->user('name'),
						'PU'=>$data['Service']['PU'],
						'PT'=>$montant,
						'montant'=>$facture['Facture']['montant'],
						'reste'=>$facture['Facture']['reste'],
						'date'=>$this->Product->formatDate($date),
						'consoId'=>$consoId,
						'original'=>$facture['Facture']['original'],
						'reduction'=>$facture['Facture']['reduction'],
						'avance_beneficiaire'=>$facture['Facture']['avance_beneficiaire'],
						'printed'=>$printed,
						);
		if($this->data['Vente']['factureId']=='creation'){
			$response['journal']=null;
		}
		exit(json_encode($response));
	}

}
?>