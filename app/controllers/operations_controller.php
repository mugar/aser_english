<?php
class OperationsController extends AppController {

	var $name = 'Operations';
	var $models=array('caisses'=>'accounts',
					'ventes'=>'deposits',
					'depenses'=>'expenses',
					);
					
	var $model1s=array('caisses'=>'accounts',
					'ventes'=>'deposit',
					
					);
	var $model2s=array('caisses'=>'accounts',
					'depenses'=>'expenses',
					);
	
	function beforeFilter(){
		parent::beforeFilter();
		if(in_array($this->params['action'],array('index','edit'))){
			$models=$this->models;
			$model1s=$this->model1s;
			$model2s=$this->model2s;
			$this->loadModel('Caiss');
			$list =$this->Caiss->find('list',array('conditions'=>array('Caiss.actif'=>'yes',
																'NOT'=>array('Caiss.id'=>$this->caissesInterdites)
																),
      												'order'=>array('Caiss.name asc')
																)
												);
			$choix=$list;
			$options=$models;
			$choix['']=$options['']='';
			$this->set(compact('models','model1s','model2s','list','options','choix'));
		}
	}
	
	function model($choix,$return='model'){
		$choix=strtolower($choix);
		switch($choix){
			case 'clients':
				$model='Client';
				$type='debit';
				break;
			case 'fournisseurs':
				$model='Client';
				$type='credit';
				break;
			case 'depenses':	
				$model='Type';
				$type='debit';
				break;
			case 'ventes':	
				$model='Type';
				$type='credit';
				break;
			case 'caisses':	
				$model='Caiss';
				$type='debit';
				break;
		}
		if($return=='model'){
			return $model;
		}
		else {
			return $type;
		}
	}
	
	function _set_common_field($data){
				$common = $data['Operation']['element1']
													.'_'.$this->model($data['Operation']['model1'])
													.'_'.$data['Operation']['element2']
													.'_'.$this->model($data['Operation']['model2']);
		return $common;
	}

	function _types($type){
		$this->loadModel('Type');
		return $this->Type->find('list',array('conditions'=>array('Type.type'=>$type,
    																	'Type.actif'=>'yes',
																		),
      												'order'=>array('Type.name asc')
																)
												);
	}

	function _caisses(){
		$list =$this->Caiss->find('list',array('conditions'=>array('Caiss.actif'=>'yes',
    																		'NOT'=>array('Caiss.id'=>$this->caissesInterdites)
																			),
      												'order'=>array('Caiss.name asc')
																)
												);
		return $list;
	}

	function autocomplete($index){
		$parts=explode(' : ',$this->data['Operation'][$index]);
		$elements=$this->Operation->Compte->find('all',array('fields'=>array('Compte.composer'),
																	'conditions'=>array('Compte.numero like'=>$parts[0].'%',
																						'Compte.actif'=>'yes',
																						),
																	'order'=>array('Compte.numero')
																));
		$this->set('elements',$elements);
		$this->layout='ajax';
	}
	
	function depenses(){
		$operations=array();
		$debit=0;
		$model='Type';
		$conditions=$cond=array();
		$conditions['Operation.model']=$model;
		$conditions['Operation.monnaie']=$monnaie='RWF';
		$conditions[$model.'.type']='depense';
		$conditions['Operation.common regexp']='(Caiss)';
		$conditions['Operation.date >=']=$date1=date('Y-m').'-01';
		$conditions['Operation.date <=']=$date2=date('Y-m').'-31';
		
		if(!empty($this->data)){
			if($this->data['Operation']['element_id']!=0){
				$cond[$model.'.id']=$conditions['Operation.element_id']=$this->data['Operation']['element_id'];
			}
			if($this->data['Operation']['date1']!=''){
				$conditions['Operation.date >=']=$date1=$this->data['Operation']['date1'];
			}
			if($this->data['Operation']['date2']!=''){
				$conditions['Operation.date <=']=$date2=$this->data['Operation']['date2'];
			}
			if($this->data['Operation']['mode_paiement']!=''){
				$conditions['Operation.mode_paiement']=$this->data['Operation']['mode_paiement'];
			}
			$conditions['Operation.monnaie']=$monnaie=$this->data['Operation']['monnaie'];
		}
	//	exit(debug($conditions));
		$operations=$this->Operation->find('all',array('conditions'=>$conditions,
													'fields'=>array('Operation.*',
																	'Type.name',
																	'Type.id',
																	'Operation.debit',
																	),
													'order'=>array('Operation.date asc'),
													));
		foreach($operations as $operation){
			$debit+=$operation['Operation']['debit'];
		}
		//	exit(debug($operations));
		$list=$this->Operation->$model->find('list',array('conditions'=>array('Type.type'=>'depense'),
														'order'=>array('Type.name')
														));
		$list[0]=' ';
		$this->set(compact('operations','date1','date2','debit','list','model','monnaie'));
	}

	function balance($element){
		$operations=array();
		$debit=$credit=$solde=$report=0;
		$model=$this->Product->model($element);
		$where=$this->Product->model($element,'where');
				
		$conditions=$cond=array();
		$conditions['Operation.model']=$model;
		$conditions['Operation.mode_paiement']=$mode_paiement='cash';
		$conditions['Operation.monnaie']=$monnaie='RWF';
		if($model!='Caiss'){
			$conditions[$model.'.type']=Inflector::singularize(strtolower($element));
		}
		
		$conditions['Operation.date >=']=$date1=date('Y-m').'-01';
		$conditions['Operation.date <=']=$date2=date('Y-m').'-31';
		
		if(!empty($this->data)){
			if($this->data['Operation']['element_id'][0]!=0){
				$cond[$model.'.id']=$this->data['Operation']['element_id'];
			}
			if($this->data['Operation']['date1']!=''){
				$conditions['Operation.date >=']=$date1=$this->data['Operation']['date1'];
			}
			if($this->data['Operation']['date2']!=''){
				$conditions['Operation.date <=']=$date2=$this->data['Operation']['date2'];
			}
			$conditions['Operation.monnaie']=$monnaie=$this->data['Operation']['monnaie'];
			$conditions['Operation.mode_paiement']=$mode_paiement=$this->data['Operation']['mode_paiement'];
		}
	
			
			if($model!='Caiss'){
				$cond[$model.'.type']=Inflector::singularize(strtolower($element));
			}
			else {
				$cond['Caiss.id']=$this->Product->caisses_permises();
			}
			$elements=$this->Operation->$model->find('all',array('fields'=>array($model.'.name',$model.'.id'),
																'conditions'=>$cond,
																'order'=>array($model.'.name')
																));
			
			foreach($elements as $key=>$compte){
				if(!is_null($date1)){
					$ants=$this->Operation->find('all',array('fields'=>array('sum(Operation.debit) as debit',
																			'sum(Operation.credit) as credit',
						                        							),
						                        				'conditions'=>array('Operation.element_id'=>$compte[$model]['id'],
						                        									'Operation.date <'=>$date1,
						                        									'Operation.model'=>$model,
						                        									'Operation.monnaie'=>$monnaie,
						                        									'Operation.mode_paiement'=>$mode_paiement
																					)
																	));
					$report+=$elements[$key]['report']=($where=='debit')?
													$ants[0]['Operation']['debit']-$ants[0]['Operation']['credit']:
													$ants[0]['Operation']['credit']-$ants[0]['Operation']['debit'];
				}
				else {
					$elements[$key]['report']=0;
				}
				$conditions['Operation.element_id']=$compte[$model]['id'];
	
				$operations=$this->Operation->find('all',array('conditions'=>$conditions,
																'fields'=>array('Operation.*',
																				'Caiss.name',
																				'Tier.name',
																				'Type.name',
																				'sum(Operation.debit) as debit',
																				'sum(Operation.credit) as credit',
																				),
																'order'=>array('Operation.date asc'),
																'group'=>array('Operation.element_id')
																));
				$debit+=$elements[$key]['debit']=(isset($operations[0]['Operation']['debit']))?$operations[0]['Operation']['debit']:0;
				$credit+=$elements[$key]['credit']=(isset($operations[0]['Operation']['credit']))?$operations[0]['Operation']['credit']:0;
				$diff=($where=='debit')?
					($elements[$key]['debit']-$elements[$key]['credit']):
					($elements[$key]['credit']-$elements[$key]['debit']);
				$solde+=$elements[$key]['solde']=$elements[$key]['report']+$diff;
			}
		//	exit(debug($elements));
			$cond=array();
			if($model!='Caiss'){
				$cond[$model.'.type']=Inflector::singularize(strtolower($element));
			}
			$list=$this->Operation->$model->find('list',array('conditions'=>$cond));
			$list[0]=' ';
			$element=ucfirst($element);
			$this->set(compact('mode_paiement','where','elements','date1','date2','debit','credit','solde','list','model','report','element','monnaie'));
	}
	
	function rapport($model=null,$id=null){
		if($model=='Caiss'){
			$caisses_permises = $this->Product->caisses_permises();
			if(!in_array($id, $caisses_permises)){
				$this->Session->setFlash('Vous n\'avez pas accès à cette caisse!');
				$this->redirect(array('action' => 'index'));
			}
		}			
		$operations=$ants=$elements=array();
		$debit=$credit=$solde=$report=0;
		$conditions=array();
		$conditions['Operation.monnaie']=$monnaie='RWF';
		$cond[$model.'.id']=$id;
		
		$conditions['Operation.date >=']=$date1=date('Y-m').'-01';
		$conditions['Operation.date <=']=$date2=date('Y-m').'-31';
		$conditions['Operation.model']=$model;
		$conditions['Operation.mode_paiement']=$mode_paiement='cash';
		
		if(!empty($this->data)){
			if($this->data['Operation']['date1']!=''){
				$conditions['Operation.date >=']=$date1=$this->data['Operation']['date1'];
			}
			if($this->data['Operation']['date2']!=''){
				$conditions['Operation.date <=']=$date2=$this->data['Operation']['date2'];
			}
			$conditions['Operation.monnaie']=$monnaie=$this->data['Operation']['monnaie'];
			$conditions['Operation.mode_paiement']=$mode_paiement=$this->data['Operation']['mode_paiement'];
		}

			$fields[]=$model.'.id';
			$fields[]=$model.'.name';
			if($model!='Caiss'){
				$fields[]=$model.'.type';
			}
			else {
				$fields[]=$model.'.monnaie';
			}
			$element=$this->Operation->$model->find('first',array('fields'=>$fields,
																'conditions'=>$cond));
			
				if($model!='Caiss'){
					$where=$this->Product->model(Inflector::pluralize($element[$model]['type']),'type');
				}
				else {
					$monnaie=$conditions['Operation.monnaie']=(!isset($this->data['Operation']['monnaie']))?
																$element[$model]['monnaie']:
																$this->data['Operation']['monnaie'];
					$where='debit';
				}
				if(!is_null($date1)){
					$ants=$this->Operation->find('all',array('fields'=>array('sum(Operation.debit) as debit',
																			'sum(Operation.credit) as credit',
						                        							),
						                        				'conditions'=>array(
						                        									'Operation.element_id'=>$element[$model]['id'],
						                        									'Operation.date <'=>$date1,
						                        									'Operation.model'=>$model,
						                        									'Operation.monnaie'=>$monnaie,
						                        									'Operation.mode_paiement'=>$mode_paiement
																					)
																	));
					$solde=$ants[0]['Operation']['solde']=($where=='debit')?
													$ants[0]['Operation']['debit']-$ants[0]['Operation']['credit']:
													$ants[0]['Operation']['credit']-$ants[0]['Operation']['debit'];
				}
				$conditions['Operation.element_id']=$id;
				
				$operations=$this->Operation->find('all',array('conditions'=>$conditions,
																'fields'=>array('Operation.*',
																					'Personnel.name',
																					'Caiss.name',
																					),
																	'order'=>array('Operation.date asc','Operation.id asc'),
																	));
				foreach($operations as $i=>$operation){
						$debit+=$operation['Operation']['debit'];	
						$credit+=$operation['Operation']['credit'];
						$solde=($where=='debit')?$solde+$operation['Operation']['debit']-$operation['Operation']['credit']:
								$solde+$operation['Operation']['credit']-$operation['Operation']['debit'];	
						$operations[$i]['Operation']['solde']=$solde;
				}
		$this->set(compact('element','solde','credit','debit','date1','date2','model','id','where','ants','monnaie','operations'));
		
		if(!empty($this->data['Operation']['xls'])&& ($this->data['Operation']['xls']==1)){
			$data=array();
			
			$data[0]['Date']=$this->Product->increase_date($date1,-1);
			$data[0]['Libélle']='Report';
			$data[0]['Débit']=$ants[0]['Operation']['debit'];
			$data[0]['Crédit']=$ants[0]['Operation']['credit'];
			$data[0]['Solde']=$ants[0]['Operation']['solde'];
			
			foreach($operations as $key=>$operation){
				$data[$key+1]['Date']=$operation['Operation']['date'];
				$data[$key+1]['Libélle']=$operation['Operation']['libelle'];
				$data[$key+1]['Débit']=$operation['Operation']['debit'];
				$data[$key+1]['Crédit']=$operation['Operation']['credit'];
				$data[$key+1]['Solde']=$operation['Operation']['solde'];
			}
			$filename=$this->Product->excel($data,array(),'historique_caisse');
			$this->redirect('/files/'.$filename);
		}	
	}
	
	
	
	function _group($operations){
		$new=array();
		$j=0;
		for($i=0;$i<count($operations); $i+=2){
			$new[$j]=$operations[$i];
			$new[$j]['Operation']['dest']=$operations[$i][$operations[$i]['Operation']['model']]['name'];
			$new[$j]['Operation']['dest_id']=$operations[$i]['Operation']['element_id'];
			$new[$j]['Operation']['dest_model']=$operations[$i]['Operation']['model'];
			$new[$j]['Operation']['src']=$operations[$i+1][$operations[$i+1]['Operation']['model']]['name'];
			$new[$j]['Operation']['src_id']=$operations[$i+1]['Operation']['element_id'];
			$new[$j]['Operation']['src_model']=$operations[$i+1]['Operation']['model'];
			if($new[$j]['Operation']['src_model']==$new[$j]['Operation']['dest_model']){
				$new[$j]['Operation']['caiss_id']=$new[$j]['Operation']['src_id'];	
			}
			else {
				$new[$j]['Operation']['caiss_id']=($new[$j]['Operation']['src_model']=='Caiss')?
													$new[$j]['Operation']['src_id']:
													$new[$j]['Operation']['dest_id'];
			}
			$j++;
		}
	//	exit(debug($new));
		return $new;
	}
	/**
	 * function to remove forbidden caisses
	 */
	function rmv_caisses_interdites($operations){
		$caisses_permises=$this->Product->caisses_permises();
		foreach($operations as $key=>$operation){
			if(!in_array($operation['Operation']['caiss_id'],$caisses_permises)){
				unset($operations[$key]);
			}
		}
		return $operations;
	}
	
	function index($mode='index') {
		$show=$this->Session->read('showCptOp');
		$operationConditions=$this->Session->read('operationConditions');
		if((empty($this->data))&&(empty($operationConditions))) {
			$operationConditions['Operation.auto']=0;
			
			$operations=$this->paginate($operationConditions);
			$operations=$this->_group($operations);
			$operations=$this->rmv_caisses_interdites($operations);
			$this->set('operations',$operations);
		}
		elseif(!empty($this->data)) {
		//building conditions
			$operationConditions=array();
		//	exit(debug($this->data));
			if($mode=='report'){
				$operationConditions['Operation.libelle']='Report';	
			}
			else {
				$operationConditions['Operation.libelle !=']='Report';	
			}
			if($this->data['Operation']['mode_paiement']!='') {
		 		$operationConditions['Operation.mode_paiement']=$this->data['Operation']['mode_paiement'];
			}
			if($this->data['Operation']['monnaie']!='') {
		 		$operationConditions['Operation.monnaie']=$this->data['Operation']['monnaie'];
			}
			if($this->data['Operation']['libelle']!='') {
		 		$operationConditions['Operation.libelle like']='%'.$this->data['Operation']['libelle'].'%';
			}
			if($this->data['Operation']['personnel_id']!=0) {
		 		$operationConditions['Operation.personnel_id']=$this->data['Operation']['personnel_id'];
			}
		 	if($this->data['Operation']['date1']!='') {
		 		$operationConditions['Operation.date >=']=$this->data['Operation']['date1'];
			}
		 	if($this->data['Operation']['date2']!='') {
		 		$operationConditions['Operation.date <=']=$this->data['Operation']['date2'];
			}
			if(($this->data['Operation']['model1']!='')&&($this->data['Operation']['element1']!='')) {
		 			$operationConditions['OR']=array(
		 										array('Operation.common regexp'=>'('.$this->data['Operation']['element1'].'_'.$this->Product->model($this->data['Operation']['model1']).'_)'),
												array('Operation.common regexp'=>'(_'.$this->data['Operation']['element1'].'_'.$this->Product->model($this->data['Operation']['model1']).')')
												);
			}
			if($this->data['Operation']['show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$this->data['Operation']['show'];
			}
			$operationConditions['Operation.id !=']=0; //to get the pagination always working
			$show['Operation.show']=$this->data['Operation']['show'];
			$operationConditions['Operation.auto']=0;
		//	exit(debug($operationConditions));
			$operations=$this->paginate($operationConditions);
			$operations=($mode!='report')?$this->_group($operations):$operations;
			$operations=$this->rmv_caisses_interdites($operations);
			$this->set('operations', $operations);
			$this->Session->write('operationConditions',$operationConditions);
			$this->Session->write('showCptOp',$show);
		}
		else {
			if($show['Operation.show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$show['Operation.show'];
			}
			if($mode=='report'){
				$operationConditions['Operation.libelle']='Report';	
			}
			else {
				$operationConditions['Operation.libelle !=']='Report';	
			}
			$operations=$this->paginate($operationConditions);
			$operations=($mode!='report')?$this->_group($operations):$operations;
			$operations=$this->rmv_caisses_interdites($operations);
			$this->set('operations', $operations);
		}
		$models=$this->models;
		$model1s=$this->model1s;
		$model2s=$this->model2s;
		$this->loadModel('Caiss');
		$list =$this->Caiss->find('list',array('conditions'=>array('Caiss.actif'=>'yes',
																'Caiss.id'=>$this->Product->caisses_permises()
																),
      												'order'=>array('Caiss.name asc')
																)
												);
		$caissiers =$this->Operation->Personnel->find('list',array('conditions'=>array('Personnel.actif'=>'yes',
																	'Personnel.fonction_id'=>2,
																	),
      												'order'=>array('Personnel.name asc'),
      												'fields'=>array('Personnel.id','Personnel.name'),
																)
												);
		$caissiers[0]='';
		$choix=array(''=>'')+$list;
		$options=array(''=>'')+$models;
		$this->set(compact('models','operations','model1s','model2s','list','mode','caissiers','options','choix'));
		
	}
	
	
	function journal($caissier,$date){
		$journals=$this->Operation->Journal->find('list',array('fields'=>array('Journal.id','Journal.numero'),
																			'conditions'=>array('Journal.personnel_id'=>$caissier,
																								'Journal.date'=>$date,
																								)
																			)
															);	
		$this->set(compact('journals'));
	}
	
	function update($no,$operation='') {
		
    	$operation =($operation=='')?($this->data['Operation']['model'.$no]):($operation);
		switch($operation){
			case 'clients':
				$this->loadModel('Tier');
      			$list =$this->Tier->find('list',array('conditions'=>array('Tier.type'=>'client',
      																	'Tier.actif'=>1
																			),
      													'order'=>array('Tier.name asc')
																		)
													);
				break;
			case 'fournisseurs':
				$this->loadModel('Tier');	
    			$list =$this->Tier->find('list',array('conditions'=>array('Tier.type'=>'fournisseur',
    																	'Tier.actif'=>1
																			),
      												'order'=>array('Tier.name asc')
																)
												);
				break;
			case 'depenses':	
				$this->loadModel('Type');	
    			$list =$this->Type->find('list',array('conditions'=>array('Type.type'=>'depense',
    																	'Type.actif'=>'yes',
																		),
      												'order'=>array('Type.name asc')
																)
												);
				break;
			case 'ventes':	
				$this->loadModel('Type');	
    			$list =$this->Type->find('list',array('conditions'=>array('Type.type'=>'vente',
    																	'Type.actif'=>'yes',
																		),
      												'order'=>array('Type.name asc')
																)
												);
				break;
			case 'caisses':	
				$this->loadModel('Caiss');	
    			$list =$this->Caiss->find('list',array('conditions'=>array('Caiss.actif'=>'yes',
    																	   'Caiss.id'=>$this->Product->caisses_permises()
																			),
      												'order'=>array('Caiss.name asc')
																)
												);
				break;
			default:
				$list=array();
				break;
		}
			
			if(!is_null($no)){
				$this->set(compact('list','no'));
			}
			else {
				return $list;
			}
			
  	}

	function bon($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'element operation'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Product->company_info();
		$search=$this->Operation->find('all',array(
													'order'=>array('Operation.id desc'),
													'conditions'=>array('Operation.op_num'=>$id),
													'fields'=>array('Operation.*',
																	'Type.name',
																	'Tier.name',
																	'Caiss.name',
																	'Personnel.name'
																	)				
														));
		if($search[1]['Operation']['model']=='Caiss'){
			$operation=$search[1];
			$operation['Operation']['beneficiaire']=$search[0][$search[0]['Operation']['model']]['name'];
			$label='Destination';
		}
		else if($search[0]['Operation']['model']=='Caiss') {
			$operation=$search[0];
			$operation['Operation']['beneficiaire']=$search[1][$search[1]['Operation']['model']]['name'];
			$label='Source';
		}
		$this->set(compact('operation','label'));
	}
	
	function _linker($detail,$op_num=null){
		if(is_array($detail)){
			$model=$detail['model'];
			$this->loadModel('Compte');
			$compte=$this->Compte->find('first',array('fields'=>array('Compte.id'),
													'conditions'=>array('Compte.numero'=>$detail['numero'])
											));
			$id=null;
			if(!empty($compte))	{						
				$detail['compte_id']=$compte['Compte']['id'];
				$detail['op_num']=$op_num;
				$detail['CompteOperation']=$detail;
				$this->Compte->CompteOperation->save($detail);
				$id=$this->Compte->CompteOperation->id;
				unset($this->Compte->CompteOperation->id);
			}
			return $id;
		}
		else {
			/*
			$info=$this->Operation->find('first',array('fields'=>array('Operation.compte_id'),
															'conditions'=>array('Operation.id'=>$detail)
													));	
			$this->loadModel('CompteOperation');
			$opInfo=$this->CompteOperation->find('first',array('fields'=>array('CompteOperation.op_num'),
													'conditions'=>array('CompteOperation.id'=>$info['Operation']['compte_id'])
												));
			if(is_null($opInfo['CompteOperation']['op_num'])){
				$this->CompteOperation->delete($info['Operation']['compte_id']);
			}
			else {
				$this->CompteOperation->deleteAll(array('CompteOperation.op_num'=>$opInfo['CompteOperation']['op_num'],
													'CompteOperation.op_num !='=>null,
													));
			}
			//*/
		}
	}

	function resultat(){
		$this->loadModel('Sorti');
		$date1=date('Y-m').'-01';
		$date2=date('Y-m-d');
		$devise['USD']=$taux=$this->Conf->find('taux_usd');
		
		if (!empty($this->data)) {
			$date1=$this->data['Operation']['date1'];
			$date2=($this->data['Operation']['date2']>date('Y-m-d'))?date('Y-m-d'):$this->data['Operation']['date2'];
			$devise['USD']=$taux=$this->data['Operation']['taux'];
		}
		$monnaie='RWF';
		$devise['RWF']=1;
		$conditions['Operation.date >=']=$date1;
		$conditions['Operation.date <=']=$date2;
		$conditions['Operation.model']='Type';

	
		// $this->loadModel('Facture');
		// $this->loadModel('Section');
		// $this->loadModel('Vente');
		
		// $factures=$this->Facture->find('all',array('fields'=>array('Facture.montant',
		// 															'Facture.operation',
		// 															'Facture.monnaie'
		// 															),
		// 											'conditions'=>array('Facture.Operation'=>array('Reservation','Service','Location'),
		// 															    'Facture.etat'=>array('paid','credit','half_paid','excedent'),
		// 																'Facture.monnaie !='=>'',
		// 																'OR'=>array(
		// 																		array('Facture.date >='=>$date1,'Facture.date <='=>$date2),
		// 																		array('Facture.id'=>$this->Product->factures($date1, $date2))
		// 																		)
		// 																),
		// 														));
		// $model['Reservation']=$model['Location']=$model['Service']=0;
		
		// foreach($factures as $facture){
		// 	if($facture['Facture']['operation']=='Reservation'){
		// 		$this->Product->extract_amount($facture,$date1,$date2);
		// 	}
		// 	$model[$facture['Facture']['operation']]+=$facture['Facture']['montant']*$devise[$facture['Facture']['monnaie']];	
		// }
		
		// $total_ventes=0;
		// if(Configure::read('aser.hotel'))										
		// 	$total_ventes+=$model['Reservation'];
		// if(Configure::read('aser.conference'))
		// 	$total_ventes+=$model['Location'];
		// if(Configure::read('aser.services'))
		// 	$total_ventes+=$model['Service'];
	
		// $sections=$this->Section->find('all',array('fields'=>array('Section.name','Section.id'),
		// 										));
		// foreach($sections as $j=>$section){
		// 	$groupes=$this->Section->Groupe->find('list',array('fields'=>array('Groupe.id','Groupe.id'),
		// 													'conditions'=>array('Groupe.section_id'=>$section['Section']['id'])
		// 										));
		// 	$ventes=$this->Vente->find('all',array('fields'=>array('Facture.reduction',
		// 															'sum(Vente.montant) as montant'
		// 															),
		// 												'conditions'=>array('Produit.groupe_id'=>$groupes, 
		// 																	'Facture.date >='=>$date1,
		// 															    	'Facture.date <='=>$date2,
		// 															    	'Facture.etat'=>array('paid','credit','half_paid','excedent'),
		// 															    	'Facture.monnaie !='=>''
		// 																	),
		// 												'group'=>array('Facture.id')
		// 											));
		// 	$total=0;										
		// 	foreach($ventes as $vente){
		// 		$total+=$vente['Vente']['montant']-($vente['Vente']['montant']*$vente['Facture']['reduction']/100);
		// 	}
		// 	$sections[$j]['Section']['montant']=$total;
		// 	$total_ventes+=$total;
		// }
		
		$deposits=$this->Operation->find('all',array('fields'=>array('Operation.*','sum(Operation.credit) as credit','Type.name'),
                                    'conditions'=>array(
                                    										'Operation.model'=>'Type',
                                    										'Operation.credit >'=>0,
                                    										'Operation.date >='=>$date1,
                                    										'Operation.date <='=>$date2,
                                    									),
                                    'group'=>array('Operation.element_id','Operation.monnaie'),
                                    'order'=>array('Type.name')
                                    )
                                  );
    $total_deposits=0;
    foreach($deposits as $dkey => $deposit){
    	$converted_amount = $deposit['Operation']['credit'] * $devise[$deposit['Operation']['monnaie']];
      $total_deposits+=$converted_amount;
      $deposits[$dkey]['Operation']['credit'] = $converted_amount;
    } 

		
		$depenses=$this->Operation->Type->find('all',array('fields'=>array('Type.name','Type.id','Type.categorie'),
													'order'=>array('Type.name'),
													'conditions'=>array('Type.type'=>'depense')
													));
		$total_depenses=0;
		$depenses_by_categories=array();
		foreach(Configure::read('categories') as $categorie => $cat_name){
			$depenses_by_categories[$categorie]['name']=$cat_name;
			$depenses_by_categories[$categorie]['montant']=0;
			$depenses_by_categories[$categorie]['depenses']=array();
		}

		foreach($depenses as $i=>$depense){
			$conditions['Operation.element_id']=$depense['Type']['id'];
			$sums=$this->Operation->find('all',array('fields'=>array('Type.name',
																	'sum(Operation.debit) as debit',
																	'Operation.monnaie'
																	),
													'conditions'=>$conditions,
													'group'=>array('Operation.monnaie')
												));
			foreach($sums as $sum){
				$montant=(isset($sum['Operation']['debit']))?$sum['Operation']['debit']:0;
				$converted_amount = $montant * $devise[$sum['Operation']['monnaie']];
				$depenses_by_categories[$depense['Type']['categorie']]['depenses'][$i]['montant']=$converted_amount;

				if($monnaie != $sum['Operation']['monnaie']){
					$custom_name = $depenses[$i]['Type']['name'].'<span class="small_highlight"> (converted from '.$sum['Operation']['monnaie'].')</span>';
					$depenses_by_categories[$depense['Type']['categorie']]['depenses'][$i]['name'] = $custom_name;
				}
				else {
					$depenses_by_categories[$depense['Type']['categorie']]['depenses'][$i]['name'] = $depense['Type']['name'];
				}
				
				$depenses_by_categories[$depense['Type']['categorie']]['montant']+=$converted_amount;
				$total_depenses+=$depenses[$i]['Type']['montant']=$converted_amount;
			}
		}
		
		// $sortis=$this->Sorti->find('all',array('fields'=>array('sum(Sorti.montant) as montant'),
		// 																		'conditions'=>array('Sorti.date >='=>$date1,
		// 																											'Sorti.date <='=>$date2
		// 																												)
		// 															));

		// $total_sortis = (!empty($sortis[0]))?$sortis[0]['Sorti']['montant']:0;
		// $depenses_by_categories[1]['montant']+=$total_sortis;

		// $marge_brute=$total_deposits - $depenses_by_categories[1]['montant'];
		// $marge_exploitation = $marge_brute - $depenses_by_categories[2]['montant'] - $depenses_by_categories[3]['montant'];
		$marge_net = $total_deposits - $total_depenses;

		$this->set(compact('total_depenses','model','sections','date1','date2','monnaie','total_ventes','taux','deposits','total_deposits',
												'marge_brute','marge_exploitation','marge_net','total_sortis','depenses_by_categories'
			));
	}
	
	function _show($ids){
		$operations=$this->Operation->find('all',array('conditions'=>array('Operation.id'=>$ids),
																		'fields'=>array('Operation.*',
																						'Caiss.id','Caiss.name',
																						'Tier.id','Tier.name',
																						'Type.id','Type.name',
																						'Personnel.id','Personnel.name'
																						)
																		));
			$mode=$this->data['Operation']['mode'];
			$operations=($mode!='report')?$this->_group($operations):$operations;
			$operation=$operations[0];
			$this->set(compact('operation','mode'));
			$this->render('quick_add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$ids=$this->Product->add_caisse_op($this->data);
			$this->_show($ids);
		}
	}
	
	function quick_edit($id = null) {
		
		
	if($id!=0){
	
		$this->data = $this->Operation->find('first',array('fields'=>array('Operation.*'),
															'recursive'=>-1,
															'conditions'=>array('Operation.id'=>$id)
													));
		$model1=$this->data['Operation']['model'];
		$el1=$this->data['Operation']['element_id'];
		$id1=$this->data['Operation']['id'];
		$fields[]=$model1.'.id';
		if($model1!='Caiss'){
			$fields[]=$model1.'.type';
		}
			
			$element1=$this->Operation->$model1->find('first',array('fields'=>$fields,
																'conditions'=>array($model1.'.id'=>$this->data['Operation']['element_id'])
																));
			
			if($model1!='Caiss'){
				$source1=Inflector::pluralize($element1[$model1]['type']);
			}
			else {
				$source1='caisses';
			}
			
		// deuxieme op
		$op2=$this->Operation->find('first',array('fields'=>array('Operation.*'),
												'conditions'=>array('Operation.op_num'=>$this->data['Operation']['op_num'],
																	'Operation.id !='=>$id,
																	)
																));
		$model2=$op2['Operation']['model'];
		$el2=$op2['Operation']['element_id'];
		$id2=$op2['Operation']['id'];
		unset($fields);
		
		$fields[]=$model2.'.id';
		if($model2!='Caiss'){
			$fields[]=$model2.'.type';
		}
			
			$element2=$this->Operation->$model2->find('first',array('fields'=>$fields,
																'conditions'=>array($model2.'.id'=>$op2['Operation']['element_id'])
																));
			
			if($model2!='Caiss'){
				$source2=Inflector::pluralize($element2[$model2]['type']);
			}
			else {
				$source2='caisses';
			}
		$models=$this->models;
		$model1s=$this->model1s;
		$model2s=$this->model2s;
		
		if($id1>$id2){
			
			$tmp=$source1;
			$source1=$source2;
			$source2=$tmp;
			
			$tmp=$el1;
			$el1=$el2;
			$el2=$tmp;
		}
		$this->data['Operation']['montant']=($this->data['Operation']['debit']!=null)?($this->data['Operation']['debit']):$this->data['Operation']['credit'];
		$list1=$this->update(null,$source1);
		$list2=$this->update(null,$source2);
		$mode='index';
		$this->set(compact('id1','id2','list1','list2','source1','source2','mode','el1','el2','model1s','model2s'));
		$this->layout='ajax';
	}
	else {
		$mode='index';
		$models=$this->models;
		$model1s=$this->model1s;
		$model2s=$this->model2s;
		$list=$this->update(null,'caisses');
		$this->set(compact('list','mode','model1s','model2s'));
		$this->render('edit_empty','ajax');
	}
	}

	function edit($op = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				if(!(($this->Auth->user('id')==$this->data['Operation']['personnel_id'])||($this->Auth->user('fonction_id')==3))){
					exit(json_encode(array('success'=>false,'msg'=>'Only the one who created this operation or an admin can edit it!')));
				}
			//	exit(debug($this->data));
				//set the common field used for search.
				$this->data['Operation']['common']=$this->_set_common_field($this->data);
				$ids=$this->Operation->find('all',array('fields'=>array('Operation.id','Operation.credit','Operation.debit'),
												'conditions'=>array('Operation.op_num'=>$this->data['Operation']['op_num']),
												'order'=>array('Operation.id asc')
												));
			//	exit(debug($ids));
				foreach($ids as $i=>$id){
				
					if($i==0){ 	//setting the element 1
						$this->data['Operation']['element_id']=$this->data['Operation']['element1'];	
						$this->data['Operation']['model']=$this->model($this->data['Operation']['model1']); //model to use
					}
					else { 	//setting the element 2
						$this->data['Operation']['element_id']=$this->data['Operation']['element2'];		
						$this->data['Operation']['model']=$this->model($this->data['Operation']['model2']); //model to use
					}
					$this->data['Operation']['debit']=($id['Operation']['debit']!=null)?($this->data['Operation']['montant']):null;
					$this->data['Operation']['credit']=($id['Operation']['credit']!=null)?($this->data['Operation']['montant']):null;
					$this->data['Operation']['id']=$id['Operation']['id'];
					$this->Operation->save($this->data);
				}
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistrée')));
			}
			else {
				$operations = $this->Operation->find('all',array('fields'=>array('Operation.*'
																																				),
																												'conditions'=>array('Operation.op_num'=>$op),
																						'order'=>array('Operation.id asc')
																						));
				if(count($operations)==2){
					$this->data = $operations[0];
					$this->data['Operation']['montant']=($this->data['Operation']['debit'])?$this->data['Operation']['debit']:$this->data['Operation']['credit'];
					if($operations[0]['Operation']['model']=='Caiss'){
						$selected_source = 'caisses';
						$elements1=$this->_caisses();
					}
					else {
						$selected_source ='ventes';
						$elements1 = $this->_types('vente');
					}
					$selected_element1=$operations[0]['Operation']['element_id'];

					if($operations[1]['Operation']['model']=='Caiss'){
						$selected_destination = 'caisses';
						$elements2=$this->_caisses();
					}
					else {
						$selected_destination ='depenses';
						$elements2 = $this->_types('depense');
					}
					$selected_element2=$operations[1]['Operation']['element_id'];

					$this->set(compact('selected_source','selected_destination','elements1','elements2','selected_element1','selected_element2'));

				}
				else {
						exit(json_encode(array('success'=>false,'msg'=>'Cette enregistrement est corrompu!')));		
				}

			}
		}
		else {
			$ids=$this->Operation->find('list',array('fields'=>array('Operation.id','Operation.id'),
												'conditions'=>array('Operation.op_num'=>$op),
												));
			$this->_show($ids);
		}
	}
//*quick_add
	function delete() {
		$notDeleted=0;
		$deleted=array();
	//	exit(debug($this->data));
		foreach($this->data['Id'] as $value){
			if($value!=0) {
				$search=$this->Operation->find('all',array('conditions'=>array('Operation.op_num'=>$value),
															'fields'=>array('Operation.personnel_id',
																			'Operation.op_num',
																			'Operation.libelle',
																			'Operation.id'
																			),
															'order'=>array('Operation.id desc')						
																			));
				
				if((($this->Auth->user('id')==$search[0]['Operation']['personnel_id'])||($this->Auth->user('fonction_id')==3))&&(count($search)==2)){
					$this->Operation->deleteAll(array('Operation.op_num'=>$value));
					$deleted[]=$value;	
					
				}
				else if(count($search)!=2) {
					$notDeleted++;
				}
				else {
					$notDeleted++;
				}
			}
		}
		
		$msg=($notDeleted>0)? 'Because only the one who created it or an admin can delete it.':'';
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>$msg
							)));
	}
//*/
	function mass_modification() {
		$this->autoRender=false;
		if (!empty($this->data)) {
			$i=0;

			foreach($this->data['Id'] as $op_num){
				if($op_num!=0) {
					$ids=$this->Operation->find('all',array('fields'=>array('Operation.*'),
												'conditions'=>array('Operation.op_num'=>$op_num),
												));
					foreach($ids as $id){
						if(($this->Auth->user('id')==$id['Operation']['personnel_id'])||($this->Auth->user('fonction_id')==3)){
							if($this->data['Operation']['mode_paiement']!=''){
								$id['Operation']['mode_paiement']=$this->data['Operation']['mode_paiement'];
							}
							if($this->data['Operation']['monnaie']!=''){
								$id['Operation']['monnaie']=$this->data['Operation']['monnaie'];
							}
							if($this->data['Operation']['date']!=''){
								$id['Operation']['date']=$this->data['Operation']['date'];
							}
							$this->Operation->save($id);
							unset($this->Operation->id);
							$i++;
						}	
					}
					
				}
			}
			$this->Session->setFlash($i.' opérations ont été modifiées');
			$this->redirect($this->referer());
		}
	}
}
?>
