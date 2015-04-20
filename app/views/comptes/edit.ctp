<div class="comptes form">
<?php echo $this->Form->create('Compte');?>
	<fieldset>
 		<legend class="edit"><?php printf(__('Edit %s', true), __('Compte', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('numero');
		echo $this->Form->input('name');
		echo $this->Form->input('type',array('options'=>array('actif'=>'actif','passif'=>'passif')));
		echo $this->Form->input('actif',array('options'=>array('oui'=>'oui','non'=>'non')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Envoyer', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Comptes', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Compte Operations', true)), array('controller' => 'compte_operations', 'action' => 'index')); ?> </li>
	</ul>
</div>
