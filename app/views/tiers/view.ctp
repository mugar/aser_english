<div class="tiers view">
<h2><?php  __('Tier');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<?php if(Configure::read('aser.accounting')):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('N° du Compte'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tier['Tier']['numero']; ?>
			&nbsp;
		</dd>
	<?php endif; ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tier['Tier']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tier['Tier']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Compagnie'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tier['Tier']['compagnie']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('NIF'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tier['Tier']['NIF']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Adresse'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tier['Tier']['adresse']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tel'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tier['Tier']['telephone']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tier['Tier']['email']; ?>
			&nbsp;
		</dd>
	<?php if(Configure::read('aser.hotel')):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nationalite'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tier['Tier']['nationalite']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Naissance'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tier['Tier']['date_naissance']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Passport'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tier['Tier']['passport']; ?>
			&nbsp;
		</dd>
	<?php endif; ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Actif'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tier['Tier']['actif']; ?>
			&nbsp;
		</dd>
	</dl>
	<br/>
	<br/>
	<?php if(!empty($dettes)) :?>
	<fieldset class="produit">
		<legend>Dettes</legend>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Montant</th>
			<th>Maximum ou Plafond</th>
			<th>Type</th>
		</tr>
	<?php
	foreach ($dettes as $dette):
		
	?>
	<tr<>
		<td><?php echo $number->format($dette['Dette']['montant']).' '.$dette['Dette']['monnaie']; ?>&nbsp;</td>
		<td><?php if(!is_null($dette['Dette']['max'])) echo $number->format($dette['Dette']['max']).' '.$dette['Dette']['monnaie']; ?>&nbsp;</td>
		<td><?php echo ' A '.$dette['Dette']['type'].' terme'; ?>&nbsp;</td>
	</tr>
<?php   endforeach; ?>
	</table>
</fieldset>
<?php endif; ?>
<br />
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), __('Tier', true)), array('action' => 'edit', $tier['Tier']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Tiers', true)), array('action' => 'index')); ?> </li>
	</ul>
</div>
