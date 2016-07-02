
<span class="titre"><? echo __('Facture '); 
					if($this->params['controller']=='reservations') echo __('synthèse des extra');
					echo ' n°'.$no;
					?>
</span>
<br />
<br />
<table cellpadding="0" cellspacing="0">
	<tr class="border">
			<th rowspan="2">Services</th>
			<th colspan="<? echo count($facturationCurrencys);?>"><? echo __('Prix total');?></th>			
	</tr>
	<tr class="border">
		<?php foreach($facturationCurrencys as $monnaie):?>
				<th><? echo $monnaie;?></th>
			<? endforeach;?>
	</tr>
		<?php
	$i = 0;
	foreach ($ventes['detail'] as $vente):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<? if($vente['gpeShow']>0):?>
	<tr>
			<td><?php echo  $vente['GroupeComptable']['name']; ?></td>
			<?php foreach($facturationCurrencys as $monnaie):?>
				<td><? echo $number->format($vente['montant'][$monnaie]+0,$formatting);?></td>
			<? endforeach;?>
	</tr>
	<? endif;?>
<?php endforeach; ?>

<?php if($ventes['tvaShow']>0) :?>
	<tr class="strong">
		<td><? echo __('T.P Hors TVA');?></td>
		<?php foreach($facturationCurrencys as $monnaie):?>
				<td><? echo $number->format($ventes['htva'][$monnaie]+0,$formatting);?></td>
			<? endforeach;?>
	<tr>
	<tr class="strong">
		<td><? echo __('TVA');?></td>
		<?php foreach($facturationCurrencys as $monnaie):?>
			<td><? echo $number->format($ventes['tva'][$monnaie]+0,$formatting);?></td>
		<? endforeach;?>
	<tr>
<?php endif;?>
	<tr class="strong">
		<td><? echo __('T.P'); if($ventes['tvaShow']>0) echo __('.TVAC');?></td>
		<?php foreach($facturationCurrencys as $monnaie):?>
			<td><? echo $number->format($ventes['montant'][$monnaie]+0,$formatting);?></td>
		<? endforeach;?>
	<tr>
</table>
<br />
<br />
<br />
<p>
<br>
