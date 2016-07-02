<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$proforma['Proforma']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$proforma['Proforma']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($proforma['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $proforma['Tier']['id'])); ?>
		</td>
		<td name="facture" valeur="">
		</td>
		<td>
			<?php echo $this->Html->link($proforma['Product']['name'], array('controller' => 'produits', 'action' => 'view', $proforma['Product']['id'])); ?>
		</td>
		<td><?php echo $proforma['Proforma']['quantite']; ?>&nbsp;</td>
		<td><?php echo $proforma['Proforma']['PU']; ?>&nbsp;</td>
		<td><?php echo $proforma['Proforma']['montant'].' '.$proforma['Proforma']['monnaie']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($proforma['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $proforma['Personnel']['id'])); ?>
		</td>
	</tr>