<?php
class AppController extends Controller {  
	var $helpers = array('Html', 'Form', 'Javascript', 'Ajax','Session','Number','MugTime','Xls');
    var $components = array('Acl', 'Auth','Session','RequestHandler','Conf','Product','Cookie','Email','License','RememberMe');
 	var $actsAs = array('containable');
    var $persistModel = false;
	var $groupes=array();
	var $monnaies=array();
	var $facturationMonnaies=array();
	var $stocks=array();
	var $sections=array();
	var $produits=array();
	var $modePaiements=array();
	var $caissesInterdites=array();
	var $groupeComptables=array();
	var $tiers=array();
	var $etat_classes=array('payee','credit','avance','excedent');
	
	
	
	function expired(){
		$historiques=$this->Product->productQty(null,null,array(),null,'all');
		$quantites=$historiques['array'];
			//exit(debug($quantites));
		$this->set(compact('quantites'));
	}
	
	function _error($action,$failureMsg){
		if($action=='add')
			exit('failure_'.$failureMsg);
		else 
			exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));	
	}
	
	function beforeRender(){
		/*	
		if($this->params['url']['url']=='/'){
			$this->loadModel('Personnel');
			$online=$this->Personnel->find('all',array('fields'=>array('Personnel.id','Personnel.name','Personnel.last_action'),
														'conditions'=>array('Personnel.identifiant !='=>'')
														)
											);
			$logged=array();	
			foreach($online as $personnel){
				$last_action = strtotime($personnel['Personnel']['last_action']); 
				$current_time = strtotime(date("Y-m-d H:i:s"));
				$time_period = floor(round(abs($current_time - $last_action)/60,2));
				if($time_period<=10){
					$logged[$personnel['Personnel']['id']]=$personnel['Personnel']['name'];
				}
			}
			$this->set(compact('logged'));
		}
		//*/
	}	
    function beforeFilter() {
    	
		//Only enabling json response parsing for url requested with the .json extension
		if ($this->RequestHandler->ext === 'json'){
   			 $this->RequestHandler->setContent('json', 'application/json');
			//Prevent debug output that'll corrupt your json data
    		Configure::write('debug', 0);
		}

		
		//check perishables
    	if(($this->params['url']['url']=='/')&&Configure::read('aser.pharmacie')){
    		$this->expired();
    	}	
		
		#checking if they 've got the right to use my soft !
    //	$this->License->mac_checker();

    	
    
    	//remember me stuff
    	 $this->RememberMe->check();  
		 $this->Conf->startup($this->params['controller']);
		//mode to use resto or magasin
		if(!Configure::read('aser.magasin')&&Configure::read('aser.multi_resto')){
			$mode=$this->Session->read('mode_restaurant');
			
			if($mode!=''){
				$mode=($mode==1)?0:1;
				Configure::write('aser.magasin',$mode);
			}
		}
		//redirecting test 
		/*
		if ((strpos($this->referer(), 'compte_operations') !== false)&&($this->params['controller']!='compte_operations')){
			$this->loadModel('CompteOperation');
			$last=$this->CompteOperation->find('all',array('order'=>array('CompteOperation.id desc'),
													'recursive'=>-1,
													'fields'=>array('CompteOperation.op_num','CompteOperation.id'),
													'conditions'=>array('CompteOperation.op_num !='=>0),
													'limit'=>2
													)
										);
			if(!empty($last)){
				if(count($last)==2){
					if($last[0]['CompteOperation']['op_num']!=$last[1]['CompteOperation']['op_num']){
						$this->Session->setFlash('Comptes Désequilibrés!<br/> Vérifiez si vous avez créée la contre-checked_out.');
						$this->redirect(array('controller'=>'compte_operations',
									  'action'=>'index'));
					}
				}
				else {
					$this->Session->setFlash('Comptes Désequilibré!<br/> Vérifiez si vous avez créée la compte checked_out');
					$this->redirect(array('controller'=>'compte_operations',
									  'action'=>'index'));
				}
			}
		}
		//*/
		
		if($this->params['action']=='view') {
    		$model=inflector::camelize(inflector::singularize($this->params['controller']));
			if(in_array($model,array('Caiss','Type'))){
    			$this->redirect(array('controller'=>'operations',
									  'action'=>'rapport/'.$model.'/'.$this->params['pass'][0]));
			}
			elseif($model=='Compte'){
				$this->redirect(array('controller'=>'compte_operations',
									  'action'=>'rapport/'.$this->params['pass'][0]));
			}	
		}
		

    	if(!Configure::read('aser.conference')){
    		$forbidden=array(
    						'locations',
    						'salles',
    						'location_extras',
    						'locationExtras',
							);
    		if(in_array($this->params['controller'],$forbidden)){
				$this->redirect('/');
			}
    	}
		
    	
    	if(!Configure::read('aser.hotel')){
    		$forbidden=array('reservations',
    						'chambres',
    						'type_chambres',
    						'typeChambres',
    						'suggestions',
    						'dotations',
    						'affectations',
    						'etages',
							);
    		if(in_array($this->params['controller'],$forbidden)){
				$this->redirect('/');
			}
    	}
	//*	
		if(!Configure::read('aser.stock')){
			unset($forbidden);
    		$forbidden=array(
    						'stocks',
    						'entrees',
    						'historiques',
    						'sortis',
    						'mouvements',
    						'unites',
    						'pertes',
							);
    		if(in_array($this->params['controller'],$forbidden)){
				$this->redirect($this->referer());
			}
    	}
		if(!Configure::read('aser.POS')){
			unset($forbidden);
    		$forbidden=array(
    						'produits',
    						'groupes',
    						'sections',
							);
    		if(in_array($this->params['controller'],$forbidden)){
				$this->redirect($this->referer());
			}
    	}
	//*/
	
	//*	
		if(!Configure::read('aser.tresorerie')){
			unset($forbidden);
    		$forbidden=array('virements',
    						'caisses',
    						'caisse_interdites',
    						'pret_argents',
    						'caisse_operations',
    						'caisseOperations'
							);
    		if(in_array($this->params['controller'],$forbidden)){
				$this->redirect($this->referer());
			}
    	}
	//*/
    	// specifying which layout menu to use. enabled==true for an enabled menu and false for login layout.
    	$this->set('enabled',(in_array($this->params['action'],array('login','swipe')))?(false):(true));
		
		//stocks list
		if(in_array($this->params['controller'],
			array('produits',
					'final_stocks',
    			'historiques',
					'sortis',
					'pertes',
					'configs',
					'mouvements',
					'ventes',
					'proformas'
					)))
			{
			$this->loadModel('Stock');
			$this->stocks=$stocks=$this->Stock->find('list');
			if(!Configure::read('aser.magasin')&&($this->params['controller']=='pertes')){
				$stocks=$stocks1=array('')+$stocks;
			}
			else {
				$stocks1=array('')+$stocks;
			}
			$this->set(compact('stocks','stocks1'));
		}
		//personnels list
		if(in_array($this->params['controller'],
			array('operations','final_stocks'
				)))
			{
			$this->loadModel('Personnel');
			$personnels=$this->Personnel->find('list');
			$personnels1=array('')+$personnels;
			$this->set(compact('personnels','personnels1'));
		}	
		//for sections & groupes stuff
		if(in_array($this->params['controller'],array('produits','configs','ventes','pertes','historiques','final_stocks','mouvements'))){
			$this->loadModel('Section');
			$this->sections=$sections=$sections1=$this->Section->find('list',array('fields'=>array('Section.id','Section.name'),
														'order'=>array('Section.name asc')
														));
			$sections[0]='';
			
			$this->loadModel('Groupe');
			$groupes=$this->Groupe->find('list',array('fields'=>array('Groupe.id','Groupe.name'),
														'order'=>array('Groupe.name asc'),
														'conditions'=>array('Groupe.actif'=>'yes',
																			'Groupe.afficher'=>'yes'
																			)
														));
			$this->groupes=$groupes;
			$groupes[0]='';
			$this->set(compact('sections','groupes','sections1'));
		}
		
		//pour les tiers de type client
		if(in_array($this->params['controller'],array('factures',
													'ventes',
													'recouvrements',
													'reservations',
													'services',
													'historiques',
													'proformas',
													'operations',
													'locations',
													'buanderies',
													'reductions',
													'paiements'
													)
		)){
			$this->loadModel('Tier');
			$this->tiers=$tiers=$this->Tier->find('list',array('conditions'=>array('Tier.actif'=>1,
																	'Tier.type'=>'client'
																	),
											'order'=>array('Tier.name asc')
											));
			$tiers1=array('')+$tiers;
			$this->set(compact('tiers','tiers1'));
		}
		
		

		//pour les $tiers de type fournisseurs
		if(in_array($this->params['controller'],array('entrees'))){
			$this->loadModel('Tier');
			$tiers=$this->Tier->find('list',array('conditions'=>array('Tier.actif'=>1,
																	'Tier.type'=>'fournisseur'
																	),
											'order'=>array('Tier.name asc')
											));
			$tiers1=$tiers;
			$tiers1[0]='';
			$this->set(compact('tiers','tiers1'));
		}
		
		//pour les type de services where they are needed
		if(in_array($this->params['controller'],array('reservations','factures'))){
			$this->loadModel('TypeService');
			$typeServices = $this->TypeService->find('list',array('order'=>'TypeService.name asc'));
			$typeServices1=array('')+$typeServices;
			$this->set(compact('typeServices','typeServices1'));
		}
		
		//pour les produits where they are needed
		if(in_array($this->params['controller'],array('historiques','final_stocks','pertes','mouvements','ventes','reductions'))){
			$this->loadModel('Produit');
			$cond['Produit.actif']='yes';
			if(!Configure::read('aser.magasin')&&($this->params['controller']=='pertes')){
				$plats_section=$this->Conf->find('plats_section');
				$platsGroupes=$this->Produit->Groupe->find('list',array('fields'=>array('Groupe.id','Groupe.id'),
																		'conditions'=>array('Groupe.section_id'=>$plats_section)
																		));
				$cond['OR']=array(array('Produit.type'=>'storable'),
								array('Produit.groupe_id'=>$platsGroupes)
								);
			}
			else {
				$cond['Produit.type']='storable';
			}
			$produits_raw=$this->Produit->find('all',array('conditions'=>$cond,
																		'order'=>array('Produit.name asc'),
																		'fields'=>array('Produit.id','Produit.name','Unite.name')
																		));
			$produits=array();
			foreach($produits_raw as $p=>$produit){
				$produits[$produit['Produit']['id']]=$produit['Produit']['name'].' ('.$produit['Unite']['name'].')';
			}
			$this->produits=$produits;
			$produits1=array('')+$produits;
			$this->set(compact('produits','produits1'));
		}
		
		//pour les unites de type client
		if(in_array($this->params['controller'],array('produits','historiques','final_stocks','pertes','mouvements'))){
			$this->loadModel('Unite');
			$unites=$this->Unite->find('list',array('order'=>array('Unite.name asc')));
			$unites[0]='';
			$this->set(compact('unites'));
		}

		//pour les groupes comptables
		if(in_array($this->params['controller'],array('produits',
													'reservations',
													'ventes',
													'factures',
													'type_services','typeServices'
													)
		)){
			$this->loadModel('GroupeComptable');
			$this->groupeComptables=$groupeComptables=$this->GroupeComptable->find('list',array(
											'order'=>array('GroupeComptable.name asc')
											));
			$groupeComptables1=array('')+$groupeComptables;
		//	exit(debug($groupeComptables));
			$this->set(compact('groupeComptables','groupeComptables1'));
		}
		//options for differents select tags
		$monnaies=array('RWF'=>'RWF','USD'=>'USD','EUR'=>'EUR');
		//pour caisses et operations add add currencies like franc Rwandais
		if(in_array($this->params['controller'],array('caisses',
													'operations',
													)
		)){
			$monnaies['RWF']='RWF';			
		}
		$monnaies1=array(''=>'')+$monnaies;
		$typeDeProduits=array('storable'=>'storable','not_storable'=>'not_storable');
		$typeDeProduits1=array(''=>'')+$typeDeProduits;
		$this->monnaies=$monnaies;
		$modePaiements=$this->modePaiements=array('cash'=>'Cash',
							'visa'=>'Visa Card',
							'cheque'=>'Cheque',
							'bank_transfert'=>'Bank Transfert'
							);
		$modePaiements1=array(''=>'')+$modePaiements;
		$operations=array('ajout'=>'ajout','retrait'=>'retrait');
		$formatting=array('places'=>0,'before'=>'','escape'=>false,'decimal'=>'.','thousands'=>' ');
		$decimal=array('places'=>2,'before'=>'','escape'=>false,'decimal'=>'.','thousands'=>' ');
		$natures=array('casse'=>'casse',
						'vol'=>'vol',
						'expiration'=>'expiration',
						'impropre'=>'impropre',
						'retard'=>'retard',
						'mauvaise preparation'=>'mauvaise préparation',
						'autre'=>'autre'
						);
		$natures1=array(''=>'')+$natures;
		$models=array(''=>'',
					'Vente'=>'Restaurant',
					// 'Location'=>'Conference Room',
					'Reservation'=>'Bookings',
					// 'Service'=>'Extras Services',
					//'Proforma'=>'Proforma'
					);
		if(!in_array($this->params['controller'],array('tiers','reductions'))){
			$actifs=$actifs1=array('yes'=>'Yes','no'=>'No');
			$actifs1[]='';
			$this->set(compact('actifs','actifs1'));
		}
			
		$taux=$this->Conf->find('taux_usd');
		$etats=array(
					'in_progress' => 'In Progress',
					'printed' => 'Printed',
					'paid'=>'Paid',
					'credit'=>'Credit',
					'half_paid'=>'Half Paid',
					'bonus'=>'Bonus',
					'canceled'=>'Canceled'
					);
		$etats1=array(''=>'')+$etats;
		$facturationMonnaies=$this->facturationMonnaies=array('RWF'=>'RWF','USD'=>'USD');
		$shifts=Configure::read('shifts');
		$countries=Configure::read('countries');
		$pax=array(1=>1,2=>2,3=>3);
		$optionsForTypes=array('depense'=>'Expense','vente'=>'Deposit');
		$optionsForType1s=array('')+$optionsForTypes;

		$inventory_operation_types=array('Entree'=>'Entry',
							'Sorti'=>'Consumption',
							'Vente'=>"Sale",
							'Perte'=>'Loss'
							);
		$inventory_operation_types1=array(''=>'')+$inventory_operation_types;

		//designed by message
		//$designed_by='<div id="designed_by" style="margin: -5px auto 10px auto; font_size: 7px; color: #666">Système conçu par aser-technologies +25779853419</div>';
		$this->set(compact('monnaies','monnaies1',
						'modePaiements','modePaiements1',
						'operations',
						'formatting',
						'models',
					'typeDeProduits',
					'typeDeProduits1',
					'natures','natures1',
					'actifs','actifs1',
					'decimal',
					'taux',
					'etats','etats1',
					'facturationMonnaies',
					'shifts',
					'countries',
					'pax',
					'optionsForTypes','optionsForType1s',
					'inventory_operation_types','inventory_operation_types1'
				//	,'designed_by'
					));
	
	if(Configure::read('aser.alerts')){	
		/*Pour les avertissements affichés seulement sur la page d'acceuil*/		
    	if($this->params['url']['url']=='/'){
    		//Recherche des produits en fin de stock
    		$min=$this->Conf->find('min');
    		$expiration=$this->Conf->find('expiration');
			$this->loadModel('Historique');
			$produits=$this->Historique->find('all',array('fields'=>array('Produit.id',
																	'Produit.name',
																	'Produit.min',
																	'Produit.type',
																	'sum(Historique.debit) as debit',
																	'sum(Historique.credit) as credit'
																	),
													'conditions'=>array('Produit.min >'=>0,
																		'Produit.actif'=>'yes',
																		'Produit.type'=>'storable',
																		),
													'group'=>array('Historique.produit_id')				
													)
											);
			$finis=array();
			foreach($produits as $key=>$produit){
				$produit['Produit']['qty']=$produit['Historique']['debit']-$produit['Historique']['credit'];
				if($produit['Produit']['qty']<=$produit['Produit']['min']){
					$finis[]=$produit;
				}
			}
			
			$this->set('finis',$finis);
		}
    		//*
    	
			
		//*/
    	//*
			
			
		
		
			
			
			
		}
		
     	//Configure AuthComponent
     	$this->Auth->authorize = 'actions';
     	$this->Auth->allow('login',
     					'logout',
     					'swipe',
     					'calcul_factures',
     					'auto_demi_journee',
     					'stuff',
     					'aserb',
     					'auto_report',
     					'repair_all_tables',
     					'availability',
     					'expose_menu'
						);
		$this->Auth->userModel='Personnel';
		
		$this->Auth->fields=array('username'=>'identifiant','password'=>'mot_passe');
     	$this->Auth->loginRedirect ='/';
     	$this->Auth->ajaxLogin ='ajax_forbidden';
    	$this->Auth->logoutRedirect = (Configure::read('aser.swipe'))?
    								array('controller' => 'personnels', 'action' => 'swipe'):
									array('controller' => 'personnels', 'action' => 'login');
 		//*     	
 		$this->Auth->loginError = "Identifiant ou mot de passe incorrect!";
     	$this->Auth->authError = "Access Denied!";
     	$this->Auth->userScope = array('Personnel.actif' =>'yes');
     	
     	//*/
   }
  
}