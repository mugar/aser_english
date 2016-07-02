<div class="proformas form">
<?php echo $this->Form->create('Proforma');?>
	<fieldset>
 		<legend class="edit"><?php printf(__('Edit %s', true), __('Proforma', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tier_id');
		echo $this->element('auto_complete',array('selected'=>true));
		echo $this->Form->input('quantite');
		echo $this->Form->input('unite_id');
		echo $this->Form->input('PU');
		echo $this->Form->input('monnaie');	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Proforma.id')), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $this->Form->value('Proforma.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Proformas', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Invoices', true)), array('controller' => 'factures', 'action' => 'index')); ?> </li>
		
	</ul>
</div>
