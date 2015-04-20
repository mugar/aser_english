<div class="groupes index">
	<h2><?php __('Gestion Des Groupes');?></h2>
	<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	
		<th>Section</th>			
		<th>Nom Du Groupe</th>
		<th>Afficher sur l'interface de vente</th>
		<?php if(!Configure::read('aser.magasin')&&Configure::read('aser.advanced_stock')):?>
		<th>Groupe pour les Accompagments</th>
		<?php endif;?>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Groupe',array('action'=>'add'));?>
		
		<td><?php echo $this->Form->input('section_id',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('name',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('afficher',array('label'=>'','options'=>array('oui'=>'oui','non'=>'non')));?></td>
		<?php if(!Configure::read('aser.magasin')&&Configure::read('aser.advanced_stock')):?>
			<td><?php echo $this->Form->input('accompagnement',array('label'=>'','options'=>array('non'=>'non','oui'=>'oui')));?></td>
		<?php endif;?>
		<td><input type="submit" value="Envoyer"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Groupe',array('name'=>'checkbox','id'=>'Groupe_groupes'));?>	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('section_id');?></th>
			<th><?php echo $this->Paginator->sort('Nom','name');?></th>
			<th><?php echo $this->Paginator->sort('afficher');?></th>
			<?php if(!Configure::read('aser.magasin')&&Configure::read('aser.advanced_stock')):?>
				<th><?php echo $this->Paginator->sort('accompagnement');?></th>
			<?php endif;?>
			<th><?php echo $this->Paginator->sort('actif');?></th>
		</tr>
	<?php

	foreach ($groupes as $groupe){
		echo $this->element('../groupes/add',array('groupe'=>$groupe));
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
		<li class= "link" onclick = "mass_delete()" >Effacer</li>
		<?php if(Configure::read('aser.touchscreen')):?>
			<li class="link"  onclick = "upload()" >Importer une image</li>
		<?php endif;?>
	</ul>
</div>

<!-- form for image upload-->
<div id="upload_boxe" style="display:none" title="Importer une image">
<div class="dialog">
	<div id="message_upload"></div>
	<?php echo $this->Form->create('Groupe',array('id'=>'upload','action'=>'upload_img','type'=>'file'));?>
	<span class="left">
		<?php	
			echo $this->Form->input('Groupe.image',array('type'=>'file','id'=>'file'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>