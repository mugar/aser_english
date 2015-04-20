<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Facture',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('mois',array('type'=>'date','dateFormat'=>'M'));
			echo $this->Form->input('annee',array('type'=>'date','dateFormat'=>'Y'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('xls',array('type'=>'checkbox','label'=>'Exporter vers excel'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
	
<div id="entete">
	<div class="left" >
		<?php echo $this->element('company'); ?>
	</div>
	
	
	<div style="clear:both"></div>
</div>

<br />
<br />
<br />
<br />
<br />
<br />
<br />

<br />
<br />
<br />
<br />
<br />
<br />
<br />

<h3 style="font-weight:bold;">Liste des Clients pour <?php echo $this->MugTime->giveMonth($month).' '.$year;?></h3>
<br />
<br />

<?php 
//exit(debug($datas));
foreach($models as $model=>$service):?>
<?php if(!empty($datas[$model]['factures'])):?>
	<span class="titre" style="text-decoration: none; font-weight: normal;"><?php echo $service;?></span> 	
<br />
<table cellpadding="0" cellspacing="0" class="border">
	<tr class="border">
			<th rowspan="2" width="150">Client</th>
			<th rowspan="2"width="100">N°Facture</th>
			<th colspan="2" width="250">Montant HTVA</th>
			<th colspan="2" width="150">TVA</th>
			<th colspan="2" width="250">Montant TVAC</th>		
	</tr>
	<tr class="border">
			<th>BIF</th>
			<th>USD</th>
			<th>BIF</th>
			<th>USD</th>
			<th>BIF</th>
			<th>USD</th>
	</tr>
		<?php
	foreach ($datas[$model]['factures'] as $facture):
		
	?>
	<tr>
			<td >
				<?php if(empty($facture['Tier']['name'])) echo 'PASSANT';
					else echo $facture['Tier']['name']; ?>
			</td>
			<td >
				<?php echo $this->Html->link($facture['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $facture['Facture']['id'])); ?>
			</td>
			<?php if($facture['Facture']['monnaie']=='BIF'):?>
				<td><?php echo  $number->format($facture['Facture']['montant']-$facture['Facture']['tva'],$formatting); ?></td>
				<td></td>
				<td ><?php echo  $number->format($facture['Facture']['tva'],$formatting); ?></td>
				<td></td>
				<td><?php echo  $number->format($facture['Facture']['montant'],$formatting); ?></td>
				<td></td>
			<?php else :?>
				<td></td>
				<td><?php echo  $number->format($facture['Facture']['montant']-$facture['Facture']['tva'],$formatting); ?></td>
				<td></td>
				<td ><?php echo  $number->format($facture['Facture']['tva'],$formatting); ?></td>
				<td></td>
				<td><?php echo  $number->format($facture['Facture']['montant'],$formatting); ?></td>
			<?php endif;?>
	</tr>
<?php endforeach; ?>
	<tr class="strong">
		<td>SOUS TOTAL</td>
		<td></td>
		<td><?php echo $number->format($datas[$model]['total']['htva']['BIF'],$formatting);?></td>
		<td><?php echo $number->format($datas[$model]['total']['htva']['USD'],$formatting);?></td>
		<td><?php echo $number->format($datas[$model]['total']['tva']['BIF'],$formatting);?></td>
		<td><?php echo $number->format($datas[$model]['total']['tva']['USD'],$formatting);?></td>
		<td><?php echo $number->format($datas[$model]['total']['montant']['BIF'],$formatting);?></td>
		<td><?php echo $number->format($datas[$model]['total']['montant']['USD'],$formatting);?></td>
	</tr>
</table>
<br />
<br />
<?php endif;?>
<?php endforeach; ?>
<table>
	<table cellpadding="0" cellspacing="0">
	<tr class="border" >
			<th rowspan="2" width="150">Libellé</th>
			<th rowspan="2"width="100">N°Facture</th>
			<th colspan="2" width="250">Montant HTVA</th>
			<th colspan="2" width="150">TVA</th>
			<th colspan="2" width="250">Montant TVAC</th>		
	</tr>
	<tr class="border">
			<th>BIF</th>
			<th>USD</th>
			<th>BIF</th>
			<th>USD</th>
			<th>BIF</th>
			<th>USD</th>
	</tr>
	<tr class="strong">
		<td>TOTAL GENERAL</td>
		<td></td>
		<td><?php echo $number->format($totals['htva']['BIF'],$formatting);?></td>
		<td><?php echo $number->format($totals['htva']['USD'],$formatting);?></td>
		<td><?php echo $number->format($totals['tva']['BIF'],$formatting);?></td>
		<td><?php echo $number->format($totals['tva']['USD'],$formatting);?></td>
		<td><?php echo $number->format($totals['montant']['BIF'],$formatting);?></td>
		<td><?php echo $number->format($totals['montant']['USD'],$formatting);?></td>
	</tr>
</table>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link('Liste des Factures', array('controller' => 'factures', 'action' => 'index')); ?> </li>
	</ul>
</div>
	
