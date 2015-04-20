
<div class="dialog">
<?php echo $this->Form->create('Stock',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Nom Du Stock'));
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>