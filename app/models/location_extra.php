<?php
class LocationExtra extends AppModel {
	var $name = 'LocationExtra';
	var $order = 'LocationExtra.id desc';
	var $recursive = 0;
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}