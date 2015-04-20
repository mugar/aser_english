<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Sorti',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->element('combobox',array('n°'=>0));
			echo $this->Form->input('stock_id',array('selected'=>0,'id'=>'stockId','options'=>$stocks1));
			echo $this->Form->input('produit_id',array('selected'=>0,'id'=>'produits','options'=>$produits1));
			
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('tier_id',array('label'=>'Client','selected'=>0,'options'=>$tiers1));
			echo $this->Form->input('date1',array('label'=>'Choisissez une date début','type'=>'text'));				
			echo $this->Form->input('date2',array('label'=>'et une date fin pour le rapport','type'=>'text'));	
			if($action=='index')
				echo $this->Form->input('show',array('label'=>'Affichage',
												'options'=>array(20=>'20',
																50=>'50',
																100=>'100',
																200=>'200',
																'all'=>'all',
																)));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
