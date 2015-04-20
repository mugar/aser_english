<div class="journals view">
<h2><?php  __('Journal');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journal['Journal']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Numero'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journal['Journal']['numero']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journal['Journal']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ventes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journal['Journal']['ventes']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cash'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journal['Journal']['cash']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Credit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journal['Journal']['credit']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bonus'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journal['Journal']['bonus']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Paiements'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journal['Journal']['paiements']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ajouts'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journal['Journal']['ajouts']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Depenses'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journal['Journal']['depenses']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Versement'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journal['Journal']['versement']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Observation'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journal['Journal']['observation']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Personnel'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($journal['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $journal['Personnel']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Closed'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $journal['Journal']['closed']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Journal', true), array('action' => 'edit', $journal['Journal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Journal', true), array('action' => 'delete', $journal['Journal']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $journal['Journal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Journals', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Journal', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personnels', true), array('controller' => 'personnels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personnel', true), array('controller' => 'personnels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Factures', true), array('controller' => 'factures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Facture', true), array('controller' => 'factures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Operations', true), array('controller' => 'operations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Operation', true), array('controller' => 'operations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Paiements', true), array('controller' => 'paiements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paiement', true), array('controller' => 'paiements', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Factures');?></h3>
	<?php if (!empty($journal['Facture'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Journal Id'); ?></th>
		<th><?php __('Tier Id'); ?></th>
		<th><?php __('Numero'); ?></th>
		<th><?php __('Operation'); ?></th>
		<th><?php __('Montant'); ?></th>
		<th><?php __('Reste'); ?></th>
		<th><?php __('Tva'); ?></th>
		<th><?php __('Monnaie'); ?></th>
		<th><?php __('Etat'); ?></th>
		<th><?php __('Date'); ?></th>
		<th><?php __('Classee'); ?></th>
		<th><?php __('Printed'); ?></th>
		<th><?php __('Table'); ?></th>
		<th><?php __('Observation'); ?></th>
		<th><?php __('Date Emission'); ?></th>
		<th><?php __('Personnel Id'); ?></th>
		<th><?php __('Reduction'); ?></th>
		<th><?php __('Original'); ?></th>
		<th><?php __('Beneficiaire'); ?></th>
		<th><?php __('Matricule'); ?></th>
		<th><?php __('Liasse'); ?></th>
		<th><?php __('Employeur'); ?></th>
		<th><?php __('Pos'); ?></th>
		<th><?php __('Cash'); ?></th>
		<th><?php __('Linked'); ?></th>
		<th><?php __('Chambre Id'); ?></th>
		<th><?php __('Inclure'); ?></th>
		<th><?php __('Aserb Num'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($journal['Facture'] as $facture):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $facture['id'];?></td>
			<td><?php echo $facture['journal_id'];?></td>
			<td><?php echo $facture['tier_id'];?></td>
			<td><?php echo $facture['numero'];?></td>
			<td><?php echo $facture['operation'];?></td>
			<td><?php echo $facture['montant'];?></td>
			<td><?php echo $facture['reste'];?></td>
			<td><?php echo $facture['tva'];?></td>
			<td><?php echo $facture['monnaie'];?></td>
			<td><?php echo $facture['etat'];?></td>
			<td><?php echo $facture['date'];?></td>
			<td><?php echo $facture['classee'];?></td>
			<td><?php echo $facture['printed'];?></td>
			<td><?php echo $facture['table'];?></td>
			<td><?php echo $facture['observation'];?></td>
			<td><?php echo $facture['date_emission'];?></td>
			<td><?php echo $facture['personnel_id'];?></td>
			<td><?php echo $facture['reduction'];?></td>
			<td><?php echo $facture['original'];?></td>
			<td><?php echo $facture['beneficiaire'];?></td>
			<td><?php echo $facture['matricule'];?></td>
			<td><?php echo $facture['liasse'];?></td>
			<td><?php echo $facture['employeur'];?></td>
			<td><?php echo $facture['pos'];?></td>
			<td><?php echo $facture['cash'];?></td>
			<td><?php echo $facture['linked'];?></td>
			<td><?php echo $facture['chambre_id'];?></td>
			<td><?php echo $facture['inclure'];?></td>
			<td><?php echo $facture['aserb_num'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'factures', 'action' => 'view', $facture['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'factures', 'action' => 'edit', $facture['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'factures', 'action' => 'delete', $facture['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $facture['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Facture', true), array('controller' => 'factures', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Operations');?></h3>
	<?php if (!empty($journal['Operation'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Journal Id'); ?></th>
		<th><?php __('Element Id'); ?></th>
		<th><?php __('Model'); ?></th>
		<th><?php __('Op Num'); ?></th>
		<th><?php __('Piece'); ?></th>
		<th><?php __('Debit'); ?></th>
		<th><?php __('Credit'); ?></th>
		<th><?php __('Monnaie'); ?></th>
		<th><?php __('Ordre'); ?></th>
		<th><?php __('Libelle'); ?></th>
		<th><?php __('Mode Paiement'); ?></th>
		<th><?php __('Date'); ?></th>
		<th><?php __('Personnel Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Auto'); ?></th>
		<th><?php __('Compte Id'); ?></th>
		<th><?php __('Common'); ?></th>
		<th><?php __('Ignore'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($journal['Operation'] as $operation):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $operation['id'];?></td>
			<td><?php echo $operation['journal_id'];?></td>
			<td><?php echo $operation['element_id'];?></td>
			<td><?php echo $operation['model'];?></td>
			<td><?php echo $operation['op_num'];?></td>
			<td><?php echo $operation['piece'];?></td>
			<td><?php echo $operation['debit'];?></td>
			<td><?php echo $operation['credit'];?></td>
			<td><?php echo $operation['monnaie'];?></td>
			<td><?php echo $operation['ordre'];?></td>
			<td><?php echo $operation['libelle'];?></td>
			<td><?php echo $operation['mode_paiement'];?></td>
			<td><?php echo $operation['date'];?></td>
			<td><?php echo $operation['personnel_id'];?></td>
			<td><?php echo $operation['created'];?></td>
			<td><?php echo $operation['auto'];?></td>
			<td><?php echo $operation['compte_id'];?></td>
			<td><?php echo $operation['common'];?></td>
			<td><?php echo $operation['ignore'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'operations', 'action' => 'view', $operation['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'operations', 'action' => 'edit', $operation['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'operations', 'action' => 'delete', $operation['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $operation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Operation', true), array('controller' => 'operations', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Paiements');?></h3>
	<?php if (!empty($journal['Paiement'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Journal Id'); ?></th>
		<th><?php __('Facture Id'); ?></th>
		<th><?php __('Montant'); ?></th>
		<th><?php __('Montant Equivalent'); ?></th>
		<th><?php __('Monnaie'); ?></th>
		<th><?php __('Mode Paiement'); ?></th>
		<th><?php __('Reference'); ?></th>
		<th><?php __('Pyt Id'); ?></th>
		<th><?php __('Date'); ?></th>
		<th><?php __('Personnel Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($journal['Paiement'] as $paiement):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $paiement['id'];?></td>
			<td><?php echo $paiement['journal_id'];?></td>
			<td><?php echo $paiement['facture_id'];?></td>
			<td><?php echo $paiement['montant'];?></td>
			<td><?php echo $paiement['montant_equivalent'];?></td>
			<td><?php echo $paiement['monnaie'];?></td>
			<td><?php echo $paiement['mode_paiement'];?></td>
			<td><?php echo $paiement['reference'];?></td>
			<td><?php echo $paiement['pyt_id'];?></td>
			<td><?php echo $paiement['date'];?></td>
			<td><?php echo $paiement['personnel_id'];?></td>
			<td><?php echo $paiement['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'paiements', 'action' => 'view', $paiement['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'paiements', 'action' => 'edit', $paiement['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'paiements', 'action' => 'delete', $paiement['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $paiement['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Paiement', true), array('controller' => 'paiements', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
