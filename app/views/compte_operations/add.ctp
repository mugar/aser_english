<div class="compteOperations form">
<?php echo $this->Form->create('CompteOperation');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Compte Operation', true)); ?></legend>
	<?php
		echo $this->Form->input('date');
		echo $this->Form->input('compte_id');
		echo $this->Form->input('piece');
		echo $this->Form->input('libelle');
		echo $this->Form->input('debit');
		echo $this->Form->input('credit');
		echo $this->Form->input('personnel_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Envoyer', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Compte Operations', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Comptes', true)), array('controller' => 'comptes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Compte', true)), array('controller' => 'comptes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Personnels', true)), array('controller' => 'personnels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Personnel', true)), array('controller' => 'personnels', 'action' => 'add')); ?> </li>
	</ul>
</div>
