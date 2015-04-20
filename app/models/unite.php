<?php

class Unite extends AppModel {
	var $name = 'Unite';
	var $displayField = 'name';
	var $recursive=0;
	//The Associations below have been created with all possible keys, those that are not needed can be removed
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
	);
	
	var $hasMany = array(
    	'Produit' => array(
      		'className' => 'Produit',
      		'foreignKey' => 'unite_id'
    	),
	);

}
?>