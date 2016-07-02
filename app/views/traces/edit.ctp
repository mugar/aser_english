<div class="traces form">
<?php echo $this->Form->create('Trace');?>
	<fieldset>
 		<legend class="edit"><?php printf(__('Edit %s', true), __('Reservation Trace', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('reservation_id');
		echo $this->Form->input('operation');	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Trace.id')), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $this->Form->value('Trace.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Reservation Traces', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Reservations', true)), array('controller' => 'reservations', 'action' => 'index')); ?> </li>
		
		
	</ul>
</div>
