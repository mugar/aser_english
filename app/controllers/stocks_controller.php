<?php
class StocksController extends AppController {

	var $name = 'Stocks';

	function index() {
		$this->Stock->recursive = 0;
		$this->set('stocks', $this->paginate());
	}

	function _logic($data,$action){
		$this->Stock->set($data);
		if(!$this->Stock->validates()){
			$failureMsg='Le Nom est obligatoire!';
			if($action=='add')
				exit('failure_'.$failureMsg);
			else 
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
		}
		$this->Stock->save($data);
	}
	
	function _show($id){
		$this->set('stock',$this->Stock->find('first',array('fields'=>array('Stock.*'),
    														'conditions'=>array('Stock.id'=>$id)
															)
											));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->Stock->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Stock->find('first',array('fields'=>array('Stock.*'),
																		'conditions'=>array('Stock.id'=>$id),
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
				$test1=$this->Stock->Historique->find('first',array('conditions'=>array('Historique.stock_id'=>$id),
																'recursive'=>-1
												));
				if (!empty($test1)){
					$notDeleted++;
				}
				else {
					$this->Stock->delete($id);
					$deleted[]=$id;
				}
			}
		}
		$msg="Vérifié s'il n'y a pas des quantités enregistrés sur ";
		$msg=($notDeleted>1)?$msg.'ces stocks.':$msg.'ce stock.';
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>$msg
							)));
	}
}
?>