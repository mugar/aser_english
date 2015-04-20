<?php
class CompteOperationsController extends AppController {

	var $name = 'CompteOperations';
	var $charges=array(60=>'COUT DE STOCK VENDU',
					61=>'MATIERES & FOURNITURES CONSOMMEES',
					62 =>'TRANSPORTS  CONSOMMES',
					63 =>'AUTRES SERVICES CONSOMMES',
					64 =>'CHARGE & PERTES DIVERSES',
					65 =>'FRAIS DE PERSONNEL',
					66 =>'IMPOTS & TAXES',
					67 =>'INTERETS PAYÉS',
					68 =>'DOTATIONS AUX AMORTISSEMENTS & PROVISIONS'
					);
					
	var $produits=array(70=>'VENTES',
					71 =>'HEBERGEMENT',
					77 =>'INTERETS RECUS',
					);
					
	function charges($return=false){
		$comptes=array();
		$date1=$date2=null;
		$conditions=array();
		if(!empty($this->data)){
			if($this->data['CompteOperation']['date1']!=''){
				$conditions['CompteOperation.date >=']=$date1=$this->data['CompteOperation']['date1'];
			}
			if($this->data['CompteOperation']['date2']!=''){
				$conditions['CompteOperation.date <=']=$date2=$this->data['CompteOperation']['date2'];
			}
		}
		else {
		//	$conditions['CompteOperation.date >=']=$date1=date('y-m-').'01';;
		//	$conditions['CompteOperation.date <=']=$date2=date('y-m-').'31';
		}
		$charges=array();
		$total=0;	
		foreach($this->charges as $no=>$name){
			$begin=$no*1000000;
			$end=($no+1)*1000000;
			$cond['Compte.numero >=']=$begin;
			$cond['Compte.numero <']=$end;
			$charges[$no]['name']=$name;
			
			$debit=$credit=$solde=$report=0;
			$comptes=$this->CompteOperation->Compte->find('all',array('fields'=>array(
																					'Compte.name',
																					'Compte.numero'
																					),
																	'conditions'=>$cond));
			foreach($comptes as $key=>$compte){
				
				$conditions['CompteOperation.compte_id']=$compte['Compte']['id'];
				
				$operations=$this->CompteOperation->find('all',array('conditions'=>$conditions,
																	'fields'=>array(
																					'Compte.*',
																					'sum(CompteOperation.debit) as debit',
																					'sum(CompteOperation.credit) as credit',
																					),
																	'order'=>array('CompteOperation.date asc'),
																	'group'=>array('CompteOperation.compte_id')
																	));
				$debit+=$comptes[$key]['debit']=(isset($operations[0]['CompteOperation']['debit']))?$operations[0]['CompteOperation']['debit']:0;
				$credit+=$comptes[$key]['credit']=(isset($operations[0]['CompteOperation']['credit']))?$operations[0]['CompteOperation']['credit']:0;
				$solde+=$comptes[$key]['solde']=$comptes[$key]['debit']-$comptes[$key]['credit'];
				$charges[$no]['details'][$key]['numero']=$compte['Compte']['numero'];
				$charges[$no]['details'][$key]['name']=$compte['Compte']['name'];
				$charges[$no]['details'][$key]['solde']=$comptes[$key]['solde'];
			}
			$total+=$charges[$no]['solde']=$solde;
		}
		if($return){
			return $charges;
		}
		else {
			$this->set(compact('charges','date1','date2','total'));
		}
	}
			
	function compte_gestion(){
		$comptes=array();
		$date1=$date2=null;
		$conditions=array();
		if(!empty($this->data)){
			if($this->data['CompteOperation']['date1']!=''){
				$conditions['CompteOperation.date >=']=$date1=$this->data['CompteOperation']['date1'];
			}
			if($this->data['CompteOperation']['date2']!=''){
				$conditions['CompteOperation.date <=']=$date2=$this->data['CompteOperation']['date2'];
			}
		}
		else {
		//	$conditions['CompteOperation.date >=']=$date1=date('y-m-').'01';;
		//	$conditions['CompteOperation.date <=']=$date2=date('y-m-').'31';
		}
		$charges=$this->charges(true);
		$produits=array();	
		foreach($this->produits as $no=>$name){
			$begin=$no*1000000;
			$end=($no+1)*1000000;
			$cond['Compte.numero >=']=$begin;
			$cond['Compte.numero <']=$end;
			$produits[$no]['name']=$name;
			
			$debit=$credit=$solde=$report=0;
			$comptes=$this->CompteOperation->Compte->find('all',array('fields'=>array(
																					'Compte.name',
																					'Compte.numero'
																					),
																	'conditions'=>$cond));
			foreach($comptes as $key=>$compte){
				
				$conditions['CompteOperation.compte_id']=$compte['Compte']['id'];
				
				$operations=$this->CompteOperation->find('all',array('conditions'=>$conditions,
																	'fields'=>array(
																					'Compte.*',
																					'sum(CompteOperation.debit) as debit',
																					'sum(CompteOperation.credit) as credit',
																					),
																	'order'=>array('CompteOperation.date asc'),
																	'group'=>array('CompteOperation.compte_id')
																	));
				$debit+=$comptes[$key]['debit']=(isset($operations[0]['CompteOperation']['debit']))?$operations[0]['CompteOperation']['debit']:0;
				$credit+=$comptes[$key]['credit']=(isset($operations[0]['CompteOperation']['credit']))?$operations[0]['CompteOperation']['credit']:0;
				$solde+=$comptes[$key]['solde']=$comptes[$key]['credit']-$comptes[$key]['debit'];
				$produits[$no]['details'][$key]['name']=$compte['Compte']['name'];
				$produits[$no]['details'][$key]['solde']=$comptes[$key]['solde'];
			}
			$produits[$no]['solde']=$solde;
		}
		$resultat[80]['name']='MARGE BRUTE';
		$resultat[80]['solde']=$produits[70]['solde']-$charges[60]['solde'];
		
		$resultat[81]['name']='VALEUR AJOUTEE';
		$resultat[81]['solde']=($resultat[80]['solde']+$produits[77]['solde'])-
							($charges[61]['solde']
							+$charges[62]['solde']
							+$charges[63]['solde']
							);
		
		$resultat[82]['name']='RESULTAT D\'EXPLOITATION';
		$resultat[82]['solde']=$resultat[81]['solde']-
							($charges[64]['solde']
							+$charges[65]['solde']
							+$charges[66]['solde']
							+$charges[67]['solde']
							+$charges[68]['solde']
							);
		$impot=($resultat[82]['solde']*35/100);
		$resultat[83]['name']='RESULTAT NET';
		$resultat[83]['solde']=$resultat[82]['solde']-$impot;					
		$this->set(compact('resultat','charges','date1','date2','produits','impot'));
	}
	
	function op_num($i=1){
		$last=$this->CompteOperation->find('first',array('order'=>array('CompteOperation.id desc'),
													'recursive'=>-1,
													'fields'=>array('CompteOperation.op_num'),
													'conditions'=>array('CompteOperation.op_num !='=>0),
													)
										);
			if(!empty($last)){
				return $last['CompteOperation']['op_num']+$i;
			}
			else return 1;
	}
	
	function autocomplete($index){
		$parts=explode(' : ',$this->data['CompteOperation'][$index]);
		$comptes=$this->CompteOperation->Compte->find('all',array('fields'=>array('Compte.composer'),
																	'conditions'=>array('Compte.numero like'=>$parts[0].'%',
																						'Compte.actif'=>'oui',
																						),
																	'order'=>array('Compte.numero')
																));
		$this->set('comptes',$comptes);
		$this->layout='ajax';
	}
	
	function balance(){
		$comptes=array();
		$debit=$credit=$solde=$report=0;
		$date1=$date2=null;
		if(!empty($this->data)){
			$conditions=array();
			if($this->data['CompteOperation']['choix']!=''){
				switch($this->data['CompteOperation']['choix']){
					case 'caisses':
						$cond['Compte.numero >=']=56000000;
						$cond['Compte.numero <']=58000000;
						break;
					case 'clients':
						$cond['Compte.numero >=']=41000000;
						$cond['Compte.numero <']=42000000;
						break;
					case 'fournisseurs':
						$cond['Compte.numero >=']=40000000;
						$cond['Compte.numero <']=41000000;
						break;
					case 'ventes':
						$cond['Compte.numero >=']=70000000;
						$cond['Compte.numero <']=8000000;
						break;
					case 'depenses':
						$cond['Compte.numero >=']=60000000;
						$cond['Compte.numero <']=70000000;
						break;
				}
			}
			else {
				if($this->data['CompteOperation']['compte1']!=''){
					$parts=explode(' : ',$this->data['CompteOperation']['compte1']);
					$cond['Compte.numero >=']=$parts[0];
				}
				if($this->data['CompteOperation']['compte2']!=''){
					$parts=explode(' : ',$this->data['CompteOperation']['compte2']);
					$cond['Compte.numero <=']=$parts[0];
				}
			}
			if($this->data['CompteOperation']['date1']!=''){
				$conditions['CompteOperation.date >=']=$date1=$this->data['CompteOperation']['date1'];
			}
			if($this->data['CompteOperation']['date2']!=''){
				$conditions['CompteOperation.date <=']=$date2=$this->data['CompteOperation']['date2'];
			}

			$comptes=$this->CompteOperation->Compte->find('all',array('fields'=>array(
																					'Compte.name',
																					'Compte.numero'
																					),
																	'conditions'=>$cond));
			foreach($comptes as $key=>$compte){
				if(!is_null($date1)){
					$ants=$this->CompteOperation->find('all',array('fields'=>array('sum(CompteOperation.debit) as debit',
																				'sum(CompteOperation.credit) as credit',
						                        								),
						                        				'conditions'=>array('CompteOperation.compte_id'=>$compte['Compte']['id'],
						                        									'CompteOperation.date <'=>$date1,
																					)
																	));
					$report+=$comptes[$key]['report']=$ants[0]['CompteOperation']['debit']-$ants[0]['CompteOperation']['credit'];
				}
				else {
					$report+=$comptes[$key]['report']=0;
				}
				$conditions['CompteOperation.compte_id']=$compte['Compte']['id'];
				
				$operations=$this->CompteOperation->find('all',array('conditions'=>$conditions,
																	'fields'=>array(
																					'Compte.*',
																					'Personnel.name',
																					'sum(CompteOperation.debit) as debit',
																					'sum(CompteOperation.credit) as credit',
																					),
																	'order'=>array('CompteOperation.date asc'),
																	'group'=>array('CompteOperation.compte_id')
																	));
				$debit+=$comptes[$key]['debit']=(isset($operations[0]['CompteOperation']['debit']))?$operations[0]['CompteOperation']['debit']:0;
				$credit+=$comptes[$key]['credit']=(isset($operations[0]['CompteOperation']['credit']))?$operations[0]['CompteOperation']['credit']:0;
				$solde+=$comptes[$key]['solde']=$comptes[$key]['report']+$comptes[$key]['debit']-$comptes[$key]['credit'];
			}
		}
		$this->set(compact('comptes','operations','date1','date2','debit','credit','solde','report'));
	}
	
	function rapport($id=null){
		$operations=$ants=$comptes=$cond=array();
		$date1=$date2=null;
		$goOn=false;
		if($id!=null){
			$cond['Compte.id']=$id;
			$goOn=true;
		}
		elseif(!empty($this->data)){
			$conditions=array();
			
			if($this->data['CompteOperation']['compte1']!=''){
				$parts=explode(' : ',$this->data['CompteOperation']['compte1']);
				$cond['Compte.numero >=']=$parts[0];
			}
			if($this->data['CompteOperation']['compte2']!=''){
				$parts=explode(' : ',$this->data['CompteOperation']['compte2']);
				$cond['Compte.numero <=']=$parts[0];
			}
			if($this->data['CompteOperation']['compte_id']!=0){
				$cond['Compte.id']=$this->data['CompteOperation']['compte_id'];
			}
			if($this->data['CompteOperation']['date1']!=''){
				$conditions['CompteOperation.date >=']=$date1=$this->data['CompteOperation']['date1'];
			}
			if($this->data['CompteOperation']['date2']!=''){
				$conditions['CompteOperation.date <=']=$date2=$this->data['CompteOperation']['date2'];
			}
			$goOn=true;
		}
		if($goOn){
			$comptes=$this->CompteOperation->Compte->find('all',array('fields'=>array(
																					'Compte.*',
																					),
																	'conditions'=>$cond));
			foreach($comptes as $key=>$compte){
				$debit=$credit=$solde=$report=0;
				if(!is_null($date1)){
					$ants=$this->CompteOperation->find('all',array('fields'=>array('sum(CompteOperation.debit) as debit',
																				'sum(CompteOperation.credit) as credit',
						                        								),
						                        				'conditions'=>array('CompteOperation.compte_id'=>$compte['Compte']['id'],
						                        									'CompteOperation.date <'=>$date1,
																					)
																	));
					$solde=$ants[0]['CompteOperation']['solde']=$ants[0]['CompteOperation']['debit']-$ants[0]['CompteOperation']['credit'];
					$comptes[$key]['ants']=$ants;
				}
				$conditions['CompteOperation.compte_id']=$compte['Compte']['id'];
				
				$operations=$this->CompteOperation->find('all',array('conditions'=>$conditions,
																'fields'=>array('CompteOperation.*',
																					'Personnel.name'
																					),
																	'order'=>array('CompteOperation.date asc')
																	));
				foreach($operations as $i=>$operation){
					$debit+=$operation['CompteOperation']['debit'];	
					$credit+=$operation['CompteOperation']['credit'];
					$solde=$operations[$i]['CompteOperation']['solde']=$solde+$operation['CompteOperation']['debit']-$operation['CompteOperation']['credit'];	
				}
				
				$comptes[$key]['op']=$operations;
				$comptes[$key]['debit']=$debit;
				$comptes[$key]['credit']=$credit;
				$comptes[$key]['solde']=$solde;
			//	exit(debug($comptes));
			}
		}
		$list=$this->CompteOperation->Compte->find('list',array('order'=>array('Compte.name')));
		$list[0]='';
		$this->set(compact('comptes','date1','date2','list'));
	}
	function index($mode='index') {
		$date1=date('Y-m').'-01';
		$date2=date('Y-m').'-31';
		
		$show=$this->Session->read('showCptOp');
		$compteOperationConditions=$this->Session->read('compteOperationConditions');
		if((empty($this->data))&&(empty($compteOperationConditions))) {
			$compteOperationConditions['CompteOperation.journal']=0;
			$compteOperationConditions['CompteOperation.date >=']=$date1;
			$compteOperationConditions['CompteOperation.date <=']=$date2;
			
			$this->set('compteOperations', $this->paginate($compteOperationConditions));
		}
		elseif(!empty($this->data)) {
		//building conditions
			$date1=
			$compteOperationConditions=array();
			$compteOperationConditions['CompteOperation.journal']=$this->data['CompteOperation']['journal'];
		 	
		 	if($this->data['CompteOperation']['date1']!='') {
		 		$compteOperationConditions['CompteOperation.date >=']=$date1=$this->data['CompteOperation']['date1'];
			}
		 	if($this->data['CompteOperation']['date2']!='') {
		 		$compteOperationConditions['CompteOperation.date <=']=$date2=$this->data['CompteOperation']['date2'];
			}
			if($this->data['CompteOperation']['show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$this->data['CompteOperation']['show'];
			}
			$compteOperationConditions['CompteOperation.id !=']=0; //to get the pagination always working
			$show['CompteOperation.show']=$this->data['CompteOperation']['show'];
			$this->set('compteOperations', $this->paginate($compteOperationConditions));
			$this->Session->write('compteOperationConditions',$compteOperationConditions);
			$this->Session->write('showCptOp',$show);
		}
		else {
			if($show['CompteOperation.show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$show['CompteOperation.show'];
			}
			$date1=(isset($compteOperationConditions['CompteOperation.date >=']))?($compteOperationConditions['CompteOperation.date >=']):$date1;
			$date2=(isset($compteOperationConditions['CompteOperation.date <=']))?($compteOperationConditions['CompteOperation.date >=']):$date2;
			
			$this->set('compteOperations', $this->paginate($compteOperationConditions));
		}
		$comptes=$this->CompteOperation->Compte->find('list',array('fields'=>array('Compte.id','Compte.composer'),
																	'conditions'=>array('Compte.actif'=>'oui')
																	));
		$journal=(isset($compteOperationConditions['CompteOperation.journal']))?
					($compteOperationConditions['CompteOperation.journal']):0;

		$compte='Journal Des Opérations Diverses';
		if($journal!=0){
			$info=$this->CompteOperation->Compte->find('first',array('fields'=>array('Compte.name'),
																	'conditions'=>array('Compte.actif'=>'oui',
																						'Compte.id'=>$journal
																						)
																	));
				$solde=$this->solde($journal);
				
				$compte='Journal '.$info['Compte']['name'].' (<span id="solde">'.$solde.'</span>)';
		}
		$journals=$this->CompteOperation->Compte->find('list',array('fields'=>array('Compte.id','Compte.name'),
																	'conditions'=>array('Compte.actif'=>'oui',
																						'Compte.numero >='=>56000000,
																						'Compte.numero <='=>58000000
																						)
																	));
		$journals[0]='Opérations diverses';
		$this->set(compact('compteOperations','comptes','compte','compteId','mode','journals','journal','solde','date1','date2'));
	}

	function solde($journal){
		
		$solde=$this->Product->solde('CompteOperation',$journal);

		if($this->RequestHandler->isAjax()){
			exit(json_encode(array('success'=>true,'solde'=>$solde)));	
		}
		else {
			return $solde;
		}
	}

	function add() {
		if (!empty($this->data)) {
			$this->CompteOperation->create();
			
			$where=$this->Session->read('where');
			$this->data['CompteOperation']['where']=$where;
		
			if(empty($where)){
				$where=($this->data['CompteOperation']['debit']!=null)?('debit'):('credit');
				$this->Session->write('where',$where);
				if(empty($this->data['CompteOperation']['id'])){
					$this->data['CompteOperation']['op_num']=$this->op_num();
				}
			}
			else {
				$where1=($this->data['CompteOperation']['debit']!=null)?('debit'):('credit');
				if($where!=$where1){
					$this->Session->delete('where');
					$this->data['CompteOperation']['op_num']=$this->op_num(0);
				}
				else {
					$this->Session->write('where',$where);
					$this->data['CompteOperation']['op_num']=$this->op_num(0);
				}
			}
			if($this->data['CompteOperation']['mode']=='report'){
				$this->data['CompteOperation']['libelle']='report';
			}
				//operation creditage
			$this->CompteOperation->save($this->data);
			$ids[]=$this->CompteOperation->id;
			unset($this->CompteOperation->id);
			
			if(($this->data['CompteOperation']['journal']!=0)&&($this->data['CompteOperation']['automatik']==1)){
				if(!empty($this->data['CompteOperation']['debit'])){
					$this->data['CompteOperation']['credit']=$this->data['CompteOperation']['debit'];
					$this->data['CompteOperation']['debit']=null;
				}
				else {
					$this->data['CompteOperation']['debit']=$this->data['CompteOperation']['credit'];
					$this->data['CompteOperation']['credit']=null;
				}
				$this->data['CompteOperation']['compte_id']=$this->data['CompteOperation']['journal'];	
				$this->CompteOperation->save($this->data);
				$ids[]=$this->CompteOperation->id;		
				
				$this->Session->delete('where');						
			}
			$compteOperations=$this->CompteOperation->find('all',array('conditions'=>array('CompteOperation.id'=>$ids),
																		'fields'=>array('CompteOperation.*',
																						'Compte.id','Compte.name',
																						'Personnel.id','Personnel.name'
																						)
																		));
			$this->set('compteOperations',$compteOperations);
			
			$this->render('quick_add');
		}
	}
	
	function quick_edit($id){
			$info=$this->CompteOperation->find('first',array('fields'=>array('CompteOperation.*'
																			),
																	'conditions'=>array('CompteOperation.id'=>$id)
														));
		exit(json_encode($info['CompteOperation']));
	}
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'compte operation'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CompteOperation->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'compte operation'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'compte operation'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CompteOperation->read(null, $id);
		}
		$comptes=$this->CompteOperation->Compte->find('list',array('fields'=>array('Compte.id','Compte.composer'),
																	'conditions'=>array('Compte.actif'=>'oui')
																	));
		$this->set(compact('comptes', 'personnels'));
	}

	function delete($id = null) {
		foreach($this->data['Id'] as $value){
			if($value!=0) {
				$this->CompteOperation->delete($value);
			}
		}
		exit(json_encode(array('success'=>true,'msg'=>'powere!')));
	}

}
?>
