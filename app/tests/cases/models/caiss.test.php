<?php
/* Caiss Test cases generated on: 2011-09-16 16:09:29 : 1316179769*/
App::import('Model', 'Caiss');

class CaissTestCase extends CakeTestCase {
	var $fixtures = array('app.caiss', 'app.personnel', 'app.group', 'app.ajout', 'app.type', 'app.retrait', 'app.entree', 'app.produit', 'app.stock', 'app.section', 'app.groupe', 'app.relation', 'app.pret', 'app.tier', 'app.affectation', 'app.reservation', 'app.type_chambre', 'app.chambre', 'app.vente', 'app.personnel', 'app.salaire', 'app.sortideservice', 'app.service', 'app.carburant', 'app.chauffeur', 'app.camion', 'app.proprietaire', 'app.cochauffeur', 'app.entretien', 'app.transport', 'app.containeur', 'app.dette_operation', 'app.dette', 'app.dossier_cloture', 'app.entreposage', 'app.facture', 'app.location_transport', 'app.location', 'app.pret_operation', 'app.retour', 'app.sorti_plat', 'app.plat', 'app.category', 'app.sorti');

	function startTest() {
		$this->Caiss =& ClassRegistry::init('Caiss');
	}

	function endTest() {
		unset($this->Caiss);
		ClassRegistry::flush();
	}

}
?>