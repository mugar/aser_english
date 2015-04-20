
	<h3><?php __('Tableau d\'amortissement');?></h3>
<a onclick="Element.toggle($('form'))" style="cursor:pointer; display:block; margin-bottom:20px;" >paramètres</a> 
<div id="form" style="display:none">
<?php echo $this->Form->create('Caiss');?>
<?php
		echo $this->Form->input('txan',array('label'=>'taux annuel'));
		echo $this->Form->input('nbr',array('label'=>'Nbre de mois'));
		echo $this->Form->input('capital',array('label'=>'capital'));
		echo $this->Form->input('txasur',array('label'=>'taux d\'assurance'));
		echo $this->Form->end(__('Envoyer', true));
		?>
		</div>
<?php if(!empty($tableau)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Mois</th>
			<th>Intérêts</th> 
			<th>Principal</th>
			<th>Assurance</th>
			<th>Mensualité</th>
			<th>Capital restant dû</th>
		</tr>
	<?php
	$i = 0;
	foreach ($tableau as $value):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $value['i']; ?>&nbsp;</td>
		<td><?php echo $value['interet']; ?>&nbsp;</td>
		<td><?php echo $value['principal']; ?>&nbsp;</td>
		<td><?php echo $value['assurance']; ?>&nbsp;</td>
		<td><?php echo $value['mensualite']; ?>&nbsp;</td>
		<td><?php echo $value['capital']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
<?php endif; ?>
