<?php
class Section extends AppModel {
	var $name = 'Section';
	var $order = 'Section.name asc'; 
	var $displayField = 'name';
	var $validate = array(
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
		'Groupe' => array(
			'className' => 'Groupe',
			'foreignKey' => 'section_id',
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

}