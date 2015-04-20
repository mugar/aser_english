
	<tr class="dbclick" op="<?php echo $operation['Operation']['op_num'];?>" id="<?php echo $operation['Operation']['id'];?>">
		<td id="<?php echo $operation['Operation']['id'];?>">
			<?php echo $this->Form->input('Id.'.$operation['Operation']['op_num'],array('label'=>'','type'=>'checkbox','value'=>$operation['Operation']['op_num'])); ?>
		</td>
		<td><?php echo $operation['Operation']['date']; ?>&nbsp;</td>
		<td><?php echo $operation['Operation']['ordre']; ?>&nbsp;</td>
		<td><?php 
			$montant=($operation['Operation']['debit']>0)?$operation['Operation']['debit']:$operation['Operation']['credit'];
			echo $number->format($montant,$decimal).' '.$operation['Operation']['monnaie']; ?>&nbsp;</td>
		<td><?php echo $operation['Operation']['libelle']; ?>&nbsp;</td>
		<?php if($mode!='report'):?>
			<td><?php echo $operation['Operation']['mode_paiement']; ?>&nbsp;</td>
		<td>
			<?php if($operation['Operation']['src_model']=='Caiss') 
					echo $this->Html->link($operation['Operation']['src'], array('controller' => 'operations', 'action' => 'rapport', $operation['Operation']['src_model'],$operation['Operation']['src_id']));
				else 
					echo $operation['Operation']['src']; 
			?>
		</td>
		<td>
			<?php if($operation['Operation']['dest_model']=='Caiss') 
					echo $this->Html->link($operation['Operation']['dest'], array('controller' => 'operations', 'action' => 'rapport', $operation['Operation']['dest_model'],$operation['Operation']['dest_id']));
				else 
					echo $operation['Operation']['dest']; 
			?>
		</td>
		<?php endif;?>
		<td>
			<?php echo $this->Html->link($operation['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $operation['Personnel']['id'])); ?>
		</td>
	</tr>
