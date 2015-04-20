<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$stock['Stock']['id'],array('label'=>'','type'=>'checkbox','value'=>$stock['Stock']['id'])); ?>
		</td>
		<td><?php echo $stock['Stock']['id']; ?>&nbsp;</td>
		<td><?php echo $stock['Stock']['name']; ?>&nbsp;</td>
	</tr>