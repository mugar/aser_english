
<div id="dialog">
<fieldset class="dialog"><legend>Détails Location</legend>
<div class="dialog">
	<?php echo $this->Form->create('Location',array('id'=>'loca_form','action'=>'edit'));?>
	<span class='left'>
		<?php
			echo $this->Form->input('salle_id',array('label'=>'Salle','id'=>'salleId'));
			echo $this->Form->input('tier_id',array('label'=>'Nom du client','id'=>'tierId'));
			echo $this->Form->input('monnaie',array('label'=>'monnaie', 'options'=>$facturationMonnaies));
			?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('nombre',array('label'=>'Nombre de personnes'));
			echo $this->Form->input('tva_incluse',array('type'=>'checkbox','checked'=>'checked'));
			echo $this->Form->input('type',array('type'=>'hidden','value'=>$type));
		?>
	</span>
	<div style="clear:both"></div>
	<table>
		<tr>
			<th>Service Desiré</th>
			<th>Prix Unitaire</th>
			<?php if(Configure::read('aser.conference-manual')):?>
				<th>Qté total</th>
			<?php else : ?>
				<th>Heure Desiré</th>
			<?php endif;?>	
		</tr>
		<tr>
			<td>Eau (Avant Midi)</td>
			<td> <?php echo $this->Form->input('services.Eau (Avant Midi).prix',array('label'=>''));?></td>
			<?php if(Configure::read('aser.conference-manual')):?>
				<td> <?php echo $this->Form->input('services.Eau (Avant Midi).quantite',array('label'=>''));?></td>
			<?php else : ?>
				<td> <?php echo $this->Form->input('services.Eau (Avant Midi).heure',array('label'=>''));?></td>
			<?php endif;?>	
		</tr>
		<tr>
			<td>Pause Café (Avant Midi)</td>
			<td> <?php echo $this->Form->input('services.Pause Café (Avant Midi).prix',array('label'=>''));?></td>
			<?php if(Configure::read('aser.conference-manual')):?>
				<td> <?php echo $this->Form->input('services.Pause Café (Avant Midi).quantite',array('label'=>''));?></td>
			<?php else : ?>
				<td> <?php echo $this->Form->input('services.Pause Café (Avant Midi).heure',array('label'=>''));?></td>
			<?php endif;?>	
		</tr>
		<tr>
			<td>Eau (Après Midi)</td>
			<td> <?php echo $this->Form->input('services.Eau (Après Midi).prix',array('label'=>''));?></td>
			
			<td> <?php echo $this->Form->input('services.Eau (Après Midi).heure',array('label'=>''));?></td>
		</tr>
		<tr>
			<td>Pause Café (Après Midi)</td>
			<td> <?php echo $this->Form->input('services.Pause Café (Après Midi).prix',array('label'=>''));?></td>
			<?php if(Configure::read('aser.conference-manual')):?>
				<td> <?php echo $this->Form->input('services.Pause Café (Après Midi).quantite',array('label'=>''));?></td>
			<?php else : ?>
				<td> <?php echo $this->Form->input('services.Pause Café (Après Midi).heure',array('label'=>''));?></td>
			<?php endif;?>	
			
		</tr>
		<tr>
			<td>Déjeuner</td>
			<td> <?php echo $this->Form->input('services.Déjeuner.prix',array('label'=>''));?></td>
			<?php if(Configure::read('aser.conference-manual')):?>
				<td> <?php echo $this->Form->input('services.Déjeuner.quantite',array('label'=>''));?></td>
			<?php else : ?>
				<td> <?php echo $this->Form->input('services.Déjeuner.heure',array('label'=>''));?></td>
			<?php endif;?>
		</tr>
		<tr>
			<td>Dîner</td>
			<td> <?php echo $this->Form->input('services.Dîner.prix',array('label'=>''));?></td>
			<?php if(Configure::read('aser.conference-manual')):?>
				<td> <?php echo $this->Form->input('services.Dîner.quantite',array('label'=>''));?></td>
			<?php else : ?>
				<td> <?php echo $this->Form->input('services.Dîner.heure',array('label'=>''));?></td>
			<?php endif;?>
		</tr>
		<tr>
			<td>Cocktail</td>
			<td> <?php echo $this->Form->input('services.Cocktail.prix',array('label'=>''));?></td>
			<?php if(Configure::read('aser.conference-manual')):?>
				<td> <?php echo $this->Form->input('services.Cocktail.quantite',array('label'=>''));?></td>
			<?php else : ?>
				<td> <?php echo $this->Form->input('services.Cocktail.heure',array('label'=>''));?></td>
			<?php endif;?>
		</tr>
	</table>
	</form>
</div>
<div class="dialog">
	<?php echo $this->Form->create('Location',array('id'=>'location-extras'));?>
<fieldset>
	<span class='left'>
		<?php
			echo $this->Form->input('PU',array('label'=>'PU','id'=>'pu1'))
			?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('date',array('type'=>'text','id'=>'DateLoc'));
		?>
	</span>
	<div style="clear:both"></div>
	<button onclick="extra_row();return false;">Ajouter/Enlever une ligne</button>
	<table id="extras_table" style="margin-top: 10px;">
		<tr>
			<th></th>
			<th>Extra</th>
			<th>Quantité</th>
			<th>Prix Unitaire</th>
		</tr>
		<?php foreach($extras as $id=>$extra):?>
			<?php if($extra['LocationExtra']['extra']=='oui'):?>
			<tr>
				<td><input type="checkbox" name="checkbox" value="<?php echo $id;?>"/></td>
				<td><?php echo $this->Form->input('name',array('label'=>'','name'=>"data[extras][$id][name]",'value'=>$extra['LocationExtra']['name']));?></td>
				<td><?php echo $this->Form->input('qte',array('label'=>'','name'=>"data[extras][$id][qte]",'value'=>$extra['LocationExtra']['quantite']));?></td>
				<td><?php echo $this->Form->input('prix',array('label'=>'','name'=>"data[extras][$id][prix]",'value'=>$extra['LocationExtra']['PU']));?></td>
			</tr>
			<?php endif;?>
		<?php endforeach;?>
	</table>
</fieldset>
	<div style="clear:both"></div>
	</form>
<div style="clear:both"></div>
</div>
</fieldset>
</div>