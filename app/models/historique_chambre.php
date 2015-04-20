<?php
class HistoriqueChambre extends AppModel {
	var $name = 'HistoriqueChambre';
	var $order = 'HistoriqueChambre.id desc';
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