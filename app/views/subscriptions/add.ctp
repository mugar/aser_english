<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$subscription['Subscription']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$subscription['Subscription']['id'])); ?>
		</td>
		<td><?php echo $subscription['Produit']['name']; ?>&nbsp;</td>
			<td>
			<?php echo $this->Html->link($subscription['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $subscription['Facture']['id'])); ?>
		</td>
		<td><?php echo $subscription['Produit']['name']; ?>&nbsp;</td>
		<td><?php echo $this->MugTime->toFrench($subscription['Subscription']['start']); ?>&nbsp;</td>
		<td><?php echo $this->MugTime->toFrench($subscription['Subscription']['end']); ?>&nbsp;</td>
		<td><?php echo $subscription['Subscription']['active']; ?>&nbsp;</td>
		<td>
			<?php echo ucfirst($subscription['Personnel']['name']); ?>
		</td>
	</tr>