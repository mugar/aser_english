<?php $fonction = $session->read('Auth.Personnel.fonction_id'); ?>
<div class="produits view">
<h2><?php  __('Produit');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produit['Produit']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Stock'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($produit['Stock']['name'], array('controller' => 'stocks', 'action' => 'view', $produit['Stock']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Section'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($produit['Section']['name'], array('controller' => 'sections', 'action' => 'view', $produit['Section']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Groupe'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($produit['Groupe']['name'], array('controller' => 'groupes', 'action' => 'view', $produit['Groupe']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produit['Produit']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PA'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produit['Produit']['PA']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PAMP'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produit['Produit']['PAMP']; ?>
			&nbsp;
		</dd>
		
	<?php if($fonction!=8): ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('marge'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produit['Produit']['marge']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PVMP'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produit['Produit']['PVMP']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PV'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produit['Produit']['PV']; ?>
			&nbsp;
		</dd>
	<?php endif; ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Quantite'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produit['Produit']['quantite']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unite'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($produit['Unite']['name'], array('controller' => 'unites', 'action' => 'view', $produit['Unite']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produit['Produit']['total']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Monnaie'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produit['Produit']['monnaie']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Relations'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produit['Produit']['relations']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Minimum'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produit['Produit']['min']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Expiration'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produit['Produit']['expiration']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Actif'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produit['Produit']['actif']; ?>
			&nbsp;
		</dd>
	</dl>
	<br />
	<br />
	<?php if(!empty($relations)) :?>
	<fieldset class="produit">
		<legend>Relations</legend>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>id</th>
			<th>stock_id</th>
			<th>premier_produit_id</th>
			<th>relation</th>
			<th>deuxieme_produit_id</th>
			<th>quantite</th>
			<th>unite_id</th>
			<th>personnel_id</th>
			<th>created</th>
			<th>modified</th>
		</tr>
	<?php
	foreach ($relations as $relation):
		
	?>
	<tr<>
		
		<td><?php echo $relation['Relation']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($relation['Stock']['name'], array('controller' => 'stocks', 'action' => 'view', $relation['Stock']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($relation['PremierProduit']['name'], array('controller' => 'produits', 'action' => 'view', $relation['PremierProduit']['id'])); ?>
		</td>
		<td><?php echo $relation['Relation']['relation']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($relation['DeuxiemeProduit']['name'], array('controller' => 'produits', 'action' => 'view', $relation['DeuxiemeProduit']['id'])); ?>
		</td>
		<td><?php echo $relation['Relation']['quantite']; ?>&nbsp;</td><td>
			<?php echo $this->Html->link($relation['Unite']['name'], array('controller' => 'unites', 'action' => 'view', $relation['Unite']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($relation['Personnel']['name'], array('controller' => 'produits', 'action' => 'view', $relation['Personnel']['id'])); ?>
		</td>
		<td><?php echo $relation['Relation']['created']; ?>&nbsp;</td>
		<td><?php echo $relation['Relation']['modified']; ?>&nbsp;</td>
	</tr>
<?php   endforeach; ?>
	</table>
</fieldset>
<?php endif; ?>
<?php if(!empty($details)) :?>
	<fieldset class="produit">
		<legend>Details</legend>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Id</th>
			<th>Quantité</th>
			<th>PA</th>
			<th>Date (<?php echo $precision; ?>)</th>
			<th>Batch N°</th>
		</tr>
	<?php
	foreach ($details as $detail):
		
	?>
	<tr<>
		
		<td><?php echo $detail['ProduitDetail']['id']; ?>&nbsp;</td>
		<td><?php echo $detail['ProduitDetail']['quantite']; ?>&nbsp;</td>
		<td><?php echo $detail['ProduitDetail']['PA']; ?>&nbsp;</td>
		<td><?php echo $detail['ProduitDetail']['date']; ?>&nbsp;</td>
		<td><?php echo $detail['ProduitDetail']['batch']; ?>&nbsp;</td>
	</tr>
<?php   endforeach; ?>
	</table>
</fieldset>
<?php endif; ?>
<br />
<br/>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Modifier %s', true), __('Produit', true)), array('action' => 'edit', $produit['Produit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Produits', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Stocks', true)), array('controller' => 'stocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Sections', true)), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Groupes', true)), array('controller' => 'groupes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Relations', true)), array('controller' => 'relations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Entrees', true)), array('controller' => 'entrees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Sortis', true)), array('controller' => 'sortis', 'action' => 'index')); ?> </li>
	</ul>
</div>
