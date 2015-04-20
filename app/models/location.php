<?php
class Location extends AppModel {
	var $name = 'Location';
	var $order = 'Location.id desc';
	var $recursive = 0;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Facture' => array(
			'className' => 'Facture',
			'foreignKey' => 'facture_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Salle' => array(
			'className' => 'Salle',
			'foreignKey' => 'salle_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
		'Tier' => array(
			'className' => 'Tier',
			'foreignKey' => 'tier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'LocationExtra' => array(
			'className' => 'LocationExtra',
			'foreignKey' => 'location_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Trace' => array(
			'className' => 'Trace',
			'foreignKey' => 'model_id',
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