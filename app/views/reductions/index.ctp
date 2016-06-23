<div class="reductions index">
	<h2><?php __('Gestion Des Reductions');?></h2>
	
	
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Reduction',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('produit_id',array('selected'=>0,'options'=>$produits1));
			echo $this->Form->input('tier_id',array('label'=>'Client','selected'=>0,'options'=>$tiers1));
		?>
	</span>
	<span class="right">
		<?php
		
			
		echo $this->Form->input('PU');				
		echo $this->Form->input('actif',array('options'=>array('-1'=>'',1=>'Actif',0=>'Non Actif')));	
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
		<th>Client</th>
		<th>Produit</th>	
		<th>PU</th>	
		<th>Actif</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Reduction',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('tier_id',array('label'=>'','selected'=>0,'options'=>$tiers1));?></td>
		<td><?php echo $this->Form->input('produit_id',array('label'=>'','selected'=>0,'options'=>$produits1));?></td>
		<td><?php echo $this->Form->input('PU',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('actif',array('label'=>'','type'=>'checkbox','checked'=>'checked'));?></td>
		<td><input type="submit" value="Envoyer"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>

	<?php echo $this->Form->create('Reduction',array('name'=>'checkbox','id'=>'Reduction_reductions','action'=>'confirm'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('Client','tier_id');?></th>
			<th><?php echo $this->Paginator->sort('produit_id');?></th>
			<th><?php echo $this->Paginator->sort('PU');?></th>
			<th><?php echo $this->Paginator->sort('actif');?></th>
		</tr>
	<?php
	foreach ($reductions as $reduction){
		echo $this->element('../reductions/add',array('reduction'=>$reduction));
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
		<li class="link" onclick="disable('reductions/disable')" >Activer/Désactiver</li>
		<li class="link" onclick="mass_delete()" >Effacer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
	</ul>
</div>
