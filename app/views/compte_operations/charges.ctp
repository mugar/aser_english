<div id='view'>
<div class="document">
<h3>CHARGES D'EXPLOITATION</h3>
<br />
<?php
	if(isset($date1)){
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).')</h4>';
		}
?>
<br />	
<br />	
<br />	
<table cellpadding="0" cellspacing="0" id="recherche" class="border" style="width: 800px; margin:0 auto;">
	
	<tr class="border">
			<th>N° DU COMPTE</th>
			<th>LIBELLE</th>
			<th>MONTANT</th>
	</tr>
	
	<?php foreach($charges as $no=>$charge):?>
		<tr style="font-weight:bold; font-size:15px;">
			<td><?php echo  $no; ?></td>
			<td><?php echo  $charge['name']; ?></td>
			<td><?php echo  $number->format(abs($charge['solde']),$formatting); ?></td>
		</tr>
		<?php foreach($charge['details'] as $compte):?>
			<tr>
				<td><?php echo  $compte['numero']; ?></td>
				<td><?php echo  $compte['name']; ?></td>
				<td><?php echo  $number->format(abs($compte['solde']),$formatting); ?></td>
			</tr>
		<?php endforeach; ?>
	<?php endforeach; ?>
	<tr style="font-weight:bold; font-size:15px;">
		<td >TOTAL DES CHARGES</td>
		<td></td>
		<td><?php echo  $number->format(abs($total),$formatting); ?></td>				
	</tr>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link(sprintf(__('Liste des charges', true), __('CompteOperation', true)), array('action' => 'index')); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('CompteOperation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('label'=>'Choisissez une date début'));									
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('date2',array('label'=>'et une date fin pour le rapport','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>