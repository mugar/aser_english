<div id='view'>
<div class="document">
	<h3> <? echo __('Listes des Commandes'); ?></h3>
	<? foreach($orders as $i=>$order){
		$facture['Facture']=$order['Order'];
		$facture['Facture']['table']=$order['Facture']['table'];
		$facture['Facture']['numero']=$order['Facture']['numero'];
		$facture['Personnel']=$order['Personnel'];
		$bon=$order['Order']['type'];
		$msg=$order['Order']['msg'];
		$ventes=$order['OrderDetail'];
		echo '<h4>'.__('Commande N° '.($i+1));
		echo __(' Vers ');
		if($bon=='boissons') echo __('le Bar');
		else echo __('la Cuisine');
		echo '</h4>';
		echo $this->element('../ventes/print_bon',array('msg'=>$msg,
													'facture'=>$facture,
													'ventes'=>$ventes,
													'bon'=>$bon,
													'thermal'=>$thermal,
													'showOrder'=>true
													));
	}
	?>
	
</div>
</div>
<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li><?php echo $this->Html->link('Retour En Arrière', array('controller'=>'factures','action'=>'view',$factureId)); ?> </li>

	</ul>
</div>
