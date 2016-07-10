<?php
class HistoriquesController extends AppController {

	var $name = 'Historiques';
	
	function beforeFilter(){
		parent::beforeFilter();
		$types=array('approvisionnement'=>'approvisionnement',
							'retour_en_stock'=>'retour_en_stock',
							'inventaire'=>'inventaire'
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
			$pa=$this->Historique->find('first',array('fields'=>array('Historique.PA'),
													'conditions'=>array('Historique.produit_id'=>$id),
													'order'=>array('Historique.date desc')
													));
			$pa=$produitInfo['Produit']['PA']=(!empty($pa))?$pa['Historique']['PA']:0;	
			$this->Historique->Produit->save($produitInfo);
		}
		else {
			$pa=$produitInfo['Produit']['PA'];
		}										
		if($this->RequestHandler->isAjax()){
				exit(json_encode(array('success'=>true,'PA'=>$pa)));
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
		$entreeConditions=$this->Session->read('entreeConditions');
		if((empty($this->data))&&(empty($entreeConditions))) {
			$this->set('entrees', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$cond=$this-> _conditions($this->data);
			$entreeConditions=$cond['conditions'];
			
			$this->set('entrees', $this->paginate($entreeConditions));
			$this->Session->write('entreeConditions',$entreeConditions);
		}
		else {
			$this->set('entrees', $this->paginate($entreeConditions));
		}
		//search the latest PA for the first displayed product
		$this->pa();
	}

	function rapport() {
		$cond=$this-> _conditions($this->data);
		$conditions=$cond['conditions'];
		$date1=$cond['date1'];
		$date2=$cond['date2'];
		$total=$qty=0;
		$grouper=true;
		$entrees=$group=array();
		if(!empty($this->data)){
			$entrees=$this->Historique->find('all',array('fields'=>array('Stock.name',
																						'Produit.name','Produit.unite_id',
																						'sum(Historique.quantite) as quantite',
																						'sum(Historique.montant) as montant',
																						'Historique.PA',
																						'Historique.type'
																						),
																			'conditions'=>$conditions,
																			'order'=>array('Historique.date'),
																			'group'=>array('Stock.id','Produit.id','Historique.PA','Historique.type'),
																			
																			)
																);
			foreach($entrees as	$entree){
				$total+=$entree['Historique']['montant'];
				$qty+=$entree['Historique']['quantite'];
			}
		}
		
		$this->set(compact('qty','entrees','date1','date2','total','grouper'));
		//for exporting to excel
		
		if(!empty($this->data['Historique']['xls'])&& ($this->data['Historique']['xls']==1)){
			$data=array();
			foreach($entrees as $key=>$entree){
				$data[$key]['Stock']=$entree['Stock']['name'];
				$data[$key]['Produit']=$entree['Produit']['name'];
				$data[$key]['Quantité']=$entree['Historique']['quantite'];
				$data[$key]['PA']=$entree['Historique']['PA'];
				$data[$key]['PT']=$entree['Historique']['montant'];
				$data[$key]['Type']=$entree['Historique']['type'];
			}
			$filename=$this->Product->excel($data,array(),'entrees');
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
		$data['Historique']['montant']=$data['Historique']['quantite']*$data['Historique']['PA'];
		
		//updating the product with the new PA = PAMP
		$produitInfo=$this->Historique->Produit->find('first',array('fields'=>array('Produit.expiration',
																					'Produit.type',
																					'Produit.PV',
																					'Produit.PA'		
																					),
																	'conditions'=>array('id'=>$data['Historique']['produit_id']),
																	'recursive'=>-1));
																	
		$current_PA=($produitInfo['Produit']['PA']<=0)?$data['Historique']['PA']:$produitInfo['Produit']['PA'];
		$current_Qty= $this->Product->ProductQty($data['Historique']['produit_id']);
		$new_PA=(($current_Qty*$current_PA)+($data['Historique']['PA']*$data['Historique']['quantite']))/($current_Qty+$data['Historique']['quantite']);
		$data['Produit']['PA']=round($new_PA); 
		//finished updating the product's PA = PAMP
		
		//expiration field checking
		if(Configure::read('aser.pharmacie')){
			if($produitInfo['Produit']['expiration']&&($data['Historique']['date_expiration']==''))
				$this->_error($action, 'Ce produit exige une date d\'expiration!');
			
			else if(!$produitInfo['Produit']['expiration']&&($data['Historique']['date_expiration']!=''))
				$data['Historique']['date_expiration']=null;
			
			//eben ezer specific logic
			if(Configure::read('aser.ebenezer')&&($action=='add')&&($data['Historique']['PV']!=0)){
				if($produitInfo['Produit']['PV']!=$data['Historique']['PV']){
					$alert=true;
				}
			}
		}
		else {
			$produitInfo=array();
		}
		//Increasing the stock level
		$return=$this->Product->stock($data,'debit',$produitInfo);
		//checking the return status
	//	exit(debug($return));
		if($return['success']){
			//Saving the entree of goods
		//	exit(debug($data));
			if(!$this->Historique->save($data)){
				$this->loadModel('Historique');
				$this->Historique->delete($data['Historique']['historique_id']);
				$this->_error($action, 'entree probleme');
			}
			//Saving the product info that may have been changed like unite de mesure
			$this->Historique->Produit->save($data);
		}
		else {
			$this->_error($action, $return['msg']);
		}
		
		return $alert;
	}

	function _show($id,$alert=false){
		$entree=$this->Historique->find('first',array('fields'=>array(
    																				'Personnel.name','Personnel.id',
   																					'Tier.name','Tier.id',
 																					'Produit.name','Produit.id','Produit.unite_id',
																					'Stock.name',
    																				'Historique.*'
    																				),
    																		'conditions'=>array('Historique.id'=>$id)
																			)
																);
		$this->set(compact('entree','alert'));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$alert=$this->_logic($this->data,'add');	
    		$this->_show($this->Historique->id,$alert);
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
				
				$appro=$this->Historique->find('first',array('fields'=>array('Historique.historique_id',
																		'Historique.personnel_id'),
																		'conditions'=>array('Historique.id'=>$id)
																));
				if(true){
					if($this->Product->productHistoryDelete($appro['Historique']['historique_id'],'Historique')){
						$this->Historique->delete($id);
						$deleted[]=$id;
					}
					else {
						$notDeleted++;	
					}
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
