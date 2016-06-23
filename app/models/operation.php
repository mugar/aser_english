<?php
class Operation extends AppModel {
	var $name = 'Operation';
	var $order = array('Operation.date desc','Operation.ordre desc','Operation.id desc');
	var $recursive = 0;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Journal' => array(
			'className' => 'Journal',
			'foreignKey' => 'Journal_id',
			'conditions' => '',
			'fields' => array('Journal.date','Journal.id','Journal.numero'),
			'order' => ''
		),
		'Personnel' => array(
			'className' => 'Personnel',
			'foreignKey' => 'personnel_id',
			'conditions' => '',
			'fields' =>array('Personnel.name','Personnel.id'),
			'order' => ''
		),
		'Caiss' => array(
			'className' => 'Caiss',
			'foreignKey' => 'element_id',
			'conditions' => '',
			'fields' =>array('Caiss.name','Caiss.id'),
			'order' => ''
		),
		'Tier' => array(
			'className' => 'Tier',
			'foreignKey' => 'element_id',
			'conditions' => '',
			'fields' => array('Tier.name','Tier.id'),
			'order' => ''
		),
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'element_id',
			'conditions' => '',
			'fields' => array('Type.name','Type.id'),
			'order' => ''
		),
	);

	function soldeCaisse($caisseId){
		$conditions['Operation.element_id']=$caisseId;
		$conditions['Operation.model']='Caiss';

		$operations=$this->find('all',array('fields'=>array('sum(Operation.debit) as debit',
																		'sum(Operation.credit) as credit',
																		'Operation.monnaie',
																		'Operation.mode_paiement'
						                        							),
					                        				'conditions'=>$conditions,
																));
		$solde = ($operations[0]['Operation'])?
							$operations[0]['Operation']['debit']-$operations[0]['Operation']['credit']:
							0;
		return $solde;
	}
}
?>