<?php
class CompteOperation extends AppModel {
	var $name = 'CompteOperation';
	var $order = array('CompteOperation.date desc','CompteOperation.id desc');
	var $recursive = 0;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Compte' => array(
			'className' => 'Compte',
			'foreignKey' => 'compte_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Personnel' => array(
			'className' => 'Personnel',
			'foreignKey' => 'personnel_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>