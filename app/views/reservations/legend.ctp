
	<div id="legend" style="display:none;">
	<table cellpadding="0" cellspacing="0" id="legend">
		<tr><td class="en_attente"><?php echo $model;?> en attente</td></tr>
		<tr><td class="confirmee"><?php echo $model;?> confirmée</td></tr>
		<tr><td class="arrivee">Le Client est arrivée</td></tr>
		<tr><td class="partie">Le Client est partie</td></tr>
		<tr><td class="credit">Le Client est partie sans payée</td></tr>
		<?php if($model=='Réservation'):?>
			<tr><td class="changee">Le Client a changé de chambre</td></tr>
			<tr><td class="disabled">Chambre inactif</td></tr>
		<?php endif;?>
	</table>
	</div>