<div class="dialog">
<?php echo $this->Form->create('Reduction',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tier_id',array('label'=>'Customer'));
		echo $this->Form->input('produit_id');
		?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('PU');
		echo $this->Form->input('actif');
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
