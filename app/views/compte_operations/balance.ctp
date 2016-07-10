<div id='view'>
<div class="document">
<h3>BALANCE</h3>
<?php
	if(isset($date1)){
			echo '<h4>(From  '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).')</h4>';
		}
?>
<br />	
<br />	
<table cellpadding="0" cellspacing="0" id="recherche">
	<tr class="border">
			<th rowspan="2">Numéro</th>
			<th rowspan="2">Compte</th>
			<th colspan="2">Ouverture</th>
			<th colspan="2">Mouvements</th>
			<th colspan="2">Solde</th>
		
	</tr>
	<tr class="border">
			<th>Débit</th>
			<th>Crédit</th>
			<th>Débit</th>
			<th>Crédit</th>
			<th>Débit</th>
			<th>Crédit</th>
		
	</tr>
	
	<?php foreach($comptes as $compte):?>
	<tr>
		<td><?php echo  $compte['Compte']['numero']; ?></td>
			<td><?php echo  $compte['Compte']['name']; ?></td>
			<?php if($compte['report']>0):?>
				<td><?php echo  $number->format(abs($compte['report']),$formatting); ?></td>
				<td></td>
			<?php else:?>
				<td></td>
				<td><?php echo  $number->format(abs($compte['report']),$formatting); ?></td>
			<?php endif;?>
			<td><?php echo  $number->format($compte['debit'],$formatting); ?></td>
			<td><?php echo  $number->format($compte['credit'],$formatting); ?></td>
			<?php if($compte['solde']>0):?>
				<td><?php echo  $number->format(abs($compte['solde']),$formatting); ?></td>
				<td></td>
			<?php else:?>
				<td></td>
				<td><?php echo  $number->format(abs($compte['solde']),$formatting); ?></td>
			<?php endif;?>
	</tr>
<?php endforeach; ?>
<tr class="strong">
		<td >TOTAL</td>
			<td></td>
			<?php if($report>0):?>
				<td><?php echo  $number->format(abs($report),$formatting); ?></td>
				<td></td>
			<?php else:?>
				<td></td>
				<td><?php echo  $number->format(abs($report),$formatting); ?></td>				
			<?php endif;?>
			<td><?php echo  $number->format($debit,$formatting); ?></td>
			<td><?php echo  $number->format($credit,$formatting); ?></td>
			<?php if($solde>0):?>
				<td><?php echo  $number->format(abs($solde),$formatting); ?></td>
				<td></td>
			<?php else:?>
				<td></td>
				<td><?php echo  $number->format(abs($solde),$formatting); ?></td>				
			<?php endif;?>
	</tr>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link(sprintf(__('Liste des comptes', true), __('CompteOperation', true)), array('action' => 'index')); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('CompteOperation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo '<div><label>Compte du : </label></div>';
			echo $ajax->autoComplete('CompteOperation.compte1','/compteOperations/autoComplete/compte1');
			
			echo '<div><label>Au : </label></div>';
			echo $ajax->autoComplete('CompteOperation.compte2','/compteOperations/autoComplete/compte2');
		
												
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('choix',array('options'=>array(''=>'',
																	'caisses'=>'caisses',
																	'clients'=>'clients',
																	'fournisseurs'=>'fournisseurs',
																	'ventes'=>'ventes',
																	'depenses'=>'depenses'
														)));
			echo $this->Form->input('date1',array('label'=>'Start Date'));
			echo $this->Form->input('date2',array('label'=>'End Date','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>