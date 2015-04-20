<tr>
			<?php if(isset($checkbox)):?>
			<td>
				<?php echo $this->Form->input('Id.'. $paiement['Paiement']['id'].'',array('label'=>'','type'=>'checkbox','value'=> $paiement['Paiement']['id'])); ?>
			</td>
			<?php endif;?>
			<td><?php echo  $this->MugTime->toFrench($paiement['Paiement']['date']); ?></td>
			<?php if(isset($facture)):?>
				<td><?php echo $this->MugTime->toFrench($paiement['Facture']['date']); ?></td>
				<td>
					<?php echo $this->Html->link($paiement['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $paiement['Facture']['id'])); ?>
				</td>
				<td><?php echo $paiement['Facture']['operation']; ?></td>
			<?php endif;?>
			<?php if(isset($chambre)):?>
				<td>
					<?php if(isset($paiement['client']['name'])) echo $paiement['client']['name']; ?>
				</td>
				<td><?php if(isset($paiement['client']['compagnie'])) echo  $paiement['client']['compagnie']; ?></td>
				<?php if($chambre=='yes'):?>
					<td><?php echo  $paiement['chambre']; ?></td>
				<?php endif;?>
			<?php endif;?>
			<td><?php echo  $number->format($paiement['Paiement']['montant'],$formatting).' '.$paiement['Facture']['monnaie']; ?></td>
			<td><?php if($paiement['Paiement']['montant_equivalent']) echo   $number->format($paiement['Paiement']['montant_equivalent'],$decimal).' '.$paiement['Paiement']['monnaie']; ?></td>
			<td><?php echo  $paiement['Paiement']['mode_paiement']; ?></td>
			<td><?php echo  $paiement['Paiement']['reference']; ?></td>	
			<td><?php echo  $paiement['Personnel']['name']; ?></td>	
	</tr>