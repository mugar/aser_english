<?php
class ComptesController extends AppController {

	var $name = 'Comptes';

	function index() {
		$this->set('comptes', $this->paginate());
	//	$tiers = $this->Compte->Tier->find('list',array('conditions'=>array('Tier.actif'=>1)));
		$tiers[0]='';
		$this->set(compact('tiers'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'compte'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('compte', $this->Compte->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Compte->create();
			
			$exp=8-strlen($this->data['Compte']['numero']);
			$this->data['Compte']['numero']*=pow(10, $exp);
			
			$search=$this->Compte->find('first',array('conditions'=>array('Compte.numero'=>$this->data['Compte']['numero']),
																'fields'=>array('Compte.id')
												));
			$this->data['Compte']['name']=$this->Product->name($this->data['Compte']['name']);
			if (empty($search)) {
				$this->Compte->save($this->data);
				$this->set('compte',$this->Compte->find('first',array('conditions'=>array('Compte.id'=>$this->Compte->id),
																'fields'=>array('Compte.*')
												)));
				$this->layout='ajax';
				$this->render('quick_add');
			} else {
				exit('failure_Ce compte "'.$this->data['Compte']['numero'].'" existe déjà');
			}
		}
		
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'compte'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$exp=8-strlen($this->data['Compte']['numero']);
			$this->data['Compte']['numero']*=pow(10, $exp);
			
			$search=$this->Compte->find('first',array('conditions'=>array('Compte.numero'=>$this->data['Compte']['numero'],
																		'Compte.id !='=>$id
																		),
																'fields'=>array('Compte.id')
												));
			$this->data['Compte']['name']=$this->Product->name($this->data['Compte']['name']);
			if (empty($search)) {
				$this->Compte->save($this->data);
				$this->set('compte',$this->Compte->find('first',array('conditions'=>array('Compte.id'=>$this->Compte->id),
																'fields'=>array('Compte.*')
												)));
				$this->Session->setFlash('Informations enregistrées');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('ce compte '.$this->data['Compte']['numero'].' existe déjà!');
				$this->redirect(array('action' => 'index'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Compte->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'compte'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Compte->delete($id)) {
			$this->Session->setFlash(sprintf(__('Enregistrement effacé', true), 'Compte'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('Impossible d\'effacer !', true), 'Compte'));
		$this->redirect(array('action' => 'index'));
	}

}
?>