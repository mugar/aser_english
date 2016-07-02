<div class="locationExtras form">
<?php echo $this->Form->create('LocationExtra');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Location Extra', true)); ?></legend>
	<?php
		echo $this->Form->input('location_id');
		echo $this->Form->input('name');
		echo $this->Form->input('quantite');
		echo $this->Form->input('PU');
		echo $this->Form->input('montant');
		echo $this->Form->input('monnaie');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Location Extras', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Locations', true)), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Location', true)), array('controller' => 'locations', 'action' => 'add')); ?> </li>
	</ul>
</div>
