<?php
class Relation extends AppModel	{
  var $name = "Relation";
  var $order ="Relation.id desc";
 
  var $belongsTo = array(
		'Stock' => array(
			'className' => 'Stock',
			'foreignKey' => 'stock_id',
			'conditions' => '',
			'fields' =>array('Stock.id','Stock.name'),
			'order' => ''
		),
		'Unite' => array(
			'className' => 'Unite',
			'foreignKey' => 'unite_id',
			'conditions' => '',
			'fields' =>array('Unite.id','Unite.name'),
			'order' => ''
		),
		'Personnel' => array(
			'className' => 'Personnel',
			'foreignKey' => 'personnel_id',
			'conditions' => '',
			'fields' =>array('Personnel.id','Personnel.name'),
			'order' => ''
		),
  
    'PremierProduit' => array(
      'className' => 'Produit',
      'foreignKey' => 'premier_produit_id',
	  'fields' =>array('PremierProduit.id','PremierProduit.name'),
	  'order'=>'PremierProduit.name asc'
    ),
    'DeuxiemeProduit' => array(
      'className' => 'Produit',
      'foreignKey' => 'deuxieme_produit_id',
	  'fields' =>array('DeuxiemeProduit.id','DeuxiemeProduit.name'),
	   'order'=>'DeuxiemeProduit.name asc'
    )
  );
}
?>