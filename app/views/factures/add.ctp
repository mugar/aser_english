<div class="factures form">
<?php echo $this->Form->create('Facture');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Facture', true)); ?></legend>
	<?php
		echo $this->Form->input('tier_id');
		echo $this->Form->input('numero');
		echo $this->Form->input('operation');
		echo $this->Form->input('montant');
		echo $this->Form->input('reste');
		echo $this->Form->input('monnaie');
		echo $this->Form->input('etat');
		echo $this->Form->input('date');
		echo $this->Form->input('echeance');
		echo $this->Form->input('classee');
		echo $this->Form->input('observation');	?>
	</fieldset>
<?php echo $this->Form->end(__('Envoyer', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Factures', true)), array('action' => 'index'));?></li>
		
		<li><?php echo $this->Html->link(sprintf(__('Lister/Créer %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Entrees', true)), array('controller' => 'entrees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Entree', true)), array('controller' => 'entrees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Entretien Chambres', true)), array('controller' => 'entretien_chambres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Entretien Chambre', true)), array('controller' => 'entretien_chambres', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Ventes', true)), array('controller' => 'ventes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Vente', true)), array('controller' => 'ventes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Paiements', true)), array('controller' => 'paiements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Paiement', true)), array('controller' => 'paiements', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Reservations', true)), array('controller' => 'reservations', 'action' => 'index')); ?> </li>
		
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Services', true)), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Service', true)), array('controller' => 'services', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Sortis', true)), array('controller' => 'sortis', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Sorti', true)), array('controller' => 'sortis', 'action' => 'add')); ?> </li>
	</ul>
</div>
