<div class="locations form">
<?php echo $this->Form->create('Location');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Location', true)); ?></legend>
	<?php
		echo $this->Form->input('tier_id');
		echo $this->Form->input('salle_id');
		echo $this->Form->input('checked_in',array('id'=>'DateEntree','type'=>'text'));
		echo $this->Form->input('depart',array('id'=>'DateSortie','type'=>'text'));
		echo $this->Form->input('moment',array('options'=>array('avant-midi'=>'avant-midi',
																'apres-midi'=>'apres-midi',
																'soir'=>'soir'
																)
											));
		echo $this->Form->input('etat',array('options'=>array('confirmed'=>'confirmeé',
																'canceled'=>'annuleé',
																)
											));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Locations', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister/Create %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Invoices', true)), array('controller' => 'factures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Facture', true)), array('controller' => 'factures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Salles', true)), array('controller' => 'salles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Salle', true)), array('controller' => 'salles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Location Extras', true)), array('controller' => 'location_extras', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Location Extra', true)), array('controller' => 'location_extras', 'action' => 'add')); ?> </li>
	</ul>
</div>
