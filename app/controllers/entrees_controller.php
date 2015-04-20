<?php
class EntreesController extends AppController {

	var $name = 'Entrees';
	
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
		$produitInfo=$this->Entree->Produit->find('first',array('fields'=>array('Produit.PA','Produit.id'),
													'conditions'=>array('Produit.id'=>$id),
													));
		if($produitInfo['Produit']['PA']==0){
			$pa=$this->Entree->find('first',array('fields'=>array('Entree.PA'),
													'conditions'=>array('Entree.produit_id'=>$id),
													'order'=>array('Entree.date desc')
													));
			$pa=$produitInfo['Produit']['PA']=(!empty($pa))?$pa['Entree']['PA']:0;	
			$this->Entree->Produit->save($produitInfo);
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
			if($data['Entree']['type']!='') {
				$conditions['Entree.type']=$data['Entree']['type'];
			}
			if($data['Entree']['produit_id']!=0) {
				$conditions['Entree.produit_id']=$data['Entree']['produit_id'];
			}
			if($data['Produit']['groupe_id']!=0) {
				$conditions['Produit.groupe_id']=$data['Produit']['groupe_id'];
			}
			else if($data['Produit']['section_id']!=0) {
				$conditions['Produit.groupe_id']=$this->Entree->Produit->Groupe->find('list',array('fields'=>array('Groupe.id','Groupe.id'),
																						'conditions'=>
																								array('Groupe.section_id'=>$data['Produit']['section_id'])
																						)
																			);
			}
			if($data['Entree']['tier_id']!=0) {
				$conditions['Entree.tier_id']=$data['Entree']['tier_id'];
			}
			if($this->data['Entree']['stock_id']!=0){
				$conditions['Entree.stock_id']=$data['Entree']['stock_id'];
			}
		 	if($data['Entree']['date1']!='') {
				$conditions['Entree.date >=']=$date1=$data['Entree']['date1'];
			}
		 	if($data['Entree']['date2']!='') {
		 		$conditions['Entree.date <=']=$date2=$data['Entree']['date2'];
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
			$entrees=$this->Entree->find('all',array('fields'=>array('Stock.name',
																						'Produit.name','Produit.unite_id',
																						'sum(Entree.quantite) as quantite',
																						'sum(Entree.montant) as montant',
																						'Entree.PA',
																						'Entree.type'
																						),
																			'conditions'=>$conditions,
																			'order'=>array('Entree.date'),
																			'group'=>array('Stock.id','Produit.id','Entree.PA','Entree.type'),
																			
																			)
																);
			foreach($entrees as	$entree){
				$total+=$entree['Entree']['montant'];
				$qty+=$entree['Entree']['quantite'];
			}
		}
		
		$this->set(compact('qty','entrees','date1','date2','total','grouper'));
		//for exporting to excel
		
		if(!empty($this->data['Entree']['xls'])&& ($this->data['Entree']['xls']==1)){
			$data=array();
			foreach($entrees as $key=>$entree){
				$data[$key]['Stock']=$entree['Stock']['name'];
				$data[$key]['Produit']=$entree['Produit']['name'];
				$data[$key]['Quantité']=$entree['Entree']['quantite'];
				$data[$key]['PA']=$entree['Entree']['PA'];
				$data[$key]['PT']=$entree['Entree']['montant'];
				$data[$key]['Type']=$entree['Entree']['type'];
			}
			$filename=$this->Product->excel($data,array(),'entrees');
			$this->redirect('/files/'.$filename);
		}	
	}
	
	
	function _logic(&$data,$action){
		//setting the alert variable need by eben ezer
		$alert=false;
		//validating first
		$this->Entree->set($data);
		if(!$this->Entree->validates()){
			$this->_error($action, 'Les champs Quantité & Date sont Obligatoires!');
		}
		if(($action=='edit')&&($this->Auth->user('id')!=$data['Entree']['personnel_id'])){
		//	exit(json_encode(array('success'=>false,'msg'=>'Seul le créateur peut effectuer la modification!')));	
		}
		if($data['Entree']['date']>date('Y-m-d')){
			$this->_error($action, 'Cette date est incorrecte!');	
		}
		$data['Entree']['montant']=$data['Entree']['quantite']*$data['Entree']['PA'];
		
		//updating the product with the new PA = PAMP
		$produitInfo=$this->Entree->Produit->find('first',array('fields'=>array('Produit.expiration',
																					'Produit.type',
																					'Produit.PV',
																					'Produit.PA'		
																					),
																	'conditions'=>array('id'=>$data['Entree']['produit_id']),
																	'recursive'=>-1));
																	
		$current_PA=($produitInfo['Produit']['PA']<=0)?$data['Entree']['PA']:$produitInfo['Produit']['PA'];
		$current_Qty= $this->Product->ProductQty($data['Entree']['produit_id']);
		$new_PA=(($current_Qty*$current_PA)+($data['Entree']['PA']*$data['Entree']['quantite']))/($current_Qty+$data['Entree']['quantite']);
		$data['Produit']['PA']=round($new_PA); 
		//finished updating the product's PA = PAMP
		
		//expiration field checking
		if(Configure::read('aser.pharmacie')){
			if($produitInfo['Produit']['expiration']&&($data['Entree']['date_expiration']==''))
				$this->_error($action, 'Ce produit exige une date d\'expiration!');
			
			else if(!$produitInfo['Produit']['expiration']&&($data['Entree']['date_expiration']!=''))
				$data['Entree']['date_expiration']=null;
			
			//eben ezer specific logic
			if(Configure::read('aser.ebenezer')&&($action=='add')&&($data['Entree']['PV']!=0)){
				if($produitInfo['Produit']['PV']!=$data['Entree']['PV']){
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
			if(!$this->Entree->save($data)){
				$this->loadModel('Historique');
				$this->Historique->delete($data['Entree']['historique_id']);
				$this->_error($action, 'entree probleme');
			}

			
			//Saving the product info that may have been changed like unite de mesure
			$this->Entree->Produit->save($data);
		}
		else {
			$this->_error($action, $return['msg']);
		}
		
		return $alert;
	}

	function _show($id,$alert=false){
		$entree=$this->Entree->find('first',array('fields'=>array(
    																				'Personnel.name','Personnel.id',
   																					'Tier.name','Tier.id',
 																					'Produit.name','Produit.id','Produit.unite_id',
																					'Stock.name',
    																				'Entree.*'
    																				),
    																		'conditions'=>array('Entree.id'=>$id)
																			)
																);
		$this->set(compact('entree','alert'));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$alert=$this->_logic($this->data,'add');	
    		$this->_show($this->Entree->id,$alert);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Entree->find('first',array('fields'=>array('Entree.*','Produit.*'),
																		'conditions'=>array('Entree.id'=>$id),
																		));
				$this->data['Entree']['date_expiration']=($this->data['Entree']['date_expiration']=='0000-00-00')?'':$this->data['Entree']['date_expiration'];
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
				
				$appro=$this->Entree->find('first',array('fields'=>array('Entree.historique_id',
																		'Entree.personnel_id'),
																		'conditions'=>array('Entree.id'=>$id)
																));
				if(true){
					if($this->Product->productHistoryDelete($appro['Entree']['historique_id'],'Historique')){
						$this->Entree->delete($id);
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
