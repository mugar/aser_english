		
<?php 
	$n°=isset($n°)? $n°:'';
	if(!isset($selected)) {
		echo $this->Form->input('Produit.section_id',array('selected'=>0,'id'=>'ProduitSectionId'.$n°));
   		echo $ajax->observeField('ProduitSectionId'.$n°,array('url' =>array('controller'=>'produits','action'=>'updateGroupe/'.$n°),'update' => 'groupe'.$n°,'indicator'=>'loading'.$n°));
		echo '<span id="groupe'.$n°.'">'.$this->Form->input('Produit.groupe_id',array('selected'=>0)).'</span>';
	}
	else {
		echo $this->Form->input('Produit.section_id',array('id'=>'ProduitSectionId'.$n°));
		echo $ajax->observeField('ProduitSectionId'.$n°,array('url' => array('controller'=>'produits','action'=>'updateGroupe/'.$n°),'update' => 'groupe'.$n°,'indicator'=>'loading'.$n°));
		echo '<span id="groupe'.$n°.'">'.$this->Form->input('Produit.groupe_id',array('id'=>'groupe')).'</span>';
	}
?>