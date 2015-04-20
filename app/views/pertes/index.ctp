<div class="pertes index">
	<h2><?php __('Pertes');?></h2>
<!--recherche form -->
<?php echo $this->element('../pertes/recherche',array('action'=>'index'));?>
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Date</th>
		<th>Stock</th>	
		<th>Quantité</th>
		<th>Produit</th>
		<th>Nature</th>
		<th>Description</th>
		<?php if(Configure::read('aser.pharmacie')):?>
		<th>N° Lot</th>
		<th>Date D'Expiration</th>
		<?php endif;?>
		<?php if (Configure::read('aser.shifts')):?>
			<th>Shift</th>	
		<?php endif;?>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Perte',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('date',array('label'=>'','type'=>'text'));?></td>
		<td><?php echo $this->Form->input('stock_id',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('quantite',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('produit_id',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('nature',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('description',array('label'=>''));?></td>
		<?php if(Configure::read('aser.pharmacie')):?>
			<td><?php echo $this->Form->input('batch',array('label'=>''));?></td>
			<td><?php echo $this->Form->input('date_expiration',array('label'=>'','type'=>'text'));?></td>
		<?php endif;?>
		<?php if (Configure::read('aser.shifts')):?>
			<td><?php echo $this->Form->input('shift',array('label'=>'','options'=>$shifts));?></td>	
		<?php endif;?>
		<td><input type="submit" value="Envoyer"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Perte',array('name'=>'checkbox','id'=>'Perte_pertes'));?>	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('Date D\'Opération','date');?></th>
			<th><?php echo $this->Paginator->sort('stock_id');?></th>
			<th><?php echo $this->Paginator->sort('quantite');?></th>
			<th><?php echo $this->Paginator->sort('produit_id');?></th>
			<th><?php echo $this->Paginator->sort('PU');?></th>
			<th><?php echo $this->Paginator->sort('montant');?></th>
			<th><?php echo $this->Paginator->sort('nature');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<?php if(Configure::read('aser.pharmacie')):?>
				<th><?php echo $this->Paginator->sort('N° De Lot','batch');?></th>
				<th><?php echo $this->Paginator->sort('Date D\'expiration','date_expiration');?></th>
			<?php endif;?>
			<?php if (Configure::read('aser.shifts')):?>
				<th><?php echo $this->Paginator->sort('shift');?></th>	
			<?php endif;?>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
		</tr>
	<?php
	foreach ($pertes as $perte){
		echo $this->element('../pertes/add',array('perte'=>$perte));
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
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link('Edition De Rapport', array('action' => 'rapport')); ?></li>
	</ul>
</div>

<?php echo $this->element('docs',array('actions'=>array('bons'),'type'=>'divs','model'=>'Perte')); ?>