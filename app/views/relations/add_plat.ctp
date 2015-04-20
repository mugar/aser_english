<div class="plats form">
<?php echo $this->Form->create('Relation');?>
	<fieldset>
 		<legend class="add"><?php printf(__('Ajouter %s', true), __('Plat', true)); ?></legend>
	<?php
		echo $this->Form->input('PremierProduit.groupe_id');
		echo $this->Form->input('PremierProduit.stock_id',array('selected'=>0));
   		echo $ajax->observeField('PremierProduitStockId',array('url' => 'ingredients','update' => 'ing','indicator'=>'loading'));
		echo $this->Form->input('PremierProduit.name');
		echo $this->Form->input('PremierProduit.PV',array('value'=>0));
		echo $this->Form->input('PremierProduit.relations',array('multiple'=>true,
																'options'=>array(
																	'simple'=>'simple',
																	'figuratif'=>'figuratif',
																	'paquet_I'=>'paquet_I',
																	'paquet_II'=>'paquet_II',
																	'composant_I'=>'composant_I',
																	'composant_II'=>'composant_II',
																	)
														));
	?>
		<fieldset class='ingredient'>
 			<legend>Liste des Ingredients</legend>
 			<div id="ing"><span id="loading" style="display:none;">Chargement ...</span></div>
		</fieldset>
	</fieldset>
<?php echo $this->Form->end(__('Envoyer', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Relation', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Groupes', true)), array('controller' => 'groupes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Groupes', true)), array('controller' => 'groupes', 'action' => 'add')); ?> </li>
	</ul>
</div>