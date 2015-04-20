<?php
class HistoriquesController extends AppController {

	var $name = 'Historiques';

	function index() {
		$historiques=$this->paginate();
		foreach($historiques as $key=>$historique){
			if($historique['Historique']['id_element']==null){
				$historiques[$key]['Historique']['compte']=$historique['Historique']['sous_famille'];
			}
			else {
				$model=$historique['Historique']['model'];
				$this->loadModel($model);
				$info=$this->$model->find('first',array('fields'=>array($model.'.*'),
														'conditions'=>array($model.'.id'=>$historique['Historique']['id_element'])
														)
										);
				$historiques[$key]['Historique']['compte']=$info[$model]['name'];
			}
		}
		$this->set('historiques', $historiques);
	}
}
?>