<?php
class Proforma extends AppModel {
	var $name = 'Proforma';
	var $order = 'Proforma.id desc';
	var $recursive = 0;
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
		'Unite' => array(
			'className' => 'Unite',
			'foreignKey' => 'unite_id',
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
			'foreignKey' => 'personnel_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>