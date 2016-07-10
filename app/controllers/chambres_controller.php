<?php
class ChambresController extends AppController {

	var $name = 'Chambres';

	function beforeFilter(){
		parent::beforeFilter();
		$typeChambres = $this->Chambre->TypeChambre->find('list',array('order'=>array('TypeChambre.name')));
		$this->set(compact('typeChambres'));
	}	
	function index() {
		$this->Chambre->recursive =0;
		$this->set('chambres', $this->paginate());
	}
	function fiche(){
		$etages=$this->Chambre->Etage->find('all',array('fieds'=>array('Etage.*'),
														'order'=>array('Etage.name asc')
														)
											);
		foreach($etages as $key=>$etage){
			$etages[$key]['details']=$this->Chambre->find('all',array('fields'=>array('Chambre.name','Chambre.propre','TypeChambre.name'),
											'conditions'=>array('Chambre.etage_id'=>$etage['Etage']['id']),
											'order'=>array('Chambre.name asc')
											));		
		}						
		$chambres=$this->Chambre->find('all',array('recursive'=>-1,
												'conditions'=>array('Chambre.message !='=>'')
													));								
		$this->set(compact('chambres','etages'));
	}
	
	function cleaner(){
		$history['chambres']='';
		foreach($this->data['Id'] as $value){
			if($value!=0) {
				$chambre=$this->Chambre->find('first',array('conditions'=>array('Chambre.id'=>$value),
															'fields'=>array('Chambre.*'),
															'recursive'=>-1
															)
											);
				$chambre['Chambre']['propre']=$this->data['Chambre']['propre'];
				$this->Chambre->save($chambre);
				$history['chambres'].=$chambre['Chambre']['name'].', ';
			}	
		}
		//recording the operation in the history
		$history['date']=date('Y-m-d');
		$history['heure']=date('H:i:s');
		$history['etat']=$this->data['Chambre']['propre'];
		$this->loadModel('HistoriqueChambre');
		$this->HistoriqueChambre->save(array('HistoriqueChambre'=>$history));
		exit('success');
	}
	
	function message(){
		foreach($this->data['Id'] as $value){
			if($value!=0) {
				$chambre=$this->Chambre->find('first',array('conditions'=>array('Chambre.id'=>$value),
															'fields'=>array('Chambre.*'),
															'recursive'=>-1
															)
											);
				$chambre['Chambre']['message']=$this->data['Chambre']['message'];
				$this->Chambre->save($chambre);
			}	
		}
		exit('success');
	}

	function _logic($data,$action){
		$this->Chambre->set($data);
		if(!$this->Chambre->validates()){
			$failureMsg='Le numéro de chambre et d\'étage sont obligatoires!';
			if($action=='add')
				exit('failure_'.$failureMsg);
			else 
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
		}
		if($action=='add'){
			$data['Chambre']['operationnelle']='yes';
		}
		$cond['Chambre.name']=$data['Chambre']['name'];
		if(!empty($data['Chambre']['id'])){
			$cond['Chambre.id !=']=$data['Chambre']['id'];
		}
		$search=$this->Chambre->find('first',array('fields'=>array('Chambre.name'),
											'conditions'=>$cond
											));	
		if(!empty($search)){
			$failureMsg='Ce numéro de chambre est déjà enregistré!';
			if($action=='add')
				exit('failure_'.$failureMsg);
			else 
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
		}	
		$this->Chambre->save($data);
	}
	
	function _show($id){
		$this->set('chambre',$this->Chambre->find('first',array('fields'=>array('Chambre.*','TypeChambre.name'),
    														'conditions'=>array('Chambre.id'=>$id)
															)
											));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->Chambre->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Chambre->find('first',array('fields'=>array('Chambre.*'),
																		'conditions'=>array('Chambre.id'=>$id),
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
				$test1=$this->Chambre->Reservation->find('first',array('conditions'=>array('Reservation.chambre_id'=>$id),
																'recursive'=>-1
												));
				if (!empty($test1)){
					$notDeleted++;
				}
				else {
					$this->Chambre->delete($id);
					$deleted[]=$id;
				}
			}
		}
		$msg="Vérifié s'il n'y a pas des réservations enregistrés sur ";
		$msg=($notDeleted>1)?$msg.'ces chambres.':$msg.'cette chambre.';
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>$msg
							)));
	}
}
?>