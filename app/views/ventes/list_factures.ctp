	<?php 
		$config=Configure::read('aser');
		foreach($factures as $facture):?>
			<tr onclick="activated(this)" 
				id="<?php echo $facture['Facture']['id']; ?>" 
				name="<?php echo $facture['Facture']['classee']; ?>" 
				printed="<?php echo $facture['Facture']['printed']; ?>"
				beneficiaire="<?php echo $facture['Facture']['beneficiaire']; ?>"
				journal="<?php echo $facture['Facture']['journal_id']; ?>"
			>
					<td id="num" >
						<?php echo $facture['Facture']['numero']; ?>
					</td>
				<?php if(!$config['magasin']): ?>
					<td id="table"><?php echo $facture['Facture']['table']; ?></td>
				<?php endif; ?>
				<td id="original"><?php echo $facture['Facture']['original']; ?></td>
				<td id="reduction"><?php echo $facture['Facture']['reduction']; ?></td>
				<td id="montant"><?php echo $facture['Facture']['montant']; ?></td>
				<?php if($config['touchscreen']): ?>
					<td id="reste"><?php echo $facture['Facture']['reste']; ?></td>
				<?php endif; ?>	
				<td id="etat"><?php echo $facture['Facture']['etat']; ?></td>
				<?php if(!$config['magasin']): ?>
					<td id="waiter"><?php echo $facture['Personnel']['name']; ?></td>
				<?php endif; ?>
				<td id="date"><?php echo $this->MugTime->toFrench($facture['Facture']['date']); ?></td>
			</tr>
		<?php endforeach;?>