<div class="paies form">
<?php echo $this->Form->create('Paie');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Paie', true)); ?></legend>
	<?php
		echo $this->Form->input('salaire_id');
		echo $this->Form->input('ILA');
		echo $this->Form->input('INDD');
		echo $this->Form->input('RBA');
		echo $this->Form->input('INSS');
		echo $this->Form->input('IPR');
		echo $this->Form->input('SNET');
		echo $this->Form->input('date');
		echo $this->Form->input('mois');
		echo $this->Form->input('annee');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Paies', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Salaires', true)), array('controller' => 'salaires', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Salaire', true)), array('controller' => 'salaires', 'action' => 'add')); ?> </li>
	</ul>
</div>
