
<div class="dialog">
<?php echo $this->Form->create('TypeChambre',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Name'));
		echo $this->Form->input('description');
	?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('montant',array('label'=>'Rate'));
		echo $this->Form->input('monnaie',array('label'=>'currency'));
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>