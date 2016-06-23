<?php
class TypesController extends AppController {

	var $name = 'Types';


	function resultat(){
		$date1=date('Y-m').'-01';
		$date2=date('Y-m-d');
		$devise['USD']=$taux=$this->Conf->find('taux_usd');
		
		if (!empty($this->data)) {
			$date1=$this->data['Operation']['date1'];
			$date2=($this->data['Operation']['date2']>date('Y-m-d'))?date('Y-m-d'):$this->data['Operation']['date2'];
			$devise['USD']=$taux=$this->data['Operation']['taux'];
		}
		$monnaie='BIF';
		$devise['BIF']=1;
		$conditions['Operation.date >=']=$date1;
		$conditions['Operation.date <=']=$date2;
		$conditions['Operation.model']='Type';
			
		$depenses=$this->Operation->Type->find('all',array('fields'=>array('Type.name','Type.id'),
													'order'=>array('Type.name'),
													'conditions'=>array('Type.type'=>'depense')
													));
		$total_depenses=$total_ventes=0;
		
		
		
		foreach($depenses as $i=>$depense){
			$conditions['Operation.element_id']=$depense['Type']['id'];
			$sums=$this->Operation->find('all',array('fields'=>array('Type.name',
																	'sum(Operation.debit) as debit',
																	'Operation.monnaie'
																	),
													'conditions'=>$conditions,
													'group'=>array('Operation.monnaie')
												));
			$montantTotal=0;
			foreach($sums as $sum){
				$montant=(isset($sum['Operation']['debit']))?$sum['Operation']['debit']:0;
				$montantTotal+=$montant*$devise[$sum['Operation']['monnaie']];
			}
			$total_depenses+=$depenses[$i]['Type']['montant']=$montantTotal;
		}
		
		$this->loadModel('Facture');
		$this->loadModel('Section');
		$this->loadModel('Vente');
		
		$factures=$this->Facture->find('all',array('fields'=>array('Facture.montant',
																	'Facture.operation',
																	'Facture.monnaie'
																	),
													'conditions'=>array('Facture.Operation'=>array('Reservation','Service','Location'),
																	    'Facture.etat'=>array('payee','credit','avance','excedent'),
																		'Facture.monnaie !='=>'',
																		'OR'=>array(
																				array('Facture.date >='=>$date1,'Facture.date <='=>$date2),
																				array('Facture.id'=>$this->Product->factures($date1, $date2))
																				)
																		),
																));
		$model['Reservation']=$model['Location']=$model['Service']=0;
		
		foreach($factures as $facture){
			if($facture['Facture']['operation']=='Reservation'){
				$this->Product->extract_amount($facture,$date1,$date2);
			}
			$model[$facture['Facture']['operation']]+=$facture['Facture']['montant']*$devise[$facture['Facture']['monnaie']];	
		}
		
		$total_ventes=0;
		if(Configure::read('aser.hotel'))										
			$total_ventes+=$model['Reservation'];
		if(Configure::read('aser.conference'))
			$total_ventes+=$model['Location'];
		if(Configure::read('aser.services'))
			$total_ventes+=$model['Service'];
	
		$sections=$this->Section->find('all',array('fields'=>array('Section.name','Section.id'),
												));
		foreach($sections as $j=>$section){
			$groupes=$this->Section->Groupe->find('list',array('fields'=>array('Groupe.id','Groupe.id'),
															'conditions'=>array('Groupe.section_id'=>$section['Section']['id'])
												));
			$ventes=$this->Vente->find('all',array('fields'=>array('Facture.reduction',
																	'sum(Vente.montant) as montant'
																	),
														'conditions'=>array('Produit.groupe_id'=>$groupes, 
																			'Facture.date >='=>$date1,
																	    	'Facture.date <='=>$date2,
																	    	'Facture.etat'=>array('payee','credit','avance','excedent'),
																	    	'Facture.monnaie !='=>''
																			),
														'group'=>array('Facture.id')
													));
			$total=0;										
			foreach($ventes as $vente){
				$total+=$vente['Vente']['montant']-($vente['Vente']['montant']*$vente['Facture']['reduction']/100);
			}
			$sections[$j]['Section']['montant']=$total;
			$total_ventes+=$total;
		}
		
		$resultat=$total_ventes-$total_depenses;
		$this->set(compact('depenses','model','sections','date1','date2','monnaie','total_depenses','total_ventes','resultat','taux'));
	}

	function beforeFilter(){
		parent::beforeFilter();
		$categories = Configure::read('categories');
		$this->set(compact('categories'));
	}
	function index(){
		$typeConditions=$this->Session->read('typeConditions');
		if((empty($this->data))&&(empty($typeConditions))) {
			$this->set('types', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$typeConditions=array();
			foreach($this->data['Type'] as $key=>$value){
				if($value!='toutes'){
					$typeConditions['Type.'.$key.' like ']=$value.'%';
				}
			}
			$this->set('types', $this->paginate($typeConditions));
			$this->Session->write('typeConditions',$typeConditions);
		}
		else {
			$this->set('types', $this->paginate($typeConditions));
		}
		$this->set(compact('types'));
	}

	function view($id = null) {
		$this->autoRender=false;
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'type'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('type', $this->Type->read(null, $id));
	}

	function _logic($data,$action){
		$this->Type->set($data);
		if(!$this->Type->validates()){
			$this->_error($action,'Le nom du type est obligatoire!');
		}
		//exit(debug($data));
		if($data['Type']['type']=='depense' && $data['Type']['categorie']==0){
			$this->_error($action,'categorie obligatoire');
		}
		if($action=='add'){
			$data['Type']['actif']='oui';
		}
		$cond['Type.name']=$data['Type']['name'];
		if(!empty($data['Type']['id'])){
			$cond['Type.id !=']=$data['Type']['id'];
		}
		$search=$this->Type->find('first',array('fields'=>array('Type.name'),
											'conditions'=>$cond
											));	
		if(!empty($search)){
			$this->_error($action,'Cette type est déjà enregistrée!');
		}	
		$this->Type->save($data);
	}
	
	function _show($id){
		$this->set('type',$this->Type->find('first',array('fields'=>array('Type.*'),
    														'conditions'=>array('Type.id'=>$id)
															)
											));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->Type->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistrée')));
			}
			else {
				$this->data = $this->Type->find('first',array('fields'=>array('Type.*'),
																		'conditions'=>array('Type.id'=>$id),
																		'recursive'=>-1
																		));
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
				$test1=$this->Type->Operation->find('first',array('conditions'=>array('Operation.element_id'=>$id,
																			'Operation.model'=>'Type',
																			),
												'recursive'=>-1
												));	
				if (!empty($test1)){
					$notDeleted++;
				}
				else {
					$this->Type->delete($id);
					$deleted[]=$id;
				}
			}
		}
		$msg="Vérifié s'il n'y a pas des opérations enregistrées sur ";
		$msg=($notDeleted>1)?$msg.'ces types.':$msg.'cette type.';
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>$msg
							)));
	}
}
?>