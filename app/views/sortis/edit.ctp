<div class="dialog">
<?php echo $this->Form->create('Sorti',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('date',array('type'=>'text','id'=>'DateEdit'));
		echo $this->Form->input('quantite');
		echo $this->Form->input('produit_id');
		echo $this->Form->input('Product.id',array('type'=>'hidden'));
		echo $this->Form->input('Product.unite_id',array('label'=>'Unité de Mesure'));
		?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('stock_id');
		echo $this->Form->input('tier_id',array('options'=>$tiers1));
		if (Configure::read('aser.shifts'))
				echo $this->Form->input('shift',array('options'=>$shifts));
		echo $this->Form->input('historique_id',array('type'=>'hidden'));
		echo $this->Form->input('personnel_id',array('type'=>'hidden'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>