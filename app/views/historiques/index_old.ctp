<div class="historiques index">
	<h2><?php __('Historiques');?></h2>
<!--form the checkbox stuff-->
	<?php echo $this->Form->create('Historique',array('name'=>'checkbox','action'=>'deleteAll','id'=>'Historique_historiques'));?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('caiss_id');?></th>
			<th><?php echo $this->Paginator->sort('tier_id');?></th>
			<th><?php echo $this->Paginator->sort('produit_id');?></th>
			<th><?php echo $this->Paginator->sort('quantite');?></th>
			<th><?php echo $this->Paginator->sort('montant');?></th>
			<th><?php echo $this->Paginator->sort('paiement');?></th>
			<th><?php echo $this->Paginator->sort('livrer');?></th>
			<th><?php echo $this->Paginator->sort('vidange');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
		</tr>
	<?php
	$i = 0;
	$j=0;
	foreach ($historiques as $historique):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
		<?php echo $this->Form->input('Id.'.$j.'',array('label'=>'','type'=>'checkbox','value'=>$historique['Historique']['id'])); ?>
		</td>
		<td><?php echo $historique['Historique']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($historique['Caiss']['name'], array('controller' => 'caisses', 'action' => 'view', $historique['Caiss']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($historique['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $historique['Tier']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($historique['Produit']['name'], array('controller' => 'produits', 'action' => 'view', $historique['Produit']['id'])); ?>
		</td>
		<td><?php echo $historique['Historique']['quantite']; ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['montant']; ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['paiement']; ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['livrer']; ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['vidange']; ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['date']; ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['modified']; ?>&nbsp;</td>
	</tr>
<?php $j++; endforeach; ?>
	</table>
</form>
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

<div id="separator" class="back" title="Cacher Le Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Historique', true)), array('action' => 'add')); ?></li>
		<li class= "link" onclick = "actions('checkbox','edit')" >Modifier</li>
		<li class="link"  onclick="actions('checkbox','view')" >Afficher</li>
		<li class="link" onclick="actions('checkbox','delete')" >Effacer</li>
		<li><?php echo $this->Html->link('Edition de rapport', array('action' => 'rapport')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Caisses', true)), array('controller' => 'caisses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Caiss', true)), array('controller' => 'caisses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister / Créer  %s', true), __('Produits', true)), array('controller' => 'produits', 'action' => 'index')); ?> </li>
	</ul>
</div>
