<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Vente',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('label'=>'Start Date','type'=>'text'));	
		?>
	</span>
	<span class="right">
		<?php			
		echo $this->Form->input('date2',array('label'=>'et une date fin pour la recherche','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
<h3>Liste des Factures Débloquées</h3>
<br />
	<?php
		if(isset($date1)){
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).', '.count($factures).' factures au total)</h4>';
		}
	?>

<br />
<br />
<table cellpadding="0" cellspacing="0">
	<tr>
			<th width="100">Invoice N°</th>
			<th>State</th>
			<th width="200">Montant</th>
			<th width="300">Reste A Payer</th>
			<th>Serveur</th>
			<th>Date</th>
			<th>Débloquer Par</th>
			<th>Action</th>

		
	</tr>
		<?php
	foreach ($factures as $facture):
		
	?>
	<tr>
			<td >
				<?php echo $this->Html->link($facture['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $facture['Facture']['id'])); ?>
			</td>
			<td name="etat"><?php echo  $facture['Facture']['etat']; ?></td>
			<td><?php echo  $number->format($facture['Facture']['montant'],$formatting).' '.$facture['Facture']['monnaie']; ?></td>
			<td name="reste" montant="<?php echo $facture['Facture']['reste'];?>"><?php echo  $number->format($facture['Facture']['reste'],$formatting).' '.$facture['Facture']['monnaie']; ?></td>
			<td><?php echo  $facture['Personnel']['name']; ?></td>
			<td><?php echo  $this->MugTime->tofrench($facture['Facture']['date']); ?></td>
			<td><?php if(isset($personnels[$facture['Facture']['debloquer']])) 
									echo $personnels[$facture['Facture']['debloquer']]; 
					?>
			</td>
			<td><?php echo $this->Html->link('Afficher l\'historique', array('controller' => 'traces', 'action' => 'index',$facture['Facture']['id'],'Facture')); ?></td>
	</tr>
<?php endforeach; ?>
</table>
</form>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Liste des Factures', array('controller' => 'factures', 'action' => 'index')); ?> </li>
	</ul>
</div>
