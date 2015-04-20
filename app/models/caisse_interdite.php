<?php
class CaisseInterdite extends AppModel {
	var $name = 'CaisseInterdite';
	var $order = 'CaisseInterdite.id desc';
	var $recursive = 0;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Personnel' => array(
			'className' => 'Personnel',
			'foreignKey' => 'personnel_id',
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
		)
	);
}
?>