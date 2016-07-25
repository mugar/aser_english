<div class="final_stocks index">
	<h2><?php __('FinalStocks');?></h2>
<!--form the checkbox stuff-->
	<?php echo $this->Form->create('FinalStock',array('name'=>'checkbox','action'=>'deleteAll','id'=>'FinalStock_final_stocks'));?>
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
	foreach ($final_stocks as $final_stock):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
		<?php echo $this->Form->input('Id.'.$j.'',array('label'=>'','type'=>'checkbox','value'=>$final_stock['FinalStock']['id'])); ?>
		</td>
		<td><?php echo $final_stock['FinalStock']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($final_stock['Caiss']['name'], array('controller' => 'caisses', 'action' => 'view', $final_stock['Caiss']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($final_stock['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $final_stock['Tier']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($final_stock['Produit']['name'], array('controller' => 'produits', 'action' => 'view', $final_stock['Produit']['id'])); ?>
		</td>
		<td><?php echo $final_stock['FinalStock']['quantite']; ?>&nbsp;</td>
		<td><?php echo $final_stock['FinalStock']['montant']; ?>&nbsp;</td>
		<td><?php echo $final_stock['FinalStock']['paiement']; ?>&nbsp;</td>
		<td><?php echo $final_stock['FinalStock']['livrer']; ?>&nbsp;</td>
		<td><?php echo $final_stock['FinalStock']['vidange']; ?>&nbsp;</td>
		<td><?php echo $final_stock['FinalStock']['date']; ?>&nbsp;</td>
		<td><?php echo $final_stock['FinalStock']['modified']; ?>&nbsp;</td>
	</tr>
<?php $j++; endforeach; ?>
	</table>
</form>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing  %current% records out of %count%, from %start%, to %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>

<div id="separator" class="back" title="Hide the Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('FinalStock', true)), array('action' => 'add')); ?></li>
		<li class= "link" onclick = "actions('checkbox','edit')" >Edit</li>
		<li class="link"  onclick="actions('checkbox','view')" >Afficher</li>
		<li class="link" onclick="actions('checkbox','delete')" >Delete</li>
		<li><?php echo $this->Html->link('Edition de rapport', array('action' => 'rapport')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Caisses', true)), array('controller' => 'caisses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Caiss', true)), array('controller' => 'caisses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister / Créer  %s', true), __('Products', true)), array('controller' => 'produits', 'action' => 'index')); ?> </li>
	</ul>
</div>
