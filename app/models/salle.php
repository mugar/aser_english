<?php
class Salle extends AppModel {
	var $name = 'Salle';
	var $order = 'Salle.id desc';
	var $recursive = 0;
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $validate = array(
		
		'name' => array(
			'notempty' =>array('rule' =>array('notempty'),
				'message' => 'Champ requis !',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'montant' => array(
			'numeric' =>array('rule' =>array('numeric'),
				'message' => 'Champ requis !',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	var $hasMany = array(
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'salle_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}