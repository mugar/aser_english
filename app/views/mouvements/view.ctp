<div class="mouvements view">
<h2><?php  __('Mouvement');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mouvement['Mouvement']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Produit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($mouvement['Produit']['name'], array('controller' => 'produits', 'action' => 'view', $mouvement['Produit']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Quantite'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mouvement['Mouvement']['quantite']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Stock Sortant'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($mouvement['StockSortant']['name'], array('controller' => 'stocks', 'action' => 'view', $mouvement['StockSortant']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('First Personnel'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($mouvement['FirstPersonnel']['name'], array('controller' => 'personnels', 'action' => 'view', $mouvement['FirstPersonnel']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Creation'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mouvement['Mouvement']['creation']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modification'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mouvement['Mouvement']['modification']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Stock Entrant'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($mouvement['StockEntrant']['name'], array('controller' => 'stocks', 'action' => 'view', $mouvement['StockEntrant']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Second Personnel'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($mouvement['SecondPersonnel']['name'], array('controller' => 'personnels', 'action' => 'view', $mouvement['SecondPersonnel']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Confirmation'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mouvement['Mouvement']['confirmation']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Echange'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mouvement['Mouvement']['echange']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mouvement['Mouvement']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Expiration Details'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mouvement['Mouvement']['expiration_details']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('Mouvement', true)), array('action' => 'edit', $mouvement['Mouvement']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Delete %s', true), __('Mouvement', true)), array('action' => 'delete', $mouvement['Mouvement']['id']), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $mouvement['Mouvement']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Mouvements', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Mouvement', true)), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister / Créer  %s', true), __('Products', true)), array('controller' => 'produits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Stocks', true)), array('controller' => 'stocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Stock Sortant', true)), array('controller' => 'stocks', 'action' => 'add')); ?> </li>
		
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('First Personnel', true)), array('controller' => 'personnels', 'action' => 'add')); ?> </li>
	</ul>
</div>
