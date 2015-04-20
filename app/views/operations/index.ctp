<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
     	jQuery('#montant').change(function(){
			var montant=0;
			jQuery.each(jQuery(this).val().split('+'),function(i,val){
					var mul=1;
					jQuery.each(val.split('*'),function(j,val1){
						if(parseInt(val1)==val1){
							mul*=parseInt(val1);
						}
					});
					if(mul!=1){
						montant+=mul;
					}
			})
			jQuery('#montant').val(montant);
		})
   //decide what to show or hide based on payment selection
   /*
  	 jQuery('#model2 option[value="caisses"], #model1 option[value="caisses"]').attr('selected','selected');
  	 
		jQuery('#element1').live('change',function(){
			var el=jQuery(this).children('option:selected').val();
			var venteId=jQuery('div#operations').attr('ventes');
			if(el==venteId){
				jQuery('#caissiers').removeAttr('disabled');
			}
			else {
				jQuery('#caissiers').attr('disabled','disabled');
			}
		})
		jQuery('#caissiers').bind('change',function(){
			var caissier=jQuery(this).val();
			var date=jQuery('#Date').val();
			jQuery.ajax({
 				type:'GET',
 				url:getBase()+'operations/journal/'+caissier+'/'+date,
 				success:function(response){
 					jQuery('#pieces').html(response);
 				}
 			})
 		})
 		//*/
	});
</script>
<?php $ids=Configure::read('ventes');
?>
<div class="operations index" id="operations" ventes="<?php echo $ids[0];?>">
	<h2 id="test"><?php __('Gestion des Opérations');?></h2>
	
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Operation',array('id'=>'recherche','action'=>'index/'.$mode));?>
	<span class="left">
		<?php
			
			echo $this->Form->input('model1',array('label'=>'Catégorie','id'=>'cat','options'=>$options,'selected'=>0));
			echo '<span id="choix">'.$this->Form->input('Operation.element1',array('label'=>'Choix','options'=>$choix,'selected'=>0)).'</span>';
			echo $ajax->observeField('cat',array('url' => array('controller'=>'operations','action'=>'update/1'),'update' => 'choix'));
			echo $this->Form->input('libelle',array('label'=>'Recherche par libellé'));
			echo $this->Form->input('personnel_id',array('label'=>'Personnel','options'=>$personnels1));
			echo $this->Form->input('mode_paiement',array('options'=>$modePaiements1));
			
			
			
												
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('monnaie',array('options'=>$monnaies1));
			echo $this->Form->input('date1',array('label'=>'Choisissez une date début'));
			echo $this->Form->input('date2',array('label'=>'et une date fin pour le rapport','type'=>'text'));
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
		<br>
<div id="quick_add" op="0">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Date</th>
		<th>N°Ordre</th>
		<?php if($mode=='index'):?>
			<th>Source :</th>
			<th>Préciser la source</th>
		<?php if(false):?>
			<th>N° compte</th>	
		<?php endif;?>
		<!--<th>Caissiers</th>-->
			<th>Montant</th>
			<th>Libellé</th>
			<th>Monnaie</th>
			<th>Mode de Paiement</th>
			<th>Destination</th>
			<th>Préciser la destination</th>
			<?php if(false):?>
			<th>N° compte</th>	
			<?php endif;?>	
		<?php elseif($mode=='report') :?>
			<th>Catégorie</th>
			<th>Préciser la destination</th>	
			<th>Montant</th>
		<?php endif;?>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Operation',array('action'=>'add'));?>
		
		<td><?php echo $this->Form->input('date',array('id'=>'Date','label'=>'','type'=>'text'));?></td>
		<td><?php echo $this->Form->input('ordre',array('label'=>'','value'=>1));?></td>
		<?php if($mode=='index'):?>
			<td><?php echo $this->Form->input('model1',array('id'=>'model1','label'=>'','options'=>$model1s));?></td>
			<td><?php echo '<span id="retrait">'.$this->Form->input('Operation.element1',array('id'=>'element1','label'=>'','options'=>$list)).'</span>';
				echo $ajax->observeField('model1',array('url' => array('controller'=>'operations','action'=>'update/1'),'update' => 'retrait','indicator'=>'loading'.$i));
			?></td>
			<?php if(false):?>
				<td><?php echo $this->Form->input('numero1',array('label'=>''));?></td>
			<?php endif;?>
			<!--<td><?php echo $this->Form->input('caissiers',array('id'=>'caissiers','label'=>'','disabled'=>'disabled','options'=>$caissiers,'selected'=>0));?></td>-->
			<td><?php echo $this->Form->input('montant',array('label'=>'','id'=>'montant'));?></td>
			<td><?php echo $this->Form->input('libelle',array('label'=>'','type'=>'textarea'));?></td>
			<td><?php echo $this->Form->input('monnaie',array('label'=>''));?></td>
			<td><?php echo $this->Form->input('mode_paiement',array('label'=>''));?></td>
		<!--<td><?php echo '<span id="pieces">'.$this->Form->input('piece',array('label'=>'','id'=>'piece')).'</span>';?></td>-->
			<td><?php echo $this->Form->input('model2',array('id'=>'model2','label'=>'','options'=>$model2s));?></td>
			<td><?php echo '<span id="ajout">'.$this->Form->input('Operation.element2',array('label'=>'','options'=>$list)).'</span>';
				echo $ajax->observeField('model2',array('url' => array('controller'=>'operations','action'=>'update/2'),'update' => 'ajout','indicator'=>'loading'.$i));
			?></td>
			<?php if(false):?>
				<td><?php echo $this->Form->input('numero2',array('label'=>''));?></td>
			<?php endif;?>
		<?php elseif($mode=='report') :?>
			<td><?php echo $this->Form->input('model1',array('id'=>'model1','label'=>'','options'=>$models));?></td>
			<td><?php echo '<span id="retrait">'.$this->Form->input('Operation.element1',array('label'=>'','options'=>$list)).'</span>';
				echo $ajax->observeField('model1',array('url' => array('controller'=>'operations','action'=>'update/1'),'update' => 'retrait','indicator'=>'loading'.$i));
			?></td>
			<td><?php echo $this->Form->input('montant',array('label'=>''));?></td>
		<?php endif;?>
		<?php echo $this->Form->input('mode',array('type'=>'hidden','value'=>$mode));?>
		<?php echo $this->Form->input('id1',array('type'=>'hidden','value'=>null));?>
		<?php echo $this->Form->input('id2',array('type'=>'hidden','value'=>null));?>
		<td><input type="submit" value="Envoyer"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Operation',array('name'=>'checkbox','id'=>'Operation_operations'));?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('ordre');?></th>
			<th><?php echo $this->Paginator->sort('montant');?></th>
			<th width="150"><?php echo $this->Paginator->sort('libelle');?></th>
			<?php if($mode!='report'):?>
			<th><?php echo $this->Paginator->sort('mode_paiement');?></th>
			<th><?php echo $this->Paginator->sort('Source');?></th>
			<th><?php echo $this->Paginator->sort('Destination');?></th>
			<?php endif;?>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
		</tr>
	<?php
	$total=0;
	foreach ($operations as $operation) {
		echo $this->element('../operations/quick_add',array('operation'=>$operation,'total'=>$total));
		$somme=($operation['Operation']['debit']>0)?$operation['Operation']['debit']:$operation['Operation']['credit'];
		$total+=$somme;
	}
	?>
	</table>
</form>
	

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
		<li class="link" onclick="actions('checkbox','bon')" >Bon de Caisse</li>
		<li class="link" onclick="mass_delete()" >Effacer</li>
		<li class="link" onclick="edit()" >Modifier</li>
		<li  class="link" onclick = "mass_modification('operations')" >Modification en Masse</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
	</ul>
</div>
<div id="mass_modification" title="Modification en masse" style="display:none">
	<div class="dialog">
		<span class="left">
		<?php 
			echo $this->Form->input('mode_paiement',array('options'=>$modePaiements1));
			echo $this->Form->input('monnaie',array('options'=>$monnaies1));
		?>
		</span>
		<span class="right">
			<?php
				echo $this->Form->input('date',array('type'=>'text'));		
			?>
		</span>
	</div>
</div>