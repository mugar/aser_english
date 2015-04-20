<div class="caisseInterdites view">
<h2><?php  __('Caisse Interdite');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $caisseInterdite['CaisseInterdite']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Personnel'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($caisseInterdite['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $caisseInterdite['Personnel']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Caiss'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($caisseInterdite['Caiss']['name'], array('controller' => 'caisses', 'action' => 'view', $caisseInterdite['Caiss']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Modifier %s', true), __('Caisse Interdite', true)), array('action' => 'edit', $caisseInterdite['CaisseInterdite']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Effacer %s', true), __('Caisse Interdite', true)), array('action' => 'delete', $caisseInterdite['CaisseInterdite']['id']), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $caisseInterdite['CaisseInterdite']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Caisse Interdites', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Caisse Interdite', true)), array('action' => 'add')); ?> </li>
		
		 
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Caisses', true)), array('controller' => 'caisses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Caiss', true)), array('controller' => 'caisses', 'action' => 'add')); ?> </li>
	</ul>
</div>
