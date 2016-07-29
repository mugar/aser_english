<?php
class Subscription extends AppModel {
  var $name = 'Subscription';
  var $order = array('Subscription.id desc');
  var $recursive = 0;
  //The Associations below have been created with all possible keys, those that are not needed can be removed

  var $validate = array(
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
    'start' => array(
      'numeric' => array(
        'rule' => array('date'),
        'message' => 'Valeurs numériques seulement !',
        'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
      ),
    ),
    'end' => array(
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
    
    'Facture' => array(
      'className' => 'Facture',
      'foreignKey' => 'facture_id',
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
  );
}