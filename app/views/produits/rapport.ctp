<div id='view'>
<div class="document">
<h3>Rapport Des Produits <?php if(!empty($stock)) echo '(Stock : '.ucfirst($stock['Stock']['name']).')';?></h3>
<br />
<h4><?php echo '(Pour La date du '.date('d/m/Y').' à '.date('H:i');
		 echo '. '.count($datas).' produits au total';
		echo ')';
?></h4>
<br/>
<br/>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Nom Du Produit</th>
			<th>Type De Produit</th>
			<th>Section</th>
			<th>Groupe</th>
			<th>Quantité</th>
			<th>PA</th>
			<th>Total</th>
	</tr>
		<?php
	foreach ($datas as $num=>$data):
		
	?>
	<tr>
			<td><?php echo  $data['Produit']; ?></td>
			<td><?php echo  $data['Type']; ?></td>
			<td><?php echo  $data['Section']; ?></td>
			<td><?php echo  $data['Groupe']; ?></td>
			<td><?php echo  $number->format($data['Quantité'],$formatting).' '.$data['Unité']; ?></td>
			<td><?php echo  $number->format($data['PA'],$formatting); ?></td>
			<td><?php echo  $number->format($data['Total'],$formatting); ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo $number->format($pvs,$formatting); ?></td>
	<tr>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link('Liste des Produits', array('controller' => 'produits', 'action' => 'index')); ?> </li>
	</ul>
</div>

<!--recherche form -->
<?php echo $this->element('../produits/recherche',array('action'=>'rapport'));?>
