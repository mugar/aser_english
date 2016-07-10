<?php
class TypeChambresController extends AppController {

	var $name = 'TypeChambres';
	
	function beforeFilter(){
		parent::beforeFilter();
		
		$monnaies=array('USD'=>'USD','RWF'=>'RWF');
		$this->set(compact('monnaies'));
	}
	
	function index() {
		$typeChambres=$this->paginate();
		foreach($typeChambres as $key=>$typeChambre){
			$typeChambres[$key]['TypeChambre']['total']=$this->TypeChambre->Chambre->find('count',array('conditions'=>array('Chambre.type_chambre_id'=>$typeChambre['TypeChambre']['id'])));
		}
		$this->set(compact('typeChambres'));
	}

	function _logic($data,$action){
		$this->TypeChambre->set($data);
		if(!$this->TypeChambre->validates()){
			$failureMsg='Le Nom et le montant sont obligatoire!';
			if($action=='add')
				exit('failure_'.$failureMsg);
			else 
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
		}
		$cond['TypeChambre.name']=$data['TypeChambre']['name'];
		if(!empty($data['TypeChambre']['id'])){
			$cond['TypeChambre.id !=']=$data['TypeChambre']['id'];
		}
		$search=$this->TypeChambre->find('first',array('fields'=>array('TypeChambre.name'),
											'conditions'=>$cond
											));	
		if(!empty($search)){
			$failureMsg='Ce type de chambre est déjà enregistré!';
			if($action=='add')
				exit('failure_'.$failureMsg);
			else 
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
		}	
		$this->TypeChambre->save($data);
	}
	
	function _show($id){
		$typeChambre=$this->TypeChambre->find('first',array('fields'=>array('TypeChambre.*'),
    														'conditions'=>array('TypeChambre.id'=>$id)
															)
											);
		$typeChambre['TypeChambre']['total']=$this->TypeChambre->Chambre->find('count',array('conditions'=>array('Chambre.type_chambre_id'=>$typeChambre['TypeChambre']['id'])));
		$this->set('typeChambre',$typeChambre);
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->TypeChambre->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->TypeChambre->find('first',array('fields'=>array('TypeChambre.*'),
																		'conditions'=>array('TypeChambre.id'=>$id),
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
				$test1=$this->TypeChambre->Chambre->find('first',array('conditions'=>array('Chambre.type_chambre_id'=>$id),
																'recursive'=>-1
												));
				if (!empty($test1)){
					$notDeleted++;
				}
				else {
					$this->TypeChambre->delete($id);
					$deleted[]=$id;
				}
			}
		}
		$msg="Vérifié s'il n'y a pas de chambres enregistrés sur ";
		$msg=($notDeleted>1)?$msg.'ces type de Chambres.':$msg.'ce type de Chambre.';
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>$msg
							)));
	}
}
?>