<?php
class ReductionsController extends AppController {

	var $name = 'Reductions';


	function disable(){
		foreach($this->data['Id'] as $value){
			if($value!=0) {
				$info=$this->Reduction->find('first',array('conditions'=>array('Reduction.id'=>$value),
													'fields'=>array('Reduction.actif')
														));
				if($info['Reduction']['actif'])
					$this->Reduction->save(array('Reduction'=>array('id'=>$value,'actif'=>0)));
				else 
					$this->Reduction->save(array('Reduction'=>array('id'=>$value,'actif'=>1)));
			}	
		}
		exit(json_encode(array('success'=>true,'msg'=>'Succès !')));
	}
	
	function index() {
		$show=$this->Session->read('showReduction');
		$reductionConditions=$this->Session->read('reductionConditions');
		if((empty($this->data))&&(empty($reductionConditions))) {
			$this->set('reductions', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$reductionConditions=array();
			if($this->data['Reduction']['produit_id']!=0) {
				$reductionConditions['Reduction.produit_id']=$this->data['Reduction']['produit_id'];
			}
			if($this->data['Reduction']['tier_id']!=0) {
				$reductionConditions['Reduction.tier_id']=$this->data['Reduction']['tier_id'];
			}
			
			if($this->data['Reduction']['actif']!='') {
				$reductionConditions['Reduction.actif']=$this->data['Reduction']['actif'];
			}
			
			if($this->data['Reduction']['show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$this->data['Reduction']['show'];
			}
			$reductionConditions['Reduction.id !=']=0; //to get the pagination always working
			$show['Reduction.show']=$this->data['Reduction']['show'];
			
			$this->set('reductions', $this->paginate($reductionConditions));
			$this->Session->write('reductionConditions',$reductionConditions);
			$this->Session->write('showReduction',$show);
		}
		else {
			if($show['Reduction.show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$show['Reduction.show'];
			}
			$this->set('reductions', $this->paginate($reductionConditions));
		}
	}

	function _show($id){
		$this->set('reduction',$this->Reduction->find('first',array('fields'=>array(
    																		'Tier.name',
    																		'Produit.name','Produit.id',
    																		'Reduction.*'
    																		),
    																		'conditions'=>array('Reduction.id'=>$id)
																			)
																));
		$this->layout="ajax";
		$this->render('add');
	}
	function _logic(&$data,$action){
		$failureMsg='Vérifiez s\'il tous les champs sont complétés';
		$this->Reduction->set($data);
		if(!$this->Reduction->validates()){
			if($action=='edit')
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
			else 
				exit('failure_'.$failureMsg);
		}
		//check for duplicates
		$search = $this->Reduction->find('first',array('conditions'=>array('Reduction.tier_id'=>$data['Reduction']['tier_id'],
																																			'Reduction.produit_id'=>$data['Reduction']['produit_id'],
																																			),
																									'recursive'=>-1
																									));
		if(!empty($search)&&empty($data['Reduction']['id'])){
			$this->_error($action,'Cette réduction est déjà enregistrée. son PU est '.$search['Reduction']['PU']);		
		}
		//saving
		$this->Reduction->save($data); 
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data, 'add');
			$this->_show($this->Reduction->id);
		}	
	}
	
	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Reduction->find('first',array('fields'=>array('Reduction.*'),
																'conditions'=>array('Reduction.id'=>$id)
																));
			}
		}
		else {
			$this->_show($id);
		}
	}	

	function delete() {
		$deleted=array();
		$notDeleted=0;
		foreach($this->data['Id'] as $id){
			if($id!=0) {
					$this->Reduction->delete($id);
					$deleted[]=$id;
			}
		}
		$msg=($notDeleted>1)?"les":"l'";
		exit(json_encode(array('success'=>true,'deleted'=>$deleted,'notDeleted'=>$notDeleted,'msg'=>"Seul le créateur peut $msg effacer.")));
	}
}
?>
