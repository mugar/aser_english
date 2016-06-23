<?php
class Limit extends AppModel {
	var $primaryKey = 'date';
	var $name = 'Limit';
	var $order = 'Limit.date asc';
	var $recursive = 0;
	var $displayField = 'date';
	var $validate = array(
		
		'date' => array(
			'notempty' =>array('rule' =>array('date'),
				'message' => 'Champ requis !',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'montant' => array(
			'numeric' =>array('rule' =>array('numeric'),
				'message' => 'Champ requis !',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	

	
}
?>