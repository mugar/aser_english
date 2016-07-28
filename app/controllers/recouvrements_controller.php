<?php
class RecouvrementsController extends AppController {

	var $name = 'Recouvrements';
	
	function beforeFilter(){
		$collectors = $this->Recouvrement->Personnel->find('list',array('conditions'=>array('Personnel.fonction_id'=>array(3,5))));
		$collectors1 = array(''=>'')+ $collectors;
		$this->set(compact('collectors','collectors1'));
		parent::beforeFilter();	
	}

	function _conditions($data){
		$conditions=array();
		$date1=$date2=null;
		if(!empty($data)) {
			if($data['Recouvrement']['done_by_id']!=0) {
				$conditions['Recouvrement.done_by_id']=$data['Recouvrement']['done_by_id'];
			}
			
			if($data['Recouvrement']['tier_id']!=0) {
				$conditions['Recouvrement.tier_id']=$data['Recouvrement']['tier_id'];
			}
		 	if($data['Recouvrement']['date1']!='') {
				$conditions['Recouvrement.date >=']=$date1=$data['Recouvrement']['date1'];
			}
		 	if($data['Recouvrement']['date2']!='') {
		 		$conditions['Recouvrement.date <=']=$date2=$data['Recouvrement']['date2'];
			}
		}
		
		return array('conditions'=>$conditions,
					'date1'=>$date1,
					'date2'=>$date2,
					);
	}
	
	function index() {
		$show=$this->Session->read('showRecouvrement');
		$recouvrementConditions=$this->Session->read('recouvrementConditions');
		if((empty($this->data))&&(empty($recouvrementConditions))) {
			$this->set('recouvrements', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$cond=$this->_conditions($this->data);
			$recouvrementConditions=$cond['conditions'];
			if($this->data['Recouvrement']['show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$this->data['Recouvrement']['show'];
			}
			$recouvrementConditions['Recouvrement.id !=']=0; //to get the pagination always working
			$show['Recouvrement.show']=$this->data['Recouvrement']['show'];
			
			$this->set('recouvrements', $this->paginate($recouvrementConditions));
			$this->Session->write('recouvrementConditions',$recouvrementConditions);
			$this->Session->write('showRecouvrement',$show);
		}
		else {
			if($show['Recouvrement.show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$show['Recouvrement.show'];
			}
			$this->set('recouvrements', $this->paginate($recouvrementConditions));
		}
	}
	
	function rapport() {
		$total=0;
		$recouvrements=array();
		$date1=$date2=null;
		if(!empty($this->data)){
			$cond=$this->_conditions($this->data);
			$conditions=$cond['conditions'];
			$date1=$cond['date1'];
			$date2=$cond['date2'];
		}
		else {
			$conditions['Recouvrement.date >= '] = $date1 = date('Y-m').'-01';
			$conditions['Recouvrement.date <= '] = $date2 =  date('Y-m').'-31';
		}
		$recouvrements=$this->Recouvrement->find('all',array('fields'=>array(
																'Tier.name',
																'DoneBy.name',
																'Recouvrement.*'
																),
														'conditions'=>$conditions,
														'order'=>array('Recouvrement.date'),
														)
										);
		foreach($recouvrements as	$recouvrement){
				$total+=$recouvrement['Recouvrement']['montant'];
		}
		$this->set(compact('recouvrements','date1','date2','total'));
	}
	
	function _show($id){
		$this->set('recouvrement',$this->Recouvrement->find('first',array('fields'=>array(
    																	'Personnel.name','Personnel.id',
    																	'DoneBy.name','DoneBy.id',
    																	'Tier.name','Tier.id',
    																	'Recouvrement.*'
 																			),
    														'conditions'=>array('Recouvrement.id'=>$id)
															)
													));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function _logic(&$data,$action){
		$this->Recouvrement->set($data);
		if(!$this->Recouvrement->validates()) {
			$failureMsg='Date & Customer field are mandatory!';
			if($action=='edit')
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
			else
				exit('failure_'.$failureMsg);	 
		}
		
		if(($action=='edit')&&($this->Auth->user('id')!=$data['Recouvrement']['personnel_id'])){
			exit(json_encode(array('success'=>false,'msg'=>'Only the one who created the operation can modifiy it!')));	
		}
		
		
		//Saving the recouvrement operation
		$this->Recouvrement->save($data);
	}
	
	function add() {
		if(!empty($this->data)) {
			$this->_logic($this->data, 'add');
			$this->_show($this->Recouvrement->id);
		}	
	}
			

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Recouvrement->find('first',array('fields'=>array('Recouvrement.*'),
															'conditions'=>array('Recouvrement.id'=>$id),
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
				$recouvrement=$this->Recouvrement->find('first',array('fields'=>array('Recouvrement.historique_id',
																																'Recouvrement.personnel_id'
																																),
																								'conditions'=>array('Recouvrement.id'=>$id)
																));
				if(true){
					$this->Product->productHistoryDelete($recouvrement['Recouvrement']['historique_id'],'Historique');
					$this->Recouvrement->delete($id);
					$deleted[]=$id;
				}
				else {
					$notDeleted++;	
				}
			}
		}
		$msg=($notDeleted>1)?"les":"l'";
		exit(json_encode(array('success'=>true,'deleted'=>$deleted,'notDeleted'=>$notDeleted,'msg'=>"Seul le créateur peut $msg effacer.")));
	}

}
?>
