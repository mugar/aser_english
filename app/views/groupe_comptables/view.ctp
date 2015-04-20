<div class="groupeComptables view">
<h2><?php  __('Groupe Comptable');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupeComptable['GroupeComptable']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupeComptable['GroupeComptable']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupeComptable['GroupeComptable']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Modifier %s', true), __('Groupe Comptable', true)), array('action' => 'edit', $groupeComptable['GroupeComptable']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Effacer %s', true), __('Groupe Comptable', true)), array('action' => 'delete', $groupeComptable['GroupeComptable']['id']), null, sprintf(__('Voulez vous vraiment effacer l\'enregistrement N° %s ?', true), $groupeComptable['GroupeComptable']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Groupe Comptables', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Groupe Comptable', true)), array('action' => 'add')); ?> </li>
	</ul>
</div>
