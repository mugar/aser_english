<div id='view'>
<div class="document">
<h3><?php echo 'Rapport des ventes ';?></h3>
<br />
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Tier</th>
			<th>Invoice N°</th>
			<th>State Facture</th>
			<th>Amount</th>
			<th>Reste</th>
			<th>Table</th>
			<th>Personnel</th>
			<th>Personnel</th>
			<th>Date</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($factures as $facture):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $facture['Tier']['name']; ?></td>
			<td>
			<?php echo $this->Html->link($facture['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $facture['Facture']['id'])); ?>
			</td>
			<td><?php echo  $facture['Facture']['etat']; ?></td>
			<td><?php echo  $facture['Facture']['montant']; ?></td>
			<td><?php echo  $facture['Facture']['reste']; ?></td>
			<td><?php echo  $facture['Facture']['table']; ?></td>
			<td><?php echo  $facture['Personnel']['name']; ?></td>
			<td><?php echo  $facture['Personnel']['name']; ?></td>
			<td><?php echo  $facture['Facture']['date']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo $total+0; ?></td>
		<td><?php echo $reste+0; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Liste des Products', array('controller' => 'produits', 'action' => 'index')); ?> </li>
	</ul>
</div>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Vente',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('Facture.tier_id',array('selected'=>0));
			echo $this->Form->input('Facture.personnel_id',array('selected'=>0));
			echo $this->Form->input('Facture.personnel_id',array('selected'=>0));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('Facture.numero',array('value'=>'toutes'));
			echo $this->Form->input('Facture.etat',array('options'=>array('toutes'=>'toutes',
																		'payee'=>'payee',
																		'non_payee'=>'non_payee',
																		'en_cours'=>'en_cours',
																		'credit'=>'credit',
																		'canceled'=>'canceled'
																		)
														));
			echo $this->Form->input('Facture.date1',array('label'=>'Start Date','type'=>'text'));									
			echo $this->Form->input('Facture.date2',array('label'=>'End Date','type'=>'text'));				
			?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>