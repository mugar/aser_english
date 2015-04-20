<div class="historiqueChambres form">
<?php echo $this->Form->create('HistoriqueChambre');?>
	<fieldset>
 		<legend class="edit"><?php printf(__('Edit %s', true), __('Historique Chambre', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('personnel_id');
		echo $this->Form->input('chambres');
		echo $this->Form->input('etat');
		echo $this->Form->input('date');
		echo $this->Form->input('heure');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Envoyer', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Effacer', true), array('action' => 'delete', $this->Form->value('HistoriqueChambre.id')), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $this->Form->value('HistoriqueChambre.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Historique Chambres', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Personnels', true)), array('controller' => 'personnels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Personnel', true)), array('controller' => 'personnels', 'action' => 'add')); ?> </li>
	</ul>
</div>
