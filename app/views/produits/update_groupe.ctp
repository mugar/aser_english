
<?php 
	
	if(!empty($advanced)){
	echo $this->Form->input('Produit.groupe_id',array('id'=>$n°.'GroupeId','label'=>'','selected'=>0,'title'=>'Le sous groupe auquel appartient le produit'));
    echo $ajax->observeField($n°.'GroupeId', array('url' => 'sous_groupe/'.$advanced,'update' => 'sous_groupe'.$n°,
    		'loading'=>'jQuery("#loading'.$n°.'").attr("class","advanced_loading").show();',
    		'complete'=>'jQuery("#loading'.$n°.'").attr("class","advanced_loading").hide();'
    	));
    	
	}
	else {
		echo $this->Form->input('Produit.groupe_id',array('id'=>$n°.'GroupeId','selected'=>0,'title'=>'Le sous groupe auquel appartient le produit'));
   		 echo $ajax->observeField($n°.'GroupeId', array('url' => 'sous_groupe','update' => 'sous_groupe'.$n°,
    	));
    	
	}
    	
    	?>
	