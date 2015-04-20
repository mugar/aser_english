<?php
class Paie extends AppModel {
	var $name = 'Paie';
	var $order = 'Paie.id desc';
	var $recursive = 0;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Salaire' => array(
			'className' => 'Salaire',
			'foreignKey' => 'salaire_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>