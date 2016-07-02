<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$sorti['Sorti']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$sorti['Sorti']['id'])); ?>
		</td>
		<td><?php echo $this->MugTime->toFrench($sorti['Sorti']['date']); ?>&nbsp;</td>
		<td><?php echo $sorti['Stock']['name']; ?>&nbsp;</td>
		<td><?php echo $sorti['Sorti']['quantite'].' ';
		if(isset($unites[$sorti['Product']['unite_id']])) echo $unites[$sorti['Product']['unite_id']]; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($sorti['Product']['name'], array('controller' => 'produits', 'action' => 'view', $sorti['Product']['id'],$sorti['Sorti']['stock_id'])); ?>
		</td>
		<td><?php echo $number->format($sorti['Sorti']['PU'],$formatting); ?>&nbsp;</td>
		<td><?php echo $number->format($sorti['Sorti']['montant'],$formatting); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($sorti['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $sorti['Tier']['id'])); ?>
		</td>
		<td><?php echo $sorti['Sorti']['observation']; ?>&nbsp;</td>
		<?php if (Configure::read('aser.shifts')):?>
			<td><?php echo $shifts[$sorti['Sorti']['shift']]; ?>&nbsp;</td>
		<?php endif;?>
		<td>
			<?php echo ucfirst($sorti['Personnel']['name']); ?>
		</td>
	</tr>