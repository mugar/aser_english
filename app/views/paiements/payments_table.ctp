<?php

 if(!isset($chambre)&&!isset($hide_title)):?>
<span class="titre">Paiements</span>
<br/>
<?php endif;?>

<?php 
if(isset($checkbox))
echo $this->Form->create('Paiement',array('name'=>'pyts','action'=>'delete', 'id'=>'Paiement_paiements'));
?>
<table cellpadding="0" cellspacing="0" id="pytTab">
	<tr>
		<?php if(isset($checkbox)):?>
			<th><input type="checkbox" name="master" value="" onclick="checkAll(document.pyts)"></th>
		<?php endif;?>
			<th>Payment Date</th>
			<?php if(isset($facture)):?>
				<th>Invoicing Date</th>
				<th>Invoice N°</th>
				<th>Invoice Type</th>
			<?php endif;?>
			<?php if(isset($chambre)||isset($customer)):?>
				<th>Customer</th>
				<th>Company</th>
				<?php if(isset($chambre)&& ($chambre=='yes')):?>
					<th>Room N°</th>
				<?php endif;?>
			<?php endif;?>
			<th width="150">Amount</th>
			<?php if(!isset($customer)):?>
				<th width="150">Equivalent Amount</th>
			<?php endif;?>
			<th>Payment Mode</th>
			<th width="100">Reference</th>
			<th>Created by</th>
	</tr>
		<?php
		$options=array();

		if(isset($facture))
			$options['facture']=true;
			if(isset($customer))
			$options['customer']=true;
		if(isset($chambre)){
			$options['chambre']=$chambre;
		}
		if(isset($checkbox))
			$options['checkbox']=true;
		
	foreach ($pyts as $pyt){
		$options['paiement']=$pyt;
		echo $this->element('../paiements/add',$options);	
	}  
	?>
	
<?php foreach ($sumPyts as $sumPyt):?>
	<tr class="strong">
		<td>TOTAL</td>
		<?php if(isset($checkbox)):?>
			<td>&nbsp;</td>	
		<?php endif;?>
		<?php if(isset($facture)):?>
			<td>&nbsp;</td>	
			<td>&nbsp;</td>	
			<td>&nbsp;</td>	
		<?php endif;?>
		<?php if(isset($chambre)||(isset($customer))):?>
			<td>&nbsp;</td>	
			<td>&nbsp;</td>	
			<?php if(isset($chambre)&&($chambre=='yes')):?>
				<td>&nbsp;</td>	
			<?php endif;?>
		<?php endif;?>
		<?php if(isset($facture) && !isset($customer)):?>
			<td><?php echo $number->format($sumPyt['Paiement']['montant'],$formatting).' '.$sumPyt['Facture']['monnaie'];?></td>	
			<td><?php echo $number->format($sumPyt['Paiement']['montant_equivalent'],$decimal).' '.$sumPyt['Paiement']['monnaie'];?></td>
		<?php elseif(isset($customer)): ?>
			<td><?php echo $number->format($sumPyt['Paiement']['montant'],$formatting).' '.$sumPyt['Paiement']['monnaie'];?></td>
			<td></td>
		<?php endif;?>
	
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
<?php endforeach; ?>
</table>
<?php 
if(isset($checkbox))
 echo '</form>';
?>