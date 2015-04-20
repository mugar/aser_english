<div class="ventes index">
	<h2><?php __('Ventes');?></h2>	
	
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Vente',array('id'=>'recherche'));?>
	<span class="left">
		<?php
		echo $this->Form->input('Produit.name',array('value'=>'toutes'));
		?>
	</span>
	<span class="right">
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
		<br>
	<?php echo $this->Form->create('Vente',array('name'=>'checkbox','id'=>'Vente_ventes'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr id="first">
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('tier_id');?></th>
			<th><?php echo $this->Paginator->sort('facture_id');?></th>
			<th><?php echo $this->Paginator->sort('Paiement','Facture.etat');?></th>
			<th><?php echo $this->Paginator->sort('stock_id');?></th>
			<th><?php echo $this->Paginator->sort('produit_id');?></th>
			<th><?php echo $this->Paginator->sort('quantite');?></th>
			<th><?php echo $this->Paginator->sort('unite_id');?></th>
			<th><?php echo $this->Paginator->sort('PU');?></th>
			<th><?php echo $this->Paginator->sort('montant');?></th>
			<th><?php echo $this->Paginator->sort('benefice');?></th>
			<th><?php echo $this->Paginator->sort('monnaie');?></th>
			<th><?php echo $this->Paginator->sort('echange');?></th>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
		</tr>
	<?php
	
	foreach ($ventes as $vente):
		
	?>
	<tr id="<?php echo $vente['Vente']['id']; ?>">
		<td>
			<?php echo $this->Form->input('Id.'.$vente['Vente']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$vente['Vente']['id'])); ?>
		</td>
		<td><?php echo $vente['Vente']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($vente['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $vente['Tier']['id'])); ?>
		</td>
		<td name="facture" valeur="<?php echo $vente['Facture']['id']; ?>">
			<?php echo $this->Html->link($vente['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $vente['Facture']['id'])); ?>
		</td>
		<td><?php echo $vente['Facture']['etat']; ?>&nbsp;</td><td>
			<?php echo $this->Html->link($vente['Stock']['name'], array('controller' => 'stocks', 'action' => 'view', $vente['Stock']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($vente['Produit']['name'], array('controller' => 'produits', 'action' => 'view', $vente['Produit']['id'])); ?>
		</td>
		<td><?php echo $vente['Vente']['quantite']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($vente['Unite']['name'], array('controller' => 'unites', 'action' => 'view', $vente['Unite']['id'])); ?>
		</td>
		<td><?php echo $vente['Vente']['PU']; ?>&nbsp;</td>
		<td><?php echo $vente['Vente']['montant']; ?>&nbsp;</td>
		<td><?php echo $vente['Vente']['benefice']; ?>&nbsp;</td>
		<td><?php echo $vente['Vente']['monnaie']; ?>&nbsp;</td>
		<td><?php echo $vente['Vente']['echange']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($vente['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $vente['Personnel']['id'])); ?>
		</td>
		<td><?php echo $vente['Vente']['created']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
</form>
	<div id='model_details' style='display:none;'></div>
	<div id="pagination">
		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page %page% de %pages%, affichage de %current% enregistrements sur %count% au total, à partir du numéro %start%, jusqu\'au numéro %end%', true)
		));
		?>	</p>

		<div class="paging">
			<?php echo $this->Paginator->prev('<< '.__('précédent', true), array(), null, array('class'=>'disabled'));?>
		 | 	<?php echo $this->Paginator->numbers();?>
	 |
			<?php echo $this->Paginator->next(__('suivant', true).' >>', array(), null, array('class' => 'disabled'));?>
		</div>
	</div>
</div>
<div id="separator" class="back" title="Cacher Le Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li class="link"  onclick = "model_details('checkbox','index')" >Lister/Masquer les Détails</li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Entrees', true)), array('controller' => 'entrees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister / Créer  %s', true), __('Produits', true)), array('controller' => 'produits', 'action' => 'index')); ?> </li>
	</ul>
</div>
