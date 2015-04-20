<?php
class FonctionsController extends AppController {

	var $name = 'Fonctions';
	var $components = array('Acl', 'Auth','Session');
	
	function index() {
		$this->Fonction->recursive = 0;
		$this->set('fonctions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'fonction'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fonction', $this->Fonction->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Fonction->create();
			if ($this->Fonction->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'fonction'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'fonction'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'fonction'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Fonction->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'fonction'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'fonction'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Fonction->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'fonction'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Fonction->delete($id)) {
			$this->Session->setFlash(sprintf(__('Enregistrement effacé', true), 'Fonction'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('Impossible d\'effacer !', true), 'Fonction'));
		$this->redirect(array('action' => 'index'));
	}
}
?>
