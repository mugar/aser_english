<div id='view'>
<div class="document">
<h3><?php echo 'CHAMBRES A NETTOYER ';
		
			echo '<h4>( Pour la journée du '.$this->MugTime->toFrench($date).' à '.date('H:i:s').' )</h4>';
			echo '<h4> -- Nombre de nuitée avant la recouche : '.$bed_sheet_duration.' --</h4>';
	?>
</h3>
<br />
<br />
<table cellpadding="0" cellspacing="0" id="journal_resume" style="width: 900px;">
	<tr class="strong">
		<td style="width: 250px;">TOTAL DES CHAMBRES : </td>
		<td style="width: 50px;"><?php echo  count($rooms_to_clean); ?></td>
		<td><?php echo  implode(', ',$rooms_to_clean); ?></td>
	</tr>
	<tr>
		<td>NETTOYER A BLANC</td>
		<td><?php echo  count($a_blanc); ?></td>
		<td><?php echo  implode(', ',$a_blanc); ?></td>
	</tr>
	<tr>
		<td>FAIRE LA RECOUCHE</td>
		<td><?php echo  count($recouche); ?></td>
		<td><?php echo  implode(', ',$recouche); ?></td>
	</tr>
	<tr>
		<td>FAIRE LA RECOUCHE A BLANC</td>
		<td><?php echo  count($recouche_a_blanc); ?></td>
		<td><?php echo  implode(', ',$recouche_a_blanc); ?></td>
	</tr>
</table>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<div id="legend" style="display:none;">
	<table cellpadding="0" cellspacing="0" id="legend">
		<tr class="active"><td>ARRIVEE DE CLIENT</td></tr>
	</table>
	</div>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Bookings Management', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
	</ul>
</div>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Reservation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date',array('label'=>'Choisissez une date','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>