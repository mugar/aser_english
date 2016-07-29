<div class="dialog">
<?php
	$action = isset($action)? $action: 'edit';
?>
<?php echo $this->Form->create('Subscription',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		if($action == 'edit')
			echo $this->Form->input('id');
		echo $this->Form->input('start',array('label'=>"Start Date",'type'=>'text','id'=>'DateStart1'));
		?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('end',array('label'=>"End Date",'type'=>'text','id'=>'DateEnd1'));
		echo $this->Form->input('personnel_id',array('type'=>'hidden'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>