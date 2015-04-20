<?php
class Chambre extends AppModel {
	var $name = 'Chambre';
	var $order = 'Chambre.name asc';
	var $recursive = 0;
	var $displayField = 'name';
	var $validate = array(
		
		'name' => array(
			'notempty' =>array('rule' =>array('notempty'),
				'message' => 'Champ requis !',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'etage' => array(
			'numeric' =>array('rule' =>array('numeric'),
				'message' => 'Champ requis !',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'TypeChambre' => array(
			'className' => 'TypeChambre',
			'foreignKey' => 'type_chambre_id',
			'conditions' => '',
			'fields' =>'',
			'order' => ''
		),
		
	);

	var $hasMany = array(
		'Reservation' => array(
			'className' => 'Reservation',
			'foreignKey' => 'chambre_id',
			'dependent' => false,
			'conditions' => '',
			'fields' =>'',
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