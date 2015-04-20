<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$caisse['Caiss']['id'],array('label'=>'','type'=>'checkbox','value'=>$caisse['Caiss']['id'])); ?>
		</td>
		<td><?php echo $caisse['Caiss']['id']; ?>&nbsp;</td>
		<td><?php echo $caisse['Caiss']['name']; ?>&nbsp;</td>
		<td><?php echo $caisse['Caiss']['monnaie']; ?>&nbsp;</td>
		<td><?php 
			foreach($modePaiements as $mode=>$paiement){
				if(isset($caisse['Caiss'][$mode])) {
					echo $mode.' = ';
					foreach($monnaies as $monnaie){
						if(isset($caisse['Caiss'][$mode][$monnaie])) {
							echo $number->format($caisse['Caiss'][$mode][$monnaie],$formatting).' '.$monnaie.'<br/> '; 
						}
					}
				}
			}
		?>
		</td>
		<td><?php echo $caisse['Caiss']['actif']; ?>&nbsp;</td>
	</tr>