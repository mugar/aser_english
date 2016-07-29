<?php
class SubscriptionsController extends AppController {

	var $name = 'Subscriptions';
	
	function beforeFilter(){
		$services = $this->Subscription->Produit->find('list',array('conditions'=>array('Produit.groupe_id in (select groupes.id from groupes where groupes.section_id = 3)')));
		$services1 = array(''=>'')+ $services;
		$this->set(compact('services','services1'));
		parent::beforeFilter(); 
	}

	function _conditions($data){
		$conditions=array();
		$date1=$date2=null;
		if(!empty($data)) {
			if($data['Facture']['tier_id']!=0) {
				$conditions['Facture.tier_id']=$data['Facture']['tier_id'];
			}
		}
		
		return array('conditions'=>$conditions,
					'date1'=>$date1,
					'date2'=>$date2,
					);
	}
	
	function index() {
		$show=$this->Session->read('showSubscription');
		$subscriptionConditions=$this->Session->read('subscriptionConditions');
		if((empty($this->data))&&(empty($subscriptionConditions))) {
			$this->set('subscriptions', $this->paginate());
		}
		elseif(!empty($this->data)) {
		//building conditions
			$cond=$this->_conditions($this->data);
			$subscriptionConditions=$cond['conditions'];
			if($this->data['Subscription']['show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$this->data['Subscription']['show'];
			}
			$subscriptionConditions['Subscription.id !=']=0; //to get the pagination always working
			$show['Subscription.show']=$this->data['Subscription']['show'];
			
			$this->set('subscriptions', $this->paginate($subscriptionConditions));
			$this->Session->write('subscriptionConditions',$subscriptionConditions);
			$this->Session->write('showSubscription',$show);
		}
		else {
			if($show['Subscription.show']=='all'){
				$this->paginate['show']='all';
			}
			else {
				$this->paginate['limit']=$show['Subscription.show'];
			}
			$this->set('subscriptions', $this->paginate($subscriptionConditions));
		}
	}
	
	function rapport() {
		$total=0;
		$subscriptions=array();
		$date1=$date2=null;
		if(!empty($this->data)){
			$cond=$this->_conditions($this->data);
			$conditions=$cond['conditions'];
			$date1=$cond['date1'];
			$date2=$cond['date2'];
		}
		else {
			$conditions['Subscription.date >= '] = $date1 = date('Y-m').'-01';
			$conditions['Subscription.date <= '] = $date2 =  date('Y-m').'-31';
		}
		$subscriptions=$this->Subscription->find('all',array('fields'=>array(
																'Tier.name',
																'DoneBy.name',
																'Subscription.*'
																),
														'conditions'=>$conditions,
														'order'=>array('Subscription.date'),
														)
										);
		foreach($subscriptions as $subscription){
				$total+=$subscription['Subscription']['montant'];
		}
		$this->set(compact('subscriptions','date1','date2','total'));
	}
	
	function _show($id){
		$this->set('subscription',$this->Subscription->find('first',array('fields'=>array(
																			'Personnel.name','Personnel.id',
																			'DoneBy.name','DoneBy.id',
																			'Tier.name','Tier.id',
																			'Subscription.*'
																			),
																'conditions'=>array('Subscription.id'=>$id)
															)
													));
		$this->layout="ajax";
		$this->render('add');
	}
	
	function _logic(&$data,$action){
		$this->Subscription->set($data);
		if(!$this->Subscription->validates()) {
			$failureMsg='Date & Customer field are mandatory!';
			if($action=='edit')
				exit(json_encode(array('success'=>false,'msg'=>$failureMsg)));
			else
				exit('failure_'.$failureMsg);  
		}
		
		if(($action=='edit')&&($this->Auth->user('id')!=$data['Subscription']['personnel_id'])){
			exit(json_encode(array('success'=>false,'msg'=>'Only the one who created the operation can modifiy it!'))); 
		}
		
		if($data['Subscription']['end']<=$data['Subscription']['start']){
			exit(json_encode(array('success'=>false,'msg'=>'The end date is not correct!')));	
		}
		//check for other previous active subscription 
		$search = $this->Subscription->find('first',array('conditions'=>array('Subscription.produit_id'=>$data['Subscription']['produit_id'],
																														'Subscription.facture_id'=>$data['Subscription']['facture_id'],
																														'Subscription.active'=>'yes',
																															)
																					));
		if(!empty($search)){
			exit(json_encode(array('success'=>false,'msg'=>'There is another subscription already created on this same invoice!')));	
		}
		
		//Saving the subscription operation
		$this->Subscription->save($data);
	}
	
	function add() {
		if(!empty($this->data)) {
			$this->_logic($this->data, 'add');
			if(!isset($this->data['remote'])){
				$this->_show($this->Subscription->id);
			}
			else {
				exit(json_encode(array('success'=>true)));
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
				$this->data = $this->Subscription->find('first',array('fields'=>array('Subscription.*'),
															'conditions'=>array('Subscription.id'=>$id),
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
				$subscription=$this->Subscription->find('first',array('fields'=>array('Subscription.historique_id',
																																'Subscription.personnel_id'
																																),
																								'conditions'=>array('Subscription.id'=>$id)
																));
				if(true){
					$this->Product->productHistoryDelete($subscription['Subscription']['historique_id'],'Historique');
					$this->Subscription->delete($id);
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
