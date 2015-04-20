<?php
	if(empty($advanced))
		echo $this->Form->input('Produit.sous_groupe_id',array('options'=>$sousGroupes,'selected'=>0));
	else
		echo $this->Form->input('Produit.sous_groupe_id',array('label'=>'','options'=>$sousGroupes,'selected'=>0));
		
?>

