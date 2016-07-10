
<div id='view'>
<div class="document">
<?php if(!empty($produits)):?>	
	<h3>
<?php
		echo 'Consommations théoriques';
?>
</h3>
	
<?php
	if(isset($date1)){
			echo '<h4>(From  '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).')';
	}
?>
<br/>
<br/>
<table cellpadding="0" cellspacing="0" id="recherche">
	<tr>
		<th width="150" >Product</th>
		<th width="100">Qte</th>
	</tr>
	<?php foreach($produits as $produit):?>
		<tr>
			<td> <?php echo $produit['Produit']['name'];?></td>
			<td> <?php echo ($produit['Produit']['quantite']+0).' '.$produit['Unite']['name'];?></td>
		</tr>
	<?php endforeach;?>	
</table>
<?php endif;?>
<br />
<br />
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link"  onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Liste des Products', array('action' => 'index')); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Produit',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('date1',array('label'=>'Start Date','type'=>'text'));
			echo $this->Form->input('date2',array('label'=>'End Date','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>