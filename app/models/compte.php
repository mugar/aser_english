<?php
class Compte extends AppModel {
	var $name = 'Compte';
	var $order = 'Compte.numero asc';
	var $recursive = 0;
	var $displayField = 'name';
	var $virtualFields = array(
    'composer' => 'CONCAT(Compte.numero, " : ", Compte.name)'
    );

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	/*
	var $belongsTo = array(
		'Tier' => array(
			'className' => 'Tier',
			'foreignKey' => 'tier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	//*/
	var $hasMany = array(
		'CompteOperation' => array(
			'className' => 'CompteOperation',
			'foreignKey' => 'compte_id',
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
