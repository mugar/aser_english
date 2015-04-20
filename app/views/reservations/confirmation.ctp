<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
	indicator();
	});
</script>
<?php echo $this->element('../elements/email/html/default');?>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick="print_documents()" >Imprimer</li>
		<li><?php echo $this->Html->link('Gestions Des Réservations', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
		<!--<li><?php echo $this->Html->link('Envoie', array('controller' => 'reservations', 'action' => 'confirmation')); ?> </li>-->
		<li><?php echo $this->Html->link('Exporter en PDF', array('controller' => 'reservations', 'action' => 'confirmation/'.$id.'/1')); ?> </li>
	</ul>
</div>

	