<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Facture',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('type'=>'text','label'=>'Start Date'));
			echo $this->Form->input('date2',array('type'=>'text','label'=>'End Date'));
			
		?>
	</span>
	<span class="right">
		<?php
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view' style="width:100%">
<div class="document">
<h3>Monthly Sales Report</h3>
<br />
	<?php
			echo '<h4>(From  '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).')</h4>';
	?>

<br />
<br />
<table cellpadding="0" cellspacing="0" class="table_center">
<?php 
$formatting=array('places'=>0,'before'=>'','escape'=>false,'decimal'=>'.','thousands'=>'_');
echo $this->element('../factures/title');?>
<?php
	foreach ($datas as $data):
	?>
	<tr>
		<td title="Afficher les détails"><?php echo $this->Html->link($this->MugTime->toFrench($data['date']),array('action'=>'cash',$data['date']),array('target'=>'blank'));?></td>
		<td><?php echo  $number->format($data['ca_RWF'],$formatting); ?></td>
		<td><?php echo  $number->format($data['ca_USD'],$formatting); ?></td>
		<td><?php echo $this->Html->link($number->format($data['credit_RWF'],$formatting),array('action'=>'rapport',$data['date'],$data['date'],'RWF'),array('target'=>'blank')); ?></td>
		<td><?php echo $this->Html->link($number->format( $data['credit_USD'],$formatting),array('action'=>'rapport',$data['date'],$data['date'],'USD'),array('target'=>'blank')); ?></td>
		<td><?php echo $this->Html->link($number->format( $data['pyt_RWF'],$formatting),array('controller'=>'paiements','action'=>'payment','no',$data['date'],'RWF','all','all'),array('target'=>'blank')); ?></td>
		<td><?php echo $this->Html->link($number->format( $data['pyt_USD'],$formatting),array('controller'=>'paiements','action'=>'payment','no',$data['date'],'USD','all','all'),array('target'=>'blank')); ?></td>
		<td><?php echo $this->Html->link($number->format( $data['pyt_EUR'],$formatting),array('controller'=>'paiements','action'=>'payment','no',$data['date'],'EUR','all','all'),array('target'=>'blank')); ?></td>
		<td><?php echo $this->Html->link($number->format( $data['bonus_RWF'],$formatting),array('action'=>'rapport',$data['date'],$data['date'],'RWF','yes'),array('target'=>'blank')); ?></td>
		<td><?php echo $this->Html->link($number->format( $data['bonus_USD'],$formatting),array('action'=>'rapport',$data['date'],$data['date'],'USD','yes'),array('target'=>'blank')); ?></td>
	</tr>
<?php endforeach; ?>

<?php echo $this->element('../factures/title');?>	

	<tr class="strong">
		<td><?php echo  $total['name']; ?></td>
		<td><?php echo  $number->format($total['ca_RWF'],$formatting); ?></td>
		<td><?php echo  $number->format($total['ca_USD'],$formatting); ?></td>
		<td><?php echo $number->format( $total['credit_RWF'],$formatting); ?></td>
		<td><?php echo  $number->format($total['credit_USD'],$formatting); ?></td>
		<td><?php echo  $number->format($total['pyt_RWF'],$formatting); ?></td>
		<td><?php echo  $number->format($total['pyt_USD'],$formatting); ?></td>
		<td><?php echo  $number->format($total['pyt_EUR'],$formatting); ?></td>
		<td><?php echo $number->format( $total['bonus_RWF'],$formatting); ?></td>
		<td><?php echo $number->format( $total['bonus_USD'],$formatting); ?></td>
	</tr>		
</table>

</form>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Invoices Management', array('controller' => 'factures', 'action' => 'index')); ?> </li>
	</ul>
</div>
<div style="clear:both;"></div>
</div>
	
