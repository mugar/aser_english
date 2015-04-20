<div class="services form">
<?php echo $this->Form->create('Service');?>
	<fieldset>
 		<legend class="edit"><?php printf(__('Edit %s', true), __('Service', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tier_id');
		echo $this->Form->input('type_service_id');
		echo $this->Form->input('montant');
		echo $this->Form->input('monnaie');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Envoyer', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Effacer', true), array('action' => 'delete', $this->Form->value('Service.id')), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $this->Form->value('Service.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Services', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister/Créer %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Factures', true)), array('controller' => 'factures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Facture', true)), array('controller' => 'factures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Type Services', true)), array('controller' => 'type_services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Type Service', true)), array('controller' => 'type_services', 'action' => 'add')); ?> </li>
		
	</ul>
</div>
