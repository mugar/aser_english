<script>
	jQuery(document).ready(function(){
		jQuery( "#FactureDate1" ).datepicker( "option", "minDate", '2013-06-04' );
		jQuery( "#FactureDate2" ).datepicker( "option", "minDate", '2013-06-04' );
		jQuery( "#FactureDate2" ).datepicker( "option", "maxDate", new Date() );
	});
</script>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Facture',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('type'=>'date','type'=>'text','label'=>'Date Debut'));
			echo $this->Form->input('date2',array('type'=>'date','type'=>'text','label'=>'Date Fin'));
		?>
	</span>
	<span class="right">
		<?php
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id='view'>
<div class="document">
	
<div id="entete">
	<div class="left" >
		<?php echo $this->element('company'); ?>
	</div>
	
	
	<div style="clear:both"></div>
</div>

<br />
<br />
<br />
<br />
<br />
<br />
<br />

<br />
<br />
<br />
<br />
<br />
<br />
<br />

<h3 style="font-weight:bold;">Liste des Factures </h3>
<br />
<br />

<?php foreach($data as $date=>$detail):?>
	<?php if(!empty($data[$date])):?>
		<span class="titre" style="text-decoration: none; font-weight: normal;"><?php echo 'DATE : '.$this->MugTime->toFrench($date);?></span> 	
		<br />
		<table cellpadding="0" cellspacing="0">
			<tr>
				<th>N°Facture</th>
				<th>Montant</th>
			</tr>
			<?php foreach ($detail as $id=>$facture):?>
				<?php if(is_numeric($id)):?>
			<tr>
				<td >
					<?php echo $this->Html->link($facture['numero'], array('controller' => 'paiements', 'action' => 'silhouette_payment', $id,$facture['montant'])); ?>
				</td>
				<td><?php echo  $number->format($facture['montant'],$formatting); ?></td>
			</tr>
			<?php endif;?>
		<?php endforeach;?>
	<tr class="strong">
		<td>TOTAL JOURNALIER</td>
		<td><?php echo $number->format($detail['total'],$formatting);?></td>
	</tr>
<?php endif;?>
</table>
<?php endforeach; ?>
<table>
	<tr class="strong">
		<td>TOTAL GENERAL</td>
		<td><?php echo $number->format($totalGeneral,$formatting);?></td>
	</tr>
</table>
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
	
