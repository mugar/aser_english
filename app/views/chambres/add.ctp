<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$chambre['Chambre']['id'],array('label'=>'','type'=>'checkbox','value'=>$chambre['Chambre']['id'])); ?>
		</td>
		<td><?php echo $chambre['Chambre']['name']; ?>&nbsp;</td>
		<td>
			<?php echo $chambre['TypeChambre']['name']; ?>
		</td>
		<td>
			<?php echo $chambre['Chambre']['etage']; ?>
		</td>
		<td><?php echo $chambre['Chambre']['operationnelle']; ?>&nbsp;</td>
		<td><?php echo $chambre['Chambre']['message']; ?>&nbsp;</td>
	</tr>