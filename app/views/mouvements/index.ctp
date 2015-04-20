<div class="mouvements index">
	<h2><?php __('Gestion Des Mouvements');?></h2>
	
	
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Mouvement',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('produit_id',array('selected'=>0,'options'=>$produits1));
			echo $this->Form->input('stock_sortant_id',array('selected'=>0,'options'=>$stocks1));
			echo $this->Form->input('stock_entrant_id',array('selected'=>0,'options'=>$stocks1));
		?>
	</span>
	<span class="right">
		<?php
		
			
		echo $this->Form->input('date1',array('label'=>'Date Début','type'=>'text'));				
		echo $this->Form->input('date2',array('label'=>'Date Fin','type'=>'text'));	
		echo $this->Form->input('show',array('label'=>'Affichage',
												'options'=>array(20=>'20',
																50=>'50',
																100=>'100',
																200=>'200',
																'all'=>'all',
																)));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Date</th>
		<th>Quantité</th>		
		<th>Produit</th>
		<th>Stock Sortant</th>
		<th>Stock Entrant</th>
		<?php if (Configure::read('aser.shifts')):?>
			<th>Shift</th>	
		<?php endif;?>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Mouvement',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('date',array('label'=>'','type'=>'text'));?></td>
		<td><?php echo $this->Form->input('quantite',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('produit_id',array('label'=>'','selected'=>0));?></td>
		<td><?php echo $this->Form->input('stock_sortant_id',array('options'=>$stocks,'label'=>''));?></td>
		<td><?php echo $this->Form->input('stock_entrant_id',array('options'=>$stocks,'label'=>''));?></td>
		<?php if (Configure::read('aser.shifts')):?>
			<td><?php echo $this->Form->input('shift',array('label'=>'','options'=>$shifts));?></td>	
		<?php endif;?>
		<td><input type="submit" value="Envoyer"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>

	<?php echo $this->Form->create('Mouvement',array('name'=>'checkbox','id'=>'Mouvement_mouvements','action'=>'confirm'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('quantite');?></th>
			<th><?php echo $this->Paginator->sort('produit_id');?></th>
			<th><?php echo $this->Paginator->sort('stock_sortant_id');?></th>
			<th><?php echo $this->Paginator->sort('stock_entrant_id');?></th>
			<?php if (Configure::read('aser.shifts')):?>
				<th><?php echo $this->Paginator->sort('shift');?></th>	
			<?php endif;?>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
		</tr>
	<?php
	foreach ($mouvements as $mouvement){
		echo $this->element('../mouvements/add',array('mouvement'=>$mouvement));
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
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
	</ul>
</div>
