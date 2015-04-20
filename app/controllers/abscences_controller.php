<?php
class AbscencesController extends AppController {

	var $name = 'Abscences';

	function beforeFilter(){
		parent::beforeFilter();
		$types=array('Non justifié', 'justifié','congé');
		$this->set(compact('types'));
	}
	function index($id=null,$month=null,$year=null) {
		$personnels=$this->Abscence->Personnel->find('list');
		if(!$this->data){
			$month=date('n');
			$year=date('Y');
			$id=key($personnels);
		}
		else {
			$id=$this->data['Abscence']['personnel_id'];
			$month=(int) $this->data['Abscence']['month']['month'];
			$year=$this->data['Abscence']['year']['year'];
		}
		
		//searching abscences data
		$sMonth=($month<10)?'0'.$month:$month; //string month
		$abscences=$this->Abscence->find('all',array('fields'=>array('day(Abscence.date) as day','Abscence.*'),
												'conditions'=>array('Abscence.personnel_id'=>$id,
																	'month(Abscence.date)'=>$sMonth,
																	'year(Abscence.date)'=>$year
																	),
												'order'=>array('Abscence.date')
												));
		//forming the days with their css
		
		$this->set(compact('personnels','month','sMonth','year','id','types','abscences'));
	}

	

	function add() {
		if (!empty($this->data)) {
			if($this->Abscence->save($this->data))
				exit(json_encode(array('success'=>true,'id'=>$this->Abscence->id)));
			else 
				exit(json_encode(array('success'=>false)));
		}
		exit(json_encode(array('success'=>false)));
	}

	function edit($id = null) {
			$this->data = $this->Abscence->find('first', array('conditions'=>array('Abscence.id'=>$id),
																'recursive'=>-1
															));
	}

	function delete($id = null) {
		if ($this->Abscence->delete($id)) {
			exit(json_encode(array('success'=>true)));
		}
		exit(json_encode(array('success'=>false)));
	}

}
?>