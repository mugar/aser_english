
<div class="dialog">
<?php echo $this->Form->create('Section',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Nom De La Section'));
	?>
	</span>
	</form>
<div style="clear:both"></div>
</div>