<?php
class Historique extends AppModel {
	var $name = 'Historique';
	var $order = 'Historique.id desc';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $validate = array(
		'stock_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => false,
				'required' => true,
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
		'debit' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'credit' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		'date' => array(
			'numeric' => array(
				'rule' => array('date'),
				'message' => 'Date',
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
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
			'order' => ''
		),
		'Stock' => array(
			'className' => 'Stock',
			'foreignKey' => 'stock_id',
			'conditions' => '',
			'order' => ''
		),
		
		
	);	
	function solde($id,$historiqueId=null){
		$cond['Historique.produit_id']=$id;
		$cond['Historique.date <=']=date('Y-m-d');
		if($historiqueId){
			$cond['Historique.id !=']=$historiqueId;
		}
			$ants=$this->find('all',array('fields'=>array('sum(Historique.debit) as debit',
														'sum(Historique.credit) as credit',
						                    			),
						                    		'conditions'=>$cond
													));
			$debit=(isset($ants[0]['Historique']['debit']))?$ants[0]['Historique']['debit']:0;
			$credit=(isset($ants[0]['Historique']['credit']))?$ants[0]['Historique']['credit']:0;
			$solde=$debit-$credit;
			$this->Produit->id=$id;
			if($this->Produit->saveField('quantite',$solde)){
				return true;
			}
			else {
				exit(json_encode(array('success'=>false,'msg'=>'Probleme avec l historique du stock.')));	
				return false;

			}
	}
	function afterSave($created){
		if(!empty($this->data['Historique']['produit_id'])){
			$this->solde($this->data['Historique']['produit_id']);			
		}
		return true;
	}
	
	function beforeDelete($cascade){
		$search=$this->find('first',array('conditions'=>array('Historique.id'=>$this->id),
										'fields'=>array('Historique.produit_id')
										));
		
		if(!empty($search['Historique']['produit_id'])){
			$this->solde($search['Historique']['produit_id'],$this->id);			
		}	
		return true;		
	}
	
	function custom_delete($id){
	//*
			$search=$this->find('first',array('conditions'=>array('Historique.id'=>$id),
										'fields'=>array('Historique.produit_id')
										));
			$this->delete($id);
			
			$this->solde($search['Historique']['produit_id']);
			
	//*/
		return true;
	}
}
?>
