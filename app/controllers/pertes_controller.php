<?php
class PertesController extends AppController {

	var $name = 'Pertes';
	
	function _conditions($data){
		$conditions=array();
		$date1=$date2=null;
		if(!empty($data)) {
			if($data['Perte']['stock_id']!=0) {
				$conditions['Perte.stock_id']=$data['Perte']['stock_id'];
			}
			if($data['Perte']['produit_id']!=0) {
				$conditions['Perte.produit_id']=$data['Perte']['produit_id'];
			}
			if($data['Produit']['groupe_id']!=0) {
				$conditions['Produit.groupe_id']=$data['Produit']['groupe_id'];
			}
			else if($data['Produit']['section_id']!=0) {
				$conditions['Produit.groupe_id']=$this->Perte->Produit->Groupe->find('list',array('fields'=>array('Groupe.id','Groupe.id'),
																						'conditions'=>
																								array('Groupe.section_id'=>$data['Produit']['section_id'])
																						)
																			);
			}
			if($data['Perte']['nature']!='') {
				$conditions['Perte.nature']=$data['Perte']['nature'];
			}
		 	if($data['Perte']['date1']!='') {
				$conditions['Perte.date >=']=$date1=$data['Perte']['date1'];
			}
		 	if($data['Perte']['date2']!='') {
		 		$conditions['Perte.date <=']=$date2=$data['Perte']['date2'];
			}
		}
		
		return array('conditions'=>$conditions,
					'date1'=>$date1,
					'date2'=>$date2,
					);
	}
	
	function index() {
		$show=$this->Session->read('showPerte');
		$perteConditions=$this->Session->read('perteConditions');
		if((empty($this->data))&&(empty($perteConditions))) {
			$this->set('pertes', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$cond=$this->_conditions($this->data);
			$perteConditions=$cond['conditions'];
			if($this->data['Perte']['show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$this->data['Perte']['show'];
			}
			$perteConditions['Perte.id !=']=0; //to get the pagination always working
			$show['Perte.show']=$this->data['Perte']['show'];
			
			$this->set('pertes', $this->paginate($perteConditions));
			$this->Session->write('perteConditions',$perteConditions);
			$this->Session->write('showPerte',$show);
		}
		else {
			if($show['Perte.show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$show['Perte.show'];
			}
			$this->set('pertes', $this->paginate($perteConditions));
		}
	}
	
	function rapport() {
		$total=$qty=0;
		$pertes=array();
		$date1=$date2=null;
		if(!empty($this->data)){
			$cond=$this->_conditions($this->data);
			$conditions=$cond['conditions'];
			$date1=$cond['date1'];
			$date2=$cond['date2'];
			$pertes=$this->Perte->find('all',array('fields'=>array(
																'Produit.name',
																'Produit.unite_id',
																'sum(Perte.montant) as montant',
																'sum(Perte.quantite) as quantite',
																'Stock.name',
																'Perte.PU',
																'Perte.nature'
																),
														'conditions'=>$conditions,
														'order'=>array('Perte.date'),
														'group'=>array('Perte.stock_id','Perte.produit_id','Perte.PU','Perte.nature')
														)
										);
			foreach($pertes as	$perte){
				$qty+=$perte['Perte']['quantite'];
				$total+=$perte['Perte']['montant'];
			}
		}
		$this->set(compact('pertes','date1','date2','total','qty'));
	}

	function _show($id){
		$this->set('perte',$this->Perte->find('first',array('fields'=>array(
    																	'Personnel.name','Personnel.id',
    																	'Produit.name','Produit.id','Produit.unite_id',
    																	'Stock.name',
    																	'Perte.*'
 																			),
    														'conditions'=>array('Perte.id'=>$id)
															)
													));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function _logic(&$data,$action){
		$this->Perte->set($data);
		if(!$this->Perte->validates()) {
			$failureMsg='Les champs date et quantité sont obligatoires!';
			if(($action=='edit')||(isset($data['quick_form'])))
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
			else
				exit('failure_'.$failureMsg);	 
		}
		if($data['Perte']['date']>date('Y-m-d')){
			$this->_error($action, 'Cette date est incorrecte!');	
		}
		$return=$this->Product->stock($data,'credit');
		if(!$return['success']){
			if(($action=='edit')||(isset($data['quick_form'])))
				exit(json_encode($return));
			else 
				exit('failure_'.$return['msg']);	 
		}
		if(($action=='edit')&&($this->Auth->user('id')!=$data['Perte']['personnel_id'])){
		//	exit(json_encode(array('success'=>false,'msg'=>'Seul le créateur peut effectuer la modification!')));	
		}
		
		$data['Perte']['PU']=$this->Product->productPrice($data['Perte']['produit_id']);
		$data['Perte']['montant']=$data['Perte']['PU']*$data['Perte']['quantite'];
		$this->Perte->save($data);
		$this->Perte->Produit->save($data);
		
		if(isset($data['quick_form']))
			exit(json_encode(array('success'=>true,'msg'=>'Perte Enregistrée!')));
	}
	
	function add() {
		if(!empty($this->data)) {
			$this->_logic($this->data, 'add');
			$this->_show($this->Perte->id);
		}	
	}
			

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistrée!')));
			}
			else {
				$this->data = $this->Perte->find('first',array('fields'=>array('Perte.*','Produit.id','Produit.unite_id'),
															'conditions'=>array('Perte.id'=>$id),
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
				$perte=$this->Perte->find('first',array('fields'=>array('Perte.historique_id',
																															'Perte.personnel_id'
																																),
																							'conditions'=>array('Perte.id'=>$id)
																));
				if(true){
					$this->Product->productHistoryDelete($perte['Perte']['historique_id'],'Historique');
					$this->Perte->delete($id);
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
