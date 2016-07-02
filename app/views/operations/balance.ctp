
<div id='view'>
<div class="document">
<h3>Mouvements des <?php echo $element;?></h3>
<br />
<?php
	if(isset($date1)){
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).')</h4>';
			echo '<h4>( monnaie : '.$monnaie.', Mode Paiement: '.$mode_paiement.')</h4>';
	}
	else {
		echo '<h4>(Currency : '.$monnaie.')</h4>';
		echo '<h4>(Mode Paiement: '.$mode_paiement.')</h4>';
	}
?>
<br />	
<br />
<table cellpadding="0" cellspacing="0" id="recherche">
	<tr class="border">
			<th rowspan="2"><?php echo $element;?></th>
			<th rowspan="2">Report</th>
			<th colspan="2">Mouvements</th>
			<th rowspan="2">Solde</th>
		
	</tr>
	<tr class="border">
			<th>Entrée</th>
			<th>Sortie</th>
	</tr>
		<?php
	foreach ($elements as $operation):
		
	?>
	<tr>
		<td>
			<?php echo $this->Html->link($operation[$model]['name'], array('controller' => 'operations', 'action' => 'rapport', $model,$operation[$model]['id'])); ?>
		</td>
			<td><?php echo  $number->format($operation['report'],$formatting); ?></td>
			<?php if($where=='debit'):?>
				<td><?php echo  $number->format($operation['debit'],$formatting); ?></td>
				<td><?php echo  $number->format($operation['credit'],$formatting); ?></td>
			<?php else:?>
				<td><?php echo  $number->format($operation['credit'],$formatting); ?></td>
				<td><?php echo  $number->format($operation['debit'],$formatting); ?></td>
			<?php endif;?>
			<td><?php echo  $number->format($operation['solde'],$formatting); ?></td>
	</tr>
<?php endforeach; ?>
<tr class="strong">
		<td >TOTAL</td>
			
			<td><?php echo  $number->format($report,$formatting); ?></td>
			<?php if($where=='debit'):?>
				<td><?php echo  $number->format($debit,$formatting); ?></td>
				<td><?php echo  $number->format($credit,$formatting); ?></td>
			<?php else:?>
				<td><?php echo  $number->format($credit,$formatting); ?></td>
				<td><?php echo  $number->format($debit,$formatting); ?></td>
			<?php endif;?>
			<td><?php echo  $number->format($solde,$formatting); ?></td>
	</tr>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link(sprintf(__('Liste des elements', true), __('Operation', true)), array('action' => 'index')); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Operation',array('id'=>'recherche','action'=>'balance/'.$element));?>
	<span class="left">
		<?php
			
			echo $this->Form->input('element_id',array('label'=>$element,'options'=>$list,'multiple'=>true, 'selected'=>0));
			echo $this->Form->input('monnaie');		
			echo $this->Form->input('mode_paiement');									
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