<tr id="<?php echo $billetage['Billetage']['id']; ?>">
		<td><?php echo $number->format($billetage['Billetage']['billet'],$formatting).' '.$billetage['Billetage']['monnaie']; ?>&nbsp;</td>
		<td><?php echo $billetage['Billetage']['nombre']; ?>&nbsp;</td>
		<td><?php echo $number->format($billetage['Billetage']['montant'],$formatting).' '.$billetage['Billetage']['monnaie']; ?>&nbsp;</td>
		<td class="cacher" onclick="delete_billet('<?php echo $billetage['Billetage']['id']; ?>')" style="cursor:pointer;"><?php echo $this->Html->image('delete.png'); ?></td>
</tr>