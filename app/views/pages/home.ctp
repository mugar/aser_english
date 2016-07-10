<!-- default display of the graph instead of the home page text-->
<?php if($session->read('Auth.Personnel.fonction_id')==3):?>
	<script>
		window.onload=function(){ 
       		chartSearch();		
    }
	</script>
<?php endif;?>
<div id="left">
	<div class="online" style="display:none">
		<h4 onclick="jQuery('#personnel').slideToggle()" style="cursor:pointer;" title="Utilisateurs connectés">Utilisateurs Connectés</h4>
		<div id="personnel" style="display:none">
		<ul>
	<?php 
	/*
	foreach($logged as $key=>$name) {
		echo '<li>'.$this->Html->link($name, array('controller' => 'personnels', 'action' => 'view', $key)).'</li>';
	}
	//*/
	?>
		</ul>
		</div>
	</div>
<!--  fin-->
<div class="online" >
		<h4 onclick="jQuery('#rapport').slideToggle()" style="cursor:pointer;" title="Raccourcis pour les rapports principals">Rapports</h4>
		<div id="rapport" style="display:none">
		<ul>
	<?php 
		$config=Configure::read('aser');
		if($config['hotel']){
			echo '<li>'.$this->Html->link('Rapport Hébergement', array('controller' => 'reservations', 'action' => 'monthly')).'</li>';
			echo '<li>'.$this->Html->link('State d\'Occupation', array('controller' => 'reservations', 'action' => 'etat_occupation')).'</li>';
			echo '<li>'.$this->Html->link('Chambres à nettoyer', array('controller' => 'reservations', 'action' => 'rooms_to_clean')).'</li>';
		}
		if($config['pos_sales_report'])
    	    echo '<li>'.$this->Html->link('Ventes Point De Vente', array('controller' => 'ventes', 'action' => 'rapport')).'</li>';
		echo '<li>'.$this->Html->link('Rapport Factures', array('controller' => 'factures', 'action' => 'rapport')).'</li>';
		echo '<li>'.$this->Html->link('Ventes Mensuelle', array('controller' => 'factures', 'action' => 'monthly')).'</li>';
		echo '<li>'.$this->Html->link('Rapport Journalier', array('controller' => 'factures', 'action' => 'cash')).'</li>';
		echo '<li>'.$this->Html->link('Rapport des Dépenses', array('controller' => 'operations', 'action' => 'depenses')).'</li>';
		if($config['POS'])
			echo '<li>'.$this->Html->link('Rapport des Consommations', array('controller' => 'ventes', 'action' => 'consommations')).'</li>';
		if($config['conference'])
			echo '<li>'.$this->Html->link('Rapport de la location des salles', array('controller' => 'locations', 'action' => 'rapport')).'</li>';
		
		echo '<li>'.$this->Html->link('Liste des Crédits', array('controller' => 'factures', 'action' => 'credit')).'</li>';
		echo '<li>'.$this->Html->link('Résultat', array('controller' => 'operations', 'action' => 'resultat')).'</li>';
		if($config['services']){
			echo '<li>'.$this->Html->link('Rapport Services', array('controller' => 'services', 'action' => 'rapport')).'</li>';
		}
	?>
			<li class="onclick" onclick="chart()">Graphique</li>
		</ul>
		</div>
	</div>
<!-- affichage des produits en fin de stock-->
<?php
	if(!empty($finis)):?>
	<div class="menu1" >
		<h4 onclick="jQuery('#stock').slideToggle()" style="cursor:pointer;" title="Products dont la quantité est inférieure ou égale à leur quantité minimale">Products en fin de stock (<?php echo count($finis);?>)</h4>
		<div id="stock" style="display:none">
		<ul>
	<?php 
		foreach($finis as $fini) {
			echo '<li>'.$this->Html->link($fini['Produit']['name'].' (reste : '.$fini['Produit']['qty'].')', array('controller' => 'produits', 'action' => 'view', $fini['Produit']['id'])).'</li>';
		}
	?>
		</ul>
		</div>
	</div>
 <?php endif; ?>
<!--  fin-->
<!-- affichage des produits proche de leur expiration-->
<?php
	if(!empty($quantites)):?>
	<div class="menu1" >
		<h4 onclick="Element.toggle($('perime'))" style="cursor:pointer;" title="Products qui vont être expirés en <?php echo 2 ?> mois">Products en expiration</h4>
		<div id="perime" style="display:none">
		<ul>
	<?php 
		foreach($quantites as $quantite) {
			echo '<li>'.$this->Html->link($quantite['Produit']['name'], array('controller' => 'produits', 'action' => 'view', $quantite['Historique']['produit_id'],$quantite['Historique']['stock_id'])).'</li>';
		}
	?>
		</ul>
		</div>
	</div>
 <?php endif; ?>
<!--  fin-->
<!-- affichage des tiers en retard de paiement-->
<?php
	if(!empty($factureCustomers)):?>
	<div class="menu1" >
		<h4 onclick="jQuery('#facture_client').slideToggle()" style="cursor:pointer;" title="Factures clients qui ont dépassés l'echeance de paiement">Factures clients non payée</h4>
		<div id="facture_client" style="display:none">
		<ul>
	<?php 
		foreach($factureCustomers as $facture) {
			if($facture['Facture']['type']=='envoyee'){
				echo '<li>'.$this->Html->link('Invoice N° '.$facture['Facture']['numero'].' de '.$facture['Tier']['name'], array('controller' => 'factures', 'action' => 'view', $facture['Facture']['id'])).'</li>';
			}
		}
	?>
		</ul>
		</div>
	</div>
 <?php endif; ?>
 
<?php
$fonction=$session->read('Auth.Personnel.fonction_id');
 if(!empty($factureFournisseurs)&&($fonction!=2)):?>
	<div class="menu1" >
		<h4 onclick="jQuery('#facture_fou').slideToggle()" style="cursor:pointer;" title="Factures fournisseurs qui ont dépassés l'echeance de paiement">Factures fournisseurs non payée</h4>
		<div id="facture_fou" style="display:none">
		<ul>
	<?php 
		foreach($factureFournisseurs as $facture) {
			if($facture['Facture']['type']=='recu'){
				echo '<li>'.$this->Html->link('Invoice N° '.$facture['Facture']['numero'].' de '.$facture['Tier']['name'], array('controller' => 'factures', 'action' => 'view', $facture['Facture']['id'])).'</li>';
			}
		}
	?>
		</ul>
		</div>
	</div>
 <?php endif; ?>
 
</div>
<div id="right">
	<div id="fermer" title="fermer" onclick="chartClose()">
	</div>
	<div id="chartDiv" style="padding:10px;"></div>
	<div id="home">
		<h3>Bienvenue dans le logiciel <strong>Aser Manager</strong> </h3>
		<br />
		Le logiciel <strong>Aser Manager</strong> est un logiciel de gestion pratique pour la gestion de Stock, de Restaurant, de Pharmacie,de Magasin et d'hôtel. Il est dispose de 5 modules :
		<br>
		<br>
		<ul>
			<li><strong>Gestion de Stock :</strong> Permet la gestion des produits répartis dans un ou plusieurs stock.</li>
			
			<li><strong>Gestion de Point de Vente :</strong> Permet la gestion des ventes qui se déroulent soit dans un restaurant, soit dans une pharmacie ou soit dans un simple magasin.</li>
			
			<li><strong>Gestion des Chambres d'hôtel :</strong> Permet la gestion des réservations et de la facturation des chambres d'hôtel.</li>
		
			<li><strong>Gestion des Salles de Conférences :</strong> Permet la gestion des réservations des salles de conférences ou salles de Réception. La facturation ainsi que la génération des factures pro-forma.</li>
			<li><strong>Gestion Trésorerie :</strong> Permet la gestion des caisses d'argent.</li>
		</ul>
		</ul>
			<br />
	</div>
</div>
<div id="chart_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<?php echo $this->Form->create('Facture',array('id'=>'chart_form','action'=>'chart'));?>
	<span class="left">
		<?php
			echo $this->Form->input('choix',array('options'=>array(
																'RWF_depenses'=>'Ventes en RWF & Dépenses',
																'RWF_USD'=>'Ventes en RWF & USD',
																'RWF'=>'Ventes en RWF',
																'USD'=>'Ventes en USD',
																'depenses'=>'Dépenses',
																),
												));
			echo $this->Form->input('taux',array('label'=>'Taux pour les Dollars','value'=>$taux));
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('date1',array('label'=>'Date début','type'=>'text','value'=>date('Y').'-01-01'));	
			echo $this->Form->input('date2',array('label'=>'Date fin','type'=>'text','value'=>date('Y-m',strtotime('-1 month')).'-'.cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'))));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>