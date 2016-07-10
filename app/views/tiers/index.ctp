<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
		indicator();
	});
</script>
<div class="tiers index">
	<h2><?php __('Customers');?></h2>
	<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Tier',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('name',array('id'=>'nom','label'=>'Full Name'));
			echo $this->Form->input('type',array('options'=>array(''=>'',
																'client'=>'customer',
																)
										));
			echo $this->Form->input('compagnie',array('label'=>'Company'));
			if(Configure::read('aser.hotel'))
				echo $this->Form->input('chambre',array('label'=>'Room N°'));
			echo $this->Form->input('passport');
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('telephone');
			echo $this->Form->input('email');
			echo $this->Form->input('nationalite',array('label'=>'Nationality','options'=>(array(''=>'')+$countries)));
			echo $this->Form->input('pers_contact',array('label'=>'Infos about the contact person'));
			echo $this->Form->input('actif',array('options'=>array(''=>'',
																	'yes'=>'yes',
																	'no'=>'no'
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
		
	
		<th>First Name</th>
		<th>Last Name</th>
		<th>Company</th>
		<th>Telephone</th>
		<th>Email</th>
		<?php if(Configure::read('aser.hotel')):?>
			<th>Nationality</th>
			<th>Passport</th>
		<?php endif;?>
		<?php if(Configure::read('aser.POS')&&in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))):?>
			<th>Discount (%)</th>
		<?php endif;?>
		<th>Max Debt</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Tier',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('nom',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('prenom',array('label'=>''));?></td>
	
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
		<td><input type="submit" value="Save"/></td>
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
			<th><?php echo $this->Paginator->sort('Full Name','name');?></th>
			<th><?php echo $this->Paginator->sort('Company','compagnie');?></th>
			<th><?php echo $this->Paginator->sort('telephone');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<?php if(Configure::read('aser.hotel')):?>
				<th><?php echo $this->Paginator->sort('Nationality','nationalite');?></th>
				<th><?php echo $this->Paginator->sort('passport');?></th>
			<?php endif; ?>
			<?php if(Configure::read('aser.POS')):?>
				<th><?php echo $this->Paginator->sort('Discount (%)','reduction');?></th>
			<?php endif; ?>
			<th><?php echo $this->Paginator->sort('Max Debt','max_dette');?></th>
			<th><?php echo $this->Paginator->sort('Contact Pers','pers_contact');?></th>
			<th><?php echo $this->Paginator->sort('active','actif');?></th>
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
		<li class= "link" onclick = "edit()" >Edit</li>
		<li class= "link" onclick = "mass_delete()" >Delete</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li class="link"  onclick = "disable('tiers/disable')" >Activate/Deactivate</li>
		<!-- <li class="link"  onclick = "global_bill()" >Global Bill</li> -->
		<li class= "link" onclick = "merge('tiers')" ><? echo  __('Merge customers');?></li>
		<li><?php echo $this->Html->link('Generate Report', array('controller'=>'tiers','action' => 'rapport'));?></li>
	</ul>
</div>

<!--global bill form -->
<div id="global_bill_boxe" style="display:none" title=' Choisissez le mois à afficher '>
<div class="dialog" id="global_bill">
	<span class='left'>
		<?php
			echo $this->Form->input('date1',array('label'=>'Start Date','id'=>'Date1','type'=>'text'));
			echo $this->Form->input('date2',array('label'=>'End Date','id'=>'Date2','type'=>'text'));
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
