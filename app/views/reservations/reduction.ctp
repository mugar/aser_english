<?php if(Configure::read('aser.reduction_on_res_bill')):
	foreach ($ress as $res):
		if($res['Reservation']['PU_standard']>$res['Reservation']['PU']):
?>
	<tr class="strong">
		<td>REDUCTION OFFERTE SUR LA <?php echo $res['Chambre']['name'];?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php  echo  round(($res['Reservation']['PU_standard']-$res['Reservation']['PU'])*100/$res['Reservation']['PU_standard'],2).' %' ; ?></td>
	</tr>
	<tr class="strong">
		<td>PRIX TOTAL DE LA <?php echo $res['Chambre']['name'];?> AVANT LA REDUCTION</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php  echo  $number->format(
							$res['Reservation']['PU_standard']*
							($this->MugTime->diff($res['Reservation']['arrivee'],$res['Reservation']['depart'])+1)
						); 
		?></td>
	</tr>
	<?php endif;?>	
	<?php endforeach;?>
<?php endif;?>	