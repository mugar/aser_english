<div class="typeChambres index">
	<h2><?php __('Gestion des Types Chambre');?></h2>
	
	<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Nom</th>
		<th>Montant/Nuitée</th>
		<th>Monnaie</th>
		<th>Description</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('TypeChambre',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('name',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('montant',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('monnaie',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('description',array('label'=>''));?></td>
		<td><input type="submit" value="Envoyer"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('TypeChambre',array('name'=>'checkbox','id'=>'TypeChambre_typeChambres'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Nom','name');?></th>
			<th><?php echo $this->Paginator->sort('Montant/nuitée','montant');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('Total des Chambres','chambres');?></th>
		</tr>
	<?php
	foreach ($typeChambres as $typeChambre){
		echo $this->element('../type_chambres/add',array('typeChambre'=>$typeChambre));
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
		<li class= "link" onclick = "edit()" >Modifier</li>
		<li class="link" onclick="mass_delete()" >Effacer</li>
		<li><?php echo $this->Html->link('Liste des Chambres', array('controller' => 'chambres', 'action' => 'index')); ?> </li>
	</ul>
</div>
