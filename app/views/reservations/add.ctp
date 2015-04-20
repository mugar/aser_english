<div class="reservations form">
<?php echo $this->Form->create('Reservation');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Add %s', true), __('Reservation', true)); ?></legend>
	<?php
		echo $this->Form->input('tier_id');
		echo $this->Form->input('type_chambre_id');
		echo $this->Form->input('nombre',array('class'=>''));
		echo $this->Form->input('adultes');
		echo $this->Form->input('enfants');
		echo $this->Form->input('arrivee',array('type'=>'text','id'=>'ArriveeDate'));
		echo $this->Form->input('depart',array('type'=>'text','id'=>'DepartDate'));
		echo $this->Form->input('discount');
		echo $this->Form->input('etat',array('options'=>array('confirmee'=>'confirmee',
															'annulee'=>'annulee',
															'en_attente'=>'en_attente'
															)));
		echo $this->Form->input('commentaire');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Envoyer', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Reservations', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister/Créer %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Type Chambres', true)), array('controller' => 'type_chambres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Type Chambre', true)), array('controller' => 'type_chambres', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Caisses', true)), array('controller' => 'caisses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Caiss', true)), array('controller' => 'caisses', 'action' => 'add')); ?> </li>
	</ul>
</div>
