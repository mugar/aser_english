<div class="fonctions form">
<?php echo $this->Form->create('Fonction');?>
	<fieldset>
 		<legend class="edit"><?php printf(__('Edit %s', true), __('Fonction', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Fonction.id')), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $this->Form->value('Fonction.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Fonctions', true)), array('action' => 'index'));?></li>
	</ul>
</div>
