<?php
class Type extends AppModel {
	var $name = 'Type';
	var $order = 'Type.id desc';
	var $recursive = 0;
	var $displayField = 'name';
	
	var $hasMany = array(
		'Operation' => array(
			'className' => 'Operation',
			'foreignKey' => 'element_id',
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