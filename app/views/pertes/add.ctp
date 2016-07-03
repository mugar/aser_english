<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$perte['Perte']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$perte['Perte']['id'])); ?>
		</td>
		<td><?php echo $this->MugTime->toFrench($perte['Perte']['date']); ?>&nbsp;</td>
		<td><?php echo $perte['Stock']['name']; ?>&nbsp;</td>
		<td><?php  echo $perte['Perte']['quantite'].' ';
				if(isset($unites[$perte['Produit']['unite_id']])) echo $unites[$perte['Produit']['unite_id']] ; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($perte['Produit']['name'], array('controller' => 'produits', 'action' => 'view', $perte['Produit']['id'],$perte['Perte']['stock_id'])); ?>
		</td>
		<td><?php echo $number->format($perte['Perte']['PU'],$formatting); ?>&nbsp;</td>
		<td><?php echo $number->format($perte['Perte']['montant'],$formatting);?>&nbsp;</td>
		<td><?php echo $perte['Perte']['nature']; ?>&nbsp;</td>
		<td><?php echo $perte['Perte']['description']; ?>&nbsp;</td>
		<?php if(Configure::read('aser.pharmacie')):?>
			<td><?php echo $perte['Perte']['batch']; ?>&nbsp;</td>
			<td><?php echo $perte['Perte']['date_expiration']; ?>&nbsp;</td>
		<?php endif;?>
			<?php if (Configure::read('aser.shifts')):?>
			<td><?php echo $shifts[$perte['Perte']['shift']]; ?>&nbsp;</td>
		<?php endif;?>
		<td>
			<?php echo ucfirst($perte['Personnel']['name']); ?>
		</td>
	</tr>