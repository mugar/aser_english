<div class="etages form">
<?php echo $this->Form->create('Etage');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Etage', true)); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Envoyer', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Etages', true)), array('action' => 'index'));?></li>
		
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Chambres', true)), array('controller' => 'chambres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Chambre', true)), array('controller' => 'chambres', 'action' => 'add')); ?> </li>
	</ul>
</div>
