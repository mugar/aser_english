<?php
class TypesController extends AppController {

	var $name = 'Types';

	function index(){
		$typeConditions=$this->Session->read('typeConditions');
		if((empty($this->data))&&(empty($typeConditions))) {
			$this->set('types', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$typeConditions=array();
			foreach($this->data['Type'] as $key=>$value){
				if($value!='toutes'){
					$typeConditions['Type.'.$key.' like ']=$value.'%';
				}
			}
			$this->set('types', $this->paginate($typeConditions));
			$this->Session->write('typeConditions',$typeConditions);
		}
		else {
			$this->set('types', $this->paginate($typeConditions));
		}
		$this->set(compact('types'));
	}

	function view($id = null) {
		$this->autoRender=false;
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'type'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('type', $this->Type->read(null, $id));
	}

	function _logic($data,$action){
		$this->Type->set($data);
		if(!$this->Type->validates()){
			$this->_error($action,'Le nom du type est obligatoire!');
		}
	
		if($action=='add'){
			$data['Type']['actif']='oui';
		}
		$cond['Type.name']=$data['Type']['name'];
		if(!empty($data['Type']['id'])){
			$cond['Type.id !=']=$data['Type']['id'];
		}
		$search=$this->Type->find('first',array('fields'=>array('Type.name'),
											'conditions'=>$cond
											));	
		if(!empty($search)){
			$this->_error($action,'Cette type est déjà enregistrée!');
		}	
		$this->Type->save($data);
	}
	
	function _show($id){
		$this->set('type',$this->Type->find('first',array('fields'=>array('Type.*'),
    														'conditions'=>array('Type.id'=>$id)
															)
											));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->Type->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistrée')));
			}
			else {
				$this->data = $this->Type->find('first',array('fields'=>array('Type.*'),
																		'conditions'=>array('Type.id'=>$id),
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
				$test1=$this->Type->Operation->find('first',array('conditions'=>array('Operation.element_id'=>$id,
																			'Operation.model'=>'Type',
																			),
												'recursive'=>-1
												));	
				if (!empty($test1)){
					$notDeleted++;
				}
				else {
					$this->Type->delete($id);
					$deleted[]=$id;
				}
			}
		}
		$msg="Vérifié s'il n'y a pas des opérations enregistrées sur ";
		$msg=($notDeleted>1)?$msg.'ces types.':$msg.'cette type.';
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>$msg
							)));
	}
}
?>