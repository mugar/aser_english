<?php
	$multiple=(isset($multiple))?($multiple):(true);
	if(isset($toutes)){
		echo $this->Form->input('CaisseOperation.operation',array('id'=>'operation','options'=>array(
																								'toutes'=>'toutes',
																								'ajout'=>'ajout',
																								'retrait'=>'retrait',
																								),
																					'selected'=>'toutes'
																));
	}
	else {
		echo $this->Form->input('CaisseOperation.operation',array('id'=>'operation','options'=>array('ajout'=>'ajout',
																								'retrait'=>'retrait',
																)));
	}
	echo '<span id="loading" style="display:none;">Chargement ...</span>';
	if($multiple){
		echo '<span id="groupe">'.$this->Form->input('CaisseOperation.type_id',array('selected'=>0,'multiple'=>true)).'</span>';
	}
	else {
		echo '<span id="groupe">'.$this->Form->input('CaisseOperation.type_id').'</span>';
	}
		
	echo $ajax->observeField('operation',array('url' => array('controller'=>'caisseOperations','action'=>'updateType/'.$multiple),'update' => 'groupe','indicator'=>'loading'));
