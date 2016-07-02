<div id='view'>
<div class="document">
<h3>Bookings by Nationality Report</h3>
<br/>
<h4>(<?php echo 'For '.$this->MugTime->giveMonth($mois).' '.$annee;?>)</h4>
<br/>
<br/>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Nationality</th>
			<th>Number of Bookings</th>
	</tr>
		<?php
		$total=0;
	foreach ($nationalites as $nationalite):
	
	?>
	<tr>
			<td><?php echo  $nationalite['Tier']['nationalite']; ?></td>
			<td><?php echo  $nationalite['Reservation']['pax']; ?></td>
	</tr>
<?php 
	$total+=$nationalite['Reservation']['pax'];
	endforeach;
 ?>
	<tr class="strong">
		<td>TOTAL</td>
		<td><?php echo $number->format($total+0,$formatting); ?></td>
	</tr>
</table>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Bookings Management', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
	</ul>
</div>

<!--goTo  form -->

<!--goTo  form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog" id="goto">
	<?php echo $this->Form->create('Reservation',array('id'=>'recherche'));?>
	<span class='left'>
		<?php
			echo $this->Form->input('mois',array('id'=>'ukwezi', 'label'=>'Month','type'=>'date','dateFormat'=>'M'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('annee',array('id'=>'umwaka','label'=>'Year','type'=>'date','dateFormat'=>'Y'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>