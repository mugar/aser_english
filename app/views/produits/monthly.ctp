
<div id='view'>
<div class="document">
<?php  if(!empty($produits)):?>	
	<h3>
<?php
		echo $choixs[$choix].' dans ';
		echo ($stock=='tous')?$stock.' les stocks':' le stock : '.$stock;
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
		<th width="100" >Product</th>
		<th width="60" >Unité</th>
		<?php if($choix=='mvt'):?>		
			<th width="30">SI</th>
		<?php endif;?>
		<?php for($i=0; $i<=$days;$i++):
			$date_parts=explode('-',$this->MugTime->increase_date($date1,$i));
		?>
			<th width="30"><?php echo $date_parts[2];?></th>
		<?php endfor;?>
		<th>VALEUR (PA)</th>
	</tr>
	<?php foreach($produits as $id=>$produit):
		$solde=($choix=='mvt')?(!empty($produit['SI'])?$produit['SI']:0):0;
	?>
		<tr>
			<td> <?php echo $this->Html->link($produit['info']['name'], array('controller' => 'produits', 'action' => 'view', $produit['info']['id'],0));?></td>
			<td><?php if(isset($unites[$produit['info']['unite_id']])) echo $unites[$produit['info']['unite_id']];?></td>
			<?php if($choix=='mvt'):?>		
				<td><?php echo  $number->format((!empty($produit['SI'])?$produit['SI']:0),$formatting); ?></td>
			<?php endif;?>
			<?php for($i=0; $i<=$days;$i++):
				$current_date=$this->MugTime->increase_date($date1,$i);
				$found=0;
				if(!empty($produit['op'])){
					foreach($produit['op'] as $historique){
						if($historique['Historique']['date']==$current_date){
							$found=($choix=='mvt')?
									$historique['Historique']['solde']:
									$historique['Historique']['debit']-$historique['Historique']['credit'];
							break;
						}
					}
				}
				else {
				//	echo '<td colspan="'.$days.'"></td>';	
				}
				$solde=($choix=='mvt')?(($found)?$found:$solde):$found;
				echo '<td>'.$solde.'</td>';	
			?>
				
			<?php endfor;?>
			<td><?php if (!empty($produit['valeur'])) echo ($produit['valeur']); else echo 0;?></td>
		</tr>
	<?php endforeach;?>	
	<tr class="strong">
		<td>TOTAL</td>
		<td colspan="<?php if($choix == 'mvt') echo $days+3; else echo $days+2; ?>"></td>
		<td><?php echo ($valeur_total);?></td>
	</tr>
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
			echo $this->Form->input('Historique.choix',array('label'=>'Type de rapport','options'=>$choixs));
			echo $this->Form->input('Historique.stock_id',array('label'=>'Stock','options'=>$stocks1));
			
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('Historique.date1',array('label'=>'Start Date','type'=>'text'));
			echo $this->Form->input('Historique.date2',array('label'=>'End Date','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>