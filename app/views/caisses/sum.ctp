<div id='view'>
<div class="document">
<h3>Rapport des Caisses</h3>

<br/>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Type</th>
			<th>Nom</th>
			<th>Amount</th>
			<th>Currency</th>
	</tr>
		<?php
	foreach ($caisses as $caisse):
		
	?>
	<tr>
			<td><?php echo  $caisse['Caiss']['type']; ?></td>
			<td><?php echo  $caisse['Caiss']['name']; ?></td>
			<td><?php echo  $number->format($caisse['Caiss']['montant']); ?></td>
			<td><?php echo  $caisse['Caiss']['monnaie']; ?></td>
	</tr>
<?php endforeach; ?>
	<?php
	foreach ($sums as $sum):
		
	?>
	<tr class="strong">
			<td>TOTAL</td>
			<td></td>
			<td><?php echo  $number->format($sum['Caiss']['montant']); ?></td>
			<td><?php echo  $sum['Caiss']['monnaie']; ?></td>
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
		<li><?php echo $this->Html->link('Lister Caisses', array('controller' => 'caisses', 'action' => 'index')); ?> </li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Caiss',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('type',array('options'=>array('toutes'=>'toutes','caisse'=>'caisse','banque'=>'banque')));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('monnaie',array('options'=>array('toutes'=>'toutes','RWF'=>'RWF','USD'=>'USD')));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>