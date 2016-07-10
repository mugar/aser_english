
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
		<?php echo  'Date : '.$this->MugTime->toFrench($operation['Operation']['date']); ?>
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
<br />
<br />
<br />
<br />
<span class="titre"> 
	<?php
		if($operation['Operation']['credit']!=null) {
			echo 'SORTIE DE CAISSE N° '.$operation['Operation']['op_num'];
			$montant=$operation['Operation']['credit'];
		}
		else  {
			echo 'ENTREE DE CAISSE N° '.$operation['Operation']['op_num'];
			$montant=$operation['Operation']['debit'];
		}
	?> </span>	
<br/>
<br />
<br />
<br />
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Description</th>
			<th>Amount</th>
			
	</tr>
	<tr>
			<td><?php echo  $operation['Operation']['libelle']; ?></td>
			<td><?php echo  $number->format($montant,$formatting).' '.$operation['Operation']['monnaie']; ?></td>
	</tr>
</table>
<br/>

<br/>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<div class="bas_page">
	<div class="left">
		<?php  
		echo 'Caissier <br/><br/>';
		echo ucfirst($operation['Personnel']['name']).'<br/>';
	?>
	</div>
	<div class="right"><?php  
		echo $label.'<br/>';
		echo ucfirst($operation['Operation']['beneficiaire']).'<br />';
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
	</ul>
</div>