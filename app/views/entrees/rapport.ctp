<div id='view'>
<div class="document">
<h3>Rapport des Entrees</h3>
<br />
<h4><?php echo $periode=(!is_null($date1)&&!is_null($date2))?
						('(Période du '.$this->MugTime->toFrench($date1).' au '.$this->MugTime->toFrench($date2).' )'):
						('');?>
</h4>
<br />
<br />
<table cellpadding="0" cellspacing="0" id="recherche">
	<tr>
		<th>Quantité</th>
		<th>Nom Du Produit</th>
		<th>Prix D'Achat</th>
		<th>Montant</th>
		<th>Type d'entrée</th>
		<th>Stock</th>
	</tr>
		<?php
	foreach ($entrees as $entree):
		
	?>
	<tr>
		<td><?php echo $entree['Entree']['quantite'].' ';
				if(isset($unites[$entree['Produit']['unite_id']])) echo $unites[$entree['Produit']['unite_id']];?>&nbsp;</td>
		<td><?php echo  $entree['Produit']['name']; ?></td>
		<td><?php echo  $entree['Entree']['PA']; ?></td>
		<td><?php echo  $number->format($entree['Entree']['montant'],$formatting); ?></td>
		<td><?php echo  $entree['Entree']['type']; ?></td>
		<td><?php echo  $entree['Stock']['name']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr class="strong">
		<td><?php echo $number->format($qty+0,$formatting); ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo $number->format($total+0,$formatting); ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link('Lister Entrees', array('controller' => 'entrees', 'action' => 'index')); ?> </li>
	</ul>
</div>

<!--recherche form -->
<?php echo $this->element('../entrees/recherche',array('action'=>'rapport'));?>
