<?php
class MouvementsController extends AppController {

	var $name = 'Mouvements';


	function index() {
		$show=$this->Session->read('showMouvement');
		$mouvementConditions=$this->Session->read('mouvementConditions');
		if((empty($this->data))&&(empty($mouvementConditions))) {
			$this->set('mouvements', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$mouvementConditions=array();
			if($this->data['Mouvement']['produit_id']!=0) {
				$mouvementConditions['Mouvement.produit_id']=$this->data['Mouvement']['produit_id'];
			}
			if($this->data['Mouvement']['stock_sortant_id']!=0){
				$mouvementConditions['Mouvement.stock_sortant_id']=$this->data['Mouvement']['stock_sortant_id'];
			}
			if($this->data['Mouvement']['stock_entrant_id']!=0){
				$mouvementConditions['Mouvement.stock_entrant_id']=$this->data['Mouvement']['stock_entrant_id'];
			}
			if($this->data['Mouvement']['date1']!='') {
				$mouvementConditions['Mouvement.date >=']=$this->data['Mouvement']['date1'];
			}
			if($this->data['Mouvement']['date2']!='') {
				$mouvementConditions['Mouvement.date <=']=$this->data['Mouvement']['date2'];
			}
			if($this->data['Mouvement']['show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$this->data['Mouvement']['show'];
			}
			$mouvementConditions['Mouvement.id !=']=0; //to get the pagination always working
			$show['Mouvement.show']=$this->data['Mouvement']['show'];
			
			$this->set('mouvements', $this->paginate($mouvementConditions));
			$this->Session->write('mouvementConditions',$mouvementConditions);
			$this->Session->write('showMouvement',$show);
		}
		else {
			if($show['Mouvement.show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$show['Mouvement.show'];
			}
			$this->set('mouvements', $this->paginate($mouvementConditions));
		}
	}

	function _show($id){
		$this->set('mouvement',$this->Mouvement->find('first',array('fields'=>array(
    																		'Personnel.name','Personnel.id',
    																		'StockSortant.name',
    																		'StockEntrant.name',
    																		'Produit.name','Produit.id','Produit.unite_id',
    																		'Mouvement.*'
    																		),
    																		'conditions'=>array('Mouvement.id'=>$id)
																			)
																));
		$this->layout="ajax";
		$this->render('add');
	}
	function _logic(&$data,$action){
		$failureMsg='Vérifiez s\'il les champs Date & Quantité sont Obligatoire!';
		$this->Mouvement->set($data);
		if(!$this->Mouvement->validates()){
			if($action=='edit')
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
			else 
				exit('failure_'.$failureMsg);
		}
		if($data['Mouvement']['date']>date('Y-m-d')){
			$this->_error($action, 'Cette date est incorrecte!');	
		}
		$stockIdentiqueMsg='Les Stocks sélectionnés sont identiques!';
		if($data['Mouvement']['stock_sortant_id']==$data['Mouvement']['stock_entrant_id']){
			if($action=='edit')
				exit(json_encode(array('success'=>false,'msg'=>$stockIdentiqueMsg)));
			else 
				exit('failure_'.$stockIdentiqueMsg);
		}
		if(($action=='edit')&&($this->Auth->user('id')!=$data['Mouvement']['personnel_id'])){
		//	exit(json_encode(array('success'=>false,'msg'=>'Seul le créateur peut effectuer la modification!')));	
		}
		//treating edit like a new add
		if($action=='edit'){
			$this->Product->productHistoryDelete($data['Mouvement']['historique1'],'Historique');
			$this->Product->productHistoryDelete($data['Mouvement']['historique2'],'Historique');
			$data['Mouvement']['historique2']=$data['Mouvement']['historique2']=null;
		}
		//for stock sortant
		$return=$this->Product->stock($data,'credit'); 
		if(!$return['success']){
			if($action=='edit')
				exit(json_encode($return));
			else 
				exit('failure_'.$return['msg']);
		}
		
		//saving
		$this->Mouvement->save($data); 
		$this->Mouvement->Produit->save($data); 
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data, 'add');
			$this->_show($this->Mouvement->id);
		}	
	}
	
	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Mouvement->find('first',array('fields'=>array('Mouvement.*','Produit.id','Produit.unite_id'),
																'conditions'=>array('Mouvement.id'=>$id)
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
				$mouvement=$this->Mouvement->find('first',array('fields'=>array('Mouvement.historique1',
																				'Mouvement.historique2',
																				'Mouvement.personnel_id'
																				),
																'conditions'=>array('Mouvement.id'=>$id),
																'recursive'=>-1
																));
					$this->Product->productHistoryDelete($mouvement['Mouvement']['historique1'],'Historique');
					$this->Product->productHistoryDelete($mouvement['Mouvement']['historique2'],'Historique');
					$this->Mouvement->delete($id);
					$deleted[]=$id;
			}
		}
		$msg=($notDeleted>1)?"les":"l'";
		exit(json_encode(array('success'=>true,'deleted'=>$deleted,'notDeleted'=>$notDeleted,'msg'=>"Seul le créateur peut $msg effacer.")));
	}
}
?>
