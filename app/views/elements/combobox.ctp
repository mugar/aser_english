		
<?php 
	$n°=isset($n°)? $n°:'';
	if(!isset($selected)) {
		echo $this->Form->input('Product.section_id',array('selected'=>0,'id'=>'ProductSectionId'.$n°));
   		echo $ajax->observeField('ProductSectionId'.$n°,array('url' =>array('controller'=>'produits','action'=>'updateGroupe/'.$n°),'update' => 'groupe'.$n°,'indicator'=>'loading'.$n°));
		echo '<span id="groupe'.$n°.'">'.$this->Form->input('Product.groupe_id',array('selected'=>0)).'</span>';
	}
	else {
		echo $this->Form->input('Product.section_id',array('id'=>'ProductSectionId'.$n°));
		echo $ajax->observeField('ProductSectionId'.$n°,array('url' => array('controller'=>'produits','action'=>'updateGroupe/'.$n°),'update' => 'groupe'.$n°,'indicator'=>'loading'.$n°));
		echo '<span id="groupe'.$n°.'">'.$this->Form->input('Product.groupe_id',array('id'=>'groupe')).'</span>';
	}
?>