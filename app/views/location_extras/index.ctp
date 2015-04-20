<div class="locationExtras index">
	<h2><?php __('Location Extras');?></h2>
	<?php echo $this->Form->create('LocationExtra',array('name'=>'checkbox','id'=>'LocationExtra_locationExtras'));?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('location_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('quantite');?></th>
			<th><?php echo $this->Paginator->sort('PU');?></th>
			<th><?php echo $this->Paginator->sort('montant');?></th>
			<th><?php echo $this->Paginator->sort('monnaie');?></th>
		</tr>
	<?php
	
	foreach ($locationExtras as $locationExtra):
		
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$locationExtra['LocationExtra']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$locationExtra['LocationExtra']['id'])); ?>
		</td>
		<td><?php echo $locationExtra['LocationExtra']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($locationExtra['Location']['id'], array('controller' => 'locations', 'action' => 'view', $locationExtra['Location']['id'])); ?>
		</td>
		<td><?php echo $locationExtra['LocationExtra']['name']; ?>&nbsp;</td>
		<td><?php echo $locationExtra['LocationExtra']['quantite']; ?>&nbsp;</td>
		<td><?php echo $locationExtra['LocationExtra']['PU']; ?>&nbsp;</td>
		<td><?php echo $locationExtra['LocationExtra']['montant']; ?>&nbsp;</td>
		<td><?php echo $locationExtra['LocationExtra']['monnaie']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
</form>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% de %pages%, affichage de %current% enregistrements sur %count% au total, à partir du numéro %start%, jusqu\'au numéro %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('précédent', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('suivant', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div id="separator" class="back" title="Cacher Le Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Location Extra', true)), array('action' => 'add')); ?></li>
		<li class="link" onclick="actions('checkbox','edit')" >Modifier</li>
		<li class="link" onclick="actions('checkbox','view')" >Afficher</li>
		<li class="link" onclick="actions('checkbox','delete')" >Effacer</li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Locations', true)), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Créer %s', true), __('Location', true)), array('controller' => 'locations', 'action' => 'add')); ?> </li>
	</ul>
</div>
