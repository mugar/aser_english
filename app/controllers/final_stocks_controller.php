<?php
class FinalStocksController extends AppController {

	var $name = 'FinalStocks';
	var $exits=array();
	
	function beforeFilter(){
		parent::beforeFilter();
		$exits=array('Vente'=>'Sale',
							'Sorti'=>'Consumption',
							'Perte'=>'Loss'
							);
		$exits1=array(''=>'')+$exits;
		$this->loadModel('Personnel');
		$waiters = $this->Personnel->find('list',array('conditions'=>array('Personnel.fonction_id'=>array(1,2))));
		$waiters1 = array(''=>'')+ $waiters;
		$this->set(compact('waiters','waiters1'));
		$this->exits = $exits;
		$this->set(compact('exits','exits1'));
	}
	
	

	
	function  _conditions($data){
		$conditions=array();
		$date1=$date2=null;
		if(!empty($data)) {
		
			if($data['Produit']['groupe_id']!=0) {
				$conditions['Produit.groupe_id']=$data['Produit']['groupe_id'];
			}
			else if($data['Produit']['section_id']!=0) {
				$conditions['Produit.groupe_id']=$this->FinalStock->Produit->Groupe->find('list',array('fields'=>array('Groupe.id','Groupe.id'),
																						'conditions'=>
																								array('Groupe.section_id'=>$data['Produit']['section_id'])
																						)
																			);
			}
			if($data['FinalStock']['stock_manager_id']!=0) {
				$conditions['FinalStock.stock_manager_id']=$data['FinalStock']['stock_manager_id'];
			}
				if($data['FinalStock']['produit_id']!=0) {
				$conditions['FinalStock.produit_id']=$data['FinalStock']['produit_id'];
			}
			if($this->data['FinalStock']['stock_id']!=0){
				$conditions['FinalStock.stock_id']=$data['FinalStock']['stock_id'];
			}
		 	if($data['FinalStock']['date1']!='') {
				$conditions['FinalStock.date >=']=$date1=$data['FinalStock']['date1'];
			}
		 	if($data['FinalStock']['date2']!='') {
		 		$conditions['FinalStock.date <=']=$date2=$data['FinalStock']['date2'];
			}
		}
		
		return array('conditions'=>$conditions,
					'date1'=>$date1,
					'date2'=>$date2,
					);
	}

	function _setExit(&$final_stock){
		foreach($this->exits as $key => $exit){
			$final_stock['FinalStock'][$key]=0;
		}


		foreach($final_stock['Historique'] as $historique){
			$final_stock['FinalStock'][$historique['libelle']]=$historique['quantite'];
		}
		return $final_stock;
	}

	function _setExits(&$final_stocks){
		// exit(debug($final_stocks));
		foreach($final_stocks as $key=>$final_stock){
			// exit(debug($this->_setExit($final_stock)));
			$final_stocks[$key]=$this->_setExit($final_stock);
		}

	}

	function create_consumption($id, $quantite, $type){
		$final_stock = $this->FinalStock->find('first',array('fields'=>array('FinalStock.*','Produit.PA'),
																												'conditions'=>array('FinalStock.id'=>$id)
																		));
		$current_total = 0;
		foreach($final_stock['Historique'] as $historique_row){
			if($type != $historique_row['libelle']){
				$current_total += $historique_row['quantite'];
			}
		}
	
		if (($current_total + $quantite) > $final_stock['FinalStock']['exit_quantite']){
			exit(json_encode(array('success'=>false, 'msg'=>'The quantity is above the limit')));
		}

		$this->FinalStock->Historique->deleteAll(array('Historique.final_stock_id'=>$id, 'Historique.libelle'=>$type));

			// exit(debug($current_total));
		if($quantite>0){
			$historique['id'] = null;
			$historique['final_stock_id'] = $id;
			$historique['stock_id'] = $final_stock['FinalStock']['stock_id'];
			$historique['produit_id'] = $final_stock['FinalStock']['produit_id'];
			$historique['produit_id'] = $final_stock['FinalStock']['produit_id'];
			$historique['PU'] = $final_stock['Produit']['PA'];
			$historique['quantite'] = $quantite;
			$historique['libelle'] = $type;
			$historique['date'] = $final_stock['FinalStock']['date'];
			$historique['personnel_id'] = $final_stock['FinalStock']['controler_id'];
			if($this->FinalStock->Historique->save(array("Historique"=>$historique))){
					exit(json_encode(array('success'=>true)));	
			}
			else {
				exit(json_encode(array('success'=>false, 'msg'=>'A saving error happened.')));
			}
		}
		else {
			exit(json_encode(array('success'=>true)));	
		}
	}

	function index() {
		$final_stockConditions=$this->Session->read('final_stockConditions');
		if((empty($this->data))&&(empty($final_stockConditions))) {
			$final_stocks =$this->paginate();
		}
		elseif(!empty($this->data)) {
		//building conditions
			$cond=$this-> _conditions($this->data);
			$final_stockConditions=$cond['conditions'];
			
			$final_stocks = $this->paginate($final_stockConditions);
			$this->Session->write('final_stockConditions',$final_stockConditions);
		}
		else {
			$final_stocks = $his->paginate($final_stockConditions);
		}
		// exit(debug($final_stocks));
		$this->_setExits($final_stocks);

		$this->set(compact('final_stocks'));
	}

	function rapport() {
		$cond=$this-> _conditions($this->data);
		$conditions=$cond['conditions'];
		$date1=$cond['date1'];
		$date2=$cond['date2'];
		$total=$qty=0;
		$grouper=true;
		$final_stocks=$group=array();
		if(!empty($this->data)){
			$final_stocks=$this->FinalStock->find('all',array('fields'=>array('Stock.name',
																						'Produit.name','Produit.unite_id',
																						'sum(FinalStock.quantite) as quantite',
																						'sum(FinalStock.montant) as montant',
																						'FinalStock.PA',
																						'FinalStock.type'
																						),
																			'conditions'=>$conditions,
																			'order'=>array('FinalStock.date'),
																			'group'=>array('Stock.id','Produit.id','FinalStock.PA','FinalStock.type'),
																			
																			)
																);
			foreach($final_stocks as	$final_stock){
				$total+=$final_stock['FinalStock']['montant'];
				$qty+=$final_stock['FinalStock']['quantite'];
			}
		}
		
		$this->set(compact('qty','final_stocks','date1','date2','total','grouper'));
		//for exporting to excel
		
		if(!empty($this->data['FinalStock']['xls'])&& ($this->data['FinalStock']['xls']==1)){
			$data=array();
			foreach($final_stocks as $key=>$final_stock){
				$data[$key]['Stock']=$final_stock['Stock']['name'];
				$data[$key]['Produit']=$final_stock['Produit']['name'];
				$data[$key]['Quantité']=$final_stock['FinalStock']['quantite'];
				$data[$key]['PA']=$final_stock['FinalStock']['PA'];
				$data[$key]['PT']=$final_stock['FinalStock']['montant'];
				$data[$key]['Type']=$final_stock['FinalStock']['type'];
			}
			$filename=$this->Product->excel($data,array(),'final_stocks');
			$this->redirect('/files/'.$filename);
		}	
	}
	
	
	function _logic(&$data,$action){
		//validating first
		$this->FinalStock->set($data);
		if(!$this->FinalStock->validates()){
			$this->_error($action, ' Quantity & Date are required!');
		}
		if(($action=='edit')&&($this->Auth->user('id')!=$data['FinalStock']['controler_id'])){
		//	exit(json_encode(array('success'=>false,'msg'=>'Seul le créateur peut effectuer la modification!')));	
		}
		if($data['FinalStock']['date']>date('Y-m-d')){
			$this->_error($action, 'this date is incorrect!');	
		}		
		//if called remotely from produits inventory. delete any previous record.
		if(isset($data['remote'])){
			$this->FinalStock->deleteAll(array('FinalStock.produit_id'=>$data['FinalStock']['produit_id'],
																				'FinalStock.stock_id'=>$data['FinalStock']['stock_id'],
																				'FinalStock.date'=>$data['FinalStock']['date']
																				)
																	);
		}

		if(isset($data['remote'])&&($data['FinalStock']['quantite'] < 0)){
			$data['FinalStock']['exit_quantite'] = 0;
		}
		else {
			//get yesterday last stock or initial stock
			// $yesterday = $this->Product->increase_date($data['FinalStock']['date']);
			$yesterday = $data['FinalStock']['date'];
			$stock_initiale = $this->Product->ProductQty($data['FinalStock']['produit_id'],$data['FinalStock']['stock_id'],array(),$yesterday);

			//get today entry
			$historiques = $this->FinalStock->Historique->find('all',array('fields'=>array('sum(Historique.quantite) as quantite'),
																									'conditions'=>array("Historique.produit_id"=>$data['FinalStock']['produit_id'],
																																		"Historique.stock_id"=>$data['FinalStock']['stock_id'],
																																		"Historique.date"=>$data['FinalStock']['date'],
																																		"Historique.libelle"=>'Entree',
																										)
																									));
			$stock_entry = (!empty($historiques[0]['Historique']['quantite'])) ? $historiques[0]['Historique']['quantite']:0;

			//set la difference ou exit quantity
			$data['FinalStock']['exit_quantite'] = $stock_initiale + $stock_entry - $data['FinalStock']['quantite'];
			$data['FinalStock']['controler_id'] = $this->Auth->user('id');
			$this->FinalStock->save($data);
		}
		return $data;
	}

	function _show($id){
		$final_stock=$this->FinalStock->find('first',array('fields'=>array(
    																				'StockManager.name','StockManager.id',
   																					'Controler.name','Controler.id',
 																					'Produit.name','Produit.id','Produit.unite_id',
																					'Stock.name',
    																				'FinalStock.*'
    																				),
    																		'conditions'=>array('FinalStock.id'=>$id)
																			)
																);
		$this->_setExit($final_stock);
		$this->set(compact('final_stock'));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$data=$this->_logic($this->data,'add');	
			if(isset($this->data['remote'])){
				exit(json_encode(array('success'=>true)+$data['FinalStock']));
			}
			else {
				$this->_show($this->FinalStock->id);	
			}
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->FinalStock->find('first',array('fields'=>array('FinalStock.*','Produit.*'),
																		'conditions'=>array('FinalStock.id'=>$id),
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
				if(true){
						$this->FinalStock->Historique->deleteAll(array('Historique.final_stock_id'=>$id));
						$this->FinalStock->delete($id);
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
