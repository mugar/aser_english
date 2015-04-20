<div class="salles index">
	<h2><?php __('Gestions Des Salles');?></h2>
	<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Nom de la Salle</th>
		<th>Montant/Jour</th>
		<th>Capacité</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Salle',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('name',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('montant',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('capacite',array('label'=>''));?></td>
		<td><input type="submit" value="Envoyer"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Salle',array('name'=>'checkbox','id'=>'Salle_salles'));?>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('Nom','name');?></th>
			<th><?php echo $this->Paginator->sort('Montant/Jour','montant');?></th>
			<th><?php echo $this->Paginator->sort('Capacité','capacite');?></th>
		</tr>
	<?php
	
	foreach ($salles as $salle){
		echo $this->element('../salles/add',array('salle'=>$salle));
	}
	?>
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
		<li class="link" onclick="edit()" >Modifier</li>
		<li class="link" onclick="mass_delete()" >Effacer</li>
		<li><?php echo $this->Html->link('Gestions des Locations', array('controller' => 'locations', 'action' => 'tabella')); ?> </li>
	</ul>
</div>
