
<div class="dialog">
	<?php echo $this->Form->create('Abscence',array('id'=>'abscence_form','action'=>'add'));?>
	<span class="left">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('type',array('id'=>'abscence_type','label'=>__('Type d\'abscence',true),'options'=>$types));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('observation',array('id'=>'observation'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>