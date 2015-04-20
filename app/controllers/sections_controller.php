<?php
class SectionsController extends AppController {

	var $name = 'Sections';

	function index() {
		$this->Section->recursive = 0;
		$this->set('sections', $this->paginate());
	}

	function _logic($data,$action){
		$this->Section->set($data);
		if(!$this->Section->validates()){
			$failureMsg='Le Nom est obligatoire!';
			if($action=='add')
				exit('failure_'.$failureMsg);
			else 
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
		}
		$this->Section->save($data);
	}
	
	function _show($id){
		$this->set('section',$this->Section->find('first',array('fields'=>array('Section.*'),
    														'conditions'=>array('Section.id'=>$id)
															)
											));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->Section->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Section->find('first',array('fields'=>array('Section.*'),
																		'conditions'=>array('Section.id'=>$id),
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
			
				$test1=$this->Section->Groupe->find('first',array('conditions'=>array('Groupe.section_id'=>$id),
																'recursive'=>-1
												));
				if (!empty($test1)){
					$notDeleted++;
				}
				else {
					$this->Section->delete($id);
					$deleted[]=$id;
				}
			}
		}
		$msg="Vérifié s'il n'y a pas des produits ou groupes enregistrés sur ";
		$msg=($notDeleted>1)?$msg.'ces sections.':$msg.'cette section.';
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>$msg
							)));
	}
}
?>