
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Entree',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->element('combobox',array('n°'=>0));
			echo $this->Form->input('produit_id',array('selected'=>0,'id'=>'produits','options'=>$produits1));
			echo $this->Form->input('stock_id',array('selected'=>0,'id'=>'stockId','options'=>$stocks1));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('tier_id',array('selected'=>0,'options'=>$tiers1));
			echo $this->Form->input('type',array('options'=>$types1));
			echo $this->Form->input('date1',array('label'=>'Start Date','type'=>'text'));				
			echo $this->Form->input('date2',array('label'=>'End Date','type'=>'text'));		
			if($action=='rapport')		
				echo $this->Form->input('xls',array('label'=>'Exporter vers Excel','type'=>'checkbox'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>