<div class="caisseInterdites form">
<?php echo $this->Form->create('CaisseInterdite');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Caisse Interdite', true)); ?></legend>
	<?php
		echo $this->Form->input('personnel_id',array('multiple'=>true));
		echo $this->Form->input('caiss_id',array('multiple'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Caisse Interdites', true)), array('action' => 'index'));?></li>
		
		 
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Caisses', true)), array('controller' => 'caisses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Caiss', true)), array('controller' => 'caisses', 'action' => 'add')); ?> </li>
	</ul>
</div>
