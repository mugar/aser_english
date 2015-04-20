
<div class="dialog">
<?php echo $this->Form->create('TypeChambre',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Nom'));
		echo $this->Form->input('description');
	?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('montant',array('label'=>'Montant/Nuitée'));
		echo $this->Form->input('monnaie');
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>