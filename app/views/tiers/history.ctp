<h3 align=center >Historique <?php echo $tier ?>
	<span style="font-size:13px !important; color:#367889; cursor:pointer;" onclick="jQuery('#filter').toggle();">
		(Options de recherche)
	</span>
</h3>
<fieldset class="recherche">
<div id="filter" style="display:none;" class="recherche">
<fieldset>
<?php echo $this->Form->create('Tier');?>
<?php
		echo $this->Form->input('Tier.id',array('label'=>'Tier id','type'=>'text'));
		echo $this->Form->input('date1',array('label'=>'Start Date',
												'type'=>'date',
												'format'=>'d-m-y')
											);									
		echo $this->Form->input('date2',array('label'=>'End Date',
												'type'=>'date',
												'format'=>'d-m-y')
											);
		echo $this->Form->end(__('Save', true));
		?>
</fieldset>
</div>

<?php if(!empty($data['Entree'])):?>
<div class="conteneur">
<h4 style="cursor:pointer" onclick="jQuery('#Entree').toggle();" title="Réduire / Etendre" >* Entrees</h4>
<table id="Entree" class="tableau" cellpadding="0" cellspacing="0">
	<tr>
			<th>Tier</th>
			<th>Products</th>
			<th>quantité</th>
			<th>Montant</th>
			<th>Paiement</th>
			<th>Livrer</th>
			<th>Vidange</th>
			<th>Date</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($data['Entree'] as $Entree):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $Entree['Tier']['name']; ?></td>
			<td><?php echo  $Entree['Produit']['name']; ?></td>
			<td><?php echo  $Entree['Entree']['quantite']; ?></td>
			<td><?php echo  $Entree['Entree']['montant']; ?></td>
			<td><?php echo  $Entree['Entree']['paiement']; ?></td>
			<td><?php echo  $Entree['Entree']['livrer']; ?></td>
			<td><?php echo  $Entree['Entree']['vidange']; ?></td>
			<td><?php echo  $Entree['Entree']['date']; ?></td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<?php endif; ?>

<?php if(!empty($data['Sorti'])):?>
<div class="conteneur">
<h4 style="cursor:pointer" onclick="jQuery('#sorti').toggle();" title="Réduire / Etendre" >* Sortis</h4>
<table id="sorti" class="tableau" cellpadding="0" cellspacing="0">
	<tr>
			<th>Tier</th>
			<th>Products</th>
			<th>Elément</th>
			<th>quantité</th>
			<th>Montant</th>
			<th>Paiement</th>
			<th>Vidange</th>
			<th>Date</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($data['Sorti'] as $sorti):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $sorti['Tier']['name']; ?></td>
			<td><?php echo  $sorti['Produit']['name']; ?></td>
			<td><?php echo  $sorti['Sorti']['element']; ?></td>
			<td><?php echo  $sorti['Sorti']['quantite']; ?></td>
			<td><?php echo  $sorti['Sorti']['montant']; ?></td>
			<td><?php echo  $sorti['Sorti']['paiement']; ?></td>
			<td><?php echo  $sorti['Sorti']['vidange']; ?></td>
			<td><?php echo  $sorti['Sorti']['date']; ?></td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<?php endif; ?>

<?php if(!empty($data['Creance'])):?>
<div class="conteneur">
<h4 style="cursor:pointer" onclick="jQuery('#Creance').toggle();" title="Réduire / Etendre" >* Creances</h4>
<table id="Creance" class="tableau" cellpadding="0" cellspacing="0">
	<tr >
			<th>Tier</th>
			<th>Montant</th>
			<th>Montant payé</th>
			<th>Reste</th>
			<th>Description</th>
			<th>Date</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($data['Creance'] as $Creance):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $Creance['Tier']['name']; ?></td>
			<td><?php echo  $Creance['Creance']['montant']; ?></td>
			<td><?php echo  $Creance['Creance']['montant_paye']; ?></td>
			<td><?php echo  $Creance['Creance']['reste']; ?></td>
			<td><?php echo  $Creance['Creance']['description']; ?></td>
			<td><?php echo  $Creance['Creance']['date']; ?></td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<?php endif; ?>

<?php if(!empty($data['Dette'])):?>
<div class="conteneur">
<h4 style="cursor:pointer" onclick="jQuery('#Dette').toggle();" title="Réduire / Etendre" >* Dettes</h4>
<table id="Dette" class="tableau" cellpadding="0" cellspacing="0">
	<tr >
			<th>Tier</th>
			<th>Montant</th>
			<th>Montant payé</th>
			<th>Reste</th>
			<th>Description</th>
			<th>Date</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($data['Dette'] as $Dette):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $Dette['Tier']['name']; ?></td>
			<td><?php echo  $number->format($dette['Dette']['montant']); ?></td>
			<td><?php echo  $Dette['Dette']['montant_paye']; ?></td>
			<td><?php echo  $Dette['Dette']['reste']; ?></td>
			<td><?php echo  $Dette['Dette']['description']; ?></td>
			<td><?php echo  $Dette['Dette']['date']; ?></td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<?php endif; ?>

<?php if(!empty($data['Pret'])):?>
<div class="conteneur">
<h4 style="cursor:pointer" onclick="jQuery('#Pret').toggle();" title="Réduire / Etendre" >* Prets</h4>
<table id="Pret" class="tableau" cellpadding="0" cellspacing="0">
	<tr >
			<th>Tier</th>
			<th>Product</th>
			<th>Pris</th>
			<th>Remis</th>
			<th>Reste</th>
			<th>Description</th>
			<th>Date</th>
		
	</tr>
		<?php
	$i = 0;
	foreach ($data['Pret'] as $Pret):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
			<td><?php echo  $Pret['Tier']['name']; ?></td>
			<td><?php echo  $Pret['Produit']['name']; ?></td>
			<td><?php echo  $Pret['Pret']['pris']; ?></td>
			<td><?php echo  $Pret['Pret']['remis']; ?></td>
			<td><?php echo  $Pret['Pret']['reste']; ?></td>
			<td><?php echo  $Pret['Pret']['description']; ?></td>
			<td><?php echo  $Pret['Pret']['date']; ?></td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<?php endif; ?>
</fieldset>