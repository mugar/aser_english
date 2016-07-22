<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$groupe['Groupe']['id'],array('label'=>'','type'=>'checkbox','value'=>$groupe['Groupe']['id'])); ?>
		</td>
		<td>
			<?php echo $groupe['Groupe']['id']; ?>
		</td>
		<td>
			<?php echo $groupe['Section']['name']; ?>
		</td>
		<td><?php echo $groupe['Groupe']['name']; ?>&nbsp;</td>
		<td><?php echo $groupe['Groupe']['afficher']; ?>&nbsp;</td>
		<td><?php echo $groupe['Groupe']['actif']; ?>&nbsp;</td>
	</tr>