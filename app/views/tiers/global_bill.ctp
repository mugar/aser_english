<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
	indicator();
	jQuery('#equi').change(function(){
		var equi=jQuery(this).val();
 		if(equi!=''){
 			jQuery('#monnaie').removeAttr('disabled');
 		}
 		else {
 			jQuery('#monnaie').attr('disabled','disabled');
 		}
 	})
	});
</script>
<div id='view'>
<div class="document">
<div id="entete">
	<div class="left">
		<?php echo $this->element('company'); ?>
	</div>
	
	<div class="right">
	<?php echo $this->element('../tiers/details',array('client'=>$tier['Tier']))?>
		 <br/>
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
<span class="titre">Facture Globale</span>
	<br />	<br />
		<h4>(<?php echo 'Pour la période du '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2);?>)</h4>
		<br />	<br />
	
<br>
<br />
<table cellpadding="0" cellspacing="0">
	<tr>
		<?php if(Configure::read('aser.beneficiaires')):?>
			<th>Date</th>
			<th>Béneficiaire</th>
			<?php if(Configure::read('aser.detailed_ben')):?>
				<th>N° de Matricule</th>
				<th>N° de Liasse</th>
				<th>Nom de l'employeur</th>
			<?php endif; ?> 
		<?php endif; ?>
			<th>Products</th>
			<th>Quantité</th>
			<th width="100">PU</th>
		<?php if(Configure::read('aser.beneficiaires')):?>
			<th width="100">Sous Total</th>
			<th width="100">Montant Payé</th>
			<th width="100">Montant Restant</th>
		<?php else : ?>
			<th>Amount</th>
		<?php endif; ?>
	</tr>
		<?php
	foreach ($ventes as $vente):
	?>
	<tr>
		<?php if(Configure::read('aser.beneficiaires')):?>
			<td><?php if(!empty($vente['Facture']['date'])) echo  $this->MugTime->toFrench($vente['Facture']['date']); ?></td>
			<td><?php  if(!empty($vente['Facture']['beneficiaire'])) echo  $vente['Facture']['beneficiaire']; ?></td>
			<?php if(Configure::read('aser.detailed_ben')):?>
				<td><?php  if(!empty($vente['Facture']['matricule'])) echo  $vente['Facture']['matricule']; ?></td>
				<td><?php  if(!empty($vente['Facture']['liasse'])) echo  $vente['Facture']['liasse']; ?></td>
				<td><?php  if(!empty($vente['Facture']['employeur'])) echo  $vente['Facture']['employeur']; ?></td>
			<?php endif; ?>
		<?php endif; ?>
			<td><?php echo  $vente['Produit']['name']; ?></td>
			<td><?php echo  $vente['Vente']['quantite']; ?></td>
			<td><?php echo  $number->format($vente['Vente']['PU'],$formatting).' '.Configure::read('aser.default_currency'); ?></td>
			<td><?php echo  $number->format($vente['Vente']['montant']+0,$formatting).' '.Configure::read('aser.default_currency'); ?></td>
		<?php if(Configure::read('aser.beneficiaires')):?>
			<td><?php echo  $vente['Vente']['reduction']; ?></td>
			<td><?php echo  $number->format($vente['Vente']['total']+0,$formatting).' '.Configure::read('aser.default_currency'); ?></td>
		<?php endif; ?>
	</tr>
<?php endforeach; ?>
<?php if(($tier['Tier']['reduction']!=0)&&($tier['Tier']['type_reduction']=='Sur le total')) :?>
	<tr class="strong">
		<td>SOUS TOTAL</td>
		<?php if(Configure::read('aser.beneficiaires')):?>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<?php if(Configure::read('aser.detailed_ben')):?>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			<?php endif; ?>
		<?php endif; ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><span ><?php echo ''.$number->format($original+0,$formatting).' '.Configure::read('aser.default_currency'); ?></span></td>
	</tr>
	<tr class="strong">
		<td>REDUCTION</td>
		<?php if(Configure::read('aser.beneficiaires')):?>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<?php if(Configure::read('aser.detailed_ben')):?>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			<?php endif; ?>
		<?php endif; ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><span ><?php echo ''.($reduction+0).' %'; ?></span></td>
	</tr>
<?php endif;?>

<?php if($tva!=0) :?>
	<tr class="strong">
		<td>WITHOUT VAT</td>
		<?php if(Configure::read('aser.beneficiaires')):?>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<?php if(Configure::read('aser.detailed_ben')):?>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			<?php endif; ?>
		<?php endif; ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><span ><?php echo ''.$number->format(($montant-$tva)+0,$formatting).' '.Configure::read('aser.default_currency'); ?></span></td>
	</tr>
	<tr class="strong">
		<td>VAT</td>
		<?php if(Configure::read('aser.beneficiaires')):?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
			<?php if(Configure::read('aser.detailed_ben')):?>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			<?php endif; ?>
	<?php endif; ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><span ><?php echo ''.$number->format($tva+0,$formatting).' '.Configure::read('aser.default_currency'); ?></span></td>
	</tr>
<?php endif;?>
	<tr class="strong">
		<td>TOTAL <?php if($tva!=0) echo '(TTC)';?></td>
		<?php if(Configure::read('aser.beneficiaires')):?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
			<?php if(Configure::read('aser.detailed_ben')):?>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			<?php endif; ?>
	<?php endif; ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><span id="a_payer" total="<?php echo $montant; ?>"><?php echo ''.$number->format($montant+0,$formatting).' '.Configure::read('aser.default_currency'); ?></span></td>
	<?php if(Configure::read('aser.beneficiaires')):?>
		<td>&nbsp;</td>
		<td><span ><?php echo ''.$number->format($total+0,$formatting).' '.Configure::read('aser.default_currency'); ?></span></td>
	<?php endif; ?>
	</tr>
	<?php if(($tier['Tier']['reduction']!=0)&&($tier['Tier']['type_reduction']=='Sur le reste')) :?>
	<tr class="strong">
		<td>RESTE ORIGINAL</td>
		<?php if(Configure::read('aser.beneficiaires')):?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
			<?php if(Configure::read('aser.detailed_ben')):?>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			<?php endif; ?>
	<?php endif; ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	<?php if(Configure::read('aser.beneficiaires')):?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
			<?php if(Configure::read('aser.detailed_ben')):?>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			<?php endif; ?>
		<td><span ><?php echo ''.$number->format($total+0,$formatting).' '.Configure::read('aser.default_currency'); ?></span></td>
	<?php else : ?>
		<td><span ><?php echo ''.$number->format($reste_original+0,$formatting).' '.Configure::read('aser.default_currency'); ?></span></td>
	<?php endif; ?>
	</tr>
	<tr class="strong">
		<td>REDUCTION</td>
		<?php if(Configure::read('aser.beneficiaires')):?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
			<?php if(Configure::read('aser.detailed_ben')):?>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			<?php endif; ?>
	<?php endif; ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<?php if(Configure::read('aser.beneficiaires')):?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><span ><?php echo ''.($reduction+0).' %'; ?></span></td>
		<?php else : ?>
		<td><span ><?php echo ''.($reduction+0).' %'; ?></span></td>
		<?php endif; ?>
	</tr>
<?php endif;?>
	<tr class="strong">
		<td>LEFT TO PAY</td>
		<?php if(Configure::read('aser.beneficiaires')):?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
			<?php if(Configure::read('aser.detailed_ben')):?>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			<?php endif; ?>
	<?php endif; ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	<?php if(Configure::read('aser.beneficiaires')):?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><span id="reste_a_payer"><?php echo ''.$number->format($reste+0,$formatting).' '.Configure::read('aser.default_currency'); ?></span></td>
	<?php else : ?>
		<td><span id="reste_a_payer"><?php echo ''.$number->format($reste+0,$formatting).' '.Configure::read('aser.default_currency'); ?></span></td>
	<?php endif; ?>
	</tr>
</table>
<p>
	<?php 
	if(!is_array($warning)&& ($warning!=''))
		echo '<strong> NB</strong> : '.$warning; 
	?> 
</p>
<div class="bas_page">
	<div class="left">
		<div class="text">
		
		</div>
	</div>
	<div class="right"><?php  
		echo ucwords($signature).'<br />';
	?>
	</div>
	<div style="clear:both"></div>
</div>
<br>
<br>
<br>
<div id="pyts" style="display:none">
<?php 
echo $this->element('../paiements/payments_table',array('pyts'=>$pyts,'facture'=>true,'sumPyts'=>array(0=>$total_pyts)));
?>
</form>
</div>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		
		<li class="link" onclick = "print_documents()" >Print</li>
		<li><?php echo $this->Html->link('Exporter vers excel', array('controller' => 'tiers', 'action' => 'global_bill',$id,$date1,$date2,1)); ?> </li>
		<li class="link" onclick = "jQuery('#pyts').slideToggle()" >Afficher Paiements</li>
		<li><?php echo $this->Html->link('Gestion des Tiers', array('controller' => 'tiers', 'action' => 'index')); ?> </li>
	</ul>
</div>

