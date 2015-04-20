<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$personnel['Personnel']['id'],array('label'=>'','type'=>'checkbox','value'=>$personnel['Personnel']['id'])); ?>
		</td>
		<td><?php echo $personnel['Personnel']['id']; ?>&nbsp;</td>
		<td><?php echo $personnel['Personnel']['name']; ?>&nbsp;</td>
		<td>
			<?php echo ucfirst($personnel['Fonction']['name']); ?>
		</td>
		<td><?php echo $personnel['Personnel']['identifiant']; ?>&nbsp;</td>
		<td><?php echo $personnel['Personnel']['actif']; ?>&nbsp;</td>
	</tr>