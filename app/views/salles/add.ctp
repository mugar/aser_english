<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$salle['Salle']['id'],array('label'=>'','type'=>'checkbox','value'=>$salle['Salle']['id'])); ?>
		</td>
		<td><?php echo $salle['Salle']['name']; ?>&nbsp;</td>
		<td><?php echo $salle['Salle']['montant']; ?>&nbsp;</td>
		<td><?php echo $salle['Salle']['capacite']; ?>&nbsp;</td>
	</tr>