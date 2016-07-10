<div id='view'>
<div class="document">
<h3>Historique</h3>

<table cellpadding="0" cellspacing="0" id="recherche">
	<tr>
			<th>Customer</th>
			<th>Occupant</th>
			<th>Room N°</th>
			<th>Arrival</th>
			<th>Départ</th>
			<th>Unit Price</th>
			<th>Amount</th>
			<th>Currency</th>
		
	</tr>
		<?php
	foreach ($affectations as $affectation):
		
	?>
	<tr>
			<td><?php echo  $affectation['Customer']['name']; ?></td>
			<td><?php echo  $affectation['Tier']['name']; ?></td>
			<td><?php echo  $affectation['Chambre']['name']; ?></td>
			<td><?php echo  $affectation['Reservation']['arrivee']; ?></td>
			<td><?php echo  $affectation['Reservation']['depart']; ?></td>
			<td><?php echo  $affectation['Reservation']['PU']; ?></td>
			<td><?php echo  $affectation['Reservation']['montant']; ?></td>
			<td><?php echo  $affectation['Reservation']['monnaie']; ?></td>
	</tr>
<?php endforeach; ?>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Tableau d\'occupation', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Affectation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('tier_id',array('selected'=>0));
		?>
	</span>
	<span class="right">
		<?php
		
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>