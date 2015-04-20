	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$typeChambre['TypeChambre']['id'],array('label'=>'','type'=>'checkbox','value'=>$typeChambre['TypeChambre']['id'])); ?>
		</td>
		<td><?php echo $typeChambre['TypeChambre']['id']; ?>&nbsp;</td>
		<td><?php echo $typeChambre['TypeChambre']['name']; ?>&nbsp;</td>
		<td><?php echo $typeChambre['TypeChambre']['montant'].' '.$typeChambre['TypeChambre']['monnaie']; ?>&nbsp;</td>
		<td><?php echo $typeChambre['TypeChambre']['description']; ?>&nbsp;</td>
		<td><?php echo $typeChambre['TypeChambre']['total']; ?>&nbsp;</td>
	</tr>