<?php
class Perte extends AppModel {
	var $name = 'Perte';
	var $order = array('Perte.date desc','Perte.id desc');
	var $recursive = 0;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		
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
		)
	);
}
?>