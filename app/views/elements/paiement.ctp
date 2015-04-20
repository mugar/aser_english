<?php 
	if($toutes){
	echo $this->Form->input('Facture.etat',array('options'=>array('toutes'=>'toutes',
																		'payee'=>'payee',
																		'credit'=>'credit',
																		'avance'=>'avance',
																		'annulee'=>'annulee',
																	)));
	}
	else {
		echo $this->Form->input('Facture.etat',array('options'=>array(
																		'payee'=>'payee',
																		'avance'=>'avance',
																		'credit'=>'credit'
																	)));
	}
																	
?>
																	
