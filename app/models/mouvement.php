<?php
class Mouvement extends AppModel {
	var $name = 'Mouvement';
	var $order = array('Mouvement.date desc','Mouvement.id desc');
	var $recursive = 0;
	var $validate = array(
		'quantite' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Produit' => array(
			'className' => 'Produit',
			'foreignKey' => 'produit_id',
			'conditions' => '',
			'fields' =>'',
			'order' => ''
		),
    	'StockSortant' => array(
    	  'className' => 'Stock',
    	  'foreignKey' => 'stock_sortant_id'
    	),
    	'StockEntrant' => array(
    	  'className' => 'Stock',
    	  'foreignKey' => 'stock_entrant_id'
    	),
    	'Personnel' => array(
    	  'className' => 'Personnel',
    	  'foreignKey' => 'personnel_id'
    	),
	);
}
?>