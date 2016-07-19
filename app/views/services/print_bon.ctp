<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
   
		if(jQuery('div#touch').text()=='yes'){
			jQuery('div#resto_print_thermal table').css({'width':300});
			jQuery('div#resto_print_thermal table').css({'font-size':20});
			jQuery('div#resto_print_thermal div.thx').css({'width':300});
			jQuery('div#resto_print_thermal #details #left').css({'width':100});
			jQuery('div#resto_print_thermal #details #right').css({'width':100});
			jQuery('div#resto_print_thermal  #bas_note').css({'width':300});
			jQuery('div#resto_print_thermal #details').css({'width':300});
			jQuery('div#resto_print_thermal #details').css({'font-size':20});
		};
	});
</script>
<?php 
		$config=Configure::read('aser');
		$id=($thermal=='yes')?('resto_print_thermal'):('resto_print');
		echo '<div style="display:none;" id="touch">'.$thermal.'</div>';
?>
<div id="<?php echo $id; ?>" >
	<div id="details">
	<div id="left">
		<span class="info"><?php if($thermal=='yes') echo 'N° '.$facture['Facture']['numero'];
                                            else echo 'Invoice N° : '.$facture['Facture']['numero'];
		?></span>
		<span class="info"><?php if($thermal=='yes') echo $this->MugTime->toFrench($facture['Facture']['date']);
										else echo 'Date : '.$this->MugTime->toFrench($facture['Facture']['date']); ?></span>
		<span class="info"><?php if($thermal=='yes') echo $facture['Personnel']['name']; else echo 'Serveur : '.$facture['Personnel']['name']; ?></span>
		<span class="info"><?php if($thermal=='yes') echo 'Table: '.$facture['Facture']['table']; ?></span>
	</div>
	<div id="right">
		<span class="info"><?php  if(!empty($facture['Facture']['pos'])) echo 'Place : '.$facture['Facture']['pos']; ?></span>
		<?php if($config['bon_num']): ?>
		<span class="info">Bon N° : <?php echo $facture['Facture']['bon']; ?></span>
		<?php endif ?>
		<span class="info"><?php
		$heure=(isset($showOrder))?	$facture['Facture']['heure']:date('H:i:s');
		 if($thermal=='yes') echo $heure; else echo 'Heure : '.$heure; ?></span>
		
	</div>
	<div style="clear:both"></div>
	</div>
	<table  cellpadding="0" cellspacing="0" collspan="0">
		<tr>	
			<?php if($thermal=='yes'):?>
			<th>Qty</th>
			<?php else: ?>
				<th>Qty</th>
			<?php endif; ?>
			<th>Product</th>
		</tr>
		<?php
		foreach ($ventes as $vente):
		?>
		<tr >
			<td><?php if(isset($vente['Vente']['print_qty'])) echo $vente['Vente']['print_qty'];
						else echo $vente['quantite'];
					 ?>
			</td>
			<td><?php echo ucwords($vente['Produit']['name']); ?>&nbsp;</td>
		</tr>
		<?php endforeach; ?>
		<?php if($msg!='null'):?>
			<tr >
				<td>MESSAGE</td>
				<td><?php echo strtoupper($msg); ?>&nbsp;</td>
			</tr>
		<?php endif; ?>
	</table>
</div>
