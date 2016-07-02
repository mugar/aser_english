<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
 		jQuery('#chambre').change(function(){
			chambre('buanderies',jQuery('#chambre option:selected').text());
		});
	});
</script>
<div class="factures index">
	<h2><?php __('Factures Buanderies');?></h2>
	<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Facture',array('id'=>'recherche','url'=>array('controller'=>'buanderies','action'=>'index')));?>
	<span class="left">
		<?php
			echo $this->Form->input('chambre_id',array('selected'=>0,'options'=>$chambres1,'label'=>'Chambre N°'));
			echo $this->Form->input('tier_id',array('selected'=>0,'options'=>$tiers1,'label'=>'Nom Du Customer'));
			echo $this->Form->input('Tier.compagnie');
			echo $this->Form->input('Facture.etat',array('options'=>array(''=>'',
																		'payee'=>'payee',
																		'credit'=>'credit',
																		'avance'=>'avance',
																		'bonus'=>'bonus',
																		'annulee'=>'annulee',
																		'non_nul'=>'Non annulee'
																		)
																	));
		?>
	</span>
	<span class="right">
		<?php
			
			echo $this->Form->input('numero',array('label'=>'Invoice N°'));
			echo $this->Form->input('Facture.montant');
			echo $this->Form->input('date1',array('label'=>'Date Début','type'=>'text'));				
			echo $this->Form->input('date2',array('label'=>'Date Fin','type'=>'text'));	
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>


<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Date</th>
		<th>N Chambre</th>
		<th>Customer</th>
		<th>Montant</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Facture',array('url'=>array('controller'=>'buanderies','action'=>'add')));?>
		<td><?php echo $this->Form->input('date',array('label'=>'','type'=>'text'));?></td>
		<td><?php echo $this->Form->input('chambre_id',array('id'=>'chambre','label'=>'','options'=>$chambres));?></td>
		<td><?php echo $this->Form->input('tier_id',array('id'=>'tierId','label'=>'','options'=>$tiers1,'selected'=>0,'disabled'=>'disabled'));?></td>
		<td><?php echo $this->Form->input('montant',array('label'=>''));?></td>
		<td><input type="submit" value="Save"/></td>
		</form>
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Buanderie',array('name'=>'checkbox','id'=>'Facture_factures'));?>	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('chambre_id');?></th>
			<th><?php echo $this->Paginator->sort('tier_id');?></th>
			<th><?php echo $this->Paginator->sort('numero');?></th>
			<th><?php echo $this->Paginator->sort('montant');?></th>
			<th><?php echo $this->Paginator->sort('Reste à Payer','reste');?></th>
			<th><?php echo $this->Paginator->sort('tva');?></th>
			<th><?php echo $this->Paginator->sort('monnaie');?></th>
			<th><?php echo $this->Paginator->sort('etat');?></th>
		</tr>
	<?php
	foreach ($factures as $facture){
		echo $this->element('../buanderies/add',array('facture'=>$facture));	
	}
	?>
	</table>
</form>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing  %current% records out of %count%, from %start%, to %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div id="separator" class="back" title="Hide the Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick="actions('checkbox','view')" >Afficher Les Détails</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link(__('Edition de Rapport', true), array('controller' => 'factures', 'action' => 'rapport')); ?> </li>
	</ul>
</div>
