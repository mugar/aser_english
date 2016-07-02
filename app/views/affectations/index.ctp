<div class="affectations index">
	<h2><?php __('Affectations');?></h2>
	
	
	<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Affectation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('Reservation.tier_id',array('selected'=>0,'label'=>'Customer Principal'));
			echo $this->Form->input('chambre_id',array('selected'=>0));
			
			echo $this->Form->input('montant',array('value'=>'toutes'));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('Reservation.id',array('label'=>'Numero de la Réservation','type'=>'text'));
			echo $this->Form->input('tier_id',array('selected'=>0,'label'=>'Occupant'));
			echo $this->Form->input('Reservation.etat',array('options'=>array(0=>'toutes',
																			'en_attente'=>'en attente',
																			'confirmee'=>'confirmée',
																			'arrivee'=>'arrivée',
																			'partie'=>'partie',
																			'annulee'=>'annulée'
																			)
																));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
	<?php echo $this->Form->create('Affectation',array('name'=>'checkbox','id'=>'Affectation_affectations'));?>	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('reservation_id');?></th>
			<th><?php echo $this->Paginator->sort('chambre_id');?></th>
			<th><?php echo $this->Paginator->sort('tier_id');?></th>
			<th><?php echo $this->Paginator->sort('etat');?></th>
			<th><?php echo $this->Paginator->sort('entree');?></th>
			<th><?php echo $this->Paginator->sort('sortie');?></th>
			<th><?php echo $this->Paginator->sort('commentaire');?></th>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
		</tr>
	<?php
	$i = 0;
	$j = 0;
	foreach ($affectations as $affectation):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Form->input('Id.'.$j.'',array('label'=>'','type'=>'checkbox','value'=>$affectation['Affectation']['id'])); ?>
		</td>
		<td><?php echo $affectation['Affectation']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($affectation['Reservation']['id'], array('controller' => 'reservations', 'action' => 'view', $affectation['Reservation']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($affectation['Chambre']['name'], array('controller' => 'chambres', 'action' => 'view', $affectation['Chambre']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($affectation['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $affectation['Tier']['id'])); ?>
		</td>
		<td><?php echo $affectation['Affectation']['etat']; ?>&nbsp;</td>
		<td><?php echo $affectation['Affectation']['entree']; ?>&nbsp;</td>
		<td><?php echo $affectation['Affectation']['sortie']; ?>&nbsp;</td>
		<td><?php echo $affectation['Affectation']['commentaire']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($affectation['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $affectation['Personnel']['id'])); ?>
		</td>
		<td><?php echo $affectation['Affectation']['created']; ?>&nbsp;</td>
		<td><?php echo $affectation['Affectation']['modified']; ?>&nbsp;</td>
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
</div>
<div id="separator" class="back" title="Hide the Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick="actions('checkbox','view')" >Afficher</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Reservations', true)), array('controller' => 'reservations', 'action' => 'index')); ?> </li>
		
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Chambres', true)), array('controller' => 'chambres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Chambre', true)), array('controller' => 'chambres', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister/Create %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		
		 
	</ul>
</div>
