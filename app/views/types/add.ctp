<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$type['Type']['id'],array('label'=>'','type'=>'checkbox','value'=>$type['Type']['id'])); ?>
		</td>
		<td><?php echo $type['Type']['id']; ?>&nbsp;</td>
		<td><?php echo $type['Type']['name']; ?>&nbsp;</td>
		<td><?php if(isset($optionsForTypes[$type['Type']['type']])) echo $optionsForTypes[$type['Type']['type']]; ?>&nbsp;</td>
		<td><?php echo $type['Type']['actif']; ?>&nbsp;</td>
	</tr>