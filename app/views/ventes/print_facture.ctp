<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
   
		if(jQuery('div#touch').text()=='oui'){
			jQuery('div#resto_print_thermal table').css({'width':300});
			jQuery('div#resto_print_thermal div.thx').css({'width':300});
			jQuery('div#resto_print_thermal #details #left').css({'width':160,
																'margin-left':'0px',
																'padding':0
																});
			jQuery('div#resto_print_thermal #details #right').css({'width':140,
																'margin-right':'-10px',
																'padding':0
																	});
			jQuery('div#resto_print_thermal  #bas_note').css({'width':300});
			jQuery('div#resto_print_thermal #details').css({'width':300});
		}
		else if(jQuery('div#touch').text()=='standard_sans_image'){
			jQuery('div#resto_print_thermal').css({'font-size':12,'font-weight':'normal'});
			jQuery('div#resto_print_thermal table').css({'width':330,'padding':0});
			jQuery('div#resto_print_thermal table td').css({'height':15,'padding':0});
			jQuery('div#resto_print_thermal div.thx').css({'width':330,'height':'auto','font-weight':'bold'});
			jQuery('div#resto_print_thermal #details').css({'margin':'0 auto'});
			jQuery('div#resto_print_thermal #details #left').css({'width':130,
																'margin-left':'0px',
																'padding':0
																});
			jQuery('div#resto_print_thermal #details #right').css({'width':200,
																'margin-right':0,
																'padding':0
																	});
			jQuery('div#resto_print_thermal  #bas_note').css({'width':330});
			jQuery('div#resto_print_thermal #details').css({'width':330});
		}
	});
</script>
<?php 
		$config=Configure::read('aser');
		$id=($thermal!='non')?('resto_print_thermal'):('resto_print');
		echo '<div style="display:none;" id="touch">'.$thermal.'</div>';
?>
<div id="<?php echo $id; ?>" >
	<?php if($thermal!='non'):?>
	<div class="thx">
		<?php 
		echo $header.'<br/>'; 
		echo 'Tél : '.$tel.'<br/>'; 
		echo $web; 
		?>
	</div>
	<?php else :?>
	<div id="bas_note">
		<?php	echo $this->element('company',array('less'=>true));?>
		<div style="clear:both;"></div>
	</div>
	<?php endif; ?>
	<div id="details">
	<div id="left">
		<?php if(Configure::read('aser.display_bill_number')||($facture['Facture']['etat']=='credit')):?>
		<span class="info"><?php if($thermal!='non') echo 'N° '.$facture['Facture']['numero'];
                                            else echo 'Facture N° : '.$facture['Facture']['numero'];
		?></span>
		<?php endif;?>
		<?php if(!$config['magasin']): ?>
		<span class="info">Serveur : <?php echo $facture['Personnel']['name']; ?></span>
		<?php endif ?>
		<span class="info"><?php  echo 'Date : '.$this->MugTime->toFrench($facture['Facture']['date']); ?></span>
		<?php if(isset($caissiers[$facture['Journal']['personnel_id']])):?>
			<span class="info">Caissier : <?php echo $caissiers[$facture['Journal']['personnel_id']]; ?></span>
		<?php endif ?>
	</div>
	<div id="right">
		<?php if(!empty($facture['Tier']['name'])): ?>
		<span class="info"><?php  echo 'Client : '.$facture['Tier']['name']; ?></span>
		<?php endif ?>
		<?php if(!empty($facture['Tier']['telephone'])): ?>
		<span class="info"><?php  echo 'Tél : '.$facture['Tier']['telephone'] ?></span>
		<?php endif ?>
		<?php if(!empty($facture['Facture']['beneficiaire'])): ?>
		<span class="info"><?php  echo 'Béneficiaire : '.$facture['Facture']['beneficiaire'] ?></span>
		<?php endif ?>
		<span class="info"><?php  if((!empty($facture['Facture']['table'])))
				  echo 'Table : '.$facture['Facture']['table']; ?>
		</span>
		<?php if(Configure::read('aser.multi_resto')): ?>
			<span class="info"><?php  echo 'Place : '.Inflector::humanize($facture['Facture']['pos']) ?></span>
		<?php endif ?>
		<span class="info"><?php  echo date('H:i:s'); ?></span>
	</div>
	<div style="clear:both"></div>
	</div>
	<table  cellpadding="0" cellspacing="0" collspan="0">
		<tr>	
			<?php if($thermal!='non'):?>
			<th>Qté</th>
			<?php else: ?>
				<th>Quantité</th>
			<?php endif; ?>
			<th>Produit</th>
			<th>PU</th>
			<th>PT</th>
		</tr>
		<?php
		foreach ($ventes as $vente):
		?>
		<tr >
			<td><?php echo $vente['Vente']['quantite']; ?>&nbsp;</td>
			<td><?php echo ucwords($vente['Produit']['name']); ?>&nbsp;</td>
			<td><?php echo $vente['Vente']['PU']; ?>&nbsp;</td>
			<td><?php echo $vente['Vente']['montant']; ?>&nbsp;</td>
		</tr>
		<?php endforeach; ?>
		<?php if($facture['Facture']['reduction']!=0):?>
		<tr>
			<td colspan="3">SOUS TOTAL</td>
			<td><?php echo $facture['Facture']['original']; ?></th>
		</tr>
		<tr>
			<td colspan="3">REDUCTION</td>
			<td><?php echo ' - '.($facture['Facture']['original']-$facture['Facture']['montant']); ?></th>
		</tr>
		<?php endif; ?>
		<tr>
			<td colspan="3">TOTAL <?php if($config['TTC']) echo 'TTC'; ?></td>
			<td><?php echo $facture['Facture']['montant']; ?></th>
		</tr>
		<?php if($facture['Facture']['classee']):?>
			<tr>
				<td colspan="3">ETAT</td>
				<td><?php echo strtoupper($facture['Facture']['etat']); ?></th>
			</tr>
			<?php if($facture['Facture']['etat']!='payee'):?>
			<tr>
				<td colspan="3">RESTE A PAYER</td>
				<td><?php echo strtoupper($facture['Facture']['reste']); ?></th>
			</tr>
			<tr height="80">
				<td colspan="4">SIGNATURE</td>
			</tr>
			<?php elseif(!empty($facture['Facture']['cash'])) : ?>
				<tr>
					<td colspan="3">CASH</td>
					<td><?php echo strtoupper($facture['Facture']['cash']); ?></th>
				</tr>
				<tr>
					<td colspan="3">CHANGE</td>
					<td><?php echo strtoupper($facture['Facture']['cash']-$facture['Facture']['montant']); ?></th>
				</tr>
			<?php endif; ?>
		<?php endif; ?>
	</table>
	<?php if($thermal=='non'):?>
	<?php else: ?>
		<div class="thx">
		<?php 
		echo $footer;
		 ?>
	</div>
	<?php endif;?>
</div>