
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$perte['Perte']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$perte['Perte']['id'])); ?>
		</td>
		<td><?php echo $perte['Perte']['id']; ?>&nbsp;</td>
		<td></td>
		<td>
			<?php echo $this->Html->link($perte['Product']['name'], array('controller' => 'produits', 'action' => 'view', $perte['Product']['id'])); ?>
		</td>
		
		<td><?php echo $perte['Perte']['nature']; ?>&nbsp;</td>
		<td><?php echo $perte['Perte']['quantite']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($perte['Unite']['name'], array('controller' => 'unites', 'action' => 'view', $perte['Unite']['id'])); ?>
		</td>
		<td><?php echo $perte['Perte']['montant']; ?>&nbsp;</td>
		<td><?php echo $perte['Perte']['monnaie']; ?>&nbsp;</td>
		<td><?php echo $perte['Perte']['echange']; ?>&nbsp;</td>
		<td><?php echo $perte['Perte']['expiration_details']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($perte['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $perte['Personnel']['id'])); ?>
		</td>
		<td><?php echo $perte['Perte']['created']; ?>&nbsp;</td>
		<td><?php echo $perte['Perte']['modified']; ?>&nbsp;</td>
	</tr>