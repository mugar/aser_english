
<div id='view'>
<div class="document">
<?php if(!empty($produits)):?>	
	<h3>
<?php
		echo $choixs[$choix].' dans ';
		echo ($stock=='tous')?$stock.' les stocks':' le stock : '.$stock;
?>
</h3>
	
<?php
	if(isset($date1)){
			echo '<h4>(Période entre le '.$this->MugTime->toFrench($date1).' et le '.$this->MugTime->toFrench($date2).')';
	}
?>
<br/>
<br/>
<table cellpadding="0" cellspacing="0" id="recherche">
	<tr>
		<th width="100" >Produit</th>
		<?php if($choix=='mvt'):?>		
			<th width="30">SI</th>
		<?php endif;?>
		<?php for($i=0; $i<=$days;$i++):
			$date_parts=explode('-',$this->MugTime->increase_date($date1,$i));
		?>
			<th width="30"><?php echo $date_parts[2];?></th>
		<?php endfor;?>
	</tr>
	<?php foreach($produits as $produit):
		$solde=($choix=='mvt')?$produit['ants'][0]['Historique']['solde']:0;
	?>
		<tr>
			<td> <?php echo $this->Html->link($produit['Produit']['name'], array('controller' => 'produits', 'action' => 'view', $produit['Produit']['id'],0));?></td>
			<?php if($choix=='mvt'):?>		
				<td><?php echo  $number->format($produit['ants'][0]['Historique']['solde'],$formatting); ?></td>
			<?php endif;?>
			<?php for($i=0; $i<=$days;$i++):
				$current_date=$this->MugTime->increase_date($date1,$i);
				$found=0;
				foreach($produit['op'] as $historique){
					if($historique['Historique']['date']==$current_date){
						$found=($choix=='mvt')?
								$historique['Historique']['solde']:
								$historique['Historique']['debit']+$historique['Historique']['credit'];
						break;
					}
				}
				$solde=($choix=='mvt')?(($found)?$found:$solde):$found;
				echo '<td>'.$solde.'</td>';	
			?>
				
			<?php endfor;?>
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
		<li class="link"  onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
		<li><?php echo $this->Html->link('Liste des Produits', array('action' => 'index')); ?></li>
	</ul>
</div>

<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
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
			echo $this->Form->input('Historique.date1',array('label'=>'Choisissez une date début','type'=>'text'));
			echo $this->Form->input('Historique.date2',array('label'=>'et une date fin pour le rapport','type'=>'text'));
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>