<?php foreach($sums as $sum):?>
		<tr class="strong" >
			<td>TOTAL</td>
			<td></td>
			<td id="total_billet"><?php echo $number->format($sum['Billetage']['montant'],$formatting).' '.$sum['Billetage']['monnaie'] ; ?>&nbsp;</td>
			<td class="cacher"></td>
		</tr>
	<?php endforeach;?>