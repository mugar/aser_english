<div class="historiques form">
<?php echo $this->Form->create('Historique');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Historique', true)); ?></legend>
	<?php
		echo $this->Form->input('num_operation');
		echo $this->Form->input('num_debit');
		echo $this->Form->input('num_credit');
		echo $this->Form->input('model');
		echo $this->Form->input('id_element');
		echo $this->Form->input('libelle');
		echo $this->Form->input('debit');
		echo $this->Form->input('credit');	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Historiques', true)), array('action' => 'index'));?></li>
		
	</ul>
</div>
