<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
   
 	jQuery('a[name="lien"]').each(function(){
 		var href=jQuery(this).attr('href');
 		jQuery(this).attr('href',getBase()+''+href);
 	})
	
	});
</script>
<?php 
	$lien='';
	function lien($match){
		$tmp=explode('N°',$match[0]);
		$factureId=$tmp[1];
		$lien='<a name="lien" href="factures/view/'.$factureId.'">'.$match[0].'</a>';
		return $lien;
	}
?>


<div class="historiques index">
	<h2><?php __('Historiques');?></h2>
	<?php echo $this->Form->create('Historique',array('name'=>'checkbox','id'=>'Historique_historiques'));?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('num_operation');?></th>
			<th><?php echo $this->Paginator->sort('num_debit');?></th>
			<th><?php echo $this->Paginator->sort('num_credit');?></th>
			<th><?php echo $this->Paginator->sort('famille');?></th>
			<th><?php echo $this->Paginator->sort('compte');?></th>
			<th><?php echo $this->Paginator->sort('libelle');?></th>
			<th><?php echo $this->Paginator->sort('debit');?></th>
			<th><?php echo $this->Paginator->sort('credit');?></th>
			<th><?php echo $this->Paginator->sort('monnaie');?></th>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
		</tr>
	<?php
	
	foreach ($historiques as $historique):
		
	?>
	<tr>
		<td>
			<?php echo $this->Form->input('Id.'.$historique['Historique']['id'].'',array('label'=>'','type'=>'checkbox','value'=>$historique['Historique']['id'])); ?>
		</td>
		<td><?php echo $historique['Historique']['id']; ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['num_operation']; ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['num_debit']; ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['num_credit']; ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['famille']; ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['compte']; ?>&nbsp;</td>
		<td><?php echo preg_replace_callback("#N°(\d)+#","lien", $historique['Historique']['libelle']); ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['debit']; ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['credit']; ?>&nbsp;</td>
		<td><?php echo $historique['Historique']['monnaie']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($historique['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $historique['Personnel']['id'])); ?>
		</td>
		<td><?php echo $historique['Historique']['created']; ?>&nbsp;</td>
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
<div id="separator" class="back" title="Hide the Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
	</ul>
</div>
