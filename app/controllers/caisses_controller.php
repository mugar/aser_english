<?php
class CaissesController extends AppController {

	var $name = 'Caisses';
	var $paginate=array('order'=>'Caiss.name asc');
	
	function sum(){
		$conditions=$sums=$caisses=array(); //reinitialiser la variable
		if(!empty($this->data)){
		 	if($this->data['Caiss']['type']!='toutes') {
		 		$conditions['Caiss.type']=$this->data['Caiss']['type'];
			}
		 	if($this->data['Caiss']['monnaie']!='toutes') {
		 		$conditions['Caiss.monnaie']=$this->data['Caiss']['monnaie'];
			}
			
			$caisses=$this->Caiss->find('all',array('fields'=>array('Caiss.*'),
													'conditions'=>$conditions
													)
										);
			$sums=$this->Caiss->find('all',array('fields'=>array('sum(Caiss.montant) as montant',
																'Caiss.monnaie',
																),
												'group'=>array('Caiss.monnaie'),
												'conditions'=>$conditions
												)
										);
		}
		
		$this->set(compact('caisses','sums'));
	}
	
	function index() {
			$devise['USD']=$taux=$this->Conf->find('taux_usd');
			$devise['EUR']=$taux=$this->Conf->find('taux_eur');
			$devise[Configure::read('aser.default_currency')]=1;
			
			$caisses=$this->paginate(array('Caiss.id'=>$this->Product->caisses_permises()));
			$this->loadModel('Operation');
			$total=0;
			foreach($caisses as $key=>$caisse){
				$operations=$this->Operation->find('all',array('fields'=>array('sum(Operation.debit) as debit',
																		'sum(Operation.credit) as credit',
																		'Operation.monnaie',
																		'Operation.mode_paiement'
						                        							),
					                        				'conditions'=>array('Operation.element_id'=>$caisse['Caiss']['id'],
					                        									'Operation.model'=>'Caiss',
																				),
															'group'=>array('Operation.mode_paiement','Operation.monnaie')
																));
				foreach($operations as $operation){
					$caisses[$key]['Caiss'][$operation['Operation']['mode_paiement']][$operation['Operation']['monnaie']]=$operation['Operation']['debit']-$operation['Operation']['credit'];
					$total+=$caisses[$key]['Caiss'][$operation['Operation']['mode_paiement']][$operation['Operation']['monnaie']]*$devise[$operation['Operation']['monnaie']];
				}
			}
	//	exit(debug($caisses));	
		$this->set(compact('caisses','total'));
	}



	function _logic($data,$action){
		$this->Caiss->set($data);
		if(!$this->Caiss->validates()){
			$this->_error($action,'Le nom de la caisse est obligatoire!');
		}
	
		if($action=='add'){
			$data['Caiss']['actif']='yes';
		}
		$cond['Caiss.name']=$data['Caiss']['name'];
		if(!empty($data['Caiss']['id'])){
			$cond['Caiss.id !=']=$data['Caiss']['id'];
		}
		$search=$this->Caiss->find('first',array('fields'=>array('Caiss.name'),
											'conditions'=>$cond
											));	
		if(!empty($search)){
			$this->_error($action,'Cette caisse est déjà enregistrée!');
		}	
		$this->Caiss->save($data);
	}
	
	function _show($id){
		$this->set('caisse',$this->Caiss->find('first',array('fields'=>array('Caiss.*'),
    														'conditions'=>array('Caiss.id'=>$id)
															)
											));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->Caiss->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistrée')));
			}
			else {
				$this->data = $this->Caiss->find('first',array('fields'=>array('Caiss.*'),
																		'conditions'=>array('Caiss.id'=>$id),
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
				$test1=$this->Caiss->Operation->find('first',array('conditions'=>array('Operation.element_id'=>$id,
																						'Operation.model'=>'Caiss'
																						),
																'recursive'=>-1
												));
				if (!empty($test1)){
					$notDeleted++;
				}
				else {
					$this->Caiss->delete($id);
					$deleted[]=$id;
				}
			}
		}
		$msg="Vérifié s'il n'y a pas des opérations enregistrées sur ";
		$msg=($notDeleted>1)?$msg.'ces caisses.':$msg.'cette caisse.';
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>$msg
							)));
	}

}
?>