<?php
class Stock extends AppModel {
	var $name = 'Stock';
	var $displayField = 'name';
	var $validate = array(
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
		'name' => array(
			'notempty' => array('rule' => array('notempty'),
				'message' => 'Champ requis !',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
		
	var $hasMany = array(
    	'MouvementSortant' => array(
   		   'className' => 'Mouvement',
    	   'foreignKey' => 'stock_sortant_id'
    	),
    	'MouvementEntrant' => array(
    	   'className' => 'Mouvement',
    	   'foreignKey' => 'stock_entrant_id'
    	),
    	'Historique' => array(
    	   'className' => 'Historique',
    	   'foreignKey' => 'stock_id'
    	)
	);

}
?>