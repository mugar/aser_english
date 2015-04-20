<?php
class BuanderiesController extends AppController {

	var $name = 'Buanderies';
	var $paginate=array('conditions'=>array('Facture.operation'=>'Buanderie'));
	Var $uses = array('Facture');
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->loadModel('Chambre');
		$chambres=$this->Chambre->find('list');	
		$chambres1=array('')+$chambres;
		$this->set(compact('chambres','chambres1'));	
	}
	
	function index() {
		$factureConditions=$this->Session->read('factureConditions');
		if((empty($this->data))&&(empty($factureConditions))) {
			$this->set('factures', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$factureConditions=array();
			if($this->data['Facture']['numero']!='') {
				$factureConditions['Facture.numero']=$this->data['Facture']['numero'];
			}
			if($this->data['Facture']['tier_id']!=0) {
				$factureConditions['Facture.tier_id']=$this->data['Facture']['tier_id'];
			}
			if($this->data['Facture']['chambre_id']!=0) {
				$factureConditions['Facture.chambre_id']=$this->data['Facture']['chambre_id'];
			}
			if($this->data['Tier']['compagnie']!='') {
				$factureConditions['Tier.compagnie']=$this->data['Tier']['compagnie'];
			}
			if(($this->data['Facture']['etat']!='')&&($this->data['Facture']['etat']!='non_nul')) {
				$factureConditions['Facture.etat']=$this->data['Facture']['etat'];
			}
			elseif($this->data['Facture']['etat']=='non_nul'){
				$factureConditions['Facture.etat !=']='annulee';
			}
			if($this->data['Facture']['montant']!='') {
		 		$factureConditions['Facture.montant']=$this->data['Facture']['montant'];
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
	
	function chambre($chambre) {
		exit(json_encode(array('success'=>true,'id'=>$this->Product->chambre($chambre))));
  	}
	
	function _logic(&$data,$action){
			//Saving the facture 
		$data['Facture']['operation']='Buanderie';
		$data['Facture']['etat']='credit';
		$data['Facture']['reste']=$data['Facture']['montant'];
		$data['Facture']['monnaie']=Configure::read('aser.default_currency');
	//	exit(debug($data));
		$this->Facture->save($data);
		//getting the display number
		$this->Product->facture_number($this->Facture->id,'Buanderie');
	}

	function _show($id){
		$this->set('facture',$this->Facture->find('first',array('fields'=>array(
   																					'Tier.name','Tier.id',
    																				'Facture.*'
    																				),
    																		'conditions'=>array('Facture.id'=>$id)
																			)
																));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->Facture->id);
		}
	}

	
	
}
?>
