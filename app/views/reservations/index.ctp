<div class="reservations index">
	<h2><?php __('Reservations');?></h2>
	<br>
	
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Reservation',array('id'=>'recherche','action'=>'index'));?>
	<span class="left">
		<?php
			echo $this->Form->input('id',array('type'=>'text','value'=>'toutes','label'=>'Numero'));
			echo $this->Form->input('tier_id',array('selected'=>0));
			echo $this->Form->input('checked_in',array('type'=>'text','id'=>'DateArrivee'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('depart',array('type'=>'text','id'=>'DateDeparture'));
			echo $this->Form->input('type_chambre_id',array('selected'=>0));
			echo $this->Form->input('choix',array('options'=>array('toutes'=>'toutes',
																'checked_ins'=>'checked_ins',
																'departs'=>'departs',
																'actif'=>'actif',
																'avenir'=>'avenir',
																'en_cours'=>'en_cours',
																'passee'=>'passee',
																'canceled'=>'canceled',
																)));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>	
	<?php echo $this->Form->create('Reservation',array('name'=>'checkbox','action'=>'documents','id'=>'Reservation_reservations'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('tier_id');?></th>
			<th><?php echo $this->Paginator->sort('facture_id');?></th>
			<th><?php echo $this->Paginator->sort('Paiement','Facture.etat');?></th>
			<th><?php echo $this->Paginator->sort('type_chambre_id');?></th>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('adultes');?></th>
			<th><?php echo $this->Paginator->sort('enfants');?></th>
			<th><?php echo $this->Paginator->sort('checked_in');?></th>
			<th><?php echo $this->Paginator->sort('depart');?></th>
			<th><?php echo $this->Paginator->sort('PU');?></th>
			<th><?php echo $this->Paginator->sort('montant');?></th>
			<th><?php echo $this->Paginator->sort('monnaie');?></th>
			<th><?php echo $this->Paginator->sort('etat');?></th>
			<th><?php echo $this->Paginator->sort('moyen');?></th>
			<th><?php echo $this->Paginator->sort('contexte');?></th>
			<th><?php echo $this->Paginator->sort('commentaire');?></th>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
		</tr>
	<?php
	$i = 0;
	$j = 0;
	foreach ($reservations as $reservation):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Form->input('Id.'.$j.'',array('label'=>'','type'=>'checkbox','value'=>$reservation['Reservation']['id'])); ?>
		</td>
		<td><?php echo $reservation['Reservation']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($reservation['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $reservation['Tier']['id'])); ?>
		</td>
		<td name="facture" valeur="<?php echo $reservation['Facture']['id']; ?>">
			<?php echo $this->Html->link($reservation['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $reservation['Facture']['id'])); ?>
		</td>
		<td><?php echo $reservation['Facture']['etat']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($reservation['TypeChambre']['name'], array('controller' => 'type_chambres', 'action' => 'view', $reservation['TypeChambre']['id'])); ?>
		</td>
		<td><?php echo $reservation['Reservation']['nombre']; ?>&nbsp;</td>
		<td><?php echo $reservation['Reservation']['adultes']; ?>&nbsp;</td>
		<td><?php echo $reservation['Reservation']['enfants']; ?>&nbsp;</td>
		<td><?php echo $reservation['Reservation']['checked_in']; ?>&nbsp;</td>
		<td><?php echo $reservation['Reservation']['depart']; ?>&nbsp;</td>
		<td><?php echo $reservation['Reservation']['PU']; ?>&nbsp;</td>
		<td><?php echo $reservation['Reservation']['montant']; ?>&nbsp;</td>
		<td><?php echo $reservation['Reservation']['monnaie']; ?>&nbsp;</td>
		<td><?php echo $reservation['Reservation']['etat']; ?>&nbsp;</td>
		<td><?php echo $reservation['Reservation']['moyen']; ?>&nbsp;</td>
		<td><?php echo $reservation['Reservation']['contexte']; ?>&nbsp;</td>
		<td><?php echo $reservation['Reservation']['commentaire']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($reservation['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $reservation['Personnel']['id'])); ?>
		</td>
		<td><?php echo $reservation['Reservation']['created']; ?>&nbsp;</td>
		<td><?php echo $reservation['Reservation']['modified']; ?>&nbsp;</td>
	</tr>
<?php  $j++; endforeach; ?>
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
	<div id='affectation'></div>
</div>
<div id="separator" class="back" title="Hide the Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class= "link" onclick = "actions('checkbox','edit')" >Edit</li>
		<li class="link"  onclick="actions('checkbox','view')" >Afficher</li>
		<li class="link" onclick = "actions('checkbox','trace')" >Historique</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link(__('Tableau d\'occupation', true), array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
		<?php echo $this->element('docs',array('actions'=>array('factures'),'type'=>'links')); ?>
		<li class="link" onclick = "actions('checkbox','affectation_index')" >Gestions Affectations</li>
		<span id='actions' style="display:none;">
		<li class="link"  onclick = "actions('checkbox','affectation_add')" >Créer Affectation </li>
		<li class="link" onclick = "actions('checkbox','affectation_edit','affectation')" >Edit Affectation</li>
		<li class="link" onclick = "actions('checkbox','affectation_delete','affectation')" >Delete Affectations</li>
		</span>
		<li><a href="#"  onclick = "actions('checkbox','extras')" >Détails des consommations</a> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister/Create %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Type Chambres', true)), array('controller' => 'type_chambres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Type Chambre', true)), array('controller' => 'type_chambres', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Affectations', true)), array('controller' => 'affectations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Affectation', true)), array('controller' => 'affectations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<!-- Divs for commande , bon & factures dialog-->
<?php echo $this->element('docs',array('actions'=>array('factures'),'model'=>'Reservation','type'=>'divs')); ?>

