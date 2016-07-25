<?php
class FinalStock extends AppModel {
	var $name = 'FinalStock';
	var $order = array('FinalStock.date desc','FinalStock.id desc');
	var $recursive = 1;
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
		'quantite' => array(
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
		
	);
	var $belongsTo = array(
		
		'StockManager' => array(
			'className' => 'Personnel',
			'foreignKey' => 'stock_manager_id',
			'conditions' => '',
			'order' => ''
		),
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
		'Controler' => array(
			'className' => 'Personnel',
			'foreignKey' => 'controler_id',
			'conditions' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		'Historique' => array(
			'className' => 'Historique',
			'foreignKey' => 'final_stock_id',
			'dependent' => false,
			'conditions' => '',
			'fields' =>'',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
}
?>