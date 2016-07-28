<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$recouvrement['Recouvrement']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$recouvrement['Recouvrement']['id'])); ?>
		</td>
		<td><?php echo $this->MugTime->toFrench($recouvrement['Recouvrement']['date']); ?>&nbsp;</td>
		<td><?php echo $recouvrement['Tier']['name']; ?>&nbsp;</td>
		<td><?php echo $recouvrement['Recouvrement']['factures']; ?>&nbsp;</td>
		<td><?php echo $number->format($recouvrement['Recouvrement']['montant'],$formatting); ?>&nbsp;</td>
		<td><?php echo $recouvrement['Recouvrement']['comments']; ?>&nbsp;</td>
		<td>
			<?php echo ucfirst($recouvrement['DoneBy']['name']); ?>
		</td>
		<td>
			<?php echo ucfirst($recouvrement['Personnel']['name']); ?>
		</td>
	</tr>