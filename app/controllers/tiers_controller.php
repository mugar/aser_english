<?php
class TiersController extends AppController {

	var $name = 'Tiers';
	
	function merge(){
		if(empty($this->data)){
			exit(json_encode(array('success'=>false,'msg'=>'Aucun Tier séléctionné!')));
		}
		$this->loadModel('Service');
		$this->loadModel('Entree');
		$this->loadModel('Sorti');
		$this->loadModel('Reservation');
		$this->loadModel('Location');
		$this->loadModel('Facture');
		
		set_time_limit(240);    //4minutes
		ini_set('memory_limit', '64M');

			$id=$this->data['rowId'];
			$ids=array();
			foreach($this->data['Id'] as $value){
				if(($value!=0)&&($value!=$id)) {
					$ids[]=$value;
				}
			}
			$names=$this->Tier->find('all',array('fields'=>array('Tier.id'),
													'conditions'=>array('Tier.id'=>$ids)
													));
			foreach($names as $name){
				$services=$this->Service->find('all',array('fields'=>array('Service.id'),
																'conditions'=>array('Service.tier_id'=>$name['Tier']['id'])
																));
				foreach($services as $service){
					$service['Service']['tier_id']=$id;
					$this->Service->save($service);
				}
				$entrees=$this->Entree->find('all',array('fields'=>array('Entree.id'),
																'conditions'=>array('Entree.tier_id'=>$name['Tier']['id'])
																));
				foreach($entrees as $entree){
					$entree['Entree']['tier_id']=$id;
					$this->Entree->save($entree);
				}
				
				$sortis=$this->Sorti->find('all',array('fields'=>array('Sorti.id'),
																'conditions'=>array('Sorti.tier_id'=>$name['Tier']['id'])
																));
				foreach($sortis as $sorti){
					$sorti['Sorti']['tier_id']=$id;
					$this->Sorti->save($sorti);
				}
				$reservations=$this->Reservation->find('all',array('fields'=>array('Reservation.id'),
																'conditions'=>array('Reservation.tier_id'=>$name['Tier']['id'])
																));
				foreach($reservations as $reservation){
					$reservation['Reservation']['tier_id']=$id;
					$this->Reservation->save($reservation);
				}
				$locations=$this->Location->find('all',array('fields'=>array('Location.id'),
																'conditions'=>array('Location.tier_id'=>$name['Tier']['id'])
																));
				foreach($locations as $location){
					$location['Location']['tier_id']=$id;
					$this->Location->save($location);
				}
				$factures=$this->Facture->find('all',array('fields'=>array('Facture.id'),
																'conditions'=>array('Facture.tier_id'=>$name['Tier']['id'])
																));
				foreach($factures as $facture){
					$facture['Facture']['tier_id']=$id;
					$this->Facture->save($facture);
				}
				if($name['Tier']['id']!=$id){
					$this->Tier->delete($name['Tier']['id']);
				}
			}
		if(!empty($this->data['name'])){
			$this->Tier->save(array('Tier'=>array('id'=>$id,'name'=>$this->Product->name($this->data['name']))));
		}
		exit(json_encode(array('success'=>true)));
	}
	function autoComplete($field){
  		$tiers=$this->Tier->find('all', array(
			 'conditions' =>array('Tier.'.$field.' like'=>$this->data['Tier'][$field].'%'),
 		   	'fields' => array('distinct Tier.'.$field),
 		   	'recursive'=>-1
 		   ));
		$this->set(compact('tiers','field'));
 		$this->layout = 'ajax';
	}
	
	function rapport(){
		$conditions=$tiers=array();
		if(!empty($this->data)){
			foreach($this->data['Tier'] as $key=>$value){
				if(($key!='actif')&&($value!='toutes')){
					$conditions['Tier.'.$key.' like ']='%'.$value.'%';
				}
			}
			if($this->data['Tier']['actif']!='toutes'){
				$conditions['Tier.actif']=($this->data['Tier']['actif']=='oui')?(1):(0);
			}
			$tiers=$this->Tier->find('all',array('conditions'=>$conditions,
												'recursive'=>-1,
												'order'=>array('Tier.name')
										));
		}
		$this->set('tiers',$tiers);
	}
	
	function disable(){
		foreach($this->data['Id'] as $value){
			if($value!=0) {
				$info=$this->Tier->find('first',array('conditions'=>array('Tier.id'=>$value),
													'fields'=>array('Tier.actif')
														));
				if($info['Tier']['actif'])
					$this->Tier->save(array('Tier'=>array('id'=>$value,'actif'=>0)));
				else 
					$this->Tier->save(array('Tier'=>array('id'=>$value,'actif'=>1)));
			}	
		}
		exit(json_encode(array('success'=>true,'msg'=>'Succès !')));
	}
	function global_bill($id,$date1,$date2,$xls=0){
		$tier=$this->Tier->find('first',array('conditions'=>array('Tier.id'=>$id)));
		$ventes=$this->Tier->Facture->Vente->find('all',array('fields'=>array('Vente.*',
																		'Produit.name',
																		'Facture.date',
																		'Facture.beneficiaire',
																		'Facture.matricule',
																		'Facture.liasse',
																		'Facture.employeur',
																		'Facture.monnaie',
																		'Facture.id'
																		),
														'conditions'=>array('Facture.tier_id'=>$id,
																			'Facture.date >='=>$date1,
																			'Facture.date <='=>$date2,
																			'Facture.etat'=>array('credit','avance'),
																			'Facture.operation'=>'Vente'
																			),
														'order'=>array('Vente.id asc')
															));
			$total=0;
			$lastPosition=0;
			foreach($ventes as $key=>$vente){
				if(($key>0)&&($ventes[$key]['Facture']['id']==$ventes[$lastPosition]['Facture']['id'])){
					$ventes[$key]['Facture']['date']='';
					$ventes[$key]['Facture']['liasse']='';
					$ventes[$key]['Facture']['employeur']='';
					$ventes[$key]['Facture']['matricule']='';
					$ventes[$key]['Facture']['beneficiaire']='';
				}
				else {
					$lastPosition=$key;
				}
				$remise=($vente['Vente']['montant']*$vente['Vente']['pourcentage'])/100;
				$ventes[$key]['Vente']['reduction']=$remise;
				$ventes[$key]['Vente']['total']=$vente['Vente']['montant']-$remise;
				$total+=$ventes[$key]['Vente']['total'];
			}
		$factures=$this->Tier->Facture->find('all',array('fields'=>array('sum(Facture.original) as original',
																		'Facture.monnaie'
																		),
														'conditions'=>array('Tier.id'=>$id,
																			'Facture.date >='=>$date1,
																			'Facture.date <='=>$date2,
																			'Facture.etat'=>array('credit','avance'),
																			'Facture.operation'=>'Vente'
																			),
														'order'=>array('Facture.date asc')
																
															));
		$pyts=$this->Tier->Facture->Paiement->find('all',array('fields'=>array('Paiement.*',
																				'Personnel.name',
																				'Facture.*',
																						),
														'conditions'=>array(
																			'Facture.date >='=>$date1,
																			'Facture.date <='=>$date2,
																			'Facture.etat'=>array('credit','avance'),
																			'Facture.operation'=>'Vente',
																			'Facture.tier_id'=>$id
																			)
																
															));	
		$total_pyts=0;
		foreach($pyts as $pyt){
			$total_pyts+=$pyt['Paiement']['montant'];
		}
		
		if($tier['Tier']['type_reduction']=='Sur le total'){
			$original=$factures[0]['Facture']['original'];
			$reduction=$tier['Tier']['reduction'];
			$montant=$original-(($original*$reduction)/100);
			$avance=$total_pyts;
			$reste=$montant-$avance;
		}
		else {
			$original=$factures[0]['Facture']['original'];
			$reduction=$tier['Tier']['reduction'];
			$montant=$original;
			$avance=$total_pyts;
			$reste_original=$montant-$avance;
			$reste=$reste_original-(($reste_original*$reduction)/100);
		}
		$tva=$this->Product->tva($montant);
		$warning=$this->Conf->find('warning');
		$this->Product->company_info();
		$signature=$this->Conf->find('signature');
		$this->set(compact('tva',
						'montant',
						'reste_original',
						'reste',
						'warning',
						'tier',
						'ventes',
						'original',
						'reduction',
						'date1',
						'date2',
						'pyts',
						'total_pyts',
						'signature',
						'total',
						'id'
						));
		if($xls){
			$data=array();
			foreach($ventes as $key=>$vente){
				$data[$key]['Date']=($vente['Facture']['date'])?
									$this->Product->toFrench($vente['Facture']['date']):
									'';
				$data[$key]['Beneficiaire']=$vente['Facture']['beneficiaire'];
				$data[$key]['Matricule']=$vente['Facture']['matricule'];
				$data[$key]['Liasse']=$vente['Facture']['liasse'];
				$data[$key]['Employeur']=$vente['Facture']['employeur'];
				$data[$key]['Produit']=$vente['Produit']['name'];
				$data[$key]['Quantité']=$vente['Vente']['quantite'];
				$data[$key]['PU']=$vente['Vente']['PU'];
				$data[$key]['Sous Total']=$vente['Vente']['montant'];
				$data[$key]['Montant Payé']=$vente['Vente']['reduction'];
				$data[$key]['Montant Restant']=$vente['Vente']['total'];
			}
			$filename=$this->Product->excel($data,array(),'global_client');
			$this->redirect('/files/'.$filename);
		}
	}
	
	function index(){
		$tierConditions=$this->Session->read('tierConditions');
		if((empty($this->data))&&(empty($tierConditions))) {
			$this->set('tiers', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$tierConditions=array();
			foreach($this->data['Tier'] as $key=>$value){
				if((!in_array($key,array('actif','chambre')))&&($value!='')){
					$tierConditions['Tier.'.$key.' like ']='%'.$value.'%';
				}
			}
			if($this->data['Tier']['actif']!=''){
				$tierConditions['Tier.actif']=($this->data['Tier']['actif']=='oui')?(1):(0);
			}
			if(!empty($this->data['Tier']['chambre'])){
				$tierid=$this->Tier->Reservation->find('first',array('fields'=>array('Reservation.tier_id'),
																	'conditions'=>array('Chambre.name' =>$this->data['Tier']['chambre'],
																						'Reservation.arrivee <='=>date('Y-m-d'),
																						'Reservation.depart >='=>$this->Product->increase_date(date('Y-m-d'),-1),
																						'Reservation.etat'=>'arrivee'
																						),
																		)
															);
				if(!empty($tierid['Reservation']['tier_id']))
					$tierConditions['Tier.id']=$tierid['Reservation']['tier_id'];
			}
			$this->set('tiers', $this->paginate($tierConditions));
			$this->Session->write('tierConditions',$tierConditions);
		}
		else {
			$this->set('tiers', $this->paginate($tierConditions));
		}
		$this->set(compact('tiers'));
	}

	function view($id = null) {
		$this->redirect(array('controller'=>'factures','action'=>'credit/'.$id));
	}

	function _logic($data,$action){
		$this->Tier->set($data);
		if(!$this->Tier->validates()){
			$failureMsg='Le Nom est obligatoire!';
			if(($action=='edit')||(isset($data['Tier']['booking'])))
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
			else 
				exit('failure_'.$failureMsg);
		}
		if($action=='add'){
			$data['Tier']['actif']=1;
			$data['Tier']['name']=str_ireplace(' ', '',$data['Tier']['nom']).' '.str_ireplace(' ', '',$data['Tier']['prenom']);
		}
		$data['Tier']['name']=$this->Product->name($data['Tier']['name']);
		if(!empty($data['Tier']['id'])){
			$cond['Tier.id !=']=$data['Tier']['id'];
		}
		$cond['Tier.name']=$data['Tier']['name'];
		$search=$this->Tier->find('first',array('conditions'=>$cond)
							);
		if (!empty($search)) {
			$failureMsg='Cette Personne est déjà enregistrée!';
			if(($action=='edit')||(isset($data['Tier']['booking'])))
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
			else 
				exit('failure_'.$failureMsg);
		}
		$this->Tier->save($data);
		
		if(isset($data['Tier']['booking'])){
			exit(json_encode(array('success'=>true,'msg'=>'Client enregistré!','id'=>$this->Tier->id)));
		}
	}
	
	function _show($id){
		$this->set('tier',$this->Tier->find('first',array('fields'=>array('Tier.*'),
    														'conditions'=>array('Tier.id'=>$id)
															)
											));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->Tier->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Tier->find('first',array('fields'=>array('Tier.*'),
																		'conditions'=>array('Tier.id'=>$id),
																		'recursive'=>-1
																		));
				$action='edit';
				$context='index';
				$model='Tier';
				$this->set(compact('action','context','model'));
			}
		}
		else {
			$this->_show($id);
		}
	}

	function delete($id = null) {
		$notDeleted=0;
		$deleted=array();
		foreach($this->data['Id'] as $id){
			if($id!=0) {
				$test1=$this->Tier->Facture->find('first',array('conditions'=>array('Facture.tier_id'=>$id),
																'recursive'=>-1
												));
				$test2=$this->Tier->Entree->find('first',array('conditions'=>array('Entree.tier_id'=>$id),
																'recursive'=>-1
												));
				$test3=$this->Tier->Reservation->find('first',array('conditions'=>array('Reservation.tier_id'=>$id),
																'recursive'=>-1
												));
				if ((!empty($test1))||(!empty($test2))||(!empty($test3))){
					$notDeleted++;
				}
				else {
					$this->Tier->delete($id);
					$deleted[]=$id;
				}
			}
		}
		$msg="Vérifié s'il n'y a pas d'enregistrements attachés à  ";
		$msg=($notDeleted>1)?$msg.'ces personnes.':$msg.'cette personne.';
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>$msg
							)));
	}
}
?>