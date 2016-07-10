<?php 
class HistoriquesController extends AppController {

	var $name = 'Historiques';
	
	function beforeFilter(){
		parent::beforeFilter();

		$this->Auth->allow('*');

		$types=array('Entree'=>'Entry',
							'Sorti'=>'Consumption',
							'Perte'=>'Loss'
							);
		$types1=array(''=>'')+$types;
		$this->set(compact('types','types1'));
	}
	
	function pa($id=null){
		if(!$id){
			$ids=array_keys($this->produits);
			$id=(isset($ids[0]))?$ids[0]:0;
		}
		$produitInfo=$this->Historique->Produit->find('first',array('fields'=>array('Produit.PA','Produit.id'),
													'conditions'=>array('Produit.id'=>$id),
													));
		if($produitInfo['Produit']['PA']==0){
			$pa=$this->Historique->find('first',array('fields'=>array('Historique.PU'),
													'conditions'=>array('Historique.produit_id'=>$id),
													'order'=>array('Historique.date desc')
													));
			$pa=$produitInfo['Produit']['PA']=(!empty($pa))?$pa['Historique']['PU']:0;	
			$this->Historique->Produit->save($produitInfo);
		}
		else {
			$pa=$produitInfo['Produit']['PA'];
		}										
		if($this->RequestHandler->isAjax()){
				exit(json_encode(array('success'=>true,'PU'=>$pa)));
		}
		else {
			$this->set('pa',$pa);
		}
	}
	
	function  _conditions($data){
		$conditions=array();
		$date1=$date2=null;
		if(!empty($data)) {
			if($data['Historique']['type']!='') {
				$conditions['Historique.type']=$data['Historique']['type'];
			}
			if($data['Historique']['produit_id']!=0) {
				$conditions['Historique.produit_id']=$data['Historique']['produit_id'];
			}
			if($data['Produit']['groupe_id']!=0) {
				$conditions['Produit.groupe_id']=$data['Produit']['groupe_id'];
			}
			else if($data['Produit']['section_id']!=0) {
				$conditions['Produit.groupe_id']=$this->Historique->Produit->Groupe->find('list',array('fields'=>array('Groupe.id','Groupe.id'),
																						'conditions'=>
																								array('Groupe.section_id'=>$data['Produit']['section_id'])
																						)
																			);
			}
			if($data['Historique']['tier_id']!=0) {
				$conditions['Historique.tier_id']=$data['Historique']['tier_id'];
			}
			if($this->data['Historique']['stock_id']!=0){
				$conditions['Historique.stock_id']=$data['Historique']['stock_id'];
			}
		 	if($data['Historique']['date1']!='') {
				$conditions['Historique.date >=']=$date1=$data['Historique']['date1'];
			}
		 	if($data['Historique']['date2']!='') {
		 		$conditions['Historique.date <=']=$date2=$data['Historique']['date2'];
			}
		}
		
		return array('conditions'=>$conditions,
					'date1'=>$date1,
					'date2'=>$date2,
					);
	}

	function index() {
		$historiqueConditions=$this->Session->read('historiqueConditions');
		if((empty($this->data))&&(empty($historiqueConditions))) {
			$this->set('historiques', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$cond=$this-> _conditions($this->data);
			$historiqueConditions=$cond['conditions'];
			
			$this->set('historiques', $this->paginate($historiqueConditions));
			$this->Session->write('historiqueConditions',$historiqueConditions);
		}
		else {
			$this->set('historiques', $this->paginate($historiqueConditions));
		}
		//search the latest PU for the first displayed product
		$this->pa();
	}

	function rapport() {
		$cond=$this-> _conditions($this->data);
		$conditions=$cond['conditions'];
		$date1=$cond['date1'];
		$date2=$cond['date2'];
		$total=$qty=0;
		$grouper=true;
		$historiques=$group=array();
		if(!empty($this->data)){
			$historiques=$this->Historique->find('all',array('fields'=>array('Stock.name',
																						'Produit.name','Produit.unite_id',
																						'sum(Historique.quantite) as quantite',
																						'sum(Historique.montant) as montant',
																						'Historique.PU',
																						'Historique.type'
																						),
																			'conditions'=>$conditions,
																			'order'=>array('Historique.date'),
																			'group'=>array('Stock.id','Produit.id','Historique.PU','Historique.type'),
																			
																			)
																);
			foreach($historiques as	$historique){
				$total+=$historique['Historique']['montant'];
				$qty+=$historique['Historique']['quantite'];
			}
		}
		
		$this->set(compact('qty','historiques','date1','date2','total','grouper'));
		//for exporting to excel
		
		if(!empty($this->data['Historique']['xls'])&& ($this->data['Historique']['xls']==1)){
			$data=array();
			foreach($historiques as $key=>$historique){
				$data[$key]['Stock']=$historique['Stock']['name'];
				$data[$key]['Produit']=$historique['Produit']['name'];
				$data[$key]['Quantité']=$historique['Historique']['quantite'];
				$data[$key]['PU']=$historique['Historique']['PU'];
				$data[$key]['PT']=$historique['Historique']['montant'];
				$data[$key]['Type']=$historique['Historique']['type'];
			}
			$filename=$this->Product->excel($data,array(),'historiques');
			$this->redirect('/files/'.$filename);
		}	
	}
	
	
	function _logic(&$data,$action){
		//setting the alert variable need by eben ezer
		$alert=false;
		//validating first
		$this->Historique->set($data);
		if(!$this->Historique->validates()){
			$this->_error($action, 'Les champs Quantité & Date sont Obligatoires!');
		}
		if(($action=='edit')&&($this->Auth->user('id')!=$data['Historique']['personnel_id'])){
		//	exit(json_encode(array('success'=>false,'msg'=>'Seul le créateur peut effectuer la modification!')));	
		}
		if($data['Historique']['date']>date('Y-m-d')){
			$this->_error($action, 'Cette date est incorrecte!');	
		}
		$data['Historique']['montant']=$data['Historique']['quantite']*$data['Historique']['PU'];
		
		//updating the product with the new PU = PUMP
		$produitInfo=$this->Historique->Produit->find('first',array('fields'=>array('Produit.expiration',
																					'Produit.type',
																					'Produit.PV',
																					'Produit.PA'		
																					),
																	'conditions'=>array('id'=>$data['Historique']['produit_id']),
																	'recursive'=>-1));
																	
		$current_PU=($produitInfo['Produit']['PA']<=0)?$data['Historique']['PU']:$produitInfo['Produit']['PA'];
		$current_Qty= $this->Product->ProductQty($data['Historique']['produit_id']);
		$new_PU=(($current_Qty*$current_PU)+($data['Historique']['PU']*$data['Historique']['quantite']))/($current_Qty+$data['Historique']['quantite']);
		$data['Produit']['PA']=round($new_PU); 
		//finished updating the product's PA = PAMP
		
		//expiration field checking
		if(Configure::read('aser.pharmacie')){
			if($produitInfo['Produit']['expiration']&&($data['Historique']['date_expiration']==''))
				$this->_error($action, 'Ce produit exige une date d\'expiration!');
			
			else if(!$produitInfo['Produit']['expiration']&&($data['Historique']['date_expiration']!=''))
				$data['Historique']['date_expiration']=null;
			
		}
		if(!$this->Historique->save($data)){
				$this->_error($action, 'Failed to save the operation');
		}
		//Saving the product info that may have been changed like unite de mesure
		$this->Historique->Produit->save($data);
	}

	function _show($id,$alert=false){
		$historique=$this->Historique->find('first',array('fields'=>array(
    																				'Personnel.name','Personnel.id',
 																					'Produit.name','Produit.id','Produit.unite_id',
																					'Stock.name',
    																				'Historique.*'
    																				),
    																		'conditions'=>array('Historique.id'=>$id)
																			)
																);
		$this->set(compact('historique','alert'));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
				$this->_logic($this->data,'add');	
    		$this->_show($this->Historique->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Historique->find('first',array('fields'=>array('Historique.*','Produit.*'),
																		'conditions'=>array('Historique.id'=>$id),
																		));
				$this->data['Historique']['date_expiration']=($this->data['Historique']['date_expiration']=='0000-00-00')?'':$this->data['Historique']['date_expiration'];
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
				if($this->Historique->delete($id)){
						$deleted[]=$id;
				}
				else {
						$notDeleted++;	
				}
			}
		}
		$msg=($notDeleted>1)?"les":"l'";
		exit(json_encode(array('success'=>true,'deleted'=>$deleted,'notDeleted'=>$notDeleted,'msg'=>"Only the creator of the operqtion can delete the records.")));
	}

}
?>
