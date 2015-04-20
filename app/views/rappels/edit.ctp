
<div class="dialog">
<?php echo $this->Form->create('Rappel',array('id'=>'edit_form'));?>
	<span class="left">
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('date',array('type'=>'text'));
		echo $this->Form->input('heure');
	?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('action',array('label'=>'Action à faire'));
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>