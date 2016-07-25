<div class="final_stocks view">
<h2><?php  __('FinalStock');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $final_stock['FinalStock']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tier'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($final_stock['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $final_stock['Tier']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Commande'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($final_stock['Commande']['numero'], array('controller' => 'commandes', 'action' => 'view', $final_stock['Commande']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bon'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($final_stock['Bon']['numero'], array('controller' => 'bons', 'action' => 'view', $final_stock['Bon']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Facture'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($final_stock['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $final_stock['Facture']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Produit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($final_stock['Produit']['name'], array('controller' => 'produits', 'action' => 'view', $final_stock['Produit']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Quantite'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $final_stock['FinalStock']['quantite']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Conversion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $final_stock['FinalStock']['conversion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Montant'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $final_stock['FinalStock']['montant']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Echange'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $final_stock['FinalStock']['echange']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Expiration Details'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $final_stock['FinalStock']['expiration_details']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Personnel'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($final_stock['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $final_stock['Personnel']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $final_stock['FinalStock']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $final_stock['FinalStock']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('FinalStock', true)), array('action' => 'edit', $final_stock['FinalStock']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s', true), __('FinalStock', true)), array('action' => 'delete', $final_stock['FinalStock']['id']), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $final_stock['FinalStock']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('FinalStocks', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('FinalStock', true)), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister/Create %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Commandes', true)), array('controller' => 'commandes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Commande', true)), array('controller' => 'commandes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Bons', true)), array('controller' => 'bons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Bon', true)), array('controller' => 'bons', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Invoices', true)), array('controller' => 'factures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Facture', true)), array('controller' => 'factures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister / Créer  %s', true), __('Products', true)), array('controller' => 'produits', 'action' => 'index')); ?> </li>
		
		 
	</ul>
</div>
