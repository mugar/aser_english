<div class="caisseInterdites form">
<?php echo $this->Form->create('CaisseInterdite');?>
	<fieldset>
 		<legend class="edit"><?php printf(__('Edit %s', true), __('Caisse Interdite', true)); ?></legend>
	<?php
		echo $this->Form->input('id');		
		echo $this->Form->input('caiss_id');	
		echo $this->Form->input('personnel_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Envoyer', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Effacer', true), array('action' => 'delete', $this->Form->value('CaisseInterdite.id')), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $this->Form->value('CaisseInterdite.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Caisse Interdites', true)), array('action' => 'index'));?></li>
		
		 
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Caisses', true)), array('controller' => 'caisses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Caiss', true)), array('controller' => 'caisses', 'action' => 'add')); ?> </li>
	</ul>
</div>
