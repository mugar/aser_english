<?php
class SalairesController extends AppController {

	var $name = 'Salaires';

	function salaire_net($id,$sb){
		$salaire=$this->Salaire->find('first',array('fields'=>array('Personnel.name',
																'Salaire.montant',
																'Salaire.*'
																),
												'conditions'=>array('Salaire.id'=>$id)
													));
		$salaire['Salaire']['montant']=$sb;
		$salaire=$this->_calculPaie($salaire);
		exit(json_encode(array('success'=>true,'sb'=>$salaire['Salaire']['SNET'])));
	}
	
	function salaire_base($id,$salaire_net){
		$sb=round(($salaire_net*2)/3);
		$salaire=$this->Salaire->find('first',array('fields'=>array('Personnel.name',
																'Salaire.montant as SB',
																'Salaire.*'
																),
												'conditions'=>array('Salaire.id'=>$id)
													));
		$salaire['Salaire']['SB']=$sb;
		$salaire=$this->_calculPaie($salaire);
		while($salaire['Salaire']['SNET']<$salaire_net){
			$salaire['Salaire']['SB']++;
			$salaire=$this->_calculPaie($salaire);
		}
		exit(' salaire de base est  : '.$salaire['Salaire']['SB']);
	}
	
	function executerLaPaie(){
	//	exit(debug($this->data));
		$ids=array();
		foreach($this->data['Id'] as $id){
			if($id!=0) {
				$ids[]=$id;
			}
		}	
		//search the salaires
		$salaires=$this->Salaire->find('all',array('fields'=>array('Personnel.name',
																'Salaire.montant as SB',
																'Salaire.*'
																),
												'conditions'=>array('Salaire.id'=>$ids)
													));
		foreach($salaires as $key=>$salaire){
			$salaire=$this->_calculPaie($salaire);
			$paie['Paie']=$salaire['Salaire'];
			$paie['Paie']['salaire_id']=$salaire['Salaire']['id'];
			$paie['Paie']['date']=$this->data['Salaire']['date'];
			$paie['Paie']['mois']=$this->data['Salaire']['mois'];
			$paie['Paie']['annee']=$this->data['Salaire']['annee'];
			$paie['Paie']['id']=null;
			$this->Salaire->Paie->save($paie);
		}	
		exit(json_encode(array('success'=>true,'msg'=>'ok')));
	}
	
	function _abscence($id,$SB){
		$this->loadModel('Abscence');
		$abscences=$this->Abscence->find('all',
										array('fields'=>array('Abscence.type',
															),
										'conditions'=>array('Abscence.type'=>0,
															'Abscence.personnel_id'=>$id,
															'month(Abscence.date)'=>date('m'),
															'year(Abscence.date)'=>date('Y'),
															)
										));
		$salaireParJour=$SB/24;
		$montantAbscence=$salaireParJour*count($abscences);
		return $montantAbscence;
	}
	
	function paie(){
		$salaires=$this->Salaire->find('all',array('fields'=>array('Personnel.name',
																'Salaire.*'
															)));
		foreach($salaires as $key=>$salaire){
			$salaires[$key]=$this->_calculPaie($salaire);
		}	
	//	exit(debug($salaires));
		$this->set(compact('salaires'));
	}
	
	function _calculPaie($salaire){
		$ID=round($this->Conf->find('ID')/100,2);	
		$IL=round($this->Conf->find('IL')/100,2);	
		$salaire['Salaire']['SB']=(!empty($salaire['Salaire']['montant']))?$salaire['Salaire']['montant']:$salaire['Salaire']['SB'];
		$salaire['Salaire']['ABSC']=$this->_abscence($salaire['Salaire']['personnel_id'],$salaire['Salaire']['SB']);
		$salaire['Salaire']['SBR']=$salaire['Salaire']['SB']-$salaire['Salaire']['ABSC'];
		$salaire['Salaire']['INDL']=$salaire['Salaire']['SBR']*$IL;
			$salaire['Salaire']['INDD']=$salaire['Salaire']['SBR']*$ID;
			$salaire['Salaire']['BRUT']=$salaire['Salaire']['SBR']
										+$salaire['Salaire']['HS']
										+$salaire['Salaire']['PRIME']
										+$salaire['Salaire']['ALLOC']
										+$salaire['Salaire']['INDL']
										+$salaire['Salaire']['INDD']
										+$salaire['Salaire']['SM'];
			$salaire['Salaire']['BINSS']=$salaire['Salaire']['BRUT']
										-$salaire['Salaire']['INDD']
										-$salaire['Salaire']['SM'];
			//calcul INSS
				//calcul QP salariale
				if(($salaire['Salaire']['BINSS']>=40000)&&($salaire['Salaire']['BINSS']<450000))
					$salaire['Salaire']['QPSAL']=$salaire['Salaire']['BINSS']*0.04;
				else if($salaire['Salaire']['BINSS']<40000)
					$salaire['Salaire']['QPSAL']=40000*0.04;
				else 
					$salaire['Salaire']['QPSAL']=450000*0.04;
				
				//calcul QP Entreprise
				if(($salaire['Salaire']['BINSS']>=40000)&&($salaire['Salaire']['BINSS']<450000))
					$salaire['Salaire']['QPENT']=$salaire['Salaire']['BINSS']*0.06;
				else if($salaire['Salaire']['BINSS']<40000)
					$salaire['Salaire']['QPENT']=40000*0.06;
				else 
					$salaire['Salaire']['QPENT']=450000*0.06;
				
				//calcul INSS RISQUE
				if(($salaire['Salaire']['BINSS']>=40000)&&($salaire['Salaire']['BINSS']<80000))
					$salaire['Salaire']['RISK']=$salaire['Salaire']['BINSS']*0.03;
				else if($salaire['Salaire']['BINSS']<40000)
					$salaire['Salaire']['RISK']=40000*0.03;
				else 
					$salaire['Salaire']['RISK']=80000*0.03;
			//INSS TOTALE	
			$salaire['Salaire']['INSS']=$salaire['Salaire']['QPSAL']
										+$salaire['Salaire']['QPENT']
										+$salaire['Salaire']['RISK'];
			//calcul base imposable			
				//calcul du montant depassant la limite des assurance. cet montant qui depasse sera imposee
				$assurImp=($salaire['Salaire']['ASSUR']>($salaire['Salaire']['BRUT']*0.2))?
							$salaire['Salaire']['ASSUR']-($salaire['Salaire']['BRUT']*0.2)
							:0;					
			$salaire['Salaire']['BIMP']=$salaire['Salaire']['BRUT']
										-$salaire['Salaire']['INDL']
										-$salaire['Salaire']['INDD']
										-$salaire['Salaire']['QPSAL']
										-$salaire['Salaire']['SM']
										-$salaire['Salaire']['ASSUR']
										+$assurImp;
			//calcul IPR
			if($salaire['Salaire']['BIMP']<=150000)
				$salaire['Salaire']['IPR']=0;
			else if(($salaire['Salaire']['BIMP']>=150001)&&($salaire['Salaire']['BIMP']<=300000)){
				$salaire['Salaire']['IPR']=($salaire['Salaire']['BIMP']-150000)*0.20;
			}
			else {
				$salaire['Salaire']['IPR']=(($salaire['Salaire']['BIMP']-300000)*0.30)+30000;
			}							
			$salaire['Salaire']['SNET']=$salaire['Salaire']['BRUT']
										-$salaire['Salaire']['IPR']
										-$salaire['Salaire']['QPSAL']
										-$salaire['Salaire']['AVANCE']
										-$salaire['Salaire']['COTIS'];
			$salaire['Salaire']['SNET']=round($salaire['Salaire']['SNET']);
			return $salaire;
	}
	
	function index() {
		$salaires=$this->paginate();
		foreach($salaires as $key=>$salaire){
			$salaires[$key]=$this->_calculPaie($salaire);
		}
		$this->set('salaires',$salaires);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'salaire'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('salaire', $this->Salaire->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Salaire->create();
			if ($this->Salaire->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'salaire'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'salaire'));
			}
		}
		$personnels = $this->Salaire->Personnel->find('list');
		$this->set(compact('personnels'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'salaire'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Salaire->save($this->data)) {
				$this->Session->setFlash(sprintf(__('Informations enregistrées', true), 'salaire'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('Impossible d\'enregistrer. Réessayer S.V.P.', true), 'salaire'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Salaire->read(null, $id);
		}
		$personnels = $this->Salaire->Personnel->find('list');
		$this->set(compact('personnels'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Id pour %s incorrecte !', true), 'salaire'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Salaire->delete($id)) {
			$this->Session->setFlash(sprintf(__('Enregistrement effacé', true), 'Salaire'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('Impossible d\'effacer !', true), 'Salaire'));
		$this->redirect(array('action' => 'index'));
	}

}
?>