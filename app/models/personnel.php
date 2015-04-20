<?php
class Personnel extends AppModel {
	var $name = 'Personnel';
	var $displayField = 'name';
	var $order= 'Personnel.name asc';
	var $belongsTo = array('Fonction');
	// Acl stuff
	var $actsAs = array('Acl' => array('type' => 'requester'));
 
    	function parentNode(){
        	if (!$this->id) {
            		return null;
        	}
        	$data = $this->read();
        
       		if (!$data['Personnel']['fonction_id']){
            		return null;
        	} 
        	else {
            		return array('model' => 'Fonction', 'foreign_key' => $data['Personnel']['fonction_id']);
        	}
    	}

	var $hasMany = array(
    	'Facture' => array(
    	   'className' => 'Facture',
    	   'foreignKey' => 'personnel_id'
    	),
    	'Paiement' => array(
    	   'className' => 'Paiement',
    	   'foreignKey' => 'personnel_id'
    	),
    	
    	'Trace' => array(
    	   'className' => 'Trace',
    	   'foreignKey' => 'personnel_id'
    	),
	);
	var $validate = array(
		'date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(/*
			'alphanumeric' => array(
				'rule' => array('alphanumeric',' '),
				'message' => 'Seules les caractères alphanumériques sont valides !',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),*/
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Ce champ est obligatoire !',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
?>