
<div id='view'>
<div class="document">
<div id="entete">
	<div class="left">
		<?php echo $this->element('company'); ?>
	</div>
	
<br />
<br />
<br />
<br />
<br />
<br />
	<div class="right">
		<?php echo  $this->element('../tiers/details',array('client'=>$client['Tier'])); ?>
		 <br/>
	</div>
	<div style="clear:both"></div>
</div>
<br/>
<br />
<br />
<br />
<br />
<br />
<br />
<br/>
<br />
<br />
<br/>
<?php echo  $this->element('../paiements/payments',array('pyts'=>$pyts,'facture'=>true,'checkbox'=>false));?>
<br />
<br />
<div class="bas_page">
	<div class="left">
	</div>
	<div class="right"><?php  
		echo 'Signature Caissier <br/>';
		echo $session->read('Auth.Personnel.name').'<br />';
	?>
	</div>
	<div style="clear:both"></div>
</div>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li><?php echo $this->Html->link('Gestions Des Factures', array('controller' => 'reservations', 'action' => 'tabella')); ?> </li>
		<li><?php echo $this->Html->link('Retour En Arrière', $referer); ?> </li>
	</ul>
</div>