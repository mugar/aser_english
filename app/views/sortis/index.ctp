
<div class="sortis index">
	<h2><?php __('Gestion Des Sorties');?></h2>	
	

<!--recherche form -->
<?php echo $this->element('../sortis/recherche',array('action'=>'index'));?>
		<br>
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Date</th>
		<th>Stock</th>
		<th>Quantité</th>	
		<th>Produit</th>
		<th>Client</th>
		<th>Observation</th>
		<?php if (Configure::read('aser.shifts')):?>
			<th>Shift</th>	
		<?php endif;?>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Sorti',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('date',array('label'=>'','type'=>'text'));?></td>
		<td><?php echo $this->Form->input('stock_id',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('quantite',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('produit_id',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('tier_id',array('label'=>'','selected'=>0,'options'=>$tiers1));?></td>
		<td><?php echo $this->Form->input('observation',array('label'=>'','type'=>'textarea'));?></td>
		<?php if (Configure::read('aser.shifts')):?>
			<td><?php echo $this->Form->input('shift',array('label'=>'','options'=>$shifts));?></td>	
		<?php endif;?>
		<td><input type="submit" value="Envoyer"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Sorti',array('name'=>'checkbox','id'=>'Sorti_sortis'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('stock_id');?></th>
			<th><?php echo $this->Paginator->sort('quantite');?></th>
			<th><?php echo $this->Paginator->sort('produit_id');?></th>
			<th><?php echo $this->Paginator->sort('PU');?></th>
			<th><?php echo $this->Paginator->sort('montant');?></th>
			<th><?php echo $this->Paginator->sort('Client','tier_id');?></th>
			<th><?php echo $this->Paginator->sort('observation');?></th>
			<?php if (Configure::read('aser.shifts')):?>
				<th><?php echo $this->Paginator->sort('shift');?></th>	
			<?php endif;?>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
		</tr>
	<?php
	$sumQty=0;
	foreach ($sortis as $sorti){
		$sumQty+=$sorti['Sorti']['quantite'];
		echo $this->element('../sortis/add',array('sorti'=>$sorti));
	} 
	?>
	<tr>
		<td>TOTAL</td>
		<td colspan="2"></td>
		<td><?php echo $number->format($sumQty,$formatting);?></td>
		<td colspan="6"></td>
	</tr>
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
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link('Edition De Rapport', array('action' => 'rapport')); ?></li>
	</ul>
</div>
