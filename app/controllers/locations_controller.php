<?php
class LocationsController extends AppController {

	var $name = 'Locations';
	
	function client($id=null,$resId=null){
		if(empty($this->data)){
				$this->data=$this->Location->Tier->find('first',array('fields'=>array('Tier.*'),
																 				'conditions'=>array('Tier.id'=>$id)
																				)
																);
				$reservation=null;
				$model='Location';
				if($resId){
					$resInfo=$reservation=$this->Location->find('first',array('fields'=>array('Location.*'),
														'conditions'=>array('Location.id'=>$resId),
														'recursive'=>-1
															));	
					$this->data['Location']=$resInfo['Location'];
					
				}
				$this->set(compact('reservation','model'));
			
		}
		else {
			//saving tier data
			//exit(debug($this->data));
			//if the tier has been changed no need to update the tier info
			if(!isset($this->data['Location']['new_tier_id'])||($this->data['Location']['new_tier_id']==0)){
				$this->Location->Tier->save($this->data);
			}
			else {
				$this->data['Location']['tier_id']=$this->data['Location']['new_tier_id'];
			}
			//saving reservation data
		//	exit(debug($this->data));
			$this->Location->save($this->data);
			
			exit(json_encode(array('success'=>true,'msg'=>'Informations enregistrées !')));
			
		}
	}

	/**
	 * this function'job is to return the list of customers who currently using a conference room
	 */
	function current_guests(){
		$date=date('Y-m-d');
		$guests=$this->Location->find('list',array('conditions'=>array(
																		'Location.arrivee <='=>$date,
																		'Location.depart >='=>$date,
																		),
													'fields'=>array('Location.tier_id','Location.tier_id')
													)
										);	
		exit(json_encode($guests));
	}
	
	function rapport($date1=null,$date2=null){
		if($date1&$date2){
			$this->data['Facture']['date1']=$date1;
			$this->data['Facture']['date2']=$date2;
			$this->data['NOT']=array('Facture.etat'=>array('annulee','proforma'));
		}
		if(!empty($this->data['Facture']['date1'])){
			$cond['Facture.date >=']=$date1=$this->data['Facture']['date1'];
		}
		else {
			$cond['Facture.date >=']=$date1=date('Y-m').'-01';
		}
		if(!empty($this->data['Facture']['date2'])){
			$cond['Facture.date <=']=$date2=$this->data['Facture']['date2'];
		}
		else {
			$cond['Facture.date <=']=$date2=date('Y-m-d');
		}
		if(!empty($this->data['Facture']['tier_id'])){
			$cond['Facture.tier_id']=$this->data['Facture']['tier_id'];
		}
		if(!empty($this->data['Facture']['etat'])&&($this->data['Facture']['etat'][0]!='toutes')){
			$cond['Facture.etat']=$this->data['Facture']['etat'];
		}
		$cond['Location.etat !=']='annulee';
	//	exit(debug($cond));
		$locations=$this->Location->find('all',array('fields'=>array(
																	'Facture.monnaie',
																	'Facture.id',
																	'Facture.numero',
																	'Facture.montant',
																	'Facture.reste',
																	'Facture.etat',
																	'Location.arrivee',
																	'Location.depart',
																	'Tier.name',
																	'Tier.compagnie',
																	'Facture.date',
																	'Salle.name'
																	),
													'conditions'=>$cond,
													'order'=>array('Facture.date')
												));
		$montant=$reste=0;
		foreach($locations as $key=>$location){
			$montant+=$location['Facture']['montant'];
			$reste+=$location['Facture']['reste'];
			$locations[$key]['Location']['jours']=$this->Product->diff($location['Location']['arrivee'],$location['Location']['depart'])+1;
		}
		$this->set(compact('locations','date1','date2','montant','reste'));
	}

	/*
	 * This function tabella will handle all tasks related to the display of bookings for a given year,month 
	 * Will receive parameters likes year/month to display and much more I hope!
	 */
	function tabella($month=null,$year=null) {
	//setting up values for current month & year
		if(($month==null)||($month<=0)||($month>12)||($year==null)||($year<=0)) { //roomsDetails invalid values
			$cur_month=date('n');
			$cur_year=date('Y');
		}
		else {
			$cur_month=$month;
			$cur_year=$year;
		}
		//setting up the first day of the current month in mysql format
		$month_first_day=(in_array($cur_month,array(10,11,12)))?($cur_year.'-'.$cur_month.'-01'):($cur_year.'-0'.$cur_month.'-01'); 
	//setting up values for previous month & year
		if(($cur_month-1)==0) {
			$prev_month=12;	
			$prev_year=(($cur_year-1)==0)?($cur_year):($cur_year-1);
		}
		else {
			$prev_month=$cur_month-1;
			$prev_year=$cur_year;
		}
	//setting up values for next month & year
		if(($cur_month+1)==13) {
			$next_month=1;	
			$next_year=$cur_year+1;
		}
		else {
			$next_month=$cur_month+1;
			$next_year=$cur_year;
		}
		$days=cal_days_in_month(CAL_GREGORIAN,$cur_month,$cur_year); //to get how manys days within the current month
		$mois=(in_array($cur_month,array(10,11,12)))?$cur_month:'0'.$cur_month; 
		$locations=$this->Location->find('all',array('fields'=>array('Location.id',
																	'Location.arrivee',
																	'Location.depart',
																	'Location.etat',
																	'Location.facture_id',
																	'Tier.name',
																	'Tier.id',
																	'Salle.name'
																			),
															'recursive'=>0,
															'order'=>'Location.arrivee asc',
															'conditions'=>array('Location.etat !='=>'annulee',
																			'OR'=>array(array('month(Location.arrivee)'=>$mois,
																								'year(Location.arrivee)'=>$cur_year,
																								),
																						array('month(Location.depart)'=>$mois,
																							'year(Location.depart)'=>$cur_year,
																							),
																						)
																				)
															)
												);
		$i=0;
		$roomsDetails=array();
		$salles=$this->Location->Salle->find('all',array('fields'=>array('Salle.name'),
												  'order'=>'Salle.name asc',
												  'conditions'=>array()
													)
									);
		foreach( $salles as $salle){
			$roomsDetails[$salle['Salle']['name']]=array();
		}
		
		foreach($locations as $location){
			$details['etat']=$location['Location']['etat'];
			$details['tier_name']=$location['Tier']['name'];		
			$details['tier_id']=$location['Tier']['id'];			
			$details['location_id']=$location['Location']['id'];		
			$details['facture_id']=(!empty($location['Location']['facture_id']))?($location['Location']['facture_id']):(0);	
			$details['arrivee']=$location['Location']['arrivee'];
			$details['depart']=$location['Location']['depart'];
			$roomsDetails[$location['Salle']['name']][$i]=$details;
			$i++;
		}
		//	die(debug($roomsDetails));
		$salles1 = $this->Location->Salle->find('list',array('order'=>'Salle.name asc'));
		
		$etats=array('en_attente'=>'En attente',
					'confirmee'=>'Confirmée',
					'arrivee'=>'Arrivée',
					'partie'=>'Partie',
					);
		$this->set(compact('days',
						   'roomsDetails',
						   'next_month',
						   'prev_month',
						   'next_year',
						   'prev_year',
						   'cur_month',
						   'cur_year',
						   'month_first_day',
						   'salles1',
						   'etats'
						   )
				);
	}
	
	function state_updater($id,$state,$obs=''){
		$info=$this->Location->find('first',array('fields'=>array('Location.etat',
																'Location.facture_id',
																'Facture.tier_id',
																'Facture.monnaie',
																'Facture.montant',
																'Facture.etat'
																),
												'conditions'=>array('Location.id'=>$id),
												));
		if(($info['Location']['etat']=='partie')&&(!in_array($this->Auth->user('fonction_id'),array(3,5)))){
			exit(json_encode(array('success'=>false,'msg'=>'Location Non Modifiable!')));
		}
		$factureId=$info['Location']['facture_id'];
		//annuler la facture aussi if any
		switch($state){
			case 'annulee': 
				if(!in_array($info['Location']['etat'],array('en_attente','confirmee'))&&(!in_array($this->Auth->user('fonction_id'),array(3,5)))){
					exit(json_encode(array('success'=>false,'msg'=>'Vous n\'avez pas le droit d\'annulée cette location!')));
				}
				$this->Product->remove_facture($factureId,'Location',$obs);
				break;
			case 'arrivee':
				if($info['Facture']['etat']=='proforma'){
					$update['Facture']['etat']='credit';
					$update['Facture']['id']=$factureId;
					$this->Location->Facture->save($update);
				}
				break;
			case 'en_attente':
					$update['Facture']['etat']='proforma';
					$update['Facture']['id']=$factureId;
					$this->Location->Facture->save($update);
				break;
			
			case 'confirmee':
					$update['Facture']['etat']='proforma';
					$update['Facture']['id']=$factureId;
					$this->Location->Facture->save($update);
				break;
			case 'partie':
					$state=($info['Facture']['etat']!='payee')?'credit':$state;
				break;
				
		}
		
		$info['Location']['etat']=$state;
		$this->Location->save($info);
		
		//trace stuff
		$trace['Trace']['model_id']=$id;
		$trace['Trace']['model']='Location';
		$trace['Trace']['operation']='Changement d\'état de "'.$info['Location']['etat'].'" à "'.$state.'"';
		$this->Location->Trace->save($trace);
		
		exit(json_encode(array('success'=>true,'state'=>$state)));
	}

	function _checker($data){
		$dispo=true;
		$locations=$this->Location->find('all',array('fields'=>array('Location.arrivee','Location.depart','Location.salle_id'),
													'conditions'=>array('Location.salle_id'=>$this->data['Location']['salle_id'],
																		'Location.etat !='=>'annulee',
																		)
													)
																);
		foreach($locations as $location){
			if(($this->data['Location']['arrivee']<=$location['Location']['depart'])and($this->data['Location']['depart']>=$location['Location']['arrivee'])) {
				$dispo=false;
			}
		}
		return $dispo;
	}
	
	function edit($id = null,$type='proforma') {
		$salles=$this->Location->Salle->find('list');
		$location=$this->Location->find('first',array('conditions'=>array('Location.id'=>$id),
													'fields'=>array('Location.*',
																	'Facture.date',
																	),
													));
		
		if(empty($this->data)){
		
			$this->data=$location;
			$this->data['Location']['date']=$location['Facture']['date'];
			$jrs=$this->Product->diff($this->data['Location']['arrivee'], $this->data['Location']['depart'])+1;
			$extras=$this->Location->LocationExtra->find('all',array('conditions'=>array('LocationExtra.location_id'=>$id),
																	'recursive'=>-1
														));
			//check if we already have some resto data
			$resto=false;
			foreach($extras as $extra){
				if($extra['LocationExtra']['extra']=='resto'){
					$resto=true;
					break;
				}
			}				
											
			foreach($extras as $extra){
				$go=false;
				if((($type=='proforma')&&($extra['LocationExtra']['extra']=='non'))||(!$resto)){ //load proforma data if requested or if there is no resto data yet 
					$go=true;
				}
				elseif(($type=='bill')&&($extra['LocationExtra']['extra']=='resto')){
					$go=true;
				}
				if($go){
					$this->data['services'][$extra['LocationExtra']['name']]['prix']=$extra['LocationExtra']['PU'];
					$this->data['services'][$extra['LocationExtra']['name']]['heure']=$extra['LocationExtra']['heure'];
					$this->data['services'][$extra['LocationExtra']['name']]['quantite']=$extra['LocationExtra']['quantite'];
				}
			}
			$this->set(compact('extras','type','salles'));
		}
		else {
			if($location['Location']['etat']=='partie'){
				exit(json_encode(array('success'=>false,'msg'=>'Location Non Modifiable!')));
			}
			$deleteConditions['LocationExtra.location_id']=$id;
			if($this->data['Location']['type']=='bill'){
				$deleteConditions['LocationExtra.extra']=array('oui','resto');
			}
			elseif($this->data['Location']['type']=='proforma'){
				$deleteConditions['LocationExtra.extra']=array('oui','non');
			}
			$this->Location->LocationExtra->deleteAll($deleteConditions);
			$this->data['Location']['arrivee']=$location['Location']['arrivee'];
			$this->data['Location']['depart']=$location['Location']['depart'];
		//	$this->data['Location']['salle_id']=$location['Location']['salle_id'];
			$this->data['Location']['facture_id']=$location['Location']['facture_id'];
			$this->data['Location']['etat']=$location['Location']['etat'];
		
			$this->add(true);	
		}
	}

	function add($edit=false) {
		//exit(debug($this->data));
		$this->autoRender=false;
		if(!$edit){
			$salleInfo=$this->Location->Salle->find('first',array('conditions'=>array('Salle.name'=>$this->data['Location']['salle']),
																'recursive'=>-1
																));
		}
		else {
			$salleInfo=$this->Location->Salle->find('first',array('conditions'=>array('Salle.id'=>$this->data['Location']['salle_id']),
																'recursive'=>-1
																));	
		}
		$this->data['Location']['salle_id']=$salleInfo['Salle']['id'];
		$montant=(empty($this->data['Location']['PU']))?$salleInfo['Salle']['montant']:$this->data['Location']['PU'];

		$go=($edit)?true:$this->_checker($this->data);
		if($go){
			$jrs=$this->Product->diff($this->data['Location']['arrivee'], $this->data['Location']['depart'])+1;
			$this->data['Location']['PU']=$montant;
			$this->data['Location']['location']=$jrs*$montant;
//			$this->data['Location']['monnaie']=Configure::read('aser.default_currency');
			$this->data['Location']['etat']=($edit)?$this->data['Location']['etat']:'en_attente';
			$this->Location->save($this->data);
			$id=$this->Location->id;
			$total=0;
			//calcul des services (pause cafe,...)
		if(isset($this->data['services'])){
			foreach($this->data['services'] as $service=>$detail){
				if(!empty($detail['prix'])){
					$extra['LocationExtra']['location_id']=$id;
					$extra['LocationExtra']['extra']=($this->data['Location']['type']=='proforma')?'non':'resto';
					$extra['LocationExtra']['name']=$service;
					$extra['LocationExtra']['heure']=(!empty($detail['heure'])) ? $detail['heure']: '';
					$extra['LocationExtra']['quantite']=(empty($detail['quantite'])) ?
														$jrs*$this->data['Location']['nombre']:
														$detail['quantite'];
					$extra['LocationExtra']['PU']=$detail['prix'];
					$extra['LocationExtra']['montant']=$extra['LocationExtra']['quantite']*$detail['prix'];
					$extra['LocationExtra']['monnaie']=$this->data['Location']['monnaie'];
					//include this in the location bill 
					if($this->data['Location']['type']=='bill'){
						$total+=$extra['LocationExtra']['montant'];
					}
					$this->Location->LocationExtra->save($extra);
					unset($this->Location->LocationExtra->id);
					unset($extra);
				}
			}
		}	
		unset($extra);
		//calcul des extras qui font partie permanante de la facture location
		if(isset($this->data['extras'])){	//calcul des extras
	//	exit(debug($this->data));
			foreach($this->data['extras'] as $detail){
				if(!empty($detail['prix'])&&!empty($detail['qte'])){
					$extra['LocationExtra']['location_id']=$id;
					$extra['LocationExtra']['extra']='oui';
					$extra['LocationExtra']['name']=$detail['name'];
					$extra['LocationExtra']['quantite']=(Configure::read('aser.conference-manual')) ?
													   $detail['qte']:
													   $detail['qte']*$jrs;
					$extra['LocationExtra']['PU']=$detail['prix'];
					$extra['LocationExtra']['montant']=$extra['LocationExtra']['quantite']*$detail['prix'];
					$extra['LocationExtra']['monnaie']=$this->data['Location']['monnaie'];
					$total+=$extra['LocationExtra']['montant'];
				
					$this->Location->LocationExtra->save($extra);
					unset($this->Location->LocationExtra->id);
				}
			}
		}
		$facture['Facture']['tier_id']=$this->data['Location']['tier_id'];
		//stop editing the price if it is a proforma modification
		if(!$edit||($edit&&($this->data['Location']['type']=='bill'))||!Configure::read('aser.conference-resto-reception')){
			$update['Location']['extras']=$total;
			$update['Location']['montant']=$update['Location']['extras']+$this->data['Location']['location'];
			
			//determination de la tva
			$facture['Facture']['tva_incluse']=$this->data['Location']['tva_incluse'];
			$facture['Facture']['tva']=$this->Product->tva($update['Location']['montant'],$this->data['Location']['tva_incluse']);
			if(!$facture['Facture']['tva_incluse']){
				$update['Location']['montant']+=$facture['Facture']['tva'];
			}

			$facture['Facture']['original']=$update['Location']['montant'];
			$facture['Facture']['montant']=$update['Location']['montant'];
			$facture['Facture']['reste']=$update['Location']['montant'];
			$facture['Facture']['date']=$this->data['Location']['date'];
		}
			if(!$edit){
				$facture['Facture']['etat']='proforma';
			}
			$facture['Facture']['monnaie']=$this->data['Location']['monnaie'];
			$facture['Facture']['operation']='Location';
			if(!$edit){
				$this->Location->Facture->save($facture);
				$factureId=$this->Location->Facture->id;
				//update location
				$update['Location']['id']=$id;
				$update['Location']['facture_id']=$factureId;
				$this->Location->save($update);
			
				//putting the facture numero
				$this->Product->facture_number($factureId,'Location');
				
			}
			else {
				
				$facture['Facture']['id']=$this->data['Location']['facture_id'];
				$this->Location->Facture->save($facture);
				$factureId=$this->data['Location']['facture_id'];
			}
			
			//trace stuff for locations
			
			$trace['Trace']['model_id']=$id;
			$trace['Trace']['model']='Location';
			$tierInfo=$this->Location->Tier->find('first',array('conditions'=>array('Tier.id'=>$this->data['Location']['tier_id']),
																'fields'=>array('Tier.name')
																));
			$action=($edit)?'Modification':'Création';
			$trace['Trace']['operation']=$action.' de la location avec les détails suivants : Client = "'.$tierInfo['Tier']['name'].
										'" nombre de clients = "'.$this->data['Location']['nombre'].
										'" Prix/Jour = "'.$this->data['Location']['PU'].'"';
			$this->Location->Trace->save($trace);
			
			//trace stuff for facture
			$trace['Trace']['id']=null;
			$trace['Trace']['model_id']=$factureId;
			$trace['Trace']['model']='Facture';
			$trace['Trace']['operation']=$action.' de la Facture avec les détails suivants : Client = "'.$tierInfo['Tier']['name'].
										'" date = "'.$this->Product->formatDate($this->data['Location']['date']).'"';
			$this->Location->Trace->save($trace);
			
			exit(json_encode(array('success'=>true,'msg'=>'Powere !','id'=>$id,'facture_id'=>$factureId)));
		}
		else {
			exit(json_encode(array('success'=>false,'msg'=>'Salle Non disponible !')));
		}
	}
}
?>