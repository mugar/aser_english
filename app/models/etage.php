<?php
class Etage extends AppModel {
	var $name = 'Etage';
	var $order = 'Etage.id desc';
	var $recursive = 0;
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed


	var $hasMany = array(
		'Chambre' => array(
			'className' => 'Chambre',
			'foreignKey' => 'etage_id',
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
?>