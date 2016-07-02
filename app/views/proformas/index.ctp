<div class="proformas index">
	<h2><?php __('Proformas');?></h2>
	<br>
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
			
		<th>Customer</th>	
		<th>Stock</th>
		<th>Product</th>
		<th>Quantité</th>
		<th>Unit Price</th>
		<th>Currency</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Proforma',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('tier_id',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('Product.stock_id',array('selected'=>0,'id'=>$i.'StockId','label'=>''));
				echo $ajax->observeField($i.'StockId',array('url' =>'/produits/stock'));?>
		</td>
		<td><?php echo $ajax->autoComplete($i.'produit','/produits/autoComplete/appro',array('id'=>$i.'produit',
																					'name'=>'data[Product][name]'));?>
		</td>
		<td><?php echo $this->Form->input('quantite',array('label'=>'','value'=>1));?></td>
		<td><?php echo $this->Form->input('PU',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('monnaie',array('label'=>''));?></td>
		<td><input type="submit" value="Save"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Proforma',array('name'=>'checkbox','id'=>'Proforma_proformas'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('tier_id');?></th>
			<th><?php echo $this->Paginator->sort('facture_id');?></th>
			<th><?php echo $this->Paginator->sort('produit_id');?></th>
			<th><?php echo $this->Paginator->sort('quantite');?></th>
			<th><?php echo $this->Paginator->sort('PU');?></th>
			<th><?php echo $this->Paginator->sort('montant');?></th>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
		</tr>
	<?php
	
	foreach ($proformas as $proforma):
		
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$proforma['Proforma']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$proforma['Proforma']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($proforma['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $proforma['Tier']['id'])); ?>
		</td>
		<td name="facture" valeur="<?php echo $proforma['Facture']['id']; ?>">
			<?php echo $this->Html->link($proforma['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $proforma['Facture']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($proforma['Product']['name'], array('controller' => 'produits', 'action' => 'view', $proforma['Product']['id'])); ?>
		</td>
		<td><?php echo $proforma['Proforma']['quantite']; ?>&nbsp;</td>
		<td><?php echo $proforma['Proforma']['PU']; ?>&nbsp;</td>
		<td><?php echo $proforma['Proforma']['montant'].' '.$proforma['Proforma']['monnaie']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($proforma['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $proforma['Personnel']['id'])); ?>
		</td>
	</tr>
<?php  endforeach; ?>
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
		<li class="link" onclick="actions('checkbox','edit')" >Edit</li>
		<li class="link" onclick="actions('checkbox','view')" >Afficher</li>
		<li class="link" onclick="actions('checkbox','delete')" >Delete</li>
		<?php echo $this->element('docs',array('actions'=>array('factures'),'type'=>'links')); ?>
		<li><?php echo $this->Html->link(sprintf(__('Lister/Create %s', true), __('Customers', true)), array('controller' => 'clients', 'action' => 'index')); ?> </li>
	</ul>
</div>

<!-- Divs for commande , bon & factures dialog-->
<?php echo $this->element('docs',array('actions'=>array('factures'),'model'=>'Proforma','type'=>'divs')); ?>
