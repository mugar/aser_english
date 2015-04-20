<?php
class TypeServicesController extends AppController {

	var $name = 'TypeServices';

	function index() {
		$this->set('typeServices', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'type service'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('typeService', $this->TypeService->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->TypeService->create();
			if ($this->TypeService->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'type service'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'type service'));
			}
		}
		$personnels = $this->TypeService->Personnel->find('list');
		$this->set(compact('personnels'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'type service'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TypeService->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'type service'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'type service'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TypeService->read(null, $id);
		}
		$personnels = $this->TypeService->Personnel->find('list');
		$this->set(compact('personnels'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'type service'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TypeService->delete($id)) {
			$this->Session->setFlash(sprintf(__('Enregistrement effacé', true), 'Type service'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('Impossible d\'effacer !', true), 'Type service'));
		$this->redirect(array('action' => 'index'));
	}

}
?>