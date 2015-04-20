	<?php	
		echo $this->Form->input('Relation.premier_produit_id',array('options'=>$produits));
		echo $this->Form->input('Relation.relation',array('options'=>array('composer_par'=>'composer_par',
																			'echanger_contre'=>'echanger_contre'
																		)));
		echo $this->Form->input('Relation.deuxieme_produit_id',array('options'=>$produits));