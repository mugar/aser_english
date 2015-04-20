<?php
class Caiss extends AppModel {
	var $name = 'Caiss';
	var $order = 'Caiss.name asc';
	var $recursive = 0;
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed


	var $hasMany = array(
		'CaisseInterdite' => array(
			'className' => 'CaisseInterdite',
			'foreignKey' => 'caiss_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Operation' => array(
			'className' => 'Operation',
			'foreignKey' => 'element_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	

}
?>