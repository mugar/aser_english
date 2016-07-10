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
			echo $this->Form->input('personnel_id',array('label'=>'Cashier','selected'=>0));
		?>
	</span>
	
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
<h3>Daily Report</h3>
<h4>
		of <?php echo $this->MugTime->toFrench($date);?>
		<br>
		at <?php echo date("H:i:s");?>
</h4>

<br />
<br />

<table cellpadding="0" cellspacing="0" >
	<tr class="border">
			<th colspan="3">TURNOVER</th>
			<th colspan="3">CREDIT</th>
	</tr>
	<tr class="border">
			<th>ITEM</th>
			<th>RWF</th>
			<th>USD</th>
			<th>ITEM</th>
			<th>RWF</th>
			<th>USD</th>
	</tr>
	<?php if($in_progress>0):?>
		<tr class="strong">
			<td>IN PROGRESS AMOUNT</td>
			<td><?php echo  $number->format($in_progress,$formatting); ?></td>
			<td colspan="3"></td>
		</tr>
	<?php endif;?>
	<tr class="strong">
		<td>PAID AMOUNT</td>
		<td><?php echo  $number->format($montantPayee['RWF'],$formatting); ?></td>
		<td><?php echo  $number->format($montantPayee['USD'],$formatting); ?></td>
		<td>PAID CREDIT</td>
		<td><?php echo  $number->format($ca['ca_RWF']-$montantPayee['RWF']-$ca['credit_RWF'],$formatting); ?></td>
		<td><?php echo  $number->format($ca['ca_USD']-$montantPayee['USD']-$ca['credit_USD'],$formatting); ?></td>
	</tr>
	<tr class="strong">
		<td>CREDIT</td>
		<td><?php echo  $number->format($credit['RWF'],$formatting); ?></td>
		<td><?php echo  $number->format($credit['USD'],$formatting); ?></td>
		<td>LEFT CREDIT</td>
		<td><?php echo $this->Html->link($number->format( $ca['credit_RWF'],$formatting),array('action'=>'rapport',$date,$date,'RWF'),array('target'=>'blank')); ?></td>
		<td><?php echo $this->Html->link($number->format( $ca['credit_USD'],$formatting),array('action'=>'rapport',$date,$date,'USD'),array('target'=>'blank')); ?></td>
	</tr>
	<tr class="strong">
		<td>TOTAL</td>
		<td><?php echo  $number->format($ca['ca_RWF'],$formatting); ?></td>
		<td><?php echo  $number->format($ca['ca_USD'],$formatting); ?></td>
		<td>TOTAL</td>
		<td><?php echo  $number->format($credit['RWF'],$formatting); ?></td>
		<td><?php echo  $number->format($credit['USD'],$formatting); ?></td>
	</tr>
</table>
<br />
<br />
<table cellpadding="0" cellspacing="0"  class="table_center">
	<tr class="border">
			<th colspan="6">PAYMENTS OF THIS DAY SALES</th>
			<th colspan="2">PAYMENTS OF OLD SALES</th>
			<th rowspan="3">TOTAL BY CURRENCY</th>
	</tr>
	<tr class="border">
			<th colspan="3"><?php echo  $number->format($old_credit['RWF'],$formatting); ?> RWF</th>
			<th colspan="3"><?php echo  $number->format($old_credit['USD'],$formatting); ?> USD</th>
			<th rowspan="2"><?php echo  $number->format($pyt1['RWF_RWF']+$pyt1['RWF_USD']+$pyt1['RWF_EUR'],$formatting); ?> RWF</th>
			<th rowspan="2"><?php echo  $number->format($pyt1['USD_RWF']+$pyt1['USD_USD']+$pyt1['USD_EUR'],$formatting); ?> USD</th>
	</tr>
	<tr class="border">
		<th>C : <?php echo  $number->format($consumed['RWF'],$formatting); ?></th>
		<th>N : <?php echo  $number->format($montantPayee['RWF'],$formatting); ?></th>
		<th>D : <?php echo  $number->format($ca['deposit_RWF'],$formatting); ?></th>
		<th>C : <?php echo  $number->format($consumed['USD'],$formatting); ?></th>
		<th>N : <?php echo  $number->format($montantPayee['USD'],$formatting); ?></th>
		<th>D : <?php echo  $number->format($ca['deposit_USD'],$formatting); ?></th>
	</tr>
	<?php foreach($monnaies as $monnaie):?>
		<tr class="strong" >
			<td colspan="3"><?php if(!empty($vente1['RWF_'.$monnaie])) echo  $number->format($vente1['RWF_'.$monnaie],$formatting).' RWF => '.$number->format($vente2['RWF_'.$monnaie],$formatting).' '.$monnaie; ?></td>
			<td colspan="3"><?php if(!empty($vente1['USD_'.$monnaie])) echo  $number->format($vente1['USD_'.$monnaie],$formatting).' USD => '.$number->format($vente2['USD_'.$monnaie],$formatting).' '.$monnaie; ?></td>
		
			<td><?php if(!empty($pyt1['RWF_'.$monnaie])) echo  $number->format($pyt1['RWF_'.$monnaie],$formatting).' RWF => '.$number->format($pyt2['RWF_'.$monnaie],$formatting).' '.$monnaie; ?></td>
			<td><?php if(!empty($pyt1['USD_'.$monnaie])) echo  $number->format($pyt1['USD_'.$monnaie],$formatting).' USD => '.$number->format($pyt2['USD_'.$monnaie],$formatting).' '.$monnaie; ?></td>
			
			<td><?php echo  $number->format($vente2['RWF_'.$monnaie]+$vente2['USD_'.$monnaie]+$pyt2['RWF_'.$monnaie]+$pyt2['USD_'.$monnaie],$formatting).' '.$monnaie; ?></td>
		</tr>
	<?php endforeach;?>
</table>
<br />
<br />
<table cellpadding="0" cellspacing="0" id="journal_resume" class="table_center">
	<tr class="border">
			<th colspan="2">REIMBOURSEMENT</th>
	</tr>
	<tr class="border">
			<th>RWF</th>
			<th>USD</th>
	</tr>
	<tr class="strong">
		<td><?php echo  $number->format(abs($remb['RWF']),$formatting); ?></td>
		<td><?php echo  $number->format(abs($remb['USD']),$formatting); ?></td>
	</tr>
</table>
<br />
<br />
<?php foreach($modePaiements as $mode=>$modeName):?>
<table cellpadding="0" cellspacing="0" class="table_center">
	<tr class="border">
			<th rowspan="3" width="100">Created By</th>
			<th colspan="6"><?php echo $modeName;?></th>
	</tr>
	<tr class="border">
		<?php foreach($monnaies as $monnaie):?>
			<th colspan="2"><?php echo $monnaie;?></th>
		<?php endforeach;?>
	</tr>
	<tr class="border">
		<?php foreach($monnaies as $monnaie):?>
			<th>This Day Pyts</th>
			<th>Old Pyts</th>
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
			
			 echo '<strong> '.strtoupper($data['name']).'\'s SIGNATURE : </strong><br /><br /><br />';
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
		<li><?php echo $this->Html->link('Invoices Management', array('controller' => 'factures', 'action' => 'index')); ?> </li>
	</ul>
</div>
	