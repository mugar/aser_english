<h3><?php __('Sortis pour ceux qui paient le transport de la période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).' ');?></h3>
<br>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Produit</th>
			<th>Tier</th>
			<th>Pleins</th>
			<th>Transport</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($sortiSsd as $sorti):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $sorti['Produit']['name']; ?></td>
		<td><?php echo $sorti['Tier']['name']; ?></td>
		<td><?php echo $sorti['Sorti']['pleins']; ?></td>
		<td><?php echo $sorti['Sorti']['transport']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td><?php echo $ssd[0]['Sorti']['pleins']+0; ?></td>
		<td><?php echo $ssd[0]['Sorti']['transport']+0; ?></td>
	</tr>
</table>
<br>

<br>
<h3><?php __('Sortis pour ceux qui paient le transport de la période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).' ');?></h3>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Produit</th>
			<th>Tier</th>
			<th>Pleins</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($sortiTier as $tier):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $tier['Produit']['name']; ?></td>
		<td><?php echo $tier['Tier']['name']; ?></td>
		<td><?php echo $tier['Sorti']['pleins']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td><?php echo $tiers[0]['Sorti']['pleins']+0; ?></td>
	</tr>
</table>
	
<br>
<h3><?php __('Sortis pour ceux qui paient le transport de la période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).' ');?></h3>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Produit</th>
			<th>Pleins</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($appro as $app):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $app['Produit']['name']; ?></td>
		<td><?php echo $app['Entree']['pleins']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td>TOTAL</td>
		<td><?php echo $sumAppro[0]['Entree']['pleins']+0; ?></td>
	</tr>
</table>

<br>
<i>TOTAL de l'argent pour les manutentiers (ssd) </i>:<strong><?php echo $ssd['manu'];?></strong>
<br>
<i>TOTAL de l'argent pour les manutentiers (tiers) </i>:<strong><?php echo $tiers['manu'];?></strong>

	<?php echo $this->Form->create('Sorti');?>
		<?php
		echo $this->Form->input('date1',array('label'=>'Choisissez une date début',
												'type'=>'date',
												'format'=>'d-m-y')
											);									
		echo $this->Form->input('date2',array('label'=>'et une date fin pour le rapport',
												'type'=>'date',
												'format'=>'d-m-y')
											);
		echo $this->Form->end(__('Envoyer', true));?>
