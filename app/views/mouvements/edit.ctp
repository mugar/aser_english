<div class="dialog">
<?php echo $this->Form->create('Mouvement',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('date',array('type'=>'text','id'=>'DateEdit'));
		echo $this->Form->input('quantite',array('label'=>'Quantité'));
		echo $this->Form->input('Produit.id',array('type'=>'hidden'));
		echo $this->Form->input('Produit.unite_id',array('label'=>'Unité de Mesure'));
		echo $this->Form->input('produit_id');
		?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('stock_sortant_id',array('options'=>$stocks));
		echo $this->Form->input('stock_entrant_id',array('options'=>$stocks));
		if (Configure::read('aser.shifts'))
				echo $this->Form->input('shift',array('options'=>$shifts));
		//needing those for stock management
		echo $this->Form->input('historique1',array('type'=>'hidden'));
		echo $this->Form->input('historique2',array('type'=>'hidden'));
		
		echo $this->Form->input('personnel_id',array('type'=>'hidden'));
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>