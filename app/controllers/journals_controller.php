<?php
class JournalsController extends AppController {

	var $name = 'Journals';

	function index() {
		$this->Journal->recursive = 0;
		$this->set('journals', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid journal', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('journal', $this->Journal->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Journal->create();
			if ($this->Journal->save($this->data)) {
				$this->Session->setFlash(__('The journal has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The journal could not be saved. Please, try again.', true));
			}
		}
		$personnels = $this->Journal->Personnel->find('list');
		$this->set(compact('personnels'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid journal', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Journal->save($this->data)) {
				$this->Session->setFlash(__('The journal has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The journal could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Journal->read(null, $id);
		}
		$personnels = $this->Journal->Personnel->find('list');
		$this->set(compact('personnels'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for journal', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Journal->delete($id)) {
			$this->Session->setFlash(__('Journal deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Journal was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
