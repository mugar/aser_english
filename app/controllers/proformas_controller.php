<?php
class ProformasController extends AppController {

	var $name = 'Proformas';

	function index() {
		$this->set('proformas', $this->paginate());
		$tiers = $this->Proforma->Tier->find('list',array('conditions'=>array('Tier.actif'=>1),
														'order'=>array('Tier.name')
														));
		$unites = $this->Proforma->Unite->find('list');
		$this->set(compact('tiers','unites'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'proforma'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('proforma', $this->Proforma->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Proforma->create();
			//determination de l'id du produit
   			$produitId=$this->Product->finder($this->data['Produit']['name'],$this->data['Produit']['stock_id']);
			$this->Proforma->set($this->data);
			if ($this->Proforma->validates()&&(!empty($produitId))) {
				$this->data['Proforma']['produit_id']=$produitId;
				$this->data['Proforma']['montant']=$this->data['Proforma']['quantite']*$this->data['Proforma']['PU'];
				$this->Proforma->save($this->data);
				$this->set('proforma',$this->Proforma->find('first',array('fields'=>array('Proforma.*',
																						'Personnel.name',
																						'Personnel.id',
																						'Unite.id','Unite.name',
																						'Produit.id','Produit.name',
																						'Tier.name',
																						'Tier.id'
																						),
    																		'conditions'=>array('Proforma.id'=>$this->Proforma->id)
																			)
																));
				$this->layout="ajax";
				$this->render('quick_add');
			
			} 
			else exit('failure');
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'proforma'));
			$this->redirect(array('action' => 'index'));
		}
		else {
			$proInfo=$this->Proforma->find('first',array('recursive'=>-1,
																	'conditions'=>array('Proforma.id'=>$id)
																	)
													);
			if(!empty($proInfo['Proforma']['facture_id'])){
				$this->Session->setFlash('Enregistrement non modifiable !');
				$this->redirect(array('action' => 'index'));
			}
		}
		if (!empty($this->data)) {
			if ($this->Proforma->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'proforma'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'proforma'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Proforma->read(null, $id);
		}
		$tiers = $this->Proforma->Tier->find('list',array('conditions'=>array('Tier.actif'=>1),
														'order'=>array('Tier.name')
														));
		$unites = $this->Proforma->Unite->find('list');
		$this->set(compact('tiers','unites'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'proforma'));
			$this->redirect(array('action'=>'index'));
		}
		else {
			$proInfo=$this->Proforma->find('first',array('recursive'=>-1,
																	'conditions'=>array('Proforma.id'=>$id)
																	)
													);
			if(!empty($proInfo['Proforma']['facture_id'])){
				$this->Session->setFlash('Enregistrement non effaçable !');
				$this->redirect(array('action' => 'index'));
			}
		}
		if ($this->Proforma->delete($id)) {
			$this->Session->setFlash(sprintf(__('Enregistrement effacé', true), 'Proforma'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('Impossible d\'effacer !', true), 'Proforma'));
		$this->redirect(array('action' => 'index'));
	}

}
?>