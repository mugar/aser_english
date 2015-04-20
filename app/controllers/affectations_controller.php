<?php
class AffectationsController extends AppController {

	var $name = 'Affectations';
	var $paginate =array('fields'=>array('Affectation.*',
										'Reservation.id',
										'Chambre.id',
										'Chambre.name',
										'Tier.id',
										'Tier.name',
										'Personnel.id',
										'Personnel.name'
										),
						'conditions'=>array()
						);

	function history(){
		$affectations=array();
		if(!empty($this->data)){
			$affectations=$this->Affectation->find('all',array('fields'=>array('Chambre.name',
																				'Reservation.arrivee',
																				'Reservation.depart',
																				'Reservation.PU',
																				'Reservation.montant',
																				'Reservation.monnaie',
																				'Tier.name',
																				'Reservation.tier_id'
																				),
																'conditions'=>array('Reservation.tier_id'=>$this->data['Affectation']['tier_id']),
																'order'=>array('Affectation.id desc'),
																)
														);
			foreach($affectations as $key=>$affectation){
				$client=$this->Affectation->Tier->find('first',array('fields'=>array('Tier.name'),
															'conditions'=>array('Tier.id'=>$affectation['Reservation']['tier_id'])
															)
												);
				$affectations[$key]['Client']['name']=$client['Tier']['name'];
											
			}
		}
		$tiers=$this->Affectation->Tier->find('list');
		$this->set(compact('affectations','tiers'));	
	}
	
	function index(){
		$affectation_cond=$this->Session->read('affectation_cond');
		if((empty($this->data))&&(empty($affectation_cond))) {
			$this->set('affectations', $this->paginate($affectation_cond));
		}
		elseif(!empty($this->data)) {
		//building conditions
			$affectation_cond=array(); //reinitialiser la variable
		 	if($this->data['Reservation']['tier_id']!=0) {
		 		$affectation_cond['Reservation.tier_id']=$this->data['Reservation']['tier_id'];
			}
			if($this->data['Reservation']['etat']!=0) {
		 		$affectation_cond['Reservation.etat']=$this->data['Reservation']['etat'];
			}
		 
		 	if($this->data['Affectation']['tier_id']!=0) {
		 		$affectation_cond['Affectation.tier_id']=$this->data['Affectation']['tier_id'];
			}
			if($this->data['Affectation']['chambre_id']!=0) {
		 		$affectation_cond['Affectation.chambre_id']=$this->data['Affectation']['chambre_id'];
			}
			$this->set('affectations', $this->paginate($affectation_cond));
			
			
			$this->Session->write('affectation_cond',$affectation_cond);
		}
		else {
			$this->set('affectations', $this->paginate($affectation_cond));
		}
		$tiers = $this->Affectation->Tier->find('list',array('conditions'=>array('Tier.type'=>array('client','polyvalent'),
																			'Tier.actif'=>1
																			)
																));
		$tiers[0]='toutes';
		$chambres = $this->Affectation->Chambre->find('list',array('order'=>'Chambre.name asc'));
		$chambres[0]='toutes';
		$this->set(compact('tiers','chambres'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'affectation'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('affectation', $this->Affectation->read(null, $id));
	}
	/*
	function add() {
		if (!empty($this->data)) {
			$this->Affectation->create();
			if ($this->Affectation->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'affectation'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'affectation'));
			}
		}
		$reservations = $this->Affectation->Reservation->find('list');
		$chambres = $this->Affectation->Chambre->find('list');
		$tiers = $this->Affectation->Tier->find('list');
		$personnels = $this->Affectation->Personnel->find('list');
		$this->set(compact('reservations', 'chambres', 'tiers', 'personnels'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'affectation'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Affectation->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'affectation'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'affectation'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Affectation->read(null, $id);
		}
		$reservations = $this->Affectation->Reservation->find('list');
		$chambres = $this->Affectation->Chambre->find('list');
		$tiers = $this->Affectation->Tier->find('list');
		$personnels = $this->Affectation->Personnel->find('list');
		$this->set(compact('reservations', 'chambres', 'tiers', 'personnels'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'affectation'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Affectation->delete($id)) {
			$this->Session->setFlash(sprintf(__('Enregistrement effacé', true), 'Affectation'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('Impossible d\'effacer !', true), 'Affectation'));
		$this->redirect(array('action' => 'index'));
	}
	*/
}
?>