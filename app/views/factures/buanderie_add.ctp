<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$facture['Facture']['id'],array('label'=>'','type'=>'checkbox','value'=>$facture['Facture']['id'])); ?>
		</td>
		<td><?php echo $facture['Facture']['id']; ?>&nbsp;</td>
		<td><?php echo $this->MugTime->toFrench($facture['Facture']['date']); ?>&nbsp;</td>
		<td><?php echo $facture['Chambre']['numero']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($facture['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $facture['Tier']['id'])); ?>
		</td>
		<td><?php echo $facture['Facture']['numero']; ?>&nbsp;</td>
		<td><?php echo $number->format($facture['Facture']['montant'],$formatting); ?>&nbsp;</td>
		<td><?php echo $number->format($facture['Facture']['reste'],$formatting); ?>&nbsp;</td>
		<td><?php echo $number->format($facture['Facture']['tva'],$formatting); ?>&nbsp;</td>
		<td><?php echo $facture['Facture']['monnaie']; ?>&nbsp;</td>
		<td name="etat"><?php echo $facture['Facture']['etat']; ?></td>
	</tr>