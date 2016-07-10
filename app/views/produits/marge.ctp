<h3><?php __('Tableau des marges de la période entre le '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).' ');?></h3>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Products</th>
			<th>Marge Brut</th>
			<th>Retours Brarudi</th>
			<th>Casses Megas</th>
			<th>Marge net</th>
	</tr>
	<?php
	$i = 0;
	foreach ($datas as $data):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $data['name']; ?></td>
			<td><?php echo  $data['Sorti'][0]['Sorti']['benefice']+0; ?></td>
			<td><?php echo  $data['Retour'][0]['Retour']['montant']+0; ?></td>
			<td><?php echo  $data['Casses'][0]['CassesMega']['total']+0; ?></td>
			<td><?php echo  ($data['Sorti'][0]['Sorti']['benefice']
											-$data['Retour'][0]['Retour']['montant']
											-$data['Casses'][0]['CassesMega']['total']
											);
					 ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td>TOTAL</td>
		<td><?php echo $sumBenefices[0]['Sorti']['benefice']+0;?></td>
		<td><?php echo $sumRetours[0]['Retour']['montant']+0;?></td>
		<td><?php echo $sumCasses[0]['CassesMega']['total']+0;?></td>
		<td><?php echo ($sumBenefices[0]['Sorti']['benefice']
										-$sumRetours[0]['Retour']['montant']
										-$sumCasses[0]['CassesMega']['total']
										);
			?></td>
	</tr>
</table>
	<?php echo $this->Form->create('Produit');?>
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
