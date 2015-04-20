<div class="caisses index">
	
	<h2><?php __('Gestion Des Caisses');?></h2>
	
<div id="quick_add">
	<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
		<th>Nom de la Caisse</th>
		<th>Monnaie Par Défaut</th>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Caiss',array('action'=>'add'));?>
		<td><?php echo $this->Form->input('name',array('label'=>''));?></td>
		<td><?php echo $this->Form->input('monnaie',array('label'=>''));?></td>
		<td><input type="submit" value="Envoyer"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>
</div>
	<?php echo $this->Form->create('Caiss',array('name'=>'checkbox','id'=>'Caiss_caisses'));?>	
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th>Id</th>
			<th>Name</th>
			<th>Monnaie Par Défaut</th>
			<th>Montant</th>
			<th>Actif</th>
		</tr>
		<?php
		foreach ($caisses as $caisse){
			echo $this->element('../caisses/add',array('caisse'=>$caisse));
		}
		?>
		<?php if(!empty($caisses)):?>
		<tr class="strong">
			<td colspan="4">TOTAL</td>
			<td><?php echo $number->format($total,$formatting).' '.Configure::read('aser.default_currency');?></td>
			<td></td>
		</tr>	
		<?php endif;?>
	</table>
</form>
	
</div>
<div id="separator" class="back" title="Cacher Le Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class= "link" onclick = "edit()" >Modifier</li>
		<li class= "link" onclick = "mass_delete()" >Effacer</li>
		<li class= "link" onclick = "actions('checkbox','view')" >Afficher l'Historique</li>
		<li><?php echo $this->Html->link('Mouvements des Caisses', array('controller' => 'operations', 'action' => 'balance/caisses')); ?> </li>
		<li><?php echo $this->Html->link('Gestion des Operations', array('controller' => 'operations', 'action' => 'index')); ?> </li>
	</ul>
</div>
