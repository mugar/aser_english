<div id='view'>
<div class="document">
<h3>Bills Collection</h3>
<br/>
<?php 
	$periode=(!is_null($date1)&&!is_null($date2))?('From '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).''):('');
	if($periode!='') echo '<h4>('.$periode.')</h4>';
	?>
<br/>
<br/>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Customer</th>
			<th>Collected Amount</th>
	</tr>
		<?php
	foreach ($recouvrements as $recouvrement):
	
	?>
	<tr>
			<td><?php echo  $recouvrement['Tier']['name']; ?></td>
			<td><?php echo  $number->format($recouvrement['Recouvrement']['montant'],$formatting); ?></td>
	</tr>
<?php endforeach; ?>
	<tr class="strong">
		<td>&nbsp;</td>
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
		<li><?php echo $this->Html->link('Bill Collections', array('controller' => 'recouvrements', 'action' => 'index')); ?> </li>
	</ul>
</div>
<!--recherche form -->
<?php echo $this->element('../recouvrements/recherche',array('action'=>'rapport'));?>
