<div class="ventes form">
<?php echo $this->Form->create('Vente');?>
<fieldset class="resto">
 		<legend class="add"><?php printf(__('Add %s', true), __('Vente', true)); ?></legend>
 	<fieldset id="resto_options" ><legend onclick="jQuery.toggle('#resto_options')" title="Show/Hide" style="cursor:pointer;">Paramètres</legend>
 	<div id='resto_options'>
		<span class="left">
		<?php
			echo $this->Form->input('caiss_id',array('class'=>'select',
													'label'=>'Nom de la caisse',
													'title'=>'Séléctionner la caisse qui va recevoir l\'argent'));
			echo $this->Form->input('paiement',array('options'=>array('cash'=>'cash',
																'credit'=>'credit',
																'interne'=>'interne',
																'gratuit'=>'gratuit',
																'promotion'=>'promotion'
																),
													'label'=>'Mode de paiement',
													'title'=>'Le mode de paiement utilisé par exemple "cash" ou "gratuit" si ça été donné gratuitement'
												));
			echo $this->Form->input('personnel_id',array('label'=>'Nom du Personnel',
													'title'=>'Le serveur/serveuse qui a servit le client'
													));
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
			 echo $this->Form->input('date',array('type'=>'text',
			 									'label'=>'choisir la date',
			 									'title'=>'Choisir la date à laquelle a eu l\'opération'));
		?>
		</span>
		
		<?php if(Configure::read('aser.hotel')):?>
		<span id="recherche_clients" onclick="guest('Vente')" title="Lancer la recherche des clients">GO</span>
			<?php endif;?>
		<div style="clear:both;"></div>
	</div>
	</fieldset>
	<fieldset class="list"><legend>Menu</legend>
		<fieldset class='ingredient'>
 			<legend>Liste des Boissons</legend>
			<?php foreach($groupes as $groupe):?>
			<div class="items" >
				<h4 onclick="Element.toggle($('personnel'))" style="cursor:pointer;"><?php echo $groupe['Groupe']['name']?></h4>
				<div id="personnel">
					<?php 
					foreach($groupe['Produit'] as $produit) {
						echo $this->Form->input('Produit.'.$produit['id'],array('label'=>$produit['name']));
					}
					?>
				</div>
			</div>
 			<?php endforeach; ?>
		</fieldset>
		<fieldset class='ingredient'>
 			<legend>Liste des Plats</legend>
			<?php $j=0; foreach($categories as $category):?>
			<div class='items'>
				<h4 onclick="Element.toggle($('category<?php echo $j?>'))" style="cursor:pointer;"><?php echo $category['Category']['name']?></h4>
				<div id="category<?php echo $j?>">
					<?php 
					foreach($category['Plat'] as $plat) {
						echo $this->Form->input('Plat.'.$plat['id'],array('label'=>$plat['name']));
					}
					?>
				</div>
			</div>
 			<?php $j++ ;endforeach; ?>
		</fieldset>
	</fieldset>
</fieldset>
<?php echo $this->Form->end(__('Save', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Vente.id')), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $this->Form->value('Vente.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Ventes', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Caisses', true)), array('controller' => 'caisses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Caiss', true)), array('controller' => 'caisses', 'action' => 'add')); ?> </li>
		
		 
		<li><?php echo $this->Html->link(sprintf(__('Lister/Create %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
	</ul>
</div>
