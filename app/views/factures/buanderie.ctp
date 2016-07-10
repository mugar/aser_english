<div class="factures index">
	<h2><?php __('Factures Buanderies');?></h2>
	<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Facture',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('chambre_id',array('selected'=>0,'options'=>$tiers1,'label'=>'Chambre N°'));
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
			echo $this->Form->input('date1',array('label'=>'Start Date','type'=>'text'));				
			echo $this->Form->input('date2',array('label'=>'End Date','type'=>'text'));	
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>

	<?php echo $this->Form->create('Facture',array('name'=>'checkbox','id'=>'Facture_factures'));?>	<table cellpadding="0" cellspacing="0">
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
		echo $this->element('../factures/buanderie_add',array('facture'=>$facture));	
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
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link(__('Edition de Rapport', true), array('controller' => 'factures', 'action' => 'rapport')); ?> </li>
	</ul>
</div>
