<div class="dettes form">
<?php echo $this->Form->create('Dette');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Dette', true)); ?></legend>
	<?php
		echo $this->Form->input('tier_id');
		echo $this->Form->input('montant');
		echo $this->Form->input('monnaie',array('label'=>'Currency'));
		echo $this->Form->input('max',array('label'=>'Montant Maximal'));
		echo $this->Form->input('date_limite',array('type'=>'text'));
		 
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Dettes', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister/Create %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		
		 
	</ul>
</div>
