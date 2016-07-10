<script>
	jQuery(document).ready(function(){
		jQuery( "#FactureDate" ).datepicker( "option", "minDate", '2013-06-04' );
		jQuery( "#FactureDate" ).datepicker( "option", "maxDate", new Date() );
	});
</script>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Facture',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('date',array('type'=>'date','type'=>'text','label'=>'Date'));
		?>
	</span>
	<span class="right">
		<?php
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>

<div id='view'>
<div class="document">
	<h3> <? echo __('Listes des Factures du ').$this->MugTime->toFrench($date); ?></h3>
	<? foreach($factures as $i=>$facture){
		if(Configure::read('aser.silhouette'))
			$facture['Facture']['numero']=$i+1;
		echo $this->element('../ventes/print_facture',array(
													'facture'=>$facture,
													'ventes'=>$facture['Facture']['ventes'],
													'thermal'=>$thermal,
													'footer'=>$footer,
													'header'=>$header,
													'tel'=>$tel,
													'web'=>$web
													));
	}
	?>
	
</div>
</div>
<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Invoices Management', array('controller' => 'factures', 'action' => 'silhouette')); ?> </li>

	</ul>
</div>
