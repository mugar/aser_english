<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$type_service['TypeService']['id'],array('label'=>'','type'=>'checkbox','value'=>$type_service['TypeService']['id'])); ?>
		</td>
		<td><?php echo $type_service['TypeService']['id']; ?>&nbsp;</td>
		<td><?php echo $type_service['TypeService']['name']; ?>&nbsp;</td>
    <td><?php echo $type_service['TypeService']['code'].' RWF'; ?>&nbsp;</td>
    <td><?php echo $type_service['TypeService']['montant'].' RWF';; ?>&nbsp;</td>
	</tr>