
	<div id="legend" style="display:none;">
	<table cellpadding="0" cellspacing="0" id="legend">
		<tr><td class="pending">Pending</td></tr>
		<tr><td class="confirmed">Confirmed</td></tr>
		<tr><td class="checked_in">Checked IN</td></tr>
		<tr><td class="checked_out">Checked OUT</td></tr>
		<tr><td class="credit">Checked OUT with unpaid bills</td></tr>
		<?php if($model=='Réservation'):?>
			<tr><td class="changee">Relocated</td></tr>
			<tr><td class="disabled">Disabled Room</td></tr>
		<?php endif;?>
	</table>
	</div>