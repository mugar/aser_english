<?php
class CaisseInterditesController extends AppController {

	var $name = 'CaisseInterdites';
	
	function beforeFilter(){
		parent::beforeFilter();
		$personnels = $this->CaisseInterdite->Personnel->find('list',array('conditions'=>array('Personnel.fonction_id'=>array(2,3,4,5),
																							'Personnel.actif'=>'yes'
																							)));
		$caisses = $this->CaisseInterdite->Caiss->find('list');
		$this->set(compact('personnels','caisses'));
		
	}
	function index() {
		$this->set('caisseInterdites', $this->paginate());
		
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'caisse interdite'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('caisseInterdite', $this->CaisseInterdite->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CaisseInterdite->create();
			$this->CaisseInterdite->set($this->data);
			if ($this->CaisseInterdite->validates()) {
				foreach($this->data['CaisseInterdite']['personnel_id'] as $personnelId){
					foreach($this->data['CaisseInterdite']['caiss_id'] as $caissId){
						$data['CaisseInterdite']['caiss_id']=$caissId;
						$data['CaisseInterdite']['personnel_id']=$personnelId;
						$this->CaisseInterdite->save($data);
						unset($this->CaisseInterdite->id);
					}
				}
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'caisse interdite'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'caisse interdite'));
			}
		}
		
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'caisse interdite'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CaisseInterdite->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'caisse interdite'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'caisse interdite'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CaisseInterdite->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'caisse interdite'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CaisseInterdite->delete($id)) {
			$this->Session->setFlash(sprintf(__('Enregistrement effacé', true), 'Caisse interdite'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('Impossible d\'effacer !', true), 'Caisse interdite'));
		$this->redirect(array('action' => 'index'));
	}

}
?>