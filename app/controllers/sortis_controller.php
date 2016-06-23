<?php
class SortisController extends AppController {

	var $name = 'Sortis';
	
	function _conditions($data){
		$conditions=array();
		$date1=$date2=null;
		if(!empty($data)) {
			if($data['Sorti']['stock_id']!=0) {
				$conditions['Sorti.stock_id']=$data['Sorti']['stock_id'];
			}
			if($data['Sorti']['produit_id']!=0) {
				$conditions['Sorti.produit_id']=$data['Sorti']['produit_id'];
			}
			if($data['Produit']['groupe_id']!=0) {
				$conditions['Produit.groupe_id']=$data['Produit']['groupe_id'];
			}
			else if($data['Produit']['section_id']!=0) {
				$conditions['Produit.groupe_id']=$this->Sorti->Produit->Groupe->find('list',array('fields'=>array('Groupe.id','Groupe.id'),
																						'conditions'=>
																								array('Groupe.section_id'=>$data['Produit']['section_id'])
																						)
																			);
			}
			if($data['Sorti']['tier_id']!=0) {
				$conditions['Sorti.tier_id']=$data['Sorti']['tier_id'];
			}
		 	if($data['Sorti']['date1']!='') {
				$conditions['Sorti.date >=']=$date1=$data['Sorti']['date1'];
			}
		 	if($data['Sorti']['date2']!='') {
		 		$conditions['Sorti.date <=']=$date2=$data['Sorti']['date2'];
			}
		}
		
		return array('conditions'=>$conditions,
					'date1'=>$date1,
					'date2'=>$date2,
					);
	}
	
	function index() {
		$show=$this->Session->read('showSorti');
		$sortiConditions=$this->Session->read('sortiConditions');
		if((empty($this->data))&&(empty($sortiConditions))) {
			$this->set('sortis', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$cond=$this->_conditions($this->data);
			$sortiConditions=$cond['conditions'];
			if($this->data['Sorti']['show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$this->data['Sorti']['show'];
			}
			$sortiConditions['Sorti.id !=']=0; //to get the pagination always working
			$show['Sorti.show']=$this->data['Sorti']['show'];
			
			$this->set('sortis', $this->paginate($sortiConditions));
			$this->Session->write('sortiConditions',$sortiConditions);
			$this->Session->write('showSorti',$show);
		}
		else {
			if($show['Sorti.show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$show['Sorti.show'];
			}
			$this->set('sortis', $this->paginate($sortiConditions));
		}
	}
	
	function rapport() {
		$total=$qty=0;
		$sortis=array();
		$date1=$date2=null;
		if(!empty($this->data)){
			$cond=$this->_conditions($this->data);
			$conditions=$cond['conditions'];
			$date1=$cond['date1'];
			$date2=$cond['date2'];
			$sortis=$this->Sorti->find('all',array('fields'=>array(
																'Produit.name',
																'Produit.unite_id',
																'Tier.name',
																'Stock.name',
																'sum(Sorti.quantite) as quantite',
																'sum(Sorti.montant) as montant ',
																'Sorti.PU',
																'Sorti.observation'
																),
														'conditions'=>$conditions,
														'order'=>array('Sorti.date'),
														'group'=>array('Sorti.stock_id','Sorti.produit_id','Sorti.PU','Sorti.observation')
														)
										);
			foreach($sortis as	$sorti){
				$qty+=$sorti['Sorti']['quantite'];
				$total+=$sorti['Sorti']['montant'];
			}
		}
		$this->set(compact('sortis','date1','qty','date2','total'));
	}
	
	function _show($id){
		$this->set('sorti',$this->Sorti->find('first',array('fields'=>array(
    																	'Personnel.name','Personnel.id',
    																	'Tier.name','Tier.id',
    																	'Produit.name','Produit.id','Produit.unite_id',
    																	'Stock.name',
    																	'Sorti.*'
 																			),
    														'conditions'=>array('Sorti.id'=>$id)
															)
													));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function _logic(&$data,$action){
		$this->Sorti->set($data);
		if(!$this->Sorti->validates()) {
			$failureMsg='Les champs date et quantité sont obligatoires!';
			if($action=='edit')
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
			else
				exit('failure_'.$failureMsg);	 
		}
		if($data['Sorti']['date']>date('Y-m-d')){
			$this->_error($action, 'Cette date est incorrecte!');	
		}
		$return=$this->Product->stock($data,'credit');
		if(!$return['success']){
			if($action=='edit')
				exit(json_encode($return));
			else 
				exit('failure_'.$return['msg']);	 
		}
		if(($action=='edit')&&($this->Auth->user('id')!=$data['Sorti']['personnel_id'])){
		//	exit(json_encode(array('success'=>false,'msg'=>'Seul le créateur peut effectuer la modification!')));	
		}
		
		$produitInfo=$this->Sorti->Produit->find('first',array('fields'=>array('Produit.expiration',
																					'Produit.type',
																					'Produit.PV',
																					'Produit.PA'		
																					),
																	'conditions'=>array('id'=>$data['Sorti']['produit_id']),
																	'recursive'=>-1));
		$data['Sorti']['PU']=$produitInfo['Produit']['PA'];
		$data['Sorti']['montant']=$data['Sorti']['PU']*$data['Sorti']['quantite'];
		//Saving the sorti operation
		$this->Sorti->save($data);
		//Saving the product info that may have been changed like unite de mesure
		$this->Sorti->Produit->save($data);
	}
	
	function add() {
		if(!empty($this->data)) {
			$this->_logic($this->data, 'add');
			$this->_show($this->Sorti->id);
		}	
	}
			

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Sorti->find('first',array('fields'=>array('Sorti.*','Produit.id','Produit.unite_id'),
															'conditions'=>array('Sorti.id'=>$id),
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
				$sorti=$this->Sorti->find('first',array('fields'=>array('Sorti.historique_id',
																																'Sorti.personnel_id'
																																),
																								'conditions'=>array('Sorti.id'=>$id)
																));
				if(true){
					$this->Product->productHistoryDelete($sorti['Sorti']['historique_id'],'Historique');
					$this->Sorti->delete($id);
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
