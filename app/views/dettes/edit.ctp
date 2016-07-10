<div class="dettes form">
<?php echo $this->Form->create('Dette');?>
	<fieldset>
 		<legend class="edit"><?php printf(__('Edit %s', true), __('Dette', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tier_id');
		echo $this->Form->input('montant');
		echo $this->Form->input('monnaie',array('label'=>'Currency'));
		echo $this->Form->input('max',array('label'=>'Maximum ou Plafond'));
		echo $this->Form->input('type',array('options'=>array('court'=>'Court terme',
															'moyen'=>'Moyen terme',
															'long'=>'Long terme'
															)));
		 
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Dette.id')), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $this->Form->value('Dette.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Dettes', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister/Create %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		
		 
	</ul>
</div>
