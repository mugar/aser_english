<script>
 jQuery.noConflict();
 jQuery(document).ready(function(){
 	
 	<?php if(Configure::read('aser.ebenezer')==1):?>
 		function pv(){
 			var pa=parseFloat(jQuery('#PA').val());
 			var pv=Math.round(pa*1.5);
 			jQuery('#PV').val(pv);
 		}
 		pv();
 		jQuery('#PA').change(function(){
			pv();
 		})
 	<?php elseif(Configure::read('aser.ebenezer')==2):?>
 		function pv(){
 			var pa=parseFloat(jQuery('#PA').val());
 			var pv=Math.round((pa/1.5)*1.4);
 			jQuery('#PV').val(pv);
 		}
 		pv();
 		jQuery('#PA').change(function(){
			pv();
 		})
 	<?php endif;?>
 	jQuery('#produit').change(function(){
		jQuery.ajax({
			type:'GET',
			url:getBase()+'entrees/pa/'+jQuery(this).val(),
			dataType:'json',
			success:function(ans){
				jQuery('#PA').val(ans.PA);
				<?php if(Configure::read('aser.ebenezer')):?>
					pv();
				<?php endif;?>
			}
		})
	})
		//support only multiplication
	jQuery('#quantite').change(function(){
		var mul=1;
		jQuery.each(jQuery(this).val().split('*'),function(j,val1){
			if(parseInt(val1)==val1){
				mul*=parseInt(val1);
			}
		});
		jQuery('#quantite').val(mul);
	})
	
	//support only division
	jQuery('#PA').change(function(){
		if(/\d+\/\d+/.test(jQuery(this).val())){
			var PA=Math.round(parseInt(jQuery(this).val().split('/')[0])/parseInt(jQuery(this).val().split('/')[1]));
			jQuery('#PA').val(PA);
		}
	});
});
</script>
<div class="entrees index">
	<h2>Gestion Des Entrées</h2>
	
<!--recherche form -->
<?php echo $this->element('../entrees/recherche',array('action'=>'index'));?>
		<br>
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Date D'Opération</th>
		<th>Quantité</th>
		<th>Produit</th>
		<th>Prix D'Achat</th>	
		<?php if(Configure::read('aser.ebenezer')):?>
			<th>Prix de Vente</th>
		<?php endif;?>
		<?php if(Configure::read('aser.pharmacie')):?>
			<th>N° De Lot</th>
			<th>Date d'Expiration</th>
		<?php endif;?>
		<th>Fournisseur</th>
		<th>Stock</th>	
		<th>Type d'entrée</th>	
		<?php if (Configure::read('aser.shifts')):?>
			<th>Shift</th>	
		<?php endif;?>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Entree',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('date',array('label'=>'','type'=>'text'));?></td>
		<td><?php echo $this->Form->input('quantite',array('id'=>'quantite','label'=>''));?></td>
		<td><?php echo $this->Form->input('produit_id',array('id'=>'produit','label'=>'','options'=>$produits));?></td>
		<td><?php echo $this->Form->input('PA',array('label'=>'','value'=>$pa,'id'=>'PA'));?></td>
		<?php if(Configure::read('aser.ebenezer')):?>
			<td><?php echo $this->Form->input('PV',array('label'=>'','value'=>0,'id'=>'PV'));?></td>
		<?php endif;?>
		<?php if(Configure::read('aser.pharmacie')):?>
			<td><?php echo $this->Form->input('batch',array('label'=>''));?></td>
			<td><?php echo $this->Form->input('date_expiration',array('label'=>'','type'=>'text'));?></td>
		<?php endif;?>
		<td><?php echo $this->Form->input('tier_id',array('label'=>'','options'=>$tiers1,'selected'=>0));?></td>
		<td><?php echo $this->Form->input('stock_id',array('id'=>$i.'StockId','label'=>'','options'=>$stocks));?></td>
		<td><?php echo $this->Form->input('type',array('label'=>'','options'=>$types));?></td>
		<?php if (Configure::read('aser.shifts')):?>
			<td><?php echo $this->Form->input('shift',array('label'=>'','options'=>$shifts));?></td>	
		<?php endif;?>
		<td><input type="submit" value="Envoyer"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Entree',array('name'=>'checkbox','id'=>'Entree_entrees'));?>	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('Date D\'Opération','date');?></th>
			<th><?php echo $this->Paginator->sort('quantite');?></th>
			<th><?php echo $this->Paginator->sort('produit_id');?></th>
			<th><?php echo $this->Paginator->sort('Prix D\'Achat','PA');?></th>
			<th><?php echo $this->Paginator->sort('montant');?></th>
			<?php if(Configure::read('aser.pharmacie')):?>
				<th><?php echo $this->Paginator->sort('N° Lot','batch');?></th>
				<th><?php echo $this->Paginator->sort('Date D\'Expiration','date_expiration');?></th>
			<?php endif;?>
			<th><?php echo $this->Paginator->sort('Fournisseur','tier_id');?></th>
			<th><?php echo $this->Paginator->sort('stock_id');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<?php if (Configure::read('aser.shifts')):?>
				<th><?php echo $this->Paginator->sort('shift');?></th>	
			<?php endif;?>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
		</tr>
	<?php
	foreach ($entrees as $entree){
		echo $this->element('../entrees/add',array('entree'=>$entree));
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
		<li class= "link" onclick="edit('entrees')" >Modifier</li>
		<li class="link" onclick="mass_delete()" >Effacer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link('Edition De Rapport', array('action' => 'rapport')); ?></li>
	</ul>
</div>