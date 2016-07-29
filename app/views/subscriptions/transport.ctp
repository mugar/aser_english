<h3><?php __('Subscriptions pour ceux qui paient le transport de la période entre le '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).' ');?></h3>
<br>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Product</th>
			<th>Tier</th>
			<th>Pleins</th>
			<th>Transport</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($subscriptionSsd as $subscription):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $subscription['Produit']['name']; ?></td>
		<td><?php echo $subscription['Tier']['name']; ?></td>
		<td><?php echo $subscription['Subscription']['pleins']; ?></td>
		<td><?php echo $subscription['Subscription']['transport']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td><?php echo $ssd[0]['Subscription']['pleins']+0; ?></td>
		<td><?php echo $ssd[0]['Subscription']['transport']+0; ?></td>
	</tr>
</table>
<br>

<br>
<h3><?php __('Subscriptions pour ceux qui paient le transport de la période entre le '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).' ');?></h3>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Product</th>
			<th>Tier</th>
			<th>Pleins</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($subscriptionTier as $tier):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $tier['Produit']['name']; ?></td>
		<td><?php echo $tier['Tier']['name']; ?></td>
		<td><?php echo $tier['Subscription']['pleins']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td><?php echo $tiers[0]['Subscription']['pleins']+0; ?></td>
	</tr>
</table>
	
<br>
<h3><?php __('Subscriptions pour ceux qui paient le transport de la période entre le '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).' ');?></h3>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Product</th>
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

	<?php echo $this->Form->create('Subscription');?>
		<?php
		echo $this->Form->input('date1',array('label'=>'Start Date',
												'type'=>'date',
												'format'=>'d-m-y')
											);									
		echo $this->Form->input('date2',array('label'=>'End Date',
												'type'=>'date',
												'format'=>'d-m-y')
											);
		echo $this->Form->end(__('Save', true));?>
