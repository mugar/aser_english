<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Facture',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date',array('type'=>'text'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('personnel_id',array('label'=>'Caissier','selected'=>0));
		?>
	</span>
	
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
<h3>Rapport Journalier </h3>
<h4>
		Du <?php echo $this->MugTime->toFrench($date);?>
		<br>
		à <?php echo date("H:i:s");?>
</h4>

<br />
<br />

<table cellpadding="0" cellspacing="0" >
	<tr class="border">
			<th colspan="3">CHIFFRE D'AFFAIRE</th>
			<th colspan="3">CREDIT</th>
	</tr>
	<tr class="border">
			<th>LIBELLE</th>
			<th>BIF</th>
			<th>USD</th>
			<th>LIBELLE</th>
			<th>BIF</th>
			<th>USD</th>
	</tr>
	<?php if($en_cours>0):?>
		<tr class="strong">
			<td>MONTANT EN COURS</td>
			<td><?php echo  $number->format($en_cours,$formatting); ?></td>
			<td colspan="3"></td>
		</tr>
	<?php endif;?>
	<tr class="strong">
		<td>MONTANT PAID AMOUNT</td>
		<td><?php echo  $number->format($montantPayee['BIF'],$formatting); ?></td>
		<td><?php echo  $number->format($montantPayee['USD'],$formatting); ?></td>
		<td>CREDIT PAID AMOUNT</td>
		<td><?php echo  $number->format($ca['ca_BIF']-$montantPayee['BIF']-$ca['credit_BIF'],$formatting); ?></td>
		<td><?php echo  $number->format($ca['ca_USD']-$montantPayee['USD']-$ca['credit_USD'],$formatting); ?></td>
	</tr>
	<tr class="strong">
		<td>CREDIT</td>
		<td><?php echo  $number->format($credit['BIF'],$formatting); ?></td>
		<td><?php echo  $number->format($credit['USD'],$formatting); ?></td>
		<td>CREDIT RESTANT</td>
		<td><?php echo $this->Html->link($number->format( $ca['credit_BIF'],$formatting),array('action'=>'rapport',$date,$date,'BIF'),array('target'=>'blank')); ?></td>
		<td><?php echo $this->Html->link($number->format( $ca['credit_USD'],$formatting),array('action'=>'rapport',$date,$date,'USD'),array('target'=>'blank')); ?></td>
	</tr>
	<tr class="strong">
		<td>TOTAL</td>
		<td><?php echo  $number->format($ca['ca_BIF'],$formatting); ?></td>
		<td><?php echo  $number->format($ca['ca_USD'],$formatting); ?></td>
		<td>TOTAL</td>
		<td><?php echo  $number->format($credit['BIF'],$formatting); ?></td>
		<td><?php echo  $number->format($credit['USD'],$formatting); ?></td>
	</tr>
</table>
<br />
<br />
<table cellpadding="0" cellspacing="0"  class="table_center">
	<tr class="border">
			<th colspan="6">VENTES DÛ PAID AMOUNTS</th>
			<th colspan="2">PAIEMENTS</th>
			<th rowspan="3">TOTAL PAR MONNAIE</th>
	</tr>
	<tr class="border">
			<th colspan="3"><?php echo  $number->format($old_credit['BIF'],$formatting); ?> BIF</th>
			<th colspan="3"><?php echo  $number->format($old_credit['USD'],$formatting); ?> USD</th>
			<th rowspan="2"><?php echo  $number->format($pyt1['BIF_BIF']+$pyt1['BIF_USD']+$pyt1['BIF_EUR'],$formatting); ?> BIF</th>
			<th rowspan="2"><?php echo  $number->format($pyt1['USD_BIF']+$pyt1['USD_USD']+$pyt1['USD_EUR'],$formatting); ?> USD</th>
	</tr>
	<tr class="border">
		<th>C : <?php echo  $number->format($consumed['BIF'],$formatting); ?></th>
		<th>N : <?php echo  $number->format($montantPayee['BIF'],$formatting); ?></th>
		<th>D : <?php echo  $number->format($ca['deposit_BIF'],$formatting); ?></th>
		<th>C : <?php echo  $number->format($consumed['USD'],$formatting); ?></th>
		<th>N : <?php echo  $number->format($montantPayee['USD'],$formatting); ?></th>
		<th>D : <?php echo  $number->format($ca['deposit_USD'],$formatting); ?></th>
	</tr>
	<?php foreach($monnaies as $monnaie):?>
		<tr class="strong" >
			<td colspan="3"><?php if(!empty($vente1['BIF_'.$monnaie])) echo  $number->format($vente1['BIF_'.$monnaie],$formatting).' BIF => '.$number->format($vente2['BIF_'.$monnaie],$formatting).' '.$monnaie; ?></td>
			<td colspan="3"><?php if(!empty($vente1['USD_'.$monnaie])) echo  $number->format($vente1['USD_'.$monnaie],$formatting).' USD => '.$number->format($vente2['USD_'.$monnaie],$formatting).' '.$monnaie; ?></td>
		
			<td><?php if(!empty($pyt1['BIF_'.$monnaie])) echo  $number->format($pyt1['BIF_'.$monnaie],$formatting).' BIF => '.$number->format($pyt2['BIF_'.$monnaie],$formatting).' '.$monnaie; ?></td>
			<td><?php if(!empty($pyt1['USD_'.$monnaie])) echo  $number->format($pyt1['USD_'.$monnaie],$formatting).' USD => '.$number->format($pyt2['USD_'.$monnaie],$formatting).' '.$monnaie; ?></td>
			
			<td><?php echo  $number->format($vente2['BIF_'.$monnaie]+$vente2['USD_'.$monnaie]+$pyt2['BIF_'.$monnaie]+$pyt2['USD_'.$monnaie],$formatting).' '.$monnaie; ?></td>
		</tr>
	<?php endforeach;?>
</table>
<br />
<br />
<table cellpadding="0" cellspacing="0" id="journal_resume" class="table_center">
	<tr class="border">
			<th colspan="2">REMBOURSEMENT</th>
	</tr>
	<tr class="border">
			<th>BIF</th>
			<th>USD</th>
	</tr>
	<tr class="strong">
		<td><?php echo  $number->format(abs($remb['BIF']),$formatting); ?></td>
		<td><?php echo  $number->format(abs($remb['USD']),$formatting); ?></td>
	</tr>
</table>
<br />
<br />
<?php foreach($modePaiements as $mode=>$modeName):?>
<table cellpadding="0" cellspacing="0" class="table_center">
	<tr class="border">
			<th rowspan="3" width="100">Personnel</th>
			<th colspan="6"><?php echo $modeName;?></th>
	</tr>
	<tr class="border">
		<?php foreach($monnaies as $monnaie):?>
			<th colspan="2"><?php echo $monnaie;?></th>
		<?php endforeach;?>
	</tr>
	<tr class="border">
		<?php foreach($monnaies as $monnaie):?>
			<th>Ventes</th>
			<th>PYT</th>
		<?php endforeach;?>
	</tr>
<?php foreach ($datas as $data):?>
	<tr>
		<td><?php echo strtoupper($data['name']);?></td>
		<?php foreach($monnaies as $monnaie):?>
			<td><?php echo $this->Html->link($number->format( $data[$mode.'_'.$monnaie],$formatting),array('controller'=>'paiements','action'=>'payment','no',$data['date'],$monnaie,'yes',$mode,$data['id']),array('target'=>'blank')); ?></td>
			<td><?php echo $this->Html->link($number->format( $data['pyt_'.$mode.'_'.$monnaie],$formatting),array('controller'=>'paiements','action'=>'payment','no',$data['date'],$monnaie,'no',$mode,$data['id']),array('target'=>'blank')); ?></td>
		<?php endforeach;?>	
	</tr>
<?php endforeach; ?>
	<tr class="strong">
				<td><?php echo  $total['name']; ?></td>
				<?php foreach($monnaies as $monnaie):?>
					<td><?php echo  $number->format($total[$mode.'_'.$monnaie],$formatting); ?></td>
					<td><?php echo  $number->format($total['pyt_'.$mode.'_'.$monnaie],$formatting); ?></td>
				<?php endforeach;?>	
	</tr>
</table>
<br />
<?php endforeach;?>
<br />
<br />
	<?php 
	foreach($datas as $i=>$data){
			
			 echo '<strong> SIGNATURE POUR '.strtoupper($data['name']).' : </strong><br /><br /><br />';
		}
	?>
<br/>
<br/>
<? echo $this->element('signature');?> 
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Liste des Factures', array('controller' => 'factures', 'action' => 'index')); ?> </li>
	</ul>
</div>
	