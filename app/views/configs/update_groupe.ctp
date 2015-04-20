<?php
	if(empty($advanced))
		echo $this->Form->input('Produit.groupe_id',array('options'=>$groupes,'selected'=>0));
	else
		echo $this->Form->input('Produit.groupe_id',array('label'=>'','options'=>$groupes,'selected'=>0));
		
?>

