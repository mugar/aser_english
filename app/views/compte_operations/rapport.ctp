
<div id='view'>
<div class="document">
<?php if(empty($comptes)) echo '<h3>GRAND LIVRE</h3>';?>
<?php 
//die(debug($comptes));
 foreach($comptes as $compte):?>
<h3>
<?php
	if(!empty($compte)){
		echo 'Compte : '.$compte['Compte']['numero'].' - '.$compte['Compte']['name'] ;
	}
?>
</h3>
<br/>
<?php
	if(isset($date1)){
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).')';
	}
?>
<br/>
<br/><br/>
<table cellpadding="0" cellspacing="0" id="recherche">
	<tr class="border">
			<th rowspan="2">Date</th>
			<th colspan="2">Ouverture</th>
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
	<?php if(!empty($compte['ants'][0])):?>
	<tr>
			<td></td>
			<?php if($compte['ants'][0]['CompteOperation']['solde']>0):?>
				<td><?php echo  $number->format(abs($compte['ants'][0]['CompteOperation']['solde']),$formatting); ?></td>
				<td></td>
			<?php else:?>
				
				<td></td>
				<td><?php echo  $number->format(abs($compte['ants'][0]['CompteOperation']['solde']),$formatting); ?></td>
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
	foreach ($compte['op'] as $operation):
		
	?>
	<tr>
			<td><?php echo  $this->MugTime->toFrench($operation['CompteOperation']['date']); ?></td>
			<td></td>
			<td></td>
			<td><?php echo  $operation['CompteOperation']['libelle']; ?></td>
			<td><?php echo  $number->format($operation['CompteOperation']['debit'],$formatting); ?></td>
			<td><?php echo  $number->format($operation['CompteOperation']['credit'],$formatting); ?></td>
			<?php if($operation['CompteOperation']['solde']>0):?>
				<td><?php echo  $number->format(abs($operation['CompteOperation']['solde']),$formatting); ?></td>
				<td></td>
			<?php else:?>
				<td></td>
				<td><?php echo  $number->format(abs($operation['CompteOperation']['solde']),$formatting); ?></td>				
			<?php endif;?>
			<td>
			<?php echo $operation['Personnel']['name']; ?>
			</td>
			<td><?php echo  $operation['CompteOperation']['created']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr class="strong">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><?php  echo   $number->format($compte['debit'],$formatting); ?></td>
			<td><?php  echo   $number->format($compte['credit'],$formatting); ?></td>
			<?php if($compte['solde']>0):?>
				<td><?php echo  $number->format(abs($compte['solde']),$formatting); ?></td>
				<td></td>
			<?php else:?>
				<td></td>
				<td><?php echo  $number->format(abs($compte['solde']),$formatting); ?></td>				
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
		<li class="link"  onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link(sprintf(__('Liste des Opérations', true), __('CompteOperation', true)), array('action' => 'index')); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
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
			echo $this->Form->input('compte_id',array('options'=>$list,'selected'=>0));
			echo $this->Form->input('date1',array('label'=>'Choisissez une date début'));
			echo $this->Form->input('date2',array('label'=>'et une date fin pour le rapport','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>