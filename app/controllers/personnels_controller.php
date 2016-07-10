<?php
class PersonnelsController extends AppController {

	var $name = 'Personnels';
	var $components = array('Acl', 'Auth','Session');
	var $paginate=array('order'=>'Personnel.name asc');
	
	/**
	 * this function if called  will check for expired product and
	 * remove them
	 */
	function _remove_expired_products(){
		$this->loadModel('Produit');
		$produits = $this->Produit->Historique->find('all',array('fields'=>array('Historique.date_expiration',
																				'Historique.produit_id',
																				'Historique.stock_id',
																				'sum(Historique.debit) as debit',
																				'sum(Historique.credit) as credit',
																				'Produit.*'
																				),
																'conditions'=>array("Historique.date_expiration <="=>date('Y-m-d'),
																					'Historique.date_expiration !='=>'0000-00-00'
																					),
																'group'=>array('Historique.stock_id','Historique.produit_id','Historique.date_expiration')
																));
		$counter=0;
		foreach($produits as $produit){
			$qty=$produit['Historique']['debit']-$produit['Historique']['credit'];
			if($qty>0){
				//create la perte
				$perte['id']=null;
				$perte['stock_id']=$produit['Historique']['stock_id'];
				$perte['produit_id']=$produit['Historique']['produit_id'];
				$perte['quantite']=$qty;
				$perte['PU']=$this->Product->productPrice($produit['Historique']['produit_id']);
				$perte['montant']=$perte['PU']*$perte['quantite'];
				$perte['date']=date('Y-m-d');
				$perte['date_expiration']=$produit['Historique']['date_expiration'];
				$perte['nature']='expiration';
				$perte['personnel_id']=11; //id de armand
				//decreasing the stock level
				$perteData['Perte']=$perte;
				$this->Product->stock($perteData,'credit',$produit);
				//Saving the loss of goods
				$this->Produit->Perte->save($perteData);
				//increasing the counter
				$counter++;
			}
		}
	}
	//*
	function beforeFilter() {
		$this->Auth->autoRedirect = false;
		$conditions=array();
		if($this->Auth->user('fonction_id')!=3){
			$conditions['Fonction.id']=array(1,2,4);
		}
		$this->set('fonctions',$fonctions=$this->Personnel->Fonction->find('list',array('order'=>array('Fonction.name'),
																						'conditions'=>$conditions
																						)));
		parent::beforeFilter();
	}
	
	function annulation($code,$action='',$factureId='',$commentaire=''){
		if(preg_match('#(\d)+#',$code,$match)){
			$code=$match[0];
			
			$search=$this->Personnel->find('first',array('conditions'=>array('Personnel.code'=>$code,
                                                                      'Personnel.actif'=>'yes'
                                                                      ),
														'recursive'=>-1
														));
			if(!empty($search)&&
				(
					in_array($search['Personnel']['fonction_id'],array(3,5))
					||
					(($search['Personnel']['fonction_id']==2)&&($action=='paiement')&&(!Configure::read('aser.deny_caishier_to_make_credit')))
				)
			)
			{
				//trace stuff
				$this->loadModel('Trace');
				$trace['Trace']['model_id']=$factureId;
				$trace['Trace']['model']='Facture';
				$trace['Trace']['operation']='Par le code de '.$search['Personnel']['name'].' : ';
				switch ($action) {
					case 'effacer':
						$trace['Trace']['operation'].='Authorisation de l\'annulation de la facture';
						break;
					case 'effacer_conso':
						$trace['Trace']['operation'].='Effacement de '.$commentaire;
						break;
					case 'direct_reduction':
						$trace['Trace']['operation'].='Réduction de la facture ';
						break;
					case 'unlock':
						$trace['Trace']['operation'].='Déblocage de la facture';
						break;
					case 'paiement':
						$trace['Trace']['operation'].='Classement de la facture crédit ou bonus';
						break;
				}
				if($this->Trace->save($trace)){
					exit(json_encode(array('success'=>true)));
				}
			}
			else {
				exit(json_encode(array('success'=>false)));
			}
		}
		else {
			exit(json_encode(array('success'=>false)));
		}
	}
	
	function swipe(){
		$action='Sans';
		$this->set(compact('action'));
		if(!empty($this->data)){
			if(preg_match('#(\d)+#',$this->data['Personnel']['code'],$match)){
				$code=$match[0];
				$search=$this->Personnel->find('first',array('conditions'=>array('Personnel.code'=>$code),
														'recursive'=>-1
															));
				$this->data=$search;
				$this->Auth->login($this->data);
				$this->redirect("/ventes/touchscreen");
			}
			else {
				$this->Session->setFlash('Code invalide !');
				$this->redirect(array('action' => 'swipe'));
			}
		}
	}
	//*/	
    
    function login($swipe=false) {
    	$action=(!$swipe)?('Avec'):('Sans');
		$this->set(compact('action'));
    //*
    	//remember me stuff
            if (!empty($this->data))  
            {
                if (empty($this->data['Personnel']['remember_me']))  
                {  
                    $this->RememberMe->delete();  
                }  
                else  
                {
                    $this->RememberMe->remember(  
                            $this->data['Personnel']['identifiant'],  
                            $this->data['Personnel']['mot_passe']  
                        );  
                }  
                unset($this->data['Personnel']['remember_me']);  
            }  
    	if(!empty($this->data)){
    		if($this->Auth->user()){
				$personnelInfo=$this->Auth->user();
				//executing the expiration function. each time at login
				if(Configure::read('aser.pharmacie')){
					$this->_remove_expired_products();
				}
				switch($personnelInfo['Personnel']['fonction_id']){
					case 1:
						if(Configure::read('aser.touchscreen')){
							$this->redirect(array('controller'=>'ventes','action'=>'touchscreen'));
						}
						else {
							$this->redirect(array('controller'=>'ventes','action'=>'index'));
						}
						break;
					case 2:
						if(Configure::read('aser.touchscreen')){
							$this->redirect(array('controller'=>'ventes','action'=>'touchscreen'));
						}
						else {
							$this->redirect(array('controller'=>'ventes','action'=>'index'));
						}
						break;
					case 4:
						$this->redirect(array('controller'=>'reservations','action'=>'tabella'));
						break;
					default:
						$this->redirect('/');
				}
			}
		}	
		else if($swipe){
			$this->redirect(array('action'=>'swipe'));
		}
	}
	//*/		

    function logout() {
    	$this->RememberMe->delete();  
    	$this->redirect($this->Auth->logout());
    }
	
	function index() {
		$this->Personnel->recursive = 0;
		$conditions=array();
		if($this->Auth->user('fonction_id')!=3){
			$conditions['OR']=array('Personnel.id'=>$this->Auth->user('id'),
									'Personnel.fonction_id'=>array(1,2,4)
									);
		}
		$this->set('personnels', $this->paginate($conditions));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'personnel'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('personnel', $this->Personnel->read(null, $id));
	}

	function _code($code,$id=null){
		$cond['Personnel.code']=$code;
		if($id){
			$cond['Personnel.id']=$id;
		}
		$search=$this->Personnel->find('first',array('fields'=>array('Personnel.code'),
											'recursive'=>-1,
											'conditons'=>$cond
															));
		
			if(!empty($search['Personnel']['code'])){
				exit(debug($search));
				$this->Session->setFlash(sprintf(__('Ce code est déjà utilisé!', true), 'personnel'));
				if($id){
					$this->redirect(array('action' => 'edit/'.$id));
				}
				else {
					$this->redirect(array('action' => 'add'));
				}
			}
			
	}

	
	function _error($action,$failureMsg){
		if($action=='add')
			exit('failure_'.$failureMsg);
		else 
			exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));	
	}
	
	function _logic($data,$action){
		$this->Personnel->set($data);
		if(!$this->Personnel->validates()){
			$this->_error($action,'Le Nom est obligatoire!');
		}
		if (isset($data['Personnel']['mot_passe'])&&($data['Personnel']['mot_passe']!=$this->Auth->password($data['Personnel']['confirmer']))){
			$this->_error($action,'Mots de passe différents!');
		}
	
		$cond['Personnel.name']=$data['Personnel']['name'];
		if(!empty($data['Personnel']['id'])){
			$cond['Personnel.id !=']=$data['Personnel']['id'];
		}
		$search=$this->Personnel->find('first',array('fields'=>array('Personnel.name'),
											'conditions'=>$cond
											));	
		if(!empty($search)){
			$this->_error($action,'Ce personnel est déjà enregistré!');
		}	
		if(!empty($this->data['Personnel']['code'])){
			if(preg_match('#^(\d)+$#',$this->data['Personnel']['code'],$match)){
				$code=$match[0];
				$this->data['Personnel']['code']=$code;
			}
			else {
				$this->_error($action,'Seul les chiffres sont permis pour Le code!');
			}
		}
		//	exit(debug($data));
		$data['Personnel']['id']=($action=='add')?null:$data['Personnel']['id'];
		$this->Personnel->save($data);
	}
	
	function _show($id){
		$personnel=$this->Personnel->find('first',array('fields'=>array('Personnel.*','Fonction.name'),
    														'conditions'=>array('Personnel.id'=>$id)
															)
											);
		$this->set('personnel',$personnel);
		$this->layout="ajax";
		$this->render('add');
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_logic($this->data,'add');	
    		$this->_show($this->Personnel->id);
		}
	}

	function edit($id = null,$edit='yes') {
		if($edit=='yes'){
			if (!empty($this->data)) {
				$this->_logic($this->data,'edit');
				exit(json_encode(array('success'=>true,'msg'=>'Modification Enregistré')));
			}
			else {
				$this->data = $this->Personnel->find('first',array('fields'=>array('Personnel.*'),
																		'conditions'=>array('Personnel.id'=>$id),
																		'recursive'=>-1
																		));
				$this->data['Personnel']['mot_passe']='';
			}
		}
		else {
			$this->_show($id);
		}
	}

	function delete($id = null) {
		$notDeleted=0;
		$deleted=array();
		foreach($this->data['Id'] as $id){
			if($id!=0) {
				$test1=$this->Personnel->Facture->find('first',array('conditions'=>array('Facture.personnel_id'=>$id),
																'recursive'=>-1
												));
				$test2=$this->Personnel->Trace->find('first',array('conditions'=>array('Trace.personnel_id'=>$id),
																'recursive'=>-1
												));
				$test3=$this->Personnel->Paiement->find('first',array('conditions'=>array('Paiement.personnel_id'=>$id),
																'recursive'=>-1
												));
												
				if (!empty($test1)||!empty($test2)||!empty($test3)){
					$notDeleted++;
				}
				else {
					$this->Personnel->delete($id);
					$deleted[]=$id;
				}
			}
		}
		$msg="Vérifié s'il n'y a pas d'enregistrements sur ";
		$msg=($notDeleted>1)?$msg.'ces personnels.':$msg.'ce personnel.';
		exit(json_encode(array('success'=>true,
							'deleted'=>$deleted,
							'notDeleted'=>$notDeleted,
							'msg'=>$msg
							)));
	}
	
	/**
 * Rebuild 
the Acl based on the current controllers in the application
 *
 * @return 
void
*/

    	function buildAcl() {
    		$this->autoRender=false;
        $log = array();
 
        $aco =& $this->Acl->Aco;
        $root = $aco->node('controllers');
        if (!$root) {
          
  $aco->create(array('parent_id'
 => null, 'model' 
=> null, 'alias' 
=> 'controllers'));
          
  $root = $aco->save();
          
  $root['Aco']['id'] = $aco->id; 
          
  $log[] = 'Created Aco node for 
controllers';
        } else {
          
  $root = $root[0];
        }   
 
        App::import('Core',
 'File');
        $Controllers = Configure::listObjects('controller');
        $appIndex = array_search('App', $Controllers);
        if ($appIndex
 !== false ) {
          
  unset($Controllers[$appIndex]);
        }
        $baseMethods = get_class_methods('Controller');
        $baseMethods[] = 'buildAcl';
 
        // look at each controller in app/controllers
        foreach ($Controllers
 as $ctrlName) {
          
  App::import('Controller', $ctrlName);
          
  $ctrlclass = $ctrlName
 . 'Controller';
          
  $methods = get_class_methods($ctrlclass);
 
          
  // find / make controller node
          
  $controllerNode = $aco->node('controllers/'.$ctrlName);
          
  if (!$controllerNode) {
          
      $aco->create(array('parent_id'
 => $root['Aco']['id'], 'model'
 => null, 'alias' 
=> $ctrlName));
          
      $controllerNode = $aco->save();
          
      $controllerNode['Aco']['id']
 = $aco->id;
          
      $log[] = 'Created Aco node for '.$ctrlName;
          
  } else {
          
      $controllerNode = $controllerNode[0];
          
  }
 
          
  //clean the methods. to remove those in Controller and private actions.
          
  foreach ($methods as $k => $method) {
          
      if (strpos($method, '_',
 0) === 0) {
          
          unset($methods[$k]);
          
          continue;
          
      }
          
      if (in_array($method, $baseMethods)) {
          
          unset($methods[$k]);
          
          continue;
          
      }
          
      $methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
          
      if (!$methodNode) {
          
          $aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model'
 => null, 'alias' 
=> $method));
          
          $methodNode =
 $aco->save();
          
          $log[] = 'Created
 Aco node for '. $method;
          
      }
          
  }
        }
        debug($log);
    }
     
}
?>
