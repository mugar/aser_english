<?php
class UnitesController extends AppController {

	var $name = 'Unites';

	function index() {
		$this->Unite->recursive = 0;
		$this->set('unites', $this->paginate());
	}

	function _logic($data,$action){
		$this->Unite->set($data);
		if(!$this->Unite->validates()){
			$failureMsg='Le Nom est obligatoire!';
			if($action=='add')
				exit('failure_'.$failureMsg);
			else 
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
		}
		$this->Unite->save($data);
	}
	
	function _show($id){
		$this->set('unite',$this->Unite->find('first',array('fields'=>array('Unite.*'),
    														'conditions'=>array('Unite.id'=>$id)
															)
											));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->Unite->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Unite->find('first',array('fields'=>array('Unite.*'),
																		'conditions'=>array('Unite.id'=>$id),
																		'recursive'=>-1
																		));
			}
		}
		else {
			$this->_show($id);
		}
	}

	function delete($id = null) {
		$notDeleted=0;
		$deleted=array();
		foreach($this->data['Id'] as $id){
			if($id!=0) {
				$test1=$this->Unite->Produit->find('first',array('conditions'=>array('Produit.unite_id'=>$id),
																'recursive'=>-1
												));
				if (!empty($test1)){
					$notDeleted++;
				}
				else {
					$this->Unite->delete($id);
					$deleted[]=$id;
				}
			}
		}
		$msg="Vérifié s'il n'y a pas des produits qui utilisent ";
		$msg=($notDeleted>1)?$msg.'ces unités.':$msg.'cette unité.';
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>$msg
							)));
	}
}
?>