<div class="typeServices form">
<?php echo $this->Form->create('TypeService');?>
	<fieldset>
 		<legend class="edit"><?php printf(__('Edit %s', true), __('Type Service', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('groupe_comptable_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('TypeService.id')), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $this->Form->value('TypeService.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Type Services', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Services', true)), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Service', true)), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
