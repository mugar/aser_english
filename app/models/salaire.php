<?php
class Salaire extends AppModel {
	var $name = 'Salaire';
	var $order = 'Salaire.id desc';
	var $recursive = 0;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Personnel' => array(
			'className' => 'Personnel',
			'foreignKey' => 'personnel_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Paie' => array(
			'className' => 'Paie',
			'foreignKey' => 'salaire_id',
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