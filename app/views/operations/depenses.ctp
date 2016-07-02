
<div id='view'>
<div class="document">
<h3>Rapport Des Dépenses</h3>
<br />
<?php
	if(isset($date1)){
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).', monnaie : '.$monnaie.')</h4>';
	}
	else {
		echo '<h4>(Currency : '.$monnaie.')</h4>';
	}
?>
<br />	
<br />
<table cellpadding="0" cellspacing="0" id="recherche" class="table_center">
	<tr class="border">
			
			<th>Date</th>
			<th>Montant</th>
			<th>Libellé</th>
			<th>Payment Mode</th>
			<th>Catégorie</th>
		
	</tr>
	
	<?php
		$total=0;
		foreach ($operations as $operation):
	?>
	<tr>
		<td><?php echo  $this->MugTime->toFrench($operation['Operation']['date']); ?></td>
		<td><?php echo  $number->format($operation['Operation']['debit'],$formatting); ?></td>
		<td><?php echo  $operation['Operation']['libelle']; ?></td>
		<td><?php echo  $operation['Operation']['mode_paiement']; ?></td>
		<td>
			<?php echo $operation[$model]['name']; ?>
		</td>
	</tr>
	<?php
		$total+=$operation['Operation']['debit'];
		 endforeach; 
	 ?>
	<tr class="strong">
			<td>TOTAL</td>
			<td><?php echo  $number->format($total,$formatting); ?></td>
			<td></td>
			<td></td>
			<td></td>
	</tr>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link(sprintf(__('Liste des Opérations', true), __('Operation', true)), array('action' => 'index')); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Operation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			
			echo $this->Form->input('element_id',array('label'=>'Catégorie','options'=>$list, 'selected'=>0));
			echo $this->Form->input('mode_paiement',array('options'=>array(''=>'',
																		'cash'=>'cash',
																		'cheque'=>'chèque',
																			)
														));		
			echo $this->Form->input('monnaie');									
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('date1',array('label'=>'Start Date'));
			echo $this->Form->input('date2',array('label'=>'End Date','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>