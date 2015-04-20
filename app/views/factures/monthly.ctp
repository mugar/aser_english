<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Facture',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('type'=>'text','label'=>'Date Début'));
			echo $this->Form->input('date2',array('type'=>'text','label'=>'Date Fin'));
			
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
<h3>Rapport des Ventes Mensuelle</h3>
<br />
	<?php
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' au '.$this->MugTime->toFrench($date2).')</h4>';
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
		<td><?php echo  $number->format($data['ca_BIF'],$formatting); ?></td>
		<td><?php echo  $number->format($data['ca_USD'],$formatting); ?></td>
		<td><?php echo $this->Html->link($number->format($data['credit_BIF'],$formatting),array('action'=>'rapport',$data['date'],$data['date'],'BIF'),array('target'=>'blank')); ?></td>
		<td><?php echo $this->Html->link($number->format( $data['credit_USD'],$formatting),array('action'=>'rapport',$data['date'],$data['date'],'USD'),array('target'=>'blank')); ?></td>
		<td><?php echo $this->Html->link($number->format( $data['pyt_BIF'],$formatting),array('controller'=>'paiements','action'=>'payment','no',$data['date'],'BIF','all','all'),array('target'=>'blank')); ?></td>
		<td><?php echo $this->Html->link($number->format( $data['pyt_USD'],$formatting),array('controller'=>'paiements','action'=>'payment','no',$data['date'],'USD','all','all'),array('target'=>'blank')); ?></td>
		<td><?php echo $this->Html->link($number->format( $data['pyt_EUR'],$formatting),array('controller'=>'paiements','action'=>'payment','no',$data['date'],'EUR','all','all'),array('target'=>'blank')); ?></td>
		<td><?php echo $this->Html->link($number->format( $data['bonus_BIF'],$formatting),array('action'=>'rapport',$data['date'],$data['date'],'BIF','yes'),array('target'=>'blank')); ?></td>
		<td><?php echo $this->Html->link($number->format( $data['bonus_USD'],$formatting),array('action'=>'rapport',$data['date'],$data['date'],'USD','yes'),array('target'=>'blank')); ?></td>
	</tr>
<?php endforeach; ?>

<?php echo $this->element('../factures/title');?>	

	<tr class="strong">
		<td><?php echo  $total['name']; ?></td>
		<td><?php echo  $number->format($total['ca_BIF'],$formatting); ?></td>
		<td><?php echo  $number->format($total['ca_USD'],$formatting); ?></td>
		<td><?php echo $number->format( $total['credit_BIF'],$formatting); ?></td>
		<td><?php echo  $number->format($total['credit_USD'],$formatting); ?></td>
		<td><?php echo  $number->format($total['pyt_BIF'],$formatting); ?></td>
		<td><?php echo  $number->format($total['pyt_USD'],$formatting); ?></td>
		<td><?php echo  $number->format($total['pyt_EUR'],$formatting); ?></td>
		<td><?php echo $number->format( $total['bonus_BIF'],$formatting); ?></td>
		<td><?php echo $number->format( $total['bonus_USD'],$formatting); ?></td>
	</tr>		
</table>

</form>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link('Liste des Factures', array('controller' => 'factures', 'action' => 'index')); ?> </li>
	</ul>
</div>
<div style="clear:both;"></div>
</div>
	
