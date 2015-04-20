<div class="ventes form">
<?php echo $this->Form->create('Vente');?>
<fieldset class="resto">
 		<legend class="add"><?php printf(__('Add %s', true), __('Vente', true)); ?></legend>
 	<fieldset id="resto_options" ><legend onclick="jQuery.toggle('#resto_options')" title="Afficher/Masquer" style="cursor:pointer;">Paramètres</legend>
 	<div id='resto_options'>
		<span class="left">
		<?php
			echo $this->Form->input('stock_id',array('selected'=>0));
   			echo $ajax->observeField('VenteStockId',array('url' => 'resto_menu','update' => 'resto_menu','indicator'=>'loading'));
			echo $this->Form->input('personnel_id',array('label'=>'Nom du Personnel',
													'title'=>'Le serveur/serveuse qui a servit le client'
													));
			 echo $this->Form->input('date',array('type'=>'text',
			 									'label'=>'choisir la date',
			 									'title'=>'Choisir la date à laquelle a eu l\'opération'));
		?>
		</span>
		<span class="right">
		<?php 
			if(Configure::read('aser.hotel')):?>
  				<?php echo $this->Form->input('chambre',array('id'=>'chambre','label'=>'Numéro de la chambre',
  															'title'=>'Pour afficher les clients de l\'hôtel occupant une chambre donné'));?>
				<span id="guests"></span>
			<?php endif;?>
			<?php	echo '<span id="tier_hotel">'.$this->Form->input('tier_id',array('label'=>'Choisir le client',
																					'title'=>'Choisir le client qui a fait la commande'
																						)
																	).'</span>';
		?>
		</span>
		
		<?php if(Configure::read('aser.hotel')):?>
		<span id="recherche_clients" onclick="guest('Vente')" title="Lancer la recherche des clients">GO</span>
			<?php endif;?>
		<div style="clear:both;"></div>
	</div>
	</fieldset>
	<fieldset class="list"><legend>Menu</legend>
	<div id="resto_menu"><span id="loading" style="display:none;">Chargement ...</span></div>
	</fieldset>
</fieldset>
<?php echo $this->Form->end(__('Envoyer', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Ventes', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Caisses', true)), array('controller' => 'caisses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Caiss', true)), array('controller' => 'caisses', 'action' => 'add')); ?> </li>
		
		 
		<li><?php echo $this->Html->link(sprintf(__('Lister/Créer %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
	</ul>
</div>
