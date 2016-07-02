<div class="comptes form">
<?php echo $this->Form->create('Compte');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Compte', true)); ?></legend>
	<?php
		echo $this->Form->input('numero');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Comptes', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Tier', true)), array('controller' => 'tiers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Compte Operations', true)), array('controller' => 'compte_operations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Compte Operation', true)), array('controller' => 'compte_operations', 'action' => 'add')); ?> </li>
	</ul>
</div>
