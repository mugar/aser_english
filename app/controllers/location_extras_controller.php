<?php
class LocationExtrasController extends AppController {

	var $name = 'LocationExtras';

	function index() {
		$this->set('locationExtras', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'location extra'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('locationExtra', $this->LocationExtra->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->LocationExtra->create();
			if ($this->LocationExtra->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'location extra'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'location extra'));
			}
		}
		$locations = $this->LocationExtra->Location->find('list');
		$this->set(compact('locations'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'location extra'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->LocationExtra->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'location extra'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'location extra'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->LocationExtra->read(null, $id);
		}
		$locations = $this->LocationExtra->Location->find('list');
		$this->set(compact('locations'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'location extra'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->LocationExtra->delete($id)) {
			$this->Session->setFlash(sprintf(__('Enregistrement effacé', true), 'Location extra'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('Impossible d\'effacer !', true), 'Location extra'));
		$this->redirect(array('action' => 'index'));
	}

}
?>