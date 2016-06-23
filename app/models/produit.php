<?php

class Produit extends AppModel {
	var $name = 'Produit';
	var $displayField = 'name';
	var $recursive=0;
	var $virtualFields = array('fullname' => "CONCAT(Produit.name,'_',Produit.quantite,'_',Produit.PV)", 
														);  
	var $validate = array(
		//*
		'name' => array(
			'notempty' => array('rule' => array('notempty'),
				'message' => 'Champ requis !',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		//*/
		'groupe_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => true,
				'required' => false,
			),
		),
		'PV' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'min' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Unite' => array(
			'className' => 'Unite',
			'foreignKey' => 'unite_id',
			'conditions' => '',
			'fields' =>array('Unite.id,Unite.name'),
			'order' => ''
		),
		'Groupe' => array(
			'className' => 'Groupe',
			'foreignKey' => 'groupe_id',
			'conditions' => array('Groupe.actif'=>'oui'),
			'fields' =>array('Groupe.id,Groupe.name','Groupe.section_id'),
			'order' => ''
		),
		
		'GroupeComptable' => array(
			'className' => 'GroupeComptable',
			'foreignKey' => 'groupe_comptable_id',
			'fields' =>array('GroupeComptable.id,GroupeComptable.name'),
			'order' => ''
		),
		
	);

	var $hasMany = array(
    	'EstComposerPar' => array(
      		'className' => 'Ingredient',
      		'foreignKey' => 'produit_id',
    	),
    	'Compose' => array(
      		'className' => 'Ingredient',
      		'foreignKey' => 'ingredient_id'
    	),
		'Entree' => array(
			'className' => 'Entree',
			'foreignKey' => 'produit_id',
			'dependent' => false,
			'conditions' => '',
			'fields' =>'',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Vente' => array(
			'className' => 'Vente',
			'foreignKey' => 'produit_id',
			'dependent' => false,
			'conditions' => '',
			'fields' =>'',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Perte' => array(
			'className' => 'Perte',
			'foreignKey' => 'produit_id',
			'dependent' => false,
			'conditions' => '',
			'fields' =>'',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Sorti' => array(
			'className' => 'Sorti',
			'foreignKey' => 'produit_id',
			'dependent' => false,
			'conditions' => '',
			'fields' =>'',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Mouvement' => array(
			'className' => 'Mouvement',
			'foreignKey' => 'produit_id',
			'dependent' => false,
			'conditions' => '',
			'fields' =>'',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Historique' => array(
			'className' => 'Historique',
			'foreignKey' => 'historique_id',
			'dependent' => false,
			'conditions' => '',
			'fields' =>'',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Tarif' => array(
			'className' => 'Tarif',
			'foreignKey' => 'produit_id',
			'dependent' => false,
			'conditions' => '',
			'fields' =>'',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		
		'Trace' => array(
			'className' => 'Trace',
			'foreignKey' => 'model_id',
			'dependent' => false,
			'conditions' => '',
			'fields' =>'',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	
	function beforeSave(){
		if(!empty($this->data[$this->alias]['relations'])&&is_array($this->data[$this->alias]['relations'])){
			$this->data[$this->alias]['relations']=implode(',',$this->data[$this->alias]['relations']);
		}
			return true;
	}
	
	function logIt($id,$action){
			$data['Action']=$action.' BY '.strtoupper($this->sessionRead('Auth.Personnel.name'));
			$search=$this->find('first',array('conditions'=>array('Produit.id'=>$this->id),
											'fields'=>array(
															'Produit.id',
															'Produit.name',
															'Produit.PV',
															'Produit.type',
															'Produit.actif'
															),
											));
			$data['Produit']=$search['Produit'];
			CakeLog::write('produit',print_r($data,true));
	}
	
}