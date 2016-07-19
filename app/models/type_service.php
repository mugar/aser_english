<?php
class TypeService extends AppModel {
	var $name = 'TypeService';
	var $order = 'TypeService.id desc';
	var $recursive = 0;
	var $displayField = 'name';
	var $virtualFields = array('full_name' => "CONCAT(TypeService.name,'_',TypeService.montant)"); 
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'GroupeComptable' => array(
			'className' => 'GroupeComptable',
			'foreignKey' => 'groupe_comptable_id',
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

	var $hasMany = array(
		'Service' => array(
			'className' => 'Service',
			'foreignKey' => 'type_service_id',
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
?>