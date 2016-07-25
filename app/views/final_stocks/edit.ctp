<div class="dialog">
<?php echo $this->Form->create('FinalStock',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('date',array('label'=>'Date d\'Opération','type'=>'text','id'=>'DateOpEdit'));
			echo $this->Form->input('stock_id',array('options'=>$stocks,'label'=>'Store'));
			echo $this->Form->input('stock_manager_id',array('options'=>$personnels,'label'=>'Store Manager'));
		?>
	</span>
	<span class="right">
		<?php
		
			echo $this->Form->input('produit_id',array('label'=>'Product'));
			echo $this->Form->input('quantite',array('label'=>'Quantity'));
			echo $this->Form->input('controler_id',array('type'=>'hidden'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
