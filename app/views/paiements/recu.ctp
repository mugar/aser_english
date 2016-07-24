
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
<span class="titre">Receipt N° <?php echo $paiement['Facture']['numero'].'-'.$paiement['Paiement']['id'];?></span>
<br />
<br />
<table cellpadding="0" cellspacing="0">
	<tr class="strong">
			<th>Date</th>
			<th>Amount Paid</th>
			<th>Description</th>
			<th>Created By</th>
	</tr>
	<tr>
		<td><?php echo $this->MugTime->toFrench($paiement['Paiement']['date']);?></td>
		<td><?php echo $number->format(abs($paiement['Paiement']['montant'])).' '.$paiement['Paiement']['monnaie'];?></td>	
		<td><?php echo ucfirst($paiement['Paiement']['type']).' payment';?></td>
		<td><?php echo $paiement['Personnel']['name'];?></td>
	</tr>
</table>
<br />
<br/>
<br />
<br/>
<div class="bas_page">
	<div class="left">
	</div>
	<div class="right"><?php  
		echo 'Approved By <br/>';
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
		<li><?php echo $this->Html->link('Invoice Management', array('controller' => 'factures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link('Go back', $referer); ?> </li>
	</ul>
</div>