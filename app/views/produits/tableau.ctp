<?php ?>
	<h3>Tableau récapitulatif</h3>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Products</th>
			<th>appro_jour</th>
			<th>appro_mens</th>
			<th>appro_annu</th>
			<th>retour_jour</th>
			<th>retour_mens</th>
			<th>retour_annu</th>
			<th>pleins</th>
			<th>vides</th>
			<th>sorti_jour</th>
			<th>sorti_mens</th>
			<th>sorti_annu</th>
			<th>PVC</th>
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
			<td><?php echo  $data['entree']['jour'][0]['Entree']['pleins']+0; ?></td>
			<td><?php echo  $data['entree']['mensuel'][0]['Entree']['pleins']+0; ?></td>
			<td><?php echo  $data['entree']['annuel'][0]['Entree']['pleins']+0; ?></td>
			<td><?php echo  $data['retour']['jour'][0]['Retour']['pleins']+0; ?></td>
			<td><?php echo  $data['retour']['mensuel'][0]['Retour']['pleins']+0; ?></td>
			<td><?php echo  $data['retour']['annuel'][0]['Retour']['pleins']+0; ?></td>
			<td><?php echo  $data['pleins']; ?></td>
			<td><?php echo  $data['vides']; ?></td>
			<td><?php echo  $data['sorti']['jour'][0]['Sorti']['pleins']+0; ?></td>
			<td><?php echo  $data['sorti']['mensuel'][0]['Sorti']['pleins']+0; ?></td>
			<td><?php echo  $data['sorti']['annuel'][0]['Sorti']['pleins']+0; ?></td>
			<td><?php echo  $data['pvc']; ?></td>
	</tr>
<?php endforeach; ?>
</table>
