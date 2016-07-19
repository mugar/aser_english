<?php
class TypeServicesController extends AppController {

	var $name = 'TypeServices';

	function index() {
		$this->TypeService->recursive = 0;
		$this->set('type_services', $this->paginate());
	}

	function _logic($data,$action){
		$this->TypeService->set($data);
		if(!$this->TypeService->validates()){
			$failureMsg='Le Nom est obligatoire!';
			if($action=='add')
				exit('failure_'.$failureMsg);
			else 
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
		}
		$this->TypeService->save($data);
	}
	
	function _show($id){
		$this->set('type_service',$this->TypeService->find('first',array('fields'=>array('TypeService.*'),
    														'conditions'=>array('TypeService.id'=>$id)
															)
											));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->TypeService->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modifications Saved')));
			}
			else {
				$this->data = $this->TypeService->find('first',array('fields'=>array('TypeService.*'),
																		'conditions'=>array('TypeService.id'=>$id),
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
			
				$test1=$this->TypeService->Service->find('first',array('conditions'=>array('Service.type_service_id'=>$id),
																'recursive'=>-1
												));
				if (!empty($test1)){
					$notDeleted++;
				}
				else {
					$this->TypeService->delete($id);
					$deleted[]=$id;
				}
			}
		}
		$msg="Vérifié s'il n'y a pas des produits ou groupes enregistrés sur ";
		$msg=($notDeleted>1)?$msg.'ces type_services.':$msg.'cette type_service.';
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>$msg
							)));
	}
}
?>