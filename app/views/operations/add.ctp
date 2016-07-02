<div class="operations form">
<?php echo $this->Form->create('Operation');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Operation', true)); ?></legend>
	<?php
		echo $this->Form->input('element_id');
		echo $this->Form->input('model');
		echo $this->Form->input('op_num');
		echo $this->Form->input('entree');
		echo $this->Form->input('sortie');
		echo $this->Form->input('date');
		echo $this->Form->input('personnel_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Operations', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Personnels', true)), array('controller' => 'personnels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Personnel', true)), array('controller' => 'personnels', 'action' => 'add')); ?> </li>
	</ul>
</div>
