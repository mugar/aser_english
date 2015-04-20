<?php
class Service extends AppModel {
	var $name = 'Service';
	var $order = 'Service.id desc';
	var $recursive = 0;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Tier' => array(
			'className' => 'Tier',
			'foreignKey' => 'tier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Facture' => array(
			'className' => 'Facture',
			'foreignKey' => 'facture_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TypeService' => array(
			'className' => 'TypeService',
			'foreignKey' => 'type_service_id',
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