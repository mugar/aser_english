
<div class="dialog">
<?php echo $this->Form->create('Caiss',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Account Name'));
		echo $this->Form->input('monnaie', array('label'=>'Currency'));
	?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('actif');
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>