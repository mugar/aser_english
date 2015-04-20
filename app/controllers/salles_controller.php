<?php
class SallesController extends AppController {

	var $name = 'Salles';

	function index() {
		$this->set('salles', $this->paginate());
	}


	function _logic($data,$action){
		$this->Salle->set($data);
		if(!$this->Salle->validates()){
			$failureMsg='Le nom de salle et le montant sont obligatoires!';
			if($action=='add')
				exit('failure_'.$failureMsg);
			else 
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
		}
		$cond['Salle.name']=$data['Salle']['name'];
		if(!empty($data['Salle']['id'])){
			$cond['Salle.id !=']=$data['Salle']['id'];
		}
		$search=$this->Salle->find('first',array('fields'=>array('Salle.name'),
											'conditions'=>$cond
											));	
		if(!empty($search)){
			$failureMsg='Cette salle est déjà enregistrée!';
			if($action=='add')
				exit('failure_'.$failureMsg);
			else 
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
		}	
		$this->Salle->save($data);
	}
	
	function _show($id){
		$this->set('salle',$this->Salle->find('first',array('fields'=>array('Salle.*'),
    														'conditions'=>array('Salle.id'=>$id)
															)
											));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->Salle->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Salle->find('first',array('fields'=>array('Salle.*'),
																		'conditions'=>array('Salle.id'=>$id),
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
				$test1=$this->Salle->Location->find('first',array('conditions'=>array('Location.salle_id'=>$id),
																'recursive'=>-1
												));
				if (!empty($test1)){
					$notDeleted++;
				}
				else {
					$this->Salle->delete($id);
					$deleted[]=$id;
				}
			}
		}
		$msg="Vérifié s'il n'y a pas des locations enregistrées sur ";
		$msg=($notDeleted>1)?$msg.'ces salles.':$msg.'cette salle.';
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>$msg
							)));
	}
}
?>