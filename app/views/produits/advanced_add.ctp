<div class="advanced_form">
	<div id="output"></div>
	<table cellpadding="0" cellspacing="0" class="advanced">
	
		<th>Stock</th>	
		<th>Section</th>	
		<th>Groupe</th>		
		<th>Gestion</th>	
		<th>Name</th>	
		<th>PA</th>	
		<th>PV</th>	
		<th>PPV</th>	
		<th>PC</th>		
		<th>PVV</th>	
		<th>NPC</th>	
		<th>Pleins</th>	
		<th>NPP</th>	
		<th>Vides</th>	
		<th>NPV</th>	
		<th>Cartons</th>	
		<th>Date d'expiration</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<5;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Produit',array('action'=>'add'));?>
		
		<td><?php echo $this->Form->input('stock_id',array('label'=>'','selected'=>0,'title'=>'Le nom du stock auquel appartient le produit'));?></td>
		<td><?php echo $this->Form->input('section_id',array('id'=>$i.'SectionId','label'=>'','selected'=>0,'title'=>'Le nom de la section auquel appartient le produit'));?></td>
		<td><?php echo '<span id="groupe'.$i.'">'.$this->Form->input('groupe_id',array('label'=>'','selected'=>0,'title'=>'Le nom du groupe auquel appartient le produit')).'</span>';
    		echo $ajax->observeField($i.'SectionId', array('url' => 'updateGroupe/1','update' => 'groupe'.$i,
    		'loading'=>'jQuery("#loading'.$i.'").attr("class","advanced_loading").show();',
    		'complete'=>'jQuery("#loading'.$i.'").attr("class","advanced_loading").hide();'
    	));?></td>
		<td><?php echo $this->Form->input('gestion',array('label'=>'','title'=>'Mode de gestion','options'=>array('paquet'=>'paquet','piece'=>'piece')));?></td>
		<td><?php echo $this->Form->input('name',array('id'=>$i.'-'.$i,'label'=>'','title'=>'Nom du produit','label'=>''));?></td>
		<td><?php echo $this->Form->input('PA',array('label'=>'','title'=>'Prix d\'achat'));?></td>
		<td><?php echo $this->Form->input('PV',array('label'=>'','title'=>'Prix de sorti'));?></td>
		<td><?php echo $this->Form->input('PPV',array('label'=>'','title'=>'Prix d\'une pièce vide','value'=>0));?></td>
		<td><?php echo $this->Form->input('PC',array('label'=>'','title'=>'Prix du carton','value'=>0));?></td>
		<td><?php echo $this->Form->input('PVV',array('label'=>'','title'=>'Prix de sorti d\' un vide','value'=>0));?></td>
		<td><?php echo $this->Form->input('NPC',array('label'=>'','title'=>'Nombre de pièce par carton','value'=>1));?></td>
		<td><?php echo $this->Form->input('pleins',array('label'=>'','title'=>'Nombre de carton remplis de produits','value'=>0));?></td>
		<td><?php echo $this->Form->input('NPP',array('label'=>'','title'=>'Nombre de pièce pleines (en plus ou en moins par rapport aux cartons remplis de produits)','value'=>0));?></td>
		<td><?php echo $this->Form->input('vides',array('label'=>'','title'=>'Nombre de carton remplis de vidanges','value'=>0));?></td>
		<td><?php echo $this->Form->input('NPV',array('label'=>'','title'=>'Nombre de pièce vides (en plus ou en moins par rapport aux cartons remplis de vidanges)','value'=>0));?></td>
		<td><?php echo $this->Form->input('cartons',array('label'=>'','title'=>'Nombre de cartons vides','value'=>0));?></td>
		<td><?php echo $form->input('perime',array('label'=>'','title'=>'Cochez si le produit a une date d\'expiration','type'=>'checkbox','onclick'=>"Element.toggle($('date'))" ));
		echo '<span id="date" style="display:none;">'.$this->Form->input('date_expiration',array('label'=>'','title'=>'Date d\'expiration du produit','type'=>'text','id'=>$i.'Date')).'</span>';?></td>
		<td><input type="submit" value="Save"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
<div id="separator" class="back" title="Hide the Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Products', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Entrees', true)), array('controller' => 'entrees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Entree', true)), array('controller' => 'entrees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Sortis', true)), array('controller' => 'sortis', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Sorti', true)), array('controller' => 'sortis', 'action' => 'add')); ?> </li>
	</ul>
</div>
