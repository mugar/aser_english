<div class="affectations form">
<?php echo $this->Form->create('Affectation');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Affectation', true)); ?></legend>
	<?php
		echo $this->Form->input('reservation_id');
		echo $this->Form->input('chambre_id');
		echo $this->Form->input('tier_id');
		echo $this->Form->input('etat');
		echo $this->Form->input('heure_arrivee');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Affectations', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Reservations', true)), array('controller' => 'reservations', 'action' => 'index')); ?> </li>
		
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Chambres', true)), array('controller' => 'chambres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Chambre', true)), array('controller' => 'chambres', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister/Create %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		
		 
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Ventes', true)), array('controller' => 'ventes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Vente', true)), array('controller' => 'ventes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Sortideservices', true)), array('controller' => 'sortideservices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Sortideservice', true)), array('controller' => 'sortideservices', 'action' => 'add')); ?> </li>
	</ul>
</div>
