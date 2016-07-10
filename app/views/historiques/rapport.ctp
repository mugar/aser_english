<div id='view'>
<div class="document">
<h3>Rapport des Historiques</h3>
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
	foreach ($historiques as $historique):
		
	?>
	<tr>
		<td><?php echo $historique['Historique']['quantite'].' ';
				if(isset($unites[$historique['Produit']['unite_id']])) echo $unites[$historique['Produit']['unite_id']];?>&nbsp;</td>
		<td><?php echo  $historique['Produit']['name']; ?></td>
		<td><?php echo  $historique['Historique']['PA']; ?></td>
		<td><?php echo  $number->format($historique['Historique']['montant'],$formatting); ?></td>
		<td><?php echo  $historique['Historique']['type']; ?></td>
		<td><?php echo  $historique['Stock']['name']; ?></td>
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
		<li><?php echo $this->Html->link('Lister Historiques', array('controller' => 'historiques', 'action' => 'index')); ?> </li>
	</ul>
</div>

<!--recherche form -->
<?php echo $this->element('../historiques/recherche',array('action'=>'rapport'));?>
