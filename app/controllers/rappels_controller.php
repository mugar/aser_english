<?php
class RappelsController extends AppController {

	var $name = 'Rappels';
	var $paginate=array('order'=>array('Rappel.date','Rappel.heure'));

	function index($reservationId=null) {
		$this->Rappel->recursive = 0;
		$rappels=$this->paginate(array('Rappel.reservation_id'=>$reservationId));
		$this->set(compact('rappels','reservationId'));
	}

	function _logic($data,$action){
		$this->Rappel->set($data);
		if(!$this->Rappel->validates()){
			$failureMsg='Le Nom est obligatoire!';
			if($action=='add')
				exit('failure_'.$failureMsg);
			else 
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
		}
		$this->Rappel->save($data);
	}
	
	function _show($id){
		$this->set('rappel',$this->Rappel->find('first',array('fields'=>array('Rappel.*'),
    														'conditions'=>array('Rappel.id'=>$id)
															)
											));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->Rappel->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Rappel->find('first',array('fields'=>array('Rappel.*'),
																		'conditions'=>array('Rappel.id'=>$id),
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
				$this->Rappel->delete($id);
				$deleted[]=$id;
			}
		}
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>''
							)));
	}
}
?>