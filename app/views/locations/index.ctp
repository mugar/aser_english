<div class="locations index">
	<h2><?php __('Locations');?></h2>
	<?php echo $this->Form->create('Location',array('name'=>'checkbox','id'=>'Location_locations'));?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('tier_id');?></th>
			<th><?php echo $this->Paginator->sort('facture_id');?></th>
			<th><?php echo $this->Paginator->sort('salle_id');?></th>
			<th><?php echo $this->Paginator->sort('arrivee');?></th>
			<th><?php echo $this->Paginator->sort('depart');?></th>
			<th><?php echo $this->Paginator->sort('Heure d\'entrée','entree');?></th>
			<th><?php echo $this->Paginator->sort('Heure d\'entrée','sortie');?></th>
			<th><?php echo $this->Paginator->sort('location');?></th>
			<th><?php echo $this->Paginator->sort('extras');?></th>
			<th><?php echo $this->Paginator->sort('montant');?></th>
			<th><?php echo $this->Paginator->sort('etat');?></th>
		</tr>
	<?php
	
	foreach ($locations as $location):
		
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$location['Location']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$location['Location']['id'])); ?>
		</td>
		<td><?php echo $location['Location']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($location['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $location['Tier']['id'])); ?>
		</td>
		<td name="facture" valeur="<?php echo $location['Facture']['id']; ?>">
			<?php echo $this->Html->link($location['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $location['Facture']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($location['Salle']['name'], array('controller' => 'salles', 'action' => 'view', $location['Salle']['id'])); ?>
		</td>
		<td><?php echo $location['Location']['arrivee']; ?>&nbsp;</td>
		<td><?php echo $location['Location']['depart']; ?>&nbsp;</td>
		<td><?php echo $location['Location']['entree']; ?>&nbsp;</td>
		<td><?php echo $location['Location']['sortie']; ?>&nbsp;</td>
		<td><?php echo $location['Location']['location']; ?>&nbsp;</td>
		<td name="extras"><?php echo $location['Location']['extras']; ?>&nbsp;</td>
		<td name="total"><?php echo $location['Location']['montant']; ?>&nbsp;</td>
		<td><?php echo $location['Location']['etat']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
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
	
	<div id='extras'></div>
</div>
<div id="separator" class="back" title="Hide the Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Location', true)), array('action' => 'add')); ?></li>
		<li class="link" onclick="actions('checkbox','edit')" >Edit</li>
		<li class="link" onclick="actions('checkbox','view')" >Afficher</li>
		<li class="link" onclick="actions('checkbox','delete')" >Delete</li>
		<li class="link"  onclick = "location_extras('checkbox','index')" >Lister Extra</li>
		<span id="extras_links" style="display:none">
			<li class="link"  onclick = "location_extras('checkbox','add')" >Créer Extra</li>
			<li class="link" onclick = "location_extras('checkbox','delete','extras_form')" >Delete Extra</li>
		</span>
		<?php echo $this->element('docs',array('actions'=>array('factures'),'type'=>'links')); ?>
		<li><?php echo $this->Html->link(sprintf(__('Lister/Create %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Invoices', true)), array('controller' => 'factures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Facture', true)), array('controller' => 'factures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Salles', true)), array('controller' => 'salles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Salle', true)), array('controller' => 'salles', 'action' => 'add')); ?> </li>
		
	</ul>
</div>

<!-- form for exta creation -->
<div id="extra_boxe" style="display:none" title="Création d'un extra">
<div class="dialog">
	<div id="message_extra"></div>
	<?php echo $this->Form->create('Location',array('id'=>'extraAdd','action'=>'extra_add'));?>
	<span class="left">
		<?php
			echo $this->Form->input('LocationExtra.name',array('id'=>'libelle','type'=>'textarea'));
			
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('LocationExtra.quantite',array('id'=>'quan'));
			echo $this->Form->input('LocationExtra.PU',array('id'=>'pu'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>

<!-- Divs for commande , bon & factures dialog-->
<?php echo $this->element('docs',array('actions'=>array('factures'),'model'=>'Location','type'=>'divs')); ?>
