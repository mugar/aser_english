<?php
class CaisseOperation extends AppModel {
	var $name = 'CaisseOperation';
	var $order = array('CaisseOperation.date desc','CaisseOperation.id desc');
	var $recursive = 0;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Journal' => array(
			'className' => 'Journal',
			'foreignKey' => 'journal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Caiss' => array(
			'className' => 'Caiss',
			'foreignKey' => 'caiss_id',
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