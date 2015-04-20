<?php
class Abscence extends AppModel {
	var $name = 'Abscence';
	var $order = 'Abscence.id desc';
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
}
?>