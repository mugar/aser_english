<div class="historiqueChambres form">
<?php echo $this->Form->create('HistoriqueChambre');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Historique Chambre', true)); ?></legend>
	<?php
		echo $this->Form->input('personnel_id');
		echo $this->Form->input('chambres');
		echo $this->Form->input('etat');
		echo $this->Form->input('date');
		echo $this->Form->input('heure');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Historique Chambres', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Personnels', true)), array('controller' => 'personnels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Personnel', true)), array('controller' => 'personnels', 'action' => 'add')); ?> </li>
	</ul>
</div>
