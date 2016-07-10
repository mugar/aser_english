
<div class="dettes index">
	<h2><?php __('Dettes');?></h2>
	<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Dette',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('tier_id',array('selected'=>0));
				echo $this->Form->input('Tier.type',array('options'=>array('toutes'=>'toutes',
																'client'=>'client',
																'fournisseur'=>'fournisseur'
																),
														'label'=>'Type de Tier'
												));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('monnaie',array('options'=>array('toutes'=>'toutes','RWF'=>'RWF','USD'=>'USD')));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
	<br>
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		
		<th>Tier</th>
		<th>Amount</th>	
		<th>Currency</th>
		<th>Montant Maximal</th>
		<th>Type</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Dette',array('action'=>'add'));?>
		
		
		<td><?php echo $this->Form->input('tier_id',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('montant',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('monnaie',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('max',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('type',array('label'=>'','id'=>'op','options'=>array('court'=>'Court terme',
																							 'moyen'=>'Moyen terme',
																							 'long'=>'Long terme'
																								)
															)
										);
			?>
		</td>
		<td><input type="submit" value="Save"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Dette',array('name'=>'checkbox','id'=>'Dette_dettes'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('tier_id');?></th>
			<th><?php echo $this->Paginator->sort('montant');?></th>
			<th><?php echo $this->Paginator->sort('Maximum ou Plafond','max');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
		</tr>
	<?php
	foreach ($dettes as $dette):
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$dette['Dette']['id'],array('label'=>'','type'=>'checkbox','value'=>$dette['Dette']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($dette['Tier']['name'], array('controller' => 'tiers', 'action' => 'view', $dette['Tier']['id'])); ?>
		</td>
		<td><?php echo $number->format($dette['Dette']['montant']).' '. $dette['Dette']['monnaie']; ?>&nbsp;</td>
		<td><?php if(!is_null($dette['Dette']['max'])) echo $number->format($dette['Dette']['max']).' '. $dette['Dette']['monnaie']; ?>&nbsp;</td>
		<td><?php echo ' A '.$dette['Dette']['type'].' terme'; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
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
<div id="separator" class="back" title="Etendre" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class= "link" onclick = "actions('checkbox','edit')" >Edit</li>
		<li class="link" onclick="actions('checkbox','delete')" >Delete</li>
		<li><?php echo $this->Html->link(__('Edition de Rapport', true), array('controller' => 'dettes', 'action' => 'rapport')); ?> </li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link(sprintf(__('Lister/Create %s', true), __('Tiers', true)), array('controller' => 'tiers', 'action' => 'index')); ?> </li>
		
		 
	</ul>
</div>
