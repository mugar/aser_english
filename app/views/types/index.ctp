<div class="types index">
	<h2><?php __('Types d\'entrées et de dépenses');?></h2>
	<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Type',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('name',array('id'=>'nom','value'=>'toutes'));
			echo $this->Form->input('type',array('options'=>$optionsForType1s
										));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('actif',array('options'=>array('toutes'=>'toutes',
																	'oui'=>'oui',
																	'non'=>'non'
																	)
												)
									);
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
	<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Nom</th>
		<th>Choisir le Type</th>	
		<th>Catégorie</th>	
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Type',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('name',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('type',array('label'=>'','options'=>$optionsForTypes));?></td>
		<td><?php echo $this->Form->input('categorie',array('label'=>'','options'=>$categories));?></td>
		<td><input type="submit" value="Envoyer"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Type',array('name'=>'checkbox','id'=>'Type_types'));?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th>Catégorie</th>
			<th><?php echo $this->Paginator->sort('actif');?></th>
		</tr>
	<?php
	
	foreach ($types as $type):
		echo $this->element('../types/add',array('type'=>$type));
	?>
	
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
		<li class= "link" onclick = "edit()" >Modifier</li>
		<li class= "link" onclick = "mass_delete()" >Effacer</li>
		<li class="link" onclick="recherche()" >Options de Recherche</li>
	</ul>
</div>
