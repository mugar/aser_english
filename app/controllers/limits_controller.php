<?php
class LimitsController extends AppController {

	var $name = 'Limits';

	
	function generate_yearly_limits($year){
			$days_in_year = date("z", mktime(0,0,0,12,31,$year)) + 1;
		//	exit("".$days_in_year);
			$start_date=$year.'-01-01';
			$limits=array();
			for($i=0;$i<$days_in_year; $i++){
			$limit['Limit']['date']=$this->Product->increase_date($start_date,$i);
		//	$limit['Limit']['montant']=0;
			if(!$this->Limit->save($limit)){
				exit(json_encode(array('success'=>false,'msg'=>"Problème avec l'enregistrement de la limite pour le ".$limit['Limit']['date'])));
			}
			$limits[]=$limit;					
		}
		exit(json_encode(array('success'=>true,'msg'=>"Succès!")));
		// return $limits;
	}
	function index($year=null) {
			$year=(empty($year))?date('Y'):$year;
			$limits=$this->Limit->find('all',array('conditions'=>array('year(Limit.date)'=>$year),
																					'order'=>array('Limit.date asc')
																						));
		//	exit(debug($limits));
			
			$this->set(compact('year','limits'));
	}

	function generate_monthly_limits($month,$year,$min,$max){
		$days=cal_days_in_month(CAL_GREGORIAN,$month,$year);
		$start_date=$year.'-'.(($month<10)?'0'.$month:$month).'-01';
		for($i=0;$i<$days; $i++){
			$limit['Limit']['date']=$this->Product->increase_date($start_date,$i);
			$limit['Limit']['montant']=rand($min,$max);
		//	echo $limit['Limit']['date'].'-'.$limit['Limit']['montant'].'<br/>';
			 if(!$this->Limit->save($limit)){
			 	exit(json_encode(array('success'=>false,'msg'=>"Problème avec l'enregistrement de la limite pour le ".$limit['Limit']['date'])));
			 }					
		}
		exit(json_encode(array('success'=>true,'msg'=>"Succès!")));
	}

	function set_montant($date,$montant){
		if($date && $montant){
			$limit['Limit']['montant']=$montant;
			$limit['Limit']['date']=$date;
			if(!$this->Limit->save($limit)){
				exit(json_encode(array('success'=>false,'msg'=>"Problème avec l'enregistrement the cette limite")));
			}					
			exit(json_encode(array('success'=>true,'msg'=>"Succès!")));
		}
		else {
			exit(json_encode(array('success'=>false,'msg'=>"Paramètres non fournis!")));
		}
	}
}
?>