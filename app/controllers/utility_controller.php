<?php
class UtilityController extends AppController {

	var $name = 'Produits';
	var $failureMsg='Vérifiez s\'il les champs Section, Groupe et Nom sont remplis!';

function beforeFilter(){
		$this->autoRender=false;
		$this->Auth->allow('*');
}

function cancel_buggy_bills(){
	$this->loadModel('Facture');
	$factures = $this->Facture->find('all',array('fields'=>array('Facture.operation','Facture.id'),
																							'conditions'=>array('Facture.etat'=>'credit'),
																							'contain'=>array('Vente'=>array('fields'=>array('Vente.id')),
																															'Reservation'=>array('fields'=>array('Reservation.id')),
																															'Location'=>array('fields'=>array('Location.id')),
																															'Service'=>array('fields'=>array('Service.id')),
																								)
																						));
	//exit(debug($factures));
	foreach($factures as $facture){
		if(empty($facture[$facture['Facture']['operation']])){
				//exit(debug($facture));
				$facture['Facture']['etat']='annulee';
				$facture['Facture']['observation']='auto_annulation';
				$this->Facture->save($facture);

		}
	}
}
function delete_locationextra_with_orphan_location(){
	$this->loadModel('LocationExtra');
	$location_ids =$this->LocationExtra->find('list',array('fields'=>array('LocationExtra.location_id'),
																														'conditions'=>array('LocationExtra.location_id NOT IN (SELECT id FROM locations)')
																														));
	exit(debug($location_ids));
	$this->LocationExtra->deleteAll(array('LocationExtra.location_id'=>$location_ids));
}	
function delete_location_with_orphan_facture(){
	$this->loadModel('Location');
	$facture_ids =$this->Location->find('list',array('fields'=>array('Location.facture_id'),
																														'conditions'=>array('Location.facture_id NOT IN (SELECT id FROM factures)')
																														));
	exit(debug($facture_ids));
	$this->Location->deleteAll(array('Location.facture_id'=>$facture_ids));
}	
function nullify_orphan_facture_in_service(){
	$this->loadModel('Service');
	$services = $this->Service->find('all',array('fields'=>array('Service.*'),
																														'conditions'=>array('Service.facture_id NOT IN (SELECT id FROM factures)')
																														));
	exit(debug($services));
	foreach($services as $service){
		$service['Service']['facture_id']=NULL;
		if(!$this->Service->save($service)){
			exit('failed to save service '.debug($service));
		}
	}
}	

function nullify_orphan_facture_in_reservation(){
	$this->loadModel('Reservation');
	$reservations = $this->Reservation->find('all',array('fields'=>array('Reservation.*'),
																														'conditions'=>array('Reservation.facture_id NOT IN (SELECT id FROM factures)')
																														));
	exit(debug($reservations));
	foreach($reservations as $reservation){
		$reservation['Reservation']['facture_id']=NULL;
		if(!$this->Reservation->save($reservation)){
			exit('failed to save reservation '.debug($reservation));
		}
	}
}	

function create_orphan_products($ids){
	$this->loadModel('Produit');
	foreach($ids as $id){
		$produit['Produit']['id']=$id;
		$produit['Produit']['name']='N/A - '.$id;
		if(!$this->Produit->save($produit)){
			exit('failed to save produit '.debug($produit));
		}
	}
}
function create_orphan_journals($ids){
  $this->loadModel('Journal');
  foreach($ids as $id){
    $journal['Journal']['id']=$id;
    $journal['Journal']['numero']='2';
    $journal['Journal']['personnel_id']=11;
    $journal['Journal']['date']='2015-11-05';
  //  exit(debug($id));
    if(!$this->Journal->save($journal)){
      exit('failed to save journal '.debug($journal));
    }
  }
}
function create_orphan_tiers($ids){
	$this->loadModel('Tier');
	foreach($ids as $id){
		$tier['Tier']['id']=$id;
		$tier['Tier']['name']='N/A - '.$id;
	//	exit(debug($id));
		if(!$this->Tier->save($tier)){
			exit('failed to save tier '.debug($tier));
		}
	}
}

function create_orphan_section_from_groupe(){
	$this->loadModel('Groupe');
	$section_ids = $this->Groupe->find('list',array('fields'=>array('Groupe.section_id'),
																														'conditions'=>array('Groupe.section_id NOT IN (SELECT id FROM sections)',
																																							'Groupe.section_id != '=>NULL
																																								)
																														));
	exit(debug($section_ids));
	$this->create_orphan_sections($section_ids);
}

function create_orphan_journal_from_facture(){
  $this->loadModel('Facture');
  $factures = $this->Facture->find('all',array('fields'=>array('Facture.*'),
                                                            'conditions'=>array('Facture.journal_id NOT IN (SELECT id FROM journals)',
                                                                              'Facture.journal_id != '=>NULL
                                                                                )
                                                            ));
  exit(debug($factures));
  $non_zero_ids=array();
  foreach ($factures as $facture) {
    if($facture['Facture']['journal_id']==0){
      $facture['Facture']['journal_id']=NULL;
      if(!$this->Facture->save($facture)){
        exit(debug($facture));
      }
    }
    else {
      $non_zero_ids[]=$facture['Facture']['journal_id'];
    }
  }
  $this->create_orphan_journals($non_zero_ids);
}

function create_orphan_tier_from_facture(){
	$this->loadModel('Facture');
	$factures = $this->Facture->find('all',array('fields'=>array('Facture.*'),
																														'conditions'=>array('Facture.tier_id NOT IN (SELECT id FROM tiers)',
																																							'Facture.tier_id != '=>NULL
																																								)
																														));
	exit(debug($factures));
	$non_zero_ids=array();
	foreach ($factures as $facture) {
		if($facture['Facture']['tier_id']==0){
			$facture['Facture']['tier_id']=NULL;
			if(!$this->Facture->save($facture)){
				exit(debug($facture));
			}
		}
		else {
			$non_zero_ids[]=$facture['Facture']['tier_id'];
		}
	}
	$this->create_orphan_tiers($non_zero_ids);
}

function create_orphan_tier_from_location(){
	$this->loadModel('Location');
	$tier_ids = $this->Location->find('list',array('fields'=>array('Location.tier_id'),
																														'conditions'=>array('Location.tier_id NOT IN (SELECT id FROM tiers)',
																																							'Location.tier_id != '=>NULL
																																								)
																														));
	exit(debug($tier_ids));
	$this->create_orphan_tiers($tier_ids);
}
function create_orphan_tier_from_service(){
	$this->loadModel('Service');
	$tiers_ids = $this->Service->find('list',array('fields'=>array('Service.tier_id'),
																														'conditions'=>array('Service.tier_id NOT IN (SELECT id FROM tiers)',
																																							'Service.tier_id != '=>NULL
																																								)
																														));
	exit(debug($tiers_ids));
	
	
	$this->create_orphan_tiers($tier_ids);
}

function nullify_orphan_tier_in_entree(){
	$this->loadModel('Entree');
	$entrees = $this->Entree->find('all',array('fields'=>array('Entree.*'),
																														'conditions'=>array('Entree.tier_id NOT IN (SELECT id FROM tiers)')
																														));
	exit(debug($entrees));
	foreach($entrees as $entree){
		$entree['Entree']['tier_id']=NULL;
		if(!$this->Entree->save($entree)){
			exit('failed to save entree '.debug($entree));
		}
	}	
}


function create_orphan_product_from_entree(){
	$this->loadModel('Entree');
	$orphan_product_ids = $this->Entree->find('list',array('fields'=>array('Entree.produit_id'),
																														'conditions'=>array('Entree.produit_id NOT IN (SELECT id FROM produits)')
																														));
	exit(debug($orphan_product_ids));
	$this->create_orphan_products($orphan_product_ids);
}

function detele_orphan_historique_of_product(){
	$this->loadModel('Historique');
	//produits
	$orphan_product_ids = $this->Historique->find('list',array('fields'=>array('Historique.produit_id'),
																														'conditions'=>array('Historique.produit_id NOT IN (SELECT id FROM produits)')
																														));
	exit(debug($orphan_product_ids));
	$this->Historique->deleteAll(array('Historique.produit_id'=>$orphan_product_ids));
}
function detele_orphan_historique_of_stock(){
	$this->loadModel('Historique');
	//stocks
	$orphan_stock_ids = $this->Historique->find('list',array('fields'=>array('Historique.stock_id'),
																														'conditions'=>array('Historique.stock_id NOT IN (SELECT id FROM stocks)')
																														));
	//exit(debug($orphan_stock_ids));
	$this->Historique->deleteAll(array('Historique.stock_id'=>$orphan_stock_ids));
}

//* correct tvas
	//*
	function correct_tvas(){
		$this->loadModel("Facture");
		$factures = $this->Facture->find('all',array('fields'=>array('Facture.tva','Facture.montant','Facture.id','Facture.date','Facture.tva_incluse'),
																					'conditions'=>array('Facture.date >='=>'2015-01-01',
																															'Facture.tva != round((Facture.montant)*18/118)',
																															'Facture.tva_incluse'=>1
																															)
																			));
		exit(debug($factures));
		foreach($factures as $facture){
			$facture['Facture']['tva']=round(($facture['Facture']['montant'])*18/118);
			$this->Facture->save($facture);
		}
	}

}
?>