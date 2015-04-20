<div class="paies form">
<?php echo $this->Form->create('Paie');?>
	<fieldset>
 		<legend class="edit"><?php printf(__('Edit %s', true), __('Paie', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('salaire_id');
		echo $this->Form->input('ILA');
		echo $this->Form->input('INDD');
		echo $this->Form->input('RBA');
		echo $this->Form->input('INSS');
		echo $this->Form->input('IPR');
		echo $this->Form->input('SNET');
		echo $this->Form->input('date');
		echo $this->Form->input('mois');
		echo $this->Form->input('annee');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Envoyer', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Effacer', true), array('action' => 'delete', $this->Form->value('Paie.id')), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $this->Form->value('Paie.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Paies', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Salaires', true)), array('controller' => 'salaires', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Salaire', true)), array('controller' => 'salaires', 'action' => 'add')); ?> </li>
	</ul>
</div>
