<div class="sections index">
	<h2><?php __('Gestion Des Sections');?></h2>
		<br>
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Nom De La Section</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Section',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('name',array('label'=>''));?></td>
		<td><input type="submit" value="Envoyer"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Section',array('name'=>'checkbox','id'=>'Section_sections'));?>	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Nom','name');?></th>
		</tr>
	<?php
	
	foreach ($sections as $section){
		echo $this->element('../sections/add',array('section'=>$section));
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
	</ul>
</div>
