<?php
class Facture extends AppModel {
	var $name = 'Facture';
	var $order = 'Facture.id desc';
	var $recursive = 0;
	var $displayField = 'numero';

	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $belongsTo = array(
		'Personnel' => array(
    	  'className' => 'Personnel',
    	  'foreignKey' => 'personnel_id'
    	),
		'Journal' => array(
			'className' => 'Journal',
			'foreignKey' => 'journal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tier' => array(
			'className' => 'Tier',
			'foreignKey' => 'tier_id',
			'fields' => '',
			'order' => '',
			'conditions'=>''
		)
	);

	var $hasMany = array(
		'Vente' => array(
			'className' => 'Vente',
			'foreignKey' => 'facture_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Paiement' => array(
			'className' => 'Paiement',
			'foreignKey' => 'facture_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Reservation' => array(
			'className' => 'Reservation',
			'foreignKey' => 'facture_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Service' => array(
			'className' => 'Service',
			'foreignKey' => 'facture_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Proforma' => array(
			'className' => 'Proforma',
			'foreignKey' => 'facture_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'facture_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Trace' => array(
			'className' => 'Trace',
			'foreignKey' => 'model_id',
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
	/*
	* this function's job is to return the amount of payments of a given bill
	*/
	function pyts($id){
		$pyts=$this->Paiement->find('all',array('fields'=>array('sum(Paiement.montant) as montant'),
																'conditions'=>array('Paiement.facture_id'=>$id)
																		));
		return (isset($pyts[0]))? $pyts[0]['Paiement']['montant']:0;
	}
	
	
	function updateBillStatus($paiementInfo,$idToIgnore){
		$old_facture = $paiementInfo['Facture'];
		$facture=$paiementInfo['Facture'];
		
		//fetching all the payments.
		$paiements=$this->Paiement->find('all',array('fields'=>array('sum(Paiement.montant) as montant'),
										'conditions'=>array('Paiement.facture_id'=>$facture['id'],
															'Paiement.id !='=>$idToIgnore
															)
										) 
							);
		$facture['pyts']=(!empty($paiements[0]))?$paiements[0]['Paiement']['montant']:0;
		//calcul du reste 
		$facture['reste']=$facture['montant']-$facture['pyts'];
		//calcul de l'etat
		if($facture['reste']==0) $facture['etat']='paid';
		elseif ($facture['reste']==$facture['montant']) $facture['etat']='credit';
		elseif (($facture['reste']>0)&&($facture['reste']<$facture['montant'])) $facture['etat']='half_paid';
		elseif ($facture['reste']<0) {
			$facture['etat']='excedent'; 
		}
		//save the bill now
		$facture['classee']=1; //when a pyt is made it closes the bill automatically.
		//exit(debug($facture));
		if(!$this->save(array('Facture'=>$facture))) exit('failed to update the status of this bill : '.$facture['id']);
		else {
					//trace stuff
			$trace['Trace']['model_id']=$facture['id'];
			$trace['Trace']['model']='Facture';
			$trace['Trace']['operation']='Changement l\'état de "'.$old_facture['etat'].'" à "'.$facture['etat'].'"';
			$this->Trace->save($trace);
		}
	}

	function tva(&$facture){
		$taux=Configure::read('aser.tva');
		if($taux==1){ //this means that bootstrap still has the old value.
			//we look in config table for the value of tva.
			$this->Config=ClassRegistry::init('Config'); 
			$search=$this->Config->find('first',array('fields'=>array('value'),
													'conditions'=>array('Config.key'=>'tva'))
										);
		//	exit(debug($search));
			if(!empty($search['Config']['value'])&&($search['Config']['value']>0)){
				$taux=$search['Config']['value'];
			}
			else {
				exit(json_encode(array("success"=>false, "msg"=>"le taux pour la tva n'est pas definie")));
			}
			
		}
		if($taux>0){
			//this part is removed because to allow two ways of calculating tvas will force to alot of things.
			// $facture['tva']=(isset($facture['tva_incluse'])&&($facture['tva_incluse']!=0))?
			// 				round(($facture['montant']*$taux)/(100+$taux)):
			// 				($facture['montant']*$taux/100);
			// 				//exit(debug($facture));
			$facture['tva']=round(($facture['montant']*$taux)/(100+$taux));
			$facture['tva_incluse']=1;
		}
		else {
			$facture['tva']=0;
		}
		return $facture['tva']; //we return here because of function which may call it.
	}
	
	/**
	*   the model param is not needed now. but maybe needed in the future if we choose
	*  to handle other models like Reservation ...
	*/
	function _ventes(&$facture,$idToIgnore=null){
		$facture['original']=$facture['avance_beneficiaire']=0;
		$ventes=$this->Vente->find('all',array('fields'=>array('Vente.montant','Vente.pourcentage'),
										'conditions'=>array('Vente.facture_id'=>$facture['id'],
															'Vente.id !='=>$idToIgnore
															)
										)
							);
		foreach($ventes as $vente){
			$facture['original']+=$vente['Vente']['montant'];
			$facture['avance_beneficiaire']+=($vente['Vente']['montant']*$vente['Vente']['pourcentage']/100);
		}
	}
	function reduction(&$facture){
		$facture['montant']=round($facture['original']-(($facture['original']*$facture['reduction'])/100));
		$facture['reste']=$facture['montant'];
		if(isset($facture['tva'])&&($facture['tva']>0))
			$facture['tva']=round($facture['tva']-(($facture['tva']*$facture['reduction'])/100));
		else 
			$this->tva($facture);
		//returning the result.
		return $facture;
	}

	function updateMontant($facture, $idToIgnore=null,$model='Vente'){ 
		if(in_array($model,array('Vente'))){
			//first we calculate the total of the bill
			$this->_ventes($facture,$idToIgnore);
			//calcul de la reduction
			$this->reduction($facture);
			//save the bill now
			if(!$this->save(array('Facture'=>$facture)))
				exit('failed to update this bill : '.$id);
		}
	}

	/* this function's job is to make sure that a bill with state credit is 
	 not saved without specifying a customer.
	 */

	function beforeSave($options){
		if(!empty($this->data['Facture']['etat'])&&in_array($this->data['Facture']['etat'],array('credit'))){
			if(!isset($this->data['Facture']['tier_id'])&&!empty($this->data['Facture']['id'])){
				$factureInfo=$this->find('first',array('fields'=>array('Facture.tier_id'),
										'conditions'=>array('Facture.id'=>$this->data['Facture']['id'])
										));
				$this->data['Facture']['tier_id']=$factureInfo['Facture']['tier_id'];
			}
			if(!empty($this->data['Facture']['tier_id']))
				return true;
			else 
				return false;

		}
		return true;
	}
}
?>
