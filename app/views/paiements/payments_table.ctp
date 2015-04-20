<?php

 if(!isset($chambre)):?>
<span class="titre">Paiements</span>
<br/>
<?php endif;?>

<?php 
if(isset($checkbox))
echo $this->Form->create('Paiement',array('name'=>'pyts','action'=>'delete'));
?>
<table cellpadding="0" cellspacing="0" id="pytTab">
	<tr>
		<?php if(isset($checkbox)):?>
			<th><input type="checkbox" name="master" value="" onclick="checkAll(document.pyts)"></th>
		<?php endif;?>
			<th>Date de Paiement</th>
			<?php if(isset($facture)):?>
				<th>Date de Facturation</th>
				<th>N° Facture</th>
				<th>Type De Facture</th>
			<?php endif;?>
			<?php if(isset($chambre)):?>
				<th>Client</th>
				<th>Compagnie</th>
				<?php if($chambre=='yes'):?>
					<th>Chambre</th>
				<?php endif;?>
			<?php endif;?>
			<th width="150">Montant</th>
			<th width="150">Montant équivalent</th>
			<th>Mode de Paiement</th>
			<th width="100">Réference</th>
			<th>Créer par</th>
	</tr>
		<?php
		$options=array();
		if(isset($facture))
			$options['facture']=true;
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
		<?php if(isset($chambre)):?>
			<td>&nbsp;</td>	
			<td>&nbsp;</td>	
			<?php if($chambre=='yes'):?>
				<td>&nbsp;</td>	
			<?php endif;?>
		<?php endif;?>
		<td><?php echo $number->format($sumPyt['Paiement']['montant'],$formatting).' '.$sumPyt['Facture']['monnaie'];?></td>
		<td><?php echo $number->format($sumPyt['Paiement']['montant_equivalent'],$decimal).' '.$sumPyt['Paiement']['monnaie'];?></td>
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