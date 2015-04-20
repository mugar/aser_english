<?php
class DettesController extends AppController {

	var $name = 'Dettes';
	
	function rapport(){
		$conditions=$sums=$dettes=array(); //reinitialiser la variable
		if(!empty($this->data)){
		 	if($this->data['Dette']['tier_id']!=0) {
		 		$conditions['Dette.tier_id']=$this->data['Dette']['tier_id'];
			}
		 	if($this->data['Tier']['type']!='toutes') {
		 		$conditions['Tier.type']=$this->data['Tier']['type'];
			}
		 	if($this->data['Dette']['monnaie']!='toutes') {
		 		$conditions['Dette.monnaie']=$this->data['Dette']['monnaie'];
			}
			if($this->data['Dette']['type'][0]!=0) {
		 		$conditions['Dette.type']=$this->data['Dette']['type'];
			}
			$dettes=$this->Dette->find('all',array('fields'=>array('Dette.*','Tier.name','Tier.id'),
													'conditions'=>$conditions,
													'order'=>array('Tier.name asc')
													)
										);
			$sums=$this->Dette->find('all',array('fields'=>array('sum(Dette.montant) as montant',
																'sum(Dette.max) as max',
																'Dette.monnaie'
																),
												'group'=>array('Dette.monnaie'),
												'conditions'=>$conditions
												)
										);
		}
		$tiers = $this->Dette->Tier->find('list',array('fields'=>array('Tier.id','Tier.name','Tier.type'),
																'conditions'=>array('Tier.actif'=>1)
																));	
		$tiers[0]='toutes';
		$this->set(compact('dettes','sums','tiers'));
	}
	
	function index() {
		$dettes_cond=$this->Session->read('dettes_cond');
		if((empty($this->data))&&(empty($dettes_cond))) {
			$this->set('dettes', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$dettes_cond=array(); //reinitialiser la variable
		 	if($this->data['Dette']['tier_id']!=0) {
		 		$dettes_cond['Dette.tier_id']=$this->data['Dette']['tier_id'];
			}
		 	if($this->data['Tier']['type']!='toutes') {
		 		$dettes_cond['Tier.type']=$this->data['Tier']['type'];
			}
		 	if($this->data['Dette']['monnaie']!='toutes') {
		 		$dette_op_cond['Dette.monnaie']=$this->data['Dette']['monnaie'];
			}
			$this->set('dettes', $this->paginate($dettes_cond));
			$this->Session->write('dettes_cond',$dettes_cond);
		}
		else {
			$this->set('dettes', $this->paginate($dettes_cond));
		}
		$tiers = $this->Dette->Tier->find('list',array('fields'=>array('Tier.id','Tier.name','Tier.type'),
																'conditions'=>array('Tier.actif'=>1)
																));	
		$tiers[0]='toutes';
		$this->set(compact('tiers'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'dette'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('dette', $this->Dette->read(null, $id));
	}
	
	function add() {
		$this->autoRender=false;
		if (!empty($this->data)) {
				$detteInfo=$this->Dette->find('first',array('recursive'=>-1,
															'conditions'=>array('Dette.tier_id'=>$this->data['Dette']['tier_id'],
																				'Dette.monnaie'=>$this->data['Dette']['monnaie'],
																				)
														)
											);
				if(empty($detteInfo)){
					$this->Dette->save($this->data);
					$this->set('dette',$this->Dette->find('first',array('fields'=>array('Dette.*',
																						'Tier.name','Tier.id'
																						),
    																		'conditions'=>array('Dette.id'=>$this->Dette->id),
    																		'recursive'=>0
																			)
																));
					$this->layout="ajax";
					$this->render('quick_add');
					
				}
				else {
					exit('failure');
				}
		}
		$tiers = $this->Dette->Tier->find('list',array('fields'=>array('Tier.id','Tier.name','Tier.type'),
																'conditions'=>array('Tier.actif'=>1)
																));	
		$this->set(compact('tiers'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'dette'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
 	   		$this->Dette->set($this->data);
			if($this->Dette->validates()) {
				$detteInfo=$this->Dette->find('first',array('recursive'=>-1,
															'conditions'=>array('Dette.id !='=>$id,
																				'Dette.tier_id'=>$this->data['Dette']['tier_id'],
																				'Dette.monnaie'=>$this->data['Dette']['monnaie'],
																				)
														)
											);
				if(empty($detteInfo)){
					$this->Dette->save($this->data);
					$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'dette'));
					$this->redirect(array('action' => 'index'));
				}
				else {
					$this->Session->setFlash('Ce Dette existe déjà !');
				}
			} 
			else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'dette'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Dette->read(null, $id);
		}
		$tiers = $this->Dette->Tier->find('list',array('fields'=>array('Tier.id','Tier.name','Tier.type'),
																'conditions'=>array('Tier.actif'=>1)
																));	
		$this->set(compact('tiers'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'dette'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Dette->delete($id)) {
			$this->Session->setFlash(sprintf(__('Enregistrement effacé', true), 'Dette'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('Impossible d\'effacer !', true), 'Dette'));
		$this->redirect(array('action' => 'index'));
	}
}
?>
