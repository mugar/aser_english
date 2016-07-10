<?php
class RelationsController extends AppController {

	var $name = 'Relations';
	

	function index() {
		$this->paginate=array('order'=>'PremierProduit.name asc');
		
		$relationConditions=$this->Session->read('relationConditions');
		if((empty($this->data))&&(empty($relationConditions))) {
			$this->set('relations', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$relationConditions=array(); //reinitialiser la variable
			if($this->data['Relation']['premier_produit_id']!=0) {
				$relationConditions['Relation.premier_produit_id']=$this->data['Relation']['premier_produit_id'];
			}
			$this->set('relations', $this->paginate($relationConditions));
			$this->Session->write('relationConditions',$relationConditions);
		}
		else {
			$this->set('relations', $this->paginate($relationConditions));
		}
		$unites = $this->Relation->Unite->find('list');
		$premiers = $this->Relation->PremierProduit->find('list',array('conditions'=>array('PremierProduit.actif'=>'yes'),
																		'order'=>array('PremierProduit.name asc')
																	));
		$premiers[0]='toutes';
		$this->set(compact('unites','premiers'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'relation'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('relation', $this->Relation->read(null, $id));
	}
	function updateProduit(){
		$stockId = $this->data['Relation']['stock_id'];
    	if ((!empty( $stockId ))&&($stockId!=0)) {
		$produits = $this->Relation->PremierProduit->find('list',array(
												'conditions'=>array('PremierProduit.stock_id'=>$stockId,
																	'Produit.actif'=>'yes'
																	),
												'order'=>'PremierProduit.name asc'
												)
										);
		
    	}
		$this->set(compact('produits'));
		$this->layout="ajax";
  	}
	
	function add_plat(){
		if (!empty($this->data)) {
			$this->Relation->set($this->data);
			if ($this->Relation->validates()) {
				$this->data['PremierProduit']['PA']=0;
				$this->data['PremierProduit']['section_id']=$this->Conf->find('plats_section');
				$this->data['PremierProduit']['unite_id']=$this->Conf->find('default_unit');
				$this->Relation->PremierProduit->save($this->data);
				$produitId=$this->Relation->PremierProduit->id;
				foreach($this->data as $key=>$value) {
					if(($key!='PremierProduit')&&($value[$key]['quantite']!=0)){
						$produitInfo=$this->Relation->DeuxiemeProduit->find('first',array('fields'=>array('DeuxiemeProduit.PA',
																										'DeuxiemeProduit.unite_id',
																										'DeuxiemeProduit.PV',
																										'DeuxiemeProduit.monnaie'
																										),
																							'conditions'=>array('DeuxiemeProduit.id'=>$key)
																						)
																			);
						$this->data['PremierProduit']['monnaie']=$produitInfo['DeuxiemeProduit']['monnaie'];
						$conversion=$this->Product->conversion($value[$key]['unite'],$produitInfo['DeuxiemeProduit']['unite_id']);
						$this->data['PremierProduit']['PA']+=$produitInfo['DeuxiemeProduit']['PA']*$value[$key]['quantite']*$conversion;
						//creation de la relation
							$relation['Relation']['stock_id']=$this->data['PremierProduit']['stock_id'];
						$relation['Relation']['premier_produit_id']=$produitId;
						$relation['Relation']['deuxieme_produit_id']=$key;
						$relation['Relation']['relation']='composer_par';
						$relation['Relation']['quantite']=$value[$key]['quantite'];
						$relation['Relation']['unite_id']=$value[$key]['unite'];
						$this->Relation->save($relation);
						unset($this->Relation->id);
					}
				}
				$this->data['PremierProduit']['id']=$produitId;
				$this->Relation->PremierProduit->save($this->data);
				
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'relation'));
				$this->redirect(array('action' => 'index'));
			}
		}
		$groupes = $this->Relation->PremierProduit->Groupe->find('list',array('conditions'=>array('Groupe.actif'=>'yes')));
		$this->set(compact('groupes'));
	}

	function ingredients() {
    	$stockId = $this->data['PremierProduit']['stock_id'];
    	if ((!empty( $stockId ))&&($stockId!=0)) {
    	$conditions['DeuxiemeProduit.stock_id']=$stockId;
		$conditions['DeuxiemeProduit.groupe_id']=13;
		$ingredients = $this->Relation->DeuxiemeProduit->find('all',array('fields'=>array('DeuxiemeProduit.id','DeuxiemeProduit.name'),
														'conditions'=>$conditions));
    	}
		$unites=$this->Relation->DeuxiemeProduit->Unite->find('list');
		$this->set(compact('ingredients','unites'));
		$this->layout="ajax";
  	}
	
	function add() {
		$this->autoRender=false;
		if (!empty($this->data)) {
			$this->Relation->create();
			$this->data['Relation']['premier_produit_id']=$this->Product->finder($this->data['PremierProduit']['name'],$this->data['Produit']['stock_id']);
			$this->data['Relation']['deuxieme_produit_id']=$this->Product->finder($this->data['DeuxiemeProduit']['name'],$this->data['Produit']['stock_id']);
			$this->data['Relation']['stock_id']=$this->data['Produit']['stock_id'];
			
			if($this->data['Relation']['premier_produit_id']==$this->data['Relation']['deuxieme_produit_id']){
				exit('failure');
			}
			if((!empty($this->data['Relation']['premier_produit_id']))&&(!empty($this->data['Relation']['deuxieme_produit_id']))) {
				$this->Relation->save($this->data);
				
				//update premier_produit_id 
				$update['PremierProduit']['relations']='paquet_II';
				$update['PremierProduit']['id']=$this->data['Relation']['premier_produit_id'];
				$this->Relation->PremierProduit->save($update);
				
				
				$relation=$this->Relation->find('first',array('fields'=>array('PremierProduit.name',
																	'PremierProduit.id',
																	'DeuxiemeProduit.id',
																	'DeuxiemeProduit.name',
																	'Relation.*',
																	'Personnel.id',
																	'Personnel.name',
																	'Stock.id',
																	'Stock.name',
																	'Unite.id',
																	'Unite.name',
				                                      		  ),
				                                     'conditions'=>array('Relation.id'=>$this->Relation->id)
															  ));
				$this->set('relation',$relation);
				$this->layout="ajax";
				$this->render('quick_add');
			} 
			else {
				exit('failure');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'relation'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data['Relation']['premier_produit_id']=$this->Product->finder($this->data['PremierProduit']['name'],$this->data['Produit']['stock_id']);
			$this->data['Relation']['deuxieme_produit_id']=$this->Product->finder($this->data['DeuxiemeProduit']['name'],$this->data['Produit']['stock_id']);
			$this->data['Relation']['stock_id']=$this->data['Produit']['stock_id'];
			
			if($this->data['Relation']['premier_produit_id']==$this->data['Relation']['deuxieme_produit_id']){
				$this->Session->setFlash('Produits identique !');
				$this->redirect(array('action' => 'edit/'.$id));
			}
			if((!empty($this->data['Relation']['premier_produit_id']))&&(!empty($this->data['Relation']['deuxieme_produit_id']))) {
				$this->Relation->save($this->data);
				
				//update premier_produit_id 
				$update['PremierProduit']['relations']='paquet_II';
				$update['PremierProduit']['id']=$this->data['Relation']['premier_produit_id'];
				$this->Relation->PremierProduit->save($update);
				
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'relation'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'relation'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Relation->read(null, $id);
			$this->Session->write('stockId',$this->data['Relation']['stock_id']);
			Configure::write('stockId',$this->data['Relation']['stock_id']);
		}
		$unites = $this->Relation->Unite->find('list');
		$this->set(compact('unites'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'relation'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Relation->delete($id)) {
			$this->Session->setFlash(sprintf(__('Enregistrement effacé', true), 'Relation'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('Impossible d\'effacer !', true), 'Relation'));
		$this->redirect(array('action' => 'index'));
	}

}
?>