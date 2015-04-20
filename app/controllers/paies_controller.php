<?php
class PaiesController extends AppController {

	var $name = 'Paies';

	function index() {
		$this->set('paies', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'paie'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('paie', $this->Paie->read(null, $id));
	}

	function add() {
		exit(debug($this->data));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'paie'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Paie->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'paie'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'paie'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Paie->read(null, $id);
		}
		$salaires = $this->Paie->Salaire->find('list');
		$this->set(compact('salaires'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'paie'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Paie->delete($id)) {
			$this->Session->setFlash(sprintf(__('Enregistrement effacé', true), 'Paie'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('Impossible d\'effacer !', true), 'Paie'));
		$this->redirect(array('action' => 'index'));
	}

}
?>