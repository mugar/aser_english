<?php
class VenteEfface extends AppModel {
	var $name = 'VenteEfface';
	var $order = 'VenteEfface.date asc';
	var $recursive = 0;
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $validate = array(
		'facture_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'produit_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'quantite' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),

		'date' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'date mandatory !',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);

	var $belongsTo = array(
		
		'Produit' => array(
			'className' => 'Produit',
			'foreignKey' => 'produit_id',
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
		
    'Personnel' => array(
      'className' => 'Personnel',
      'foreignKey' => 'personnel_id'
    ),
	);
}
?>