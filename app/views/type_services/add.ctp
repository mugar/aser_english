<div class="typeServices form">
<?php echo $this->Form->create('TypeService');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Type Service', true)); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('groupe_comptable_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Envoyer', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Type Services', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Services', true)), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Service', true)), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
