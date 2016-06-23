<script>
	jQuery(document).ready(function(){
		jQuery( "#OperationDate2" ).datepicker( "option", "maxDate", new Date() );
	});
</script>
<div id='view'>
<div class="document">

<?php if(empty($limits)): echo "<h3> Pas de limites définis pour cette année $year"; ?>
<?php else:?> 
<h3>
	LIMITES
</h3>
<br/>
<?php
	if(!empty($year)){
			echo '<h4>Année '.$year.'</h4>';
	}
	
?>
<br/>
<br/>
<?php 
	$position=0;
	for($month=1; $month<=12; $month++):
?>
		<div  style="width:220px; border: 1px solid #ccc; padding: 5px; margin: 20px; display:block; float:left;">
		<table>
			<tr>
				<th colspan="2" style="text-align: center; font-size: 20px;"><?php echo $this->MugTime->giveMonth($month);?><th>
			</tr>
			<tr>
				<th colspan="2" style="text-align: center;"><button month="<?php echo $month;?>" year="<?php echo $year;?>" onclick="generate_monthly_limits(this)">Générer les limites</button><th>
			</tr>
			<tr>
				<th>Date</th>
				<th>Montant</th>
			</tr>
			<?php
				$month_days=cal_days_in_month(CAL_GREGORIAN,$month,$year);
				$current_stop=$position+$month_days;
				for($position; $position<$current_stop; $position++):
			?>
				<tr>
					<td><?php //echo $position; exit(debug($limits));
					 echo $limits[$position]['Limit']['date'];
					 echo $this->Html->image('ok.png', array('id'=>$limits[$position]['Limit']['date'],'alt'=>'OK', 'border' => '0','width'=>16,'height'=>16, 'style'=>'display:none'));
					?></td>
					<td><input  style="width:100px;" date="<?php echo $limits[$position]['Limit']['date'];?>" value="<?php echo $limits[$position]['Limit']['montant'];?>" onchange="set_limite_montant(this)"/>
					</td>
				</tr>
				<?php endfor;?>
		</table>
		</div>
		<?php if($month%4==0):?>
			<div style="clear:both;"></div>
		<?php endif;?>
<?php endfor;?>
<?php endif;?>
<br />
<br />
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "year_limits()" >Changer l'année</li>
		<li><?php echo $this->Html->link(sprintf(__('Liste des Opérations', true), __('Type', true)), array('action' => 'index')); ?></li>
	</ul>
</div>

<!--goTo  form -->
<div id="year_limits_boxe" style="display:none" title="Choisissez l'année à afficher">
<div class="dialog" id="goto">
	<span class='left'>
		<?php
			echo $this->Form->input('annee',array('id'=>'umwaka','label'=>'Année','type'=>'date','dateFormat'=>'Y'));
		?>
	</span>
	<span class="right">
		
	</span>
<div style="clear:both"></div>
</div>
</div>
</div>