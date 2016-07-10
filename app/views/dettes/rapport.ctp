<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
    /*
    //decide what to show or hide based on payment selection
   jQuery('#TierType option[value="client"]').attr('selected','selected');
 	// montant equivalent field stuff
 	jQuery('#TierType').change(function(){
		var type=jQuery(this).val();
 		if(type=='fournisseur'){
 			jQuery('#DetteChoix').removeAttr('disabled');
 		}
 		else {
 			jQuery('#DetteChoix').attr('disabled','disabled');
 		}
 	})
 	//*/
	
	});
</script>
<div id='view'>
<div class="document">
<h3>Rapport des Dettes</h3>

<br/>
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Tier</th>
			<th>Amount</th>
			<th>Maximum ou Plafond</th>
			<th>Type</th>
	</tr>
		<?php
	foreach ($dettes as $dette):
		
	?>
	<tr>
			<td><?php echo  $dette['Tier']['name']; ?></td>
			<td><?php echo  $number->format($dette['Dette']['montant']).' '.$dette['Dette']['monnaie']; ?></td>
			<td><?php if(!is_null($dette['Dette']['max'])) echo $number->format($dette['Dette']['max']).' '.$dette['Dette']['monnaie']; ?></td>
			<td><?php echo  ' A '.$dette['Dette']['type'].' terme'; ?></td>
	</tr>
<?php endforeach; ?>
	<?php
	foreach ($sums as $sum):
		
	?>
	<tr class="strong">
			<td>TOTAL</td>
			<td><?php echo  $number->format($sum['Dette']['montant']).' '.$sum['Dette']['monnaie']; ?></td>
			<td><?php echo  $number->format($sum['Dette']['max']).' '.$sum['Dette']['monnaie']; ?></td>
			<td>&nbsp;</td>
	</tr>
<?php endforeach; ?>
</table>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Lister Dettes', array('controller' => 'dettes', 'action' => 'index')); ?> </li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Dette',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('tier_id',array('selected'=>0));
			echo $this->Form->input('Tier.type',array('options'=>array('client'=>'client','fournisseur'=>'fournisseur')));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('monnaie',array('options'=>array('toutes'=>'toutes','RWF'=>'RWF','USD'=>'USD')));
			echo $this->Form->input('type',array('label'=>'Dette à ',
												'options'=>array(0=>'toutes',
																'court'=>'court terme',
																'moyen'=>'moyen terme',
																'long'=>'long terme',
																),
												'multiple'=>true,
												'selected'=>0
												)
									);
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>