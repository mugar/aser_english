<?php
class Vente extends AppModel {
	var $name = 'Vente';
	var $order = 'Vente.id desc';
	var $recursive = 0;
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $validate = array(
		'facture_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'stock_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'produit_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'historique_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'quantite' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);

	var $belongsTo = array(
		
		'Produit' => array(
			'className' => 'Produit',
			'foreignKey' => 'produit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Stock' => array(
			'className' => 'Stock',
			'foreignKey' => 'stock_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Facture' => array(
			'className' => 'Facture',
			'foreignKey' => 'facture_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
    	'Personnel' => array(
    	  'className' => 'Personnel',
    	  'foreignKey' => 'personnel_id'
    	),
    	'Historique' => array(
    	  'className' => 'Historique',
    	  'foreignKey' => 'historique_id'
    	)
	);



	function beforeSave($options){
		if(!empty($this->data['Vente']['id'])){
			$oldVenteInfo = $this->find('first',array('fields'=>array(
																'Vente.facture_id',
																'Facture.etat',
																'Facture.classee',
																'Facture.reduction',
																'Facture.tva_incluse',
																	),
													'conditions'=>array('Vente.id'=>$this->data['Vente']['id'])
													));
			if((($oldVenteInfo['Facture']['etat']=='en_cours')&&(($oldVenteInfo['Facture']['classee']==0)))
				||(Configure::read('aser.aserb')==1)
				){
				/*
				if(!empty($this->data['Vente']['facture_id'])){
					if(($this->data['Vente']['facture_id']!=$oldVenteInfo['Vente']['facture_id'])){
						$this->Facture->updateMontant($oldVenteInfo['Facture'],$this->data['Vente']['id']);
					}
				}*/
				return true;	
			}
			else 
				return false;
		}
		else 
			return true;
	}
	/**
	* this function's job is to update the bill to which this vente is attached.
	* it does it on aftersave and on beforedelete.
	*/
	function _sharedLogic($callback){
		if($this->id){
			$venteInfo = $this->find('first',array('fields'=>array('Vente.facture_id',
																'Facture.id',
																'Facture.reduction',
																'Facture.tva_incluse',
																	),
													'conditions'=>array('Vente.id'=>$this->id)
													));
			if(!empty($venteInfo['Vente']['facture_id'])){
				$idToIgnore=($callback=='beforeDelete')?$this->id:null;
				$this->Facture->updateMontant($venteInfo['Facture'],$idToIgnore);
			}
		}
	}
	function afterSave($created){
		$this->_sharedLogic("afterSave");
	}

	function beforeDelete(){
		$this->_sharedLogic("beforeDelete");
		return true;
	}
}
?>