<div id='view'>
<div class="gouv">
	<div id="entete">
	<?php	
	$logo=Configure::read('logo');
	echo $this->Html->image($logo['name'], array('alt'=>'test logo', 'border' => '0','width'=>$logo['width'],'height'=>$logo['height']));?>
	<h4> FICHE GOUVERNANTE</h4>
	<div style="clear:both;"></div>
	</div>
<div class="left">
	Date : <?php echo date('d/m/Y'); ?>
	<table>
		<tr>
			<td>Occupation précedente</td>	
			<td><?php echo $this->Form->input('occupation_prec',array('label'=>'')); ?></td>	
		</tr>
		<tr>
			<td>Check-in</td>	
			<td><?php echo $this->Form->input('checkin',array('label'=>'')); ?></td>	
		</tr>
		<tr>
			<td>Check-out</td>	
			<td><?php echo $this->Form->input('checkout',array('label'=>'')); ?></td>	
		</tr>
	</table>
	
	<table>
		<tr>
			<th>Occupation pour les 3jrs nexte</th>	
			<th>Occupation</th>	
		</tr>
		<tr>
			<td>Le <?php echo date('d/m/Y',strtotime('+ 1 day')); ?></td>	
			<td><?php echo $this->Form->input('one',array('label'=>'')); ?></td>	
		</tr>
		<tr>
			<td>Le <?php echo date('d/m/Y',strtotime('+ 2 day')); ?></td>	
			<td><?php echo $this->Form->input('two',array('label'=>'')); ?></td>	
		</tr>
		<tr>
			<td>Le <?php echo date('d/m/Y',strtotime('+ 3 day')); ?></td>	
			<td><?php echo $this->Form->input('thirst',array('label'=>'')); ?></td>	
		</tr>
	</table>
</div>
<div class="right">
	<?php echo $this->Form->input('gouvernante',array('class'=>'long','label'=>'Nom & Prénom de la Gouvernante')); ?>
	<table>
		<tr>
			<th>N° Etage</th>
			<th>Nom & Prénom</th>
			<th>Nom & Prénom</th>
		</tr>
		<?php foreach($etages as $key=>$etage): ?>
		<tr>
			<td><?php echo $etage['Etage']['name']; ?></td>	
			<td><?php echo $this->Form->input('femme'.$key,array('label'=>'')); ?></td>	
			<td><?php echo $this->Form->input('femme'.$key+1,array('label'=>'')); ?></td>	
		</tr>
		<?php endforeach; ?>
	</table>
</div>
<table class="middle" id="vip">
	<tr>
		<th>VIP</th>
		<th>GROUPE</th>
		<th>ARRIVEE</th>
		<th>DEPART</th>
		<th>N° CHAMBRE</th>
	</tr>
	<tr>
		<td><?php echo $this->Form->input('vip',array('label'=>'')); ?></td>	
		<td><?php echo $this->Form->input('groupe',array('label'=>'')); ?></td>	
		<td><?php echo $this->Form->input('arrivee',array('label'=>'')); ?></td>	
		<td><?php echo $this->Form->input('depart',array('label'=>'')); ?></td>	
		<td><?php echo $this->Form->input('chambre',array('label'=>'')); ?></td>
	</tr>
</table>
<button onclick="add_row('vip')">Ajouter une ligne</button>

<table class="middle" id="events">
	<tr>
		<th>Conférence</th>
		<th>Timing</th>
		<th>Salle</th>
		<th>Invités</th>
		<th>Pause Café</th>
		<th>Déjeuner</th>
		<th>Dîner</th>
	</tr>
	<tr>
		<td><?php echo $this->Form->input('conference',array('label'=>'')); ?></td>	
		<td><?php echo $this->Form->input('timing',array('label'=>'')); ?></td>	
		<td><?php echo $this->Form->input('salle',array('label'=>'')); ?></td>	
		<td><?php echo $this->Form->input('invite',array('label'=>'')); ?></td>	
		<td><?php echo $this->Form->input('cafe',array('label'=>'')); ?></td>
		<td><?php echo $this->Form->input('dejeuner',array('label'=>'')); ?></td>
		<td><?php echo $this->Form->input('diner',array('label'=>'')); ?></td>
	</tr>
</table>
<button onclick="add_row('events')">Ajouter une ligne</button>
<?php if(!empty($chambres)): ?>
<h4 class="gouv">Messages</h4>
<table class="gouv">
	<?php 
//	die(debug($etages));
	foreach($chambres as $chambre){
		echo '<tr>';
		echo '<td> CH '.$chambre['Chambre']['name'].'</td>';
		echo '<td class="message"> Message : '.$chambre['Chambre']['message'].'</td>';
		echo '</tr>';
	}
	?>
</table>
<?php endif; ?>
<h4 class="gouv">State des chambres</h4>
<table class="gouv">
	<?php 
//	die(debug($etages));
	foreach($etages as $etage){
		echo '<tr>';
		echo '<td> Etage N° '.$etage['Etage']['name'].'</td>';
		foreach($etage['details'] as $chambre){
			if($chambre['Chambre']['propre']=='no'){
				echo '<td title="'.$chambre['TypeChambre']['name'].'" class="'.$chambre['Chambre']['propre'].'">'.$chambre['Chambre']['name'].' A nettoyer</td>';
			}
			else {
				echo '<td title="'.$chambre['TypeChambre']['name'].'" class="'.$chambre['Chambre']['propre'].'">'.$chambre['Chambre']['name'].'</td>';
			}
		} 
		echo '</tr>';
	}
	?>
</table>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li><?php echo $this->Html->link('Liste des Chambres', array('controller' => 'chambres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link('Bookings Management', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
	</ul>
</div>