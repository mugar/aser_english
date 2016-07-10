<div class="services form">
<?php echo $this->Form->create('Service');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Service', true)); ?></legend>
	<?php
		echo $this->Form->input('tier_id');
		echo $this->Form->input('type_service_id');
		echo $this->Form->input('montant');
		echo $this->Form->input('monnaie',array('label'=>'Currency'));
		echo $this->Form->input('description');
		 
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Services', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister/Create %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Invoices', true)), array('controller' => 'factures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Facture', true)), array('controller' => 'factures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Type Services', true)), array('controller' => 'type_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Type Service', true)), array('controller' => 'type_services', 'action' => 'add')); ?> </li>
		
	</ul>
</div>
