<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
		indicator();
	});
</script>
<div class="tiers index">
	<h2><?php __('Clients & Fournisseurs');?></h2>
	<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Tier',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('name',array('id'=>'nom','label'=>'Nom et prénom'));
			echo $this->Form->input('type',array('options'=>array(''=>'',
																'client'=>'client',
																'fournisseur'=>'fournisseur'
																)
										));
			echo $this->Form->input('compagnie');
			if(Configure::read('aser.hotel'))
				echo $this->Form->input('chambre',array('label'=>'N° de Chambre'));
			echo $this->Form->input('passport');
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('telephone');
			echo $this->Form->input('email');
			echo $this->Form->input('nationalite',array('options'=>(array(''=>'')+$countries)));
			echo $this->Form->input('pers_contact',array('label'=>'Infos de la Personne de Contact'));
			echo $this->Form->input('actif',array('options'=>array(''=>'',
																	'oui'=>'oui',
																	'non'=>'non'
																	)
												)
									);
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
		
	
		<th>Nom</th>
		<th>Prénom</th>
		<th>Type</th>	
		<th>Compagnie</th>
		<th>Télephone</th>
		<th>Email</th>
		<?php if(Configure::read('aser.hotel')):?>
			<th>Nationalité</th>
			<th>Passport</th>
		<?php endif;?>
		<?php if(Configure::read('aser.POS')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))):?>
			<th>Réduction (%)</th>
		<?php endif;?>
		<th>Max Dette</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Tier',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('nom',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('prenom',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('type',array('label'=>'','id'=>'op','options'=>array('client'=>'client',
																									'fournisseur'=>'fournisseur',
																									)
															)
										);
			?>
		</td>
		<td><?php echo $ajax->autoComplete('compagnie','/tiers/autoComplete/compagnie');?></td>
		<td><?php echo $this->Form->input('telephone',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('email',array('label'=>''));?></td>
		<?php if(Configure::read('aser.hotel')):?>
			<td><?php echo $this->Form->input('nationalite',array('label'=>'','options'=>$countries,'selected'=>'BDI'));?></td>
			<td><?php echo $this->Form->input('passport',array('label'=>''));?></td>
		<?php endif;?>
		<?php if(Configure::read('aser.POS')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))):?>
			<td><?php echo $this->Form->input('reduction',array('label'=>''));?></td>
			<?php echo $this->Form->input('type_reduction',array('type'=>'hidden','value'=>'Sur le total'
															));?>
			
		<?php endif;?>
		<td><?php echo $this->Form->input('max_dette',array('label'=>'','value'=>0));?></td>
		<td><input type="submit" value="Envoyer"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Tier',array('name'=>'checkbox','id'=>'Tier_tiers'));?>	
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Nom & Prénom','name');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('compagnie');?></th>
			<th><?php echo $this->Paginator->sort('telephone');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<?php if(Configure::read('aser.hotel')):?>
				<th><?php echo $this->Paginator->sort('nationalite');?></th>
				<th><?php echo $this->Paginator->sort('passport');?></th>
			<?php endif; ?>
			<?php if(Configure::read('aser.POS')):?>
				<th><?php echo $this->Paginator->sort('Réducton (%)','reduction');?></th>
				<th><?php echo $this->Paginator->sort('type_reduction');?></th>
			<?php endif; ?>
			<th><?php echo $this->Paginator->sort('max_dette');?></th>
			<th><?php echo $this->Paginator->sort('pers_contact');?></th>
			<th><?php echo $this->Paginator->sort('actif');?></th>
		</tr>
	<?php
	foreach ($tiers as $tier) {
		echo $this->element('../tiers/add',array('tier'=>$tier));
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
		<li class= "link" onclick = "mass_delete()" >Effacer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li class="link"  onclick = "disable('tiers/disable')" >Activer/Désactiver</li>
		<li class="link"  onclick = "global_bill()" >Facture Globale</li>
		<li class= "link" onclick = "merge('tiers')" ><? echo  __('Fusionner les Enregistrements');?></li>
		<li><?php echo $this->Html->link('Edition de Rapport', array('controller'=>'tiers','action' => 'rapport'));?></li>
	</ul>
</div>

<!--global bill form -->
<div id="global_bill_boxe" style="display:none" title=' Choisissez le mois à afficher '>
<div class="dialog" id="global_bill">
	<span class='left'>
		<?php
			echo $this->Form->input('date1',array('label'=>'Date Début','id'=>'Date1','type'=>'text'));
			echo $this->Form->input('date2',array('label'=>'Date Fin','id'=>'Date2','type'=>'text'));
		?>
	</span>
	<span class="right">
		<?php
			
			echo $this->Form->input('xls',array('id'=>'xls','label'=>'Exporter vers excel','type'=>'checkbox'));
		?>
	</span>
<div style="clear:both"></div>
</div>
</div>


<!--merge form -->
<? echo $this->element('merge');?>
