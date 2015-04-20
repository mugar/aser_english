<?php
class Trace extends AppModel {
	var $name = 'Trace';
	var $order = 'Trace.id desc';
	var $recursive = 0;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Reservation' => array(
			'className' => 'Reservation',
			'foreignKey' => 'model_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
		'Facture' => array(
			'className' => 'Facture',
			'foreignKey' => 'model_id',
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