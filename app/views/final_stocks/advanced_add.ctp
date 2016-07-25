<div class="advanced_form">
	<div id="output"></div>
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
			
		<th>Caisse</th>
		<th>Tier</th>
		<th>Stock</th>	
		<th>Product</th>	
		<th>Element</th>
		<th>Quantité</th>	
		<th>Paiement</th>	
		<th>Livrer</th>	
		<th>Vidange</th>	
		<th>Date</th>	
		<th>Expiration Details</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<5;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('FinalStock',array('action'=>'add'));?>
		
		<td><?php echo $this->Form->input('caiss_id',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('tier_id',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('Produit.stock_id',array('selected'=>0,'id'=>$i.'StockId','label'=>''));
				echo $ajax->observeField($i.'StockId',array('url' =>'/produits/stock'));?>
		</td>
		<td><?php echo $ajax->autoComplete($i.'produit','/produits/autoComplete',array('id'=>$i.'produit',
																					'name'=>'data[Product][name]'));?>
		</td>
		<td><?php echo $this->Form->input('element',array('label'=>'','options'=>array('pleins'=>'pleins','vides'=>'vides','cartons'=>'cartons')));?></td>
		<td><?php echo $this->Form->input('quantite',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('paiement',array('label'=>'','options'=>array('cash'=>'cash',
																'credit'=>'credit',
																'interne'=>'interne',
																'gratuit'=>'gratuit',
																'promotion'=>'promotion'
																)));?>
		</td>
		<td><?php echo $this->Form->input('livrer',array('label'=>'','options'=>array('yes'=>'yes',
																						'no'=>'no')));?>
		</td>
		<td><?php echo $this->Form->input('vidange',array('label'=>'','options'=>array('yes'=>'yes','no'=>'no')));?></td>
		<td><?php echo $this->Form->input('date',array('label'=>'','id'=>$i.'Date','type'=>'text'));?></td>
		<td><?php echo $this->Form->input('expiration_details',array('label'=>''));?></td>
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

		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('FinalStocks', true)), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(sprintf(__('Show %s', true), __('Caisses', true)), array('controller' => 'caisses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Create %s', true), __('Caiss', true)), array('controller' => 'caisses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister / Créer  %s', true), __('Products', true)), array('controller' => 'produits', 'action' => 'index')); ?> </li>
	</ul>
</div>
