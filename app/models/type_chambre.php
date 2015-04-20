<?php
class TypeChambre extends AppModel {
	var $name = 'TypeChambre';
	var $order = 'TypeChambre.name asc';
	var $recursive = 0;
	var $displayField = 'name';
	var $validate = array(
		
		'name' => array(
			'notempty' => array('rule' => array('notempty'),
				'message' => 'Champ requis !',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'montant' => array(
			'numeric' => array('rule' => array('numeric'),
				'message' => 'Champ requis !',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Chambre' => array(
			'className' => 'Chambre',
			'foreignKey' => 'typeChambre_id',
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