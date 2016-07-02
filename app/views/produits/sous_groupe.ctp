<?php
	if(empty($advanced))
		echo $this->Form->input('Product.sous_groupe_id',array('options'=>$sousGroupes,'selected'=>0));
	else
		echo $this->Form->input('Product.sous_groupe_id',array('label'=>'','options'=>$sousGroupes,'selected'=>0));
		
?>

