<?php
class Sorti extends AppModel {
	var $name = 'Sorti';
	var $order = array('Sorti.date desc','Sorti.id desc');
	var $recursive = 0;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $validate = array(
		'stock_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'produit_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'quantite' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Valeurs numériques seulement !',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date' => array(
			'numeric' => array(
				'rule' => array('date'),
				'message' => 'Date',
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
	);
	var $belongsTo = array(
		
		'Tier' => array(
			'className' => 'Tier',
			'foreignKey' => 'tier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
		'Produit' => array(
			'className' => 'Produit',
			'foreignKey' => 'produit_id',
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
		),
		'Stock' => array(
			'className' => 'Stock',
			'foreignKey' => 'stock_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
}