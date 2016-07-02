<div class="salaires form">
<?php echo $this->Form->create('Salaire');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Salaire', true)); ?></legend>
	<?php
		echo $this->Form->input('personnel_id');
		echo $this->Form->input('montant');
		echo $this->Form->input('HS');
		echo $this->Form->input('PRIME');
		echo $this->Form->input('ALLOC');
		echo $this->Form->input('SM');
		echo $this->Form->input('ASSUR');
		echo $this->Form->input('AVANCE');
		echo $this->Form->input('COTIS');
		echo $this->Form->input('date_debut');
		echo $this->Form->input('date_fin');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Salaires', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Personnels', true)), array('controller' => 'personnels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Personnel', true)), array('controller' => 'personnels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Paies', true)), array('controller' => 'paies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Paie', true)), array('controller' => 'paies', 'action' => 'add')); ?> </li>
	</ul>
</div>
