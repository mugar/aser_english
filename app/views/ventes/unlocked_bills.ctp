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
		echo $this->Form->input('date2',array('label'=>'End Date','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
<h3>Unlocked Invoices Report</h3>
<br />
	<?php
		if(isset($date1)){
			echo '<h4>(From  '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).', '.count($factures).' invoices  in total)</h4>';
		}
	?>

<br />
<br />
<table cellpadding="0" cellspacing="0">
	<tr>
			<th width="100">Invoice N°</th>
			<th>State</th>
			<th width="200">Amount</th>
			<th width="300">Left to Pay</th>
			<th>Waiter</th>
			<th>Date</th>
			<th>Unlocked By</th>
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
		<li><?php echo $this->Html->link('Invoices Management', array('controller' => 'factures', 'action' => 'index')); ?> </li>
	</ul>
</div>
