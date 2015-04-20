<?php
class Paiement extends AppModel {
	var $name = 'Paiement';
	var $order = 'Paiement.id desc';
	var $recursive = 0;
	

	var $validate = array(
		'journal_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'montant' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date' => array(
			'rule' => array('date'),
			'message' => 'Date',
			'allowEmpty' => false,
			'required' => true,
			//'last' => false, // Stop validation after this rule
			//'on' => 'create', // Limit validation to 'create' or 'update' operations
		),
		'mode_paiement' => array(
			'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
               'allowEmpty' => false,
				'required' => true,
                'message' => 'mode de Paiement obligatoire'
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Facture' => array(
			'className' => 'Facture',
			'foreignKey' => 'facture_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Journal' => array(
			'className' => 'Journal',
			'foreignKey' => 'journal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Personnel' => array(
			'className' => 'Personnel',
			'foreignKey' => 'personnel_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	* this function's job is to update the bill to which this paiement is attached.
	* it does it on aftersave and on beforedelete.
	*/
	function _sharedLogic($callback){
		if($this->id){
			$paiementInfo = $this->find('first',array('fields'=>array(
																	'Facture.montant',
																	'Facture.id'
																	),
													'conditions'=>array('Paiement.id'=>$this->id)
													));
			if(!empty($paiementInfo['Facture']['id'])){
				$idToIgnore=($callback=='beforeDelete')?$this->id:null;
				$this->Facture->updateBillStatus($paiementInfo['Facture'],$idToIgnore);
			}
			else return false;
		}
		else return false;
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