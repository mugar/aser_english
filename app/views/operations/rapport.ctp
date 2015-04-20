
<div id='view'>
<div class="document">
<h3>
<?php
	if(!empty($element)){
		echo 'Historique de : '.ucfirst($element[$model]['name']) ;
	}
?>
</h3>
<br/>
<?php
	if(isset($date1)){
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).', monnaie : '.$monnaie.')</h4>';
	}
	else {
		echo '<h4>(Monnaie : '.$monnaie.')</h4>';
	}
?>
<br/>
<br/>
<table cellpadding="0" cellspacing="0" id="recherche">
	<tr>
			<th>Date</th>
			<th width="50">N° Ordre</th>
			<th width="200">Libéllé</th>
			<th width="200">Mode de Paiement</th>
			<th width="150">Entrée</th>
			<th width="150">Sortie</th>
			<th width="150">Solde Progréssif</th>
			<th>Personnel</th>
		
	</tr>
	<?php if(!empty($ants)):?>
	<tr class="strong">
			<td colspan="4">REPORT</td>
			<?php if($where=='debit'):?>
				<td><?php echo  $number->format($ants[0]['Operation']['debit'],$decimal); ?></td>
				<td><?php echo  $number->format($ants[0]['Operation']['credit'],$decimal); ?></td>
			<?php else:?>
				<td><?php echo  $number->format($ants[0]['Operation']['credit'],$decimal); ?></td>
				<td><?php echo  $number->format($ants[0]['Operation']['debit'],$decimal); ?></td>
			<?php endif;?>
			<td><?php echo   $number->format($ants[0]['Operation']['solde'],$decimal); ?></td>
			<td></td>
	</tr>
	<?php endif;?>
		<?php
	foreach ($operations as $operation):
		
	?>
	<tr>
			<td><?php echo  $this->MugTime->toFrench($operation['Operation']['date']); ?></td>
			<td><?php echo  $operation['Operation']['op_num']; ?></td>
			<td><?php echo  $operation['Operation']['libelle']; ?></td>
			<td><?php echo  $operation['Operation']['mode_paiement']; ?></td>
			<?php if($where=='debit'):?>
				<td><?php echo  $number->format($operation['Operation']['debit'],$decimal); ?></td>
				<td><?php echo  $number->format($operation['Operation']['credit'],$decimal); ?></td>
			<?php else:?>
				<td><?php echo  $number->format($operation['Operation']['credit'],$decimal); ?></td>
				<td><?php echo  $number->format($operation['Operation']['debit'],$decimal); ?></td>
			<?php endif;?>
			<td><?php echo   $number->format($operation['Operation']['solde'],$decimal); ?></td>
			<td>
			<?php echo $operation['Personnel']['name']; ?>
			</td>
	</tr>
<?php endforeach; ?>
	<tr class="strong">
			<td colspan="4"></td>
			<?php if($where=='debit'):?>
				<td><?php echo  $number->format($debit,$decimal); ?></td>
				<td><?php echo  $number->format($credit,$decimal); ?></td>
			<?php else:?>
				<td><?php echo  $number->format($credit,$decimal); ?></td>
				<td><?php echo  $number->format($debit,$decimal); ?></td>
			<?php endif;?>
			<td><?php  echo   $number->format($solde,$decimal); ?></td>
			<td></td>
	</tr>
	
	<tr class="strong">
			<td colspan="4">TOTAL</td>
			<?php if($where=='debit'):?>
				<td><?php if(isset($ants[0]['Operation']['debit'])) 
								echo  $number->format($debit+$ants[0]['Operation']['debit'],$decimal);
							else  
								echo  $number->format($debit+$ants[0]['Operation']['debit'],$decimal);
				?></td>
				<td><?php if(isset($ants[0]['Operation']['credit'])) 
								echo  $number->format($credit+$ants[0]['Operation']['credit'],$decimal);
							else  
								echo  $number->format($credit+$ants[0]['Operation']['credit'],$decimal);
				?></td>
			<?php else:?>
				<td><?php if(isset($ants[0]['Operation']['credit'])) 
								echo  $number->format($credit+$ants[0]['Operation']['credit'],$decimal);
							else  
								echo  $number->format($credit+$ants[0]['Operation']['credit'],$decimal);
				?></td>
				<td><?php if(isset($ants[0]['Operation']['debit'])) 
								echo  $number->format($debit+$ants[0]['Operation']['debit'],$decimal);
							else  
								echo  $number->format($debit+$ants[0]['Operation']['debit'],$decimal);
				?></td>
			<?php endif;?>
			<td></td>
			<td></td>
	</tr>
</table>
<br />
<br />
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link(sprintf(__('Liste des Opérations', true), __('Operation', true)), array('action' => 'index')); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Operation',array('id'=>'recherche','action'=>'rapport/'.$model.'/'.$id));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('label'=>'Choisissez une date début'));
			echo $this->Form->input('date2',array('label'=>'et une date fin pour le rapport','type'=>'text'));
												
		?>
	</span>
	<span class="right">
		<?php
				echo $this->Form->input('monnaie');
				echo $this->Form->input('mode_paiement',array('options'=>$modePaiements));
				echo $this->Form->input('xls',array('label'=>'Exporter vers Excel','type'=>'checkbox'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>