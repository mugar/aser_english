<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$dette['Dette']['id'],array('label'=>'','type'=>'checkbox','value'=>$dette['Dette']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($dette['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $dette['Tier']['id'])); ?>
		</td>
		<td><?php echo $number->format($dette['Dette']['montant']).' '. $dette['Dette']['monnaie']; ?>&nbsp;</td>
		<td><?php if(!is_null($dette['Dette']['max'])) echo $number->format($dette['Dette']['max']).' '. $dette['Dette']['monnaie']; ?>&nbsp;</td>
		<td><?php echo ' A '.$dette['Dette']['type'].' terme'; ?>&nbsp;</td>
	</tr>