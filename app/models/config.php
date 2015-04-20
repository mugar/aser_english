<?php 
class Config extends AppModel {
    
    var $name = "Config";
    
    var $belongsTo = array(
		'Personnel' => array(
			'className' => 'Personnel',
			'foreignKey' => 'personnel_id',
			'conditions' => '',
			'fields' =>'',
			'order' => ''
		)
	);
}
