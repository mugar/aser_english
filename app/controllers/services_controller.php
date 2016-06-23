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
		
		if(!empty($this->data['Service'])){
		//	exit(debug($this->data));
			$factureId=$this->data['facture_id'];
			//deleting the data already stored first
			if($factureId!=0)
				$this->Service->deleteAll(array('Service.facture_id'=>$factureId));
			//saving now the new data
			$montantTotal=0;
			foreach($this->data['Service'] as $service){
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
			$this->data['NOT']=array('Facture.etat'=>array('annulee','proforma'));
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
		if(isset($this->data['Service']['tier_id'])&&($this->data['Service']['tier_id']!=0)) {
			$conditions['Service.tier_id']=$this->data['Service']['tier_id'];
		}
		if(isset($this->data['Service']['type_service_id'])&&($this->data['Service']['type_service_id'][0]!=0)) {
	 		$conditions['Service.type_service_id']=$this->data['Service']['type_service_id'];
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
			$conditions['Facture.etat !=']='annulee';
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
	
	

	function index() {
		$serviceConditions=$this->Session->read('serviceConditions');
		if((empty($this->data))&&(empty($serviceConditions))) {
			$this->set('services', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$serviceConditions=array();
			if($this->data['Facture']['numero']!='') {
				$serviceConditions['Facture.numero LIKE']='%'.$this->data['Facture']['numero'].'%';
			}
			if($this->data['Service']['tier_id']!=0) {
				$serviceConditions['Service.tier_id']=$this->data['Service']['tier_id'];
			}
			if($this->data['Service']['type_service_id']!=0) {
				$serviceConditions['Service.type_service_id']=$this->data['Service']['type_service_id'];
			}
			if($this->data['Facture']['etat']!='') {
				$serviceConditions['Facture.etat']=$this->data['Facture']['etat'];
			}
			
			if($this->data['Service']['montant']!='') {
		 		$serviceConditions['Service.montant']=$this->data['Service']['montant'];
			}
			if($this->data['Facture']['monnaie']!='') {
		 		$serviceConditions['OR']= array('Facture.monnaie'=>$this->data['Facture']['monnaie'],
		 										'Service.monnaie'=>$this->data['Facture']['monnaie'],
												);
			}
		 	if($this->data['Facture']['date1']!='') {
		 		$serviceConditions['Facture.date >=']=$this->data['Facture']['date1'];
			}
			if($this->data['Facture']['date2']!='') {
		 		$serviceConditions['Facture.date <=']=$this->data['Facture']['date2'];
			}
			$this->set('services', $this->paginate($serviceConditions));
			$this->Session->write('serviceConditions',$serviceConditions);
		}
		else {
			$this->set('services', $this->paginate($serviceConditions));
		}
		
		$typeServices=$this->Service->TypeService->find('list');
		$typeServices[0]='toutes';
		$this->set(compact('caisses','tiers','typeServices'));
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
		$data['Facture']['date']=$this->data['Service']['date'];
		$data['Document']['model']='Service';
		$this->Product->create_facture($data);
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->Service->create();
			if ($this->Service->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'service'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'service'));
			}
		}
		$tiers = $this->Service->Tier->find('list',array('order'=>'Tier.name asc',
														'conditions'=>array('Tier.actif'=>1)
															));
		$typeServices = $this->Service->TypeService->find('list');
		$this->set(compact('tiers','typeServices'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'service'));
			$this->redirect(array('action' => 'index'));
		}
		else {
			$serviceInfo=$this->Service->find('first',array('recursive'=>-1,
																	'conditions'=>array('Service.id'=>$id)
																	)
													);
			if(!empty($serviceInfo['Service']['facture_id'])){
				$this->Session->setFlash('Enregistrement non modifiable !');
				$this->redirect(array('action' => 'index'));
			}
		}
		if (!empty($this->data)) {
			if ($this->Service->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'service'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'service'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Service->read(null, $id);
		}
		$tiers = $this->Service->Tier->find('list',array('order'=>'Tier.name asc','conditions'=>array('Tier.actif'=>1)));
		$factures = $this->Service->Facture->find('list');
		$typeServices = $this->Service->TypeService->find('list');
		$personnels = $this->Service->Personnel->find('list');
		$this->set(compact('tiers', 'factures', 'typeServices', 'personnels'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'service'));
			$this->redirect(array('action'=>'index'));
		}
		else {
			$serviceInfo=$this->Service->find('first',array('recursive'=>-1,
																	'conditions'=>array('Service.id'=>$id)
																	)
													);
			if(!empty($serviceInfo['Service']['facture_id'])){
				$this->Session->setFlash('Enregistrement non effaçable !');
				$this->redirect(array('action' => 'index'));
			}
		}
		if ($this->Service->delete($id)) {
			$this->Session->setFlash(sprintf(__('Enregistrement effacé', true), 'Service'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('Impossible d\'effacer !', true), 'Service'));
		$this->redirect(array('action' => 'index'));
	}

}
?>