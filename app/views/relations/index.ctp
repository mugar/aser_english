<div class="relations index">
	<h2><?php __('Relations');?></h2>
			<br>
			<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Relation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('premier_produit_id',array('selected'=>0,'options'=>$premiers));
		?>
	</span>
	<span class="right">
		<?php
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
			
		<th>Stock</th>	
		<th>Premier Product</th>
		<th>Relation</th>
		<th>Deuxième Product</th>
		<th>Quantité</th>	
		<th>Unité</th>	
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Relation',array('action'=>'add'));?>
		
		<td><?php echo $this->Form->input('Produit.stock_id',array('selected'=>0,'id'=>$i.'StockId','label'=>''));
				echo $ajax->observeField($i.'StockId',array('url' =>'/produits/stock'));?>
		</td>
		<td><?php echo $ajax->autoComplete($i.'1produit','/produits/autoComplete',array('id'=>$i.'1produit',
																					'name'=>'data[PremierProduct][name]'));?>
		</td>
		<td><?php echo $this->Form->input('relation',array('label'=>'','options'=>array('composer_par'=>'composer_par')));?></td>
		<td><?php echo $ajax->autoComplete($i.'2produit','/produits/autoComplete',array('id'=>$i.'2produit',
																					'name'=>'data[DeuxiemeProduct][name]'));?>
		</td>
		<td><?php echo $this->Form->input('quantite',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('unite_id',array('id'=>'PA','label'=>''));?></td>
		<td><input type="submit" value="Save"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Relation',array('name'=>'checkbox','id'=>'Relation_relations'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('stock_id');?></th>
			<th><?php echo $this->Paginator->sort('premier_produit_id');?></th>
			<th><?php echo $this->Paginator->sort('relation');?></th>
			<th><?php echo $this->Paginator->sort('deuxieme_produit_id');?></th>
			<th><?php echo $this->Paginator->sort('quantite');?></th>
			<th><?php echo $this->Paginator->sort('unite_id');?></th>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
		</tr>
	<?php
	
	foreach ($relations as $relation):
		
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$relation['Relation']['id'],array('label'=>'','type'=>'checkbox','value'=>$relation['Relation']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($relation['Stock']['name'], array('controller' => 'stocks', 'action' => 'view', $relation['Stock']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($relation['PremierProduct']['name'], array('controller' => 'produits', 'action' => 'view', $relation['PremierProduct']['id'])); ?>
		</td>
		<td><?php echo $relation['Relation']['relation']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($relation['DeuxiemeProduct']['name'], array('controller' => 'produits', 'action' => 'view', $relation['DeuxiemeProduct']['id'])); ?>
		</td>
		<td><?php echo $relation['Relation']['quantite']; ?>&nbsp;</td><td>
			<?php echo $this->Html->link($relation['Unite']['name'], array('controller' => 'unites', 'action' => 'view', $relation['Unite']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($relation['Personnel']['name'], array('controller' => 'produits', 'action' => 'view', $relation['Personnel']['id'])); ?>
		</td>
	</tr>
<?php  endforeach; ?>
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
		<li class= "link" onclick = "actions('checkbox','edit')" >Edit</li>
		<li class="link"  onclick="actions('checkbox','view')" >Afficher</li>
		<li class="link" onclick="actions('checkbox','delete')" >Delete</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link(sprintf(__('Lister / Créer  %s', true), __('Products', true)), array('controller' => 'produits', 'action' => 'index')); ?> </li>
	</ul>
</div>
