
<div id='view'>
<div class="document">
<?php if(empty($personnels)) echo '<h3>Historique des versements</h3>';?>
<?php 
//die(debug($personnels));
 foreach($personnels as $personnel):?>
<h3>
<?php
	if(!empty($personnel)){
		echo 'Personnel : '.$personnel['Personnel']['numero'].' - '.$personnel['Personnel']['name'] ;
	}
?>
</h3>
<br/>
<?php
	if(isset($date1)){
			echo '<h4>(From  '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).')';
	}
?>
<br/>
<br/><br/>
<table cellpadding="0" cellspacing="0" id="recherche" class="border">
	<tr class="border">
			<th rowspan="2">Date</th>
			<th colspan="2">Report</th>
			<th rowspan="2">Libéllé</th>
			<th colspan="2">Mouvements</th>
			<th colspan="2">Solde Progressif</th>
			<th rowspan="2">Personnel</th>
			<th rowspan="2">Heure Création</th>
		
	</tr>
	<tr class="border">
			<th>Débit</th>
			<th>Crédit</th>
			<th>Débit</th>
			<th>Crédit</th>
			<th>Débit</th>
			<th>Crédit</th>
	</tr>
	<?php if(!empty($personnel['ants'][0])):?>
	<tr>
			<td></td>
			<?php if($personnel['ants'][0]['Journal']['solde']>0):?>
				<td><?php echo  $number->format(abs($personnel['ants'][0]['Journal']['solde']),$formatting); ?></td>
				<td></td>
			<?php else:?>
				
				<td></td>
				<td><?php echo  $number->format(abs($personnel['ants'][0]['Journal']['solde']),$formatting); ?></td>
			<?php endif;?>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
	</tr>
	<?php endif;?>
		<?php
	foreach ($personnel['op'] as $operation):
		
	?>
	<tr>
			<td><?php echo  $this->MugTime->toFrench($operation['Journal']['date']); ?></td>
			<td></td>
			<td></td>
			<td><?php echo  $operation['Journal']['libelle']; ?></td>
			<td><?php echo  $number->format($operation['Journal']['debit'],$formatting); ?></td>
			<td><?php echo  $number->format($operation['Journal']['credit'],$formatting); ?></td>
			<?php if($operation['Journal']['solde']>0):?>
				<td><?php echo  $number->format(abs($operation['Journal']['solde']),$formatting); ?></td>
				<td></td>
			<?php else:?>
				<td></td>
				<td><?php echo  $number->format(abs($operation['Journal']['solde']),$formatting); ?></td>				
			<?php endif;?>
			<td>
			<?php echo $operation['Personnel']['name']; ?>
			</td>
			<td><?php echo  $operation['Journal']['created']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr class="strong">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><?php  echo   $number->format($personnel['debit'],$formatting); ?></td>
			<td><?php  echo   $number->format($personnel['credit'],$formatting); ?></td>
			<?php if($personnel['solde']>0):?>
				<td><?php echo  $number->format(abs($personnel['solde']),$formatting); ?></td>
				<td></td>
			<?php else:?>
				<td></td>
				<td><?php echo  $number->format(abs($personnel['solde']),$formatting); ?></td>				
			<?php endif;?>
			<td></td>
			<td></td>
	</tr>
	
</table>
<br />
<br />
<?php endforeach;?>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link(sprintf(__('Liste des Opérations', true), __('Journal', true)), array('action' => 'index')); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Journal',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('personnel_id',array('label'=>'Caissier','options'=>$caissiers));												
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