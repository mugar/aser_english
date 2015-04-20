<script>
     jQuery.noConflict();
     jQuery(document).ready(function(){
     	window.onbeforeunload="return false;";
      window.onunload=function(){ 
       			if(jQuery('#compteDetails').length>0){
       				var debit=parseInt(jQuery('#debit').text());
       				var credit=parseInt(jQuery('#credit').text());
       				if(debit!=credit){
       				//	alert('Le compte n\'est pas équilibré !')
       				//	window.location.href=getBase()+'compte_operations/index';
       				}
       			}
       		}
     	var journal=jQuery('div#accounting').attr('journal');
		jQuery('select#compteId option[value="'+journal+'"]').hide();  
		
		//preventing from filling both fields
		jQuery('input#debit').change(function(){
			  jQuery('input#credit').val('');
		})
		jQuery('input#credit').change(function(){
			  jQuery('input#debit').val('');
		})
		
     });
   </script>
<div id="accounting" class="compteOperations index" journal="<?php echo $journal;?>" date1="<?php echo $date1;?>" date2="<?php echo $date2;?>">
	<h2 id="testing"><?php echo $compte;?></h2>
	
<div id="recherche_boxe" style="display:none" title="Choix du Journal">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('CompteOperation',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('journal',array('id'=>'journal'));
			echo $this->Form->input('show',array('label'=>'Affichage',
												'options'=>array(20=>'20',
																50=>'50',
																100=>'100',
																200=>'200',
																'all'=>'all',
																)));
												
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('date1',array('label'=>'Choisissez une date début'));
			echo $this->Form->input('date2',array('label'=>'et une date fin pour le rapport','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>

<?php if(false) :?>
<table cellpadding="0" cellspacing="0" class="advanced1" id="compteDetails">
	<tr>
		<th>Report</th>		
		<th>Débit</th>
		<th>Crédit</th>
		<th>Solde</th>
	</tr>
	<tr>
		<td id="report"><?php echo $solde['report'];?></td>
		<td id="debit"><?php echo $solde['debit'];?></td>
		<td id="credit"><?php echo $solde['credit'];?></td>
		<td id="solde"><?php echo $solde['solde'];?></td>
	</tr>
</table>
<?php endif;?>

		<br>
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
			
		<th>Date</th>
		<th>Compte</th>
		<?php if($mode=='index'):?>
			<th>Réference</th>	
			<th>Libéllé</th>
		<?php endif;?>
		<th>Débit</th>	
		<th>Crédit</th>	
		<?php if(($mode=='index')&&($journal!=0)):?>
			<th>Auto</th>	
		<?php endif;?>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('CompteOperation',array('action'=>'add'));?>
		
		<td><?php echo $this->Form->input('date',array('label'=>'','type'=>'text','id'=>'Date'));?></td>
		
			<td><?php 
				echo $this->Form->input('compte_id',array('label'=>'','options'=>$comptes,'id'=>'compteId'));
			?></td>
		<?php if($mode=='index'):?>
			<td><?php echo $this->Form->input('piece',array('label'=>'','id'=>'piece'));?></td>
			<td><?php echo $this->Form->input('libelle',array('label'=>'','type'=>'textarea','id'=>'libelle'));?></td>
		<?php endif;?>
			<td><?php echo $this->Form->input('debit',array('label'=>'','id'=>'debit'));?></td>
			<td><?php echo $this->Form->input('credit',array('label'=>'','id'=>'credit'));?></td>
		<?php if(($mode=='index')&&($journal!=0)):?>
			<td><?php echo $this->Form->input('automatik',array('label'=>'','type'=>'checkbox','checked'=>'checked','value'=>1));?></td>
		<?php endif;?>	
		<?php echo $this->Form->input('mode',array('type'=>'hidden','value'=>$mode));?>
		<td><input type="submit" value="Envoyer"/></td>
		<?php echo $this->Form->input('journal',array('id'=>'compte','type'=>'hidden','value'=>$journal));?>
		<?php echo $this->Form->input('id',array('id'=>'id','type'=>'hidden','value'=>null));?>
		</form>
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('CompteOperation',array('name'=>'checkbox','id'=>'CompteOperation_compteOperations'));?>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('op_num');?></th>
			<th><?php echo $this->Paginator->sort('compte_id');?></th>
			<th><?php echo $this->Paginator->sort('piece');?></th>
			<th><?php echo $this->Paginator->sort('libelle');?></th>
			<th><?php echo $this->Paginator->sort('debit');?></th>
			<th><?php echo $this->Paginator->sort('credit');?></th>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
		</tr>
	<?php
	
	foreach ($compteOperations as $compteOperation):
		
	?>
	<tr ondblclick="quick_edit(this)" id="<?php echo $compteOperation['CompteOperation']['id'];?>">
		<td>
			<?php echo $this->Form->input('Id.'.$compteOperation['CompteOperation']['id'],array('label'=>'','type'=>'checkbox','value'=>$compteOperation['CompteOperation']['id'])); ?>
		</td>
		<td><?php echo $compteOperation['CompteOperation']['date']; ?>&nbsp;</td>
		<td><?php echo $compteOperation['CompteOperation']['op_num']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($compteOperation['Compte']['name'], array('controller' => 'comptes', 'action' => 'view', $compteOperation['Compte']['id'])); ?>
		</td>
		<td><?php echo $compteOperation['CompteOperation']['piece']; ?>&nbsp;</td>
		<td><?php echo $compteOperation['CompteOperation']['libelle']; ?>&nbsp;</td>
		<td><?php echo $compteOperation['CompteOperation']['debit']; ?>&nbsp;</td>
		<td><?php echo $compteOperation['CompteOperation']['credit']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($compteOperation['Personnel']['name'], array('controller' => 'personnels', 'action' => 'view', $compteOperation['Personnel']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
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
		<li class="link"  onclick = "recherche()" >Choix du journal</li>		
		<li class="link" onclick="mass_delete()" >Effacer en Masse</li>
		<li><?php echo $this->Html->link('Grand livre', array('controller' => 'compte_operations', 'action' => 'rapport')); ?> </li>
		<li><?php echo $this->Html->link('Balance', array('controller' => 'compte_operations', 'action' => 'balance')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Lister %s', true), __('Comptes', true)), array('controller' => 'comptes', 'action' => 'index')); ?> </li>
	</ul>
</div>
