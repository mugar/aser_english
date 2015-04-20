<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$rappel['Rappel']['id'],array('label'=>'','type'=>'checkbox','value'=>$rappel['Rappel']['id'])); ?>
		</td>
		<td><?php echo $rappel['Rappel']['action']; ?>&nbsp;</td>
		<td><?php echo $rappel['Rappel']['date']; ?>&nbsp;</td>
		<td><?php echo $rappel['Rappel']['heure']; ?>&nbsp;</td>
	</tr>