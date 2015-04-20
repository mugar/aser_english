<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$compte['Compte']['id'],array('label'=>'','type'=>'checkbox','value'=>$compte['Compte']['id'])); ?>
		</td>
		<td><?php echo $compte['Compte']['numero']; ?>&nbsp;</td>
		<td><?php echo $compte['Compte']['name']; ?>&nbsp;</td>
		<td><?php echo $compte['Compte']['type']; ?>&nbsp;</td>
		<td><?php echo $compte['Compte']['actif']; ?>&nbsp;</td>
	</tr>