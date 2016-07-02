<tr <?php if(isset($alert)&&($alert)) echo 'class="active"';?>>
		<td>
			<?php echo $this->Form->input('Id.'.$entree['Entree']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$entree['Entree']['id'])); ?>
		</td>
		<td><?php echo $this->MugTime->toFrench($entree['Entree']['date']); ?>&nbsp;</td>
		<td><?php echo $entree['Entree']['quantite'].' ';
				if(isset($unites[$entree['Product']['unite_id']])) echo $unites[$entree['Product']['unite_id']];?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($entree['Product']['name'], array('controller' => 'produits', 'action' => 'view', $entree['Product']['id'],$entree['Entree']['stock_id'])); ?>
		</td>
		<td><?php echo $number->format($entree['Entree']['PA'],$formatting); ?>&nbsp;</td>
		<td><?php echo $number->format($entree['Entree']['montant'],$formatting); ?>&nbsp;</td>
		<?php if(Configure::read('aser.pharmacie')):?>
			<td><?php echo $entree['Entree']['batch']; ?>&nbsp;</td>
			<td><?php echo $this->MugTime->toFrench($entree['Entree']['date_expiration']); ?>&nbsp;</td>
		<?php endif;?>
		<td>
			<?php echo $this->Html->link($entree['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $entree['Tier']['id'])); ?>
		</td>
		<td><?php echo $entree['Stock']['name']; ?>&nbsp;</td>
		<td><?php echo $entree['Entree']['type']; ?>&nbsp;</td>
		<?php if (Configure::read('aser.shifts')):?>
			<td><?php echo $shifts[$entree['Entree']['shift']]; ?>&nbsp;</td>
		<?php endif;?>
		<td>
			<?php echo ucfirst($entree['Personnel']['name']); ?>
		</td>
	</tr>