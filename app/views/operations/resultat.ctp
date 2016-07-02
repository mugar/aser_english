<script>
	jQuery(document).ready(function(){
		jQuery( "#OperationDate2" ).datepicker( "option", "maxDate", new Date() );
	});
</script>
<style type="text/css">
	.sous_total {
		font-size: 12px;
		font-weight: bold;
	}
	.categorie td {
		text-align: center !important;
		font-size: 12px;
		font-weight: bold;
	}
</style>
<div id='view'>
<div class="document">
<h3>
	RESULTAT : <?php echo $number->format($marge_net,$formatting).' '.$monnaie;?>
</h3>
<br/>
<?php
	if(isset($date1)&&isset($date1)){
			echo '<h4>Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).' <br/><br/>Taux de change pour USD => BIF : '.$taux.'</h4>';
	}
	
?>
<br/>
<br/>


	
<table  cellpadding="0" cellspacing="0">
	
		<?php 
			
				echo '<tr class="categorie">';
				echo '<td colspan="2">RECETTES</td>';
				echo '</tr>';
				
			foreach($sections as $section) {
				if($section['Section']['montant']>0){
					echo '<tr>';
					echo '<td>'.$this->Html->link($section['Section']['name'], array('controller' => 'ventes', 'action' => 'consommations', $section['Section']['id'],$date1,$date2),array('target'=>'blank')).'</td>';
					echo '<td >'. $number->format($section['Section']['montant'],$formatting).'</td>';
					echo '</tr>';
				}
			}
			if(Configure::read('aser.hotel')){
				echo '<tr>';
				echo '<td>'.$this->Html->link('HEBERGEMENT', array('controller' => 'reservations', 'action' => 'monthly',$date1,$date2),array('target'=>'blank')).'</td>';
				echo '<td >'. $number->format($model['Reservation'],$formatting).'</td>';
				echo '</tr>';
			}
			if(Configure::read('aser.conference')){
				echo '<tr>';
				echo '<td>'.$this->Html->link('SALLE DE CONFERENCE', array('controller' => 'locations', 'action' => 'rapport',$date1,$date2),array('target'=>'blank')).'</td>';
				echo '<td >'. $number->format($model['Location'],$formatting).'</td>';
				echo '</tr>';
			}
			if(Configure::read('aser.services')){
				echo '<tr>';
				echo '<td>'.$this->Html->link('AUTRES SERVICES', array('controller' => 'services', 'action' => 'rapport',$date1,$date2),array('target'=>'blank')).'</td>';
				echo '<td >'. $number->format($model['Service'],$formatting).'</td>';
				echo '</tr>';
			}
				echo '<tr class="sous_total">';
				echo '<td>TOTAL VENTES</td>';
				echo '<td >'. $number->format($total_ventes,$formatting).'</td>';
				echo '</tr>';

				echo '<tr class="categorie">';
				echo '<td colspan="2">- '.Configure::read('categories.1').'</td>';
				echo '</tr>';

			if(Configure::read('aser.stock')){
				echo '<tr>';
				echo '<td>SORTIES STOCK</td>';
				echo '<td>'. $number->format($total_sortis,$formatting).'</td>';
				echo '</tr>';
			}
				
			foreach($depenses_by_categories[1]['depenses'] as $depense) {
				echo '<tr width="400">';
				echo '<td>'.$depense['name'].'</td>'; 
				echo '<td >'. $number->format($depense['montant'],$formatting).'</td>';
				echo '</tr>';
			}
				echo '<tr class="sous_total">';
				echo '<td>TOTAL '.strtoupper(Configure::read('categories.1')).'</td>';
				echo '<td >'. $number->format($depenses_by_categories[1]['montant'],$formatting).'</td>';
				
				echo '<tr class="strong">';
				echo '<td >MARGE BRUTE</td>';
				echo '<td >'. $number->format($marge_brute,$formatting).'</td>';
				echo '</tr>';


				echo '<tr class="categorie">';
				echo '<td colspan="2">- '.Configure::read('categories.2').'</td>';
				echo '</tr>';
				foreach($depenses_by_categories[2]['depenses'] as $depense) {
				echo '<tr width="400">';
				echo '<td>'.$depense['name'].'</td>'; 
				echo '<td >'. $number->format($depense['montant'],$formatting).'</td>';
				echo '</tr>';
			}
				echo '<tr class="sous_total">';
				echo '<td>TOTAL '.strtoupper(Configure::read('categories.2')).'</td>';
				echo '<td >'. $number->format($depenses_by_categories[2]['montant'],$formatting).'</td>';
				echo '<tr class="strong">';
				echo '<td >MARGE INTERMEDIAIRE</td>';
				echo '<td >'. $number->format($marge_intermediaire,$formatting).'</td>';
				echo '</tr>';

				echo '<tr class="categorie">';
				echo '<td colspan="2">- '.Configure::read('categories.3').'</td>';
				echo '</tr>';

				foreach($depenses_by_categories[3]['depenses'] as $depense) {
				echo '<tr width="400">';
				echo '<td>'.$depense['name'].'</td>'; 
				echo '<td >'. $number->format($depense['montant'],$formatting).'</td>';
				echo '</tr>';
			}
				echo '<tr class="sous_total">';
				echo '<td>TOTAL '.strtoupper(Configure::read('categories.3')).'</td>';
				echo '<td >'. $number->format($depenses_by_categories[3]['montant'],$formatting).'</td>';
				echo '<tr class="strong">';
				echo '<td >MARGE EXPLOITATION</td>';
				echo '<td >'. $number->format($marge_exploitation,$formatting).'</td>';
				echo '</tr>';

				echo '<tr class="categorie">';
				echo '<td colspan="2">- '.Configure::read('categories.4').'</td>';
				echo '</tr>';

				foreach($depenses_by_categories[4]['depenses'] as $depense) {
				echo '<tr width="400">';
				echo '<td>'.$depense['name'].'</td>'; 
				echo '<td >'. $number->format($depense['montant'],$formatting).'</td>';
				echo '</tr>';
			}
				echo '<tr class="sous_total">';
				echo '<td>TOTAL '.strtoupper(Configure::read('categories.4')).'</td>';
				echo '<td>'. $number->format($depenses_by_categories[4]['montant'],$formatting).'</td>';
				echo '<tr class="strong">';
				echo '<td >MARGE NET</td>';
				echo '<td >'. $number->format($marge_net,$formatting).'</td>';
				echo '</tr>';
		?>
</table>
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