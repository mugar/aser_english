<script>
	jQuery(document).ready(function(){
		jQuery( "#OperationDate2" ).datepicker( "option", "maxDate", new Date() );
	});
</script>
<div id='view'>
<div class="document">
<h3>
	RESULTAT : <?php echo $number->format($resultat,$formatting).' '.$monnaie;?>
</h3>
<br/>
<?php
	if(isset($date1)&&isset($date1)){
			echo '<h4>From  '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).' <br/><br/>Taux de change pour USD => RWF : '.$taux.'</h4>';
	}
	
?>
<br/>
<br/>
<fieldset class="bilan">
<table id="actif" cellpadding="0" cellspacing="0">
	
		<?php 
			
			echo '<tr class="strong">';
				echo '<td>CHARGES</td>';
				echo '<td>'. $number->format($total_depenses,$formatting).'</td>';
				echo '</tr>';
				
			foreach($depenses as $depense) {
			
				echo '<tr width="400">';
				echo '<td>'.$depense['Type']['name'].'</td>'; 
				echo '<td style="font-weight:bold;font-size:14px;">'. $number->format($depense['Type']['montant'],$formatting).'</td>';
				echo '</tr>';
				$total_depenses+=$depense['Type']['montant'];
			}
				
		?>
</table>
	
<table id="passif" cellpadding="0" cellspacing="0">
	
		<?php 
			
				echo '<tr class="strong">';
				echo '<td>RECETTES</td>';
				echo '<td >'. $number->format($total_ventes,$formatting).'</td>';
				echo '</tr>';
				
			foreach($sections as $section) {
				if($section['Section']['montant']>0){
					echo '<tr>';
					echo '<td>'.$this->Html->link($section['Section']['name'], array('controller' => 'ventes', 'action' => 'consommations', $section['Section']['id'],$date1,$date2),array('target'=>'blank')).'</td>';
					echo '<td style="font-weight:bold;font-size:14px;">'. $number->format($section['Section']['montant'],$formatting).'</td>';
					echo '</tr>';
				}
			}
			if(Configure::read('aser.hotel')){
				echo '<tr>';
				echo '<td>'.$this->Html->link('HEBERGEMENT', array('controller' => 'reservations', 'action' => 'monthly',$date1,$date2),array('target'=>'blank')).'</td>';
				echo '<td style="font-weight:bold;font-size:14px;">'. $number->format($model['Reservation'],$formatting).'</td>';
				echo '</tr>';
			}
			if(Configure::read('aser.conference')){
				echo '<tr>';
				echo '<td>'.$this->Html->link('SALLE DE CONFERENCE', array('controller' => 'locations', 'action' => 'rapport',$date1,$date2),array('target'=>'blank')).'</td>';
				echo '<td style="font-weight:bold;font-size:14px;">'. $number->format($model['Location'],$formatting).'</td>';
				echo '</tr>';
			}
			if(Configure::read('aser.services')){
				echo '<tr>';
				echo '<td>'.$this->Html->link('AUTRES SERVICES', array('controller' => 'services', 'action' => 'rapport',$date1,$date2),array('target'=>'blank')).'</td>';
				echo '<td style="font-weight:bold;font-size:14px;">'. $number->format($model['Service'],$formatting).'</td>';
				echo '</tr>';
			}
		?>
</table>
</fieldset>
<br />
<br />
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link(sprintf(__('Liste des Opérations', true), __('Type', true)), array('action' => 'index')); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Operation',array('id'=>'recherche','action'=>'resultat'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date1',array('label'=>'Start Date'));
			echo $this->Form->input('date2',array('label'=>'End Date','type'=>'text'));
												
		?>
	</span>
	<span class="right">
		<?php
				echo $this->Form->input('taux',array('label'=>'Taux de Change','value'=>$taux));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>