<?php 
?>

<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Facture',array('id'=>'recherche','action'=>'credit/'.$id));?>
	<span class="left">
		<?php
			echo $this->Form->input('numero',array('label'=>'Invoice N°'));
			if(is_null($id)){
				echo $this->Form->input('tier_id',array('label'=>'Customer','selected'=>$id,'options'=>$tiers1));
				echo $this->Form->input('Tier.compagnie',array('label'=>'Company'));
				echo $this->Form->input('Facture.show_less',array('type'=>'checkbox','label'=>'Show less'));
			}
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
<div id='view'>
<div class="document">
<?php if(is_null($id)):?>
	<h3>DEBTORS LIST</h3>
<?php else:?>
	<h3>UNPAID INVOICES OF : <?php echo $tierInfo['Tier']['name'];?></h3>
<?php endif;?>
<br />
	<?php
		if(isset($date1)&&isset($date2)){
			echo '<h4>(From  '.$this->MugTime->toFrench($date1).' to '.$this->MugTime->toFrench($date2).')</h4>';
		}
	?>

<br />
<br />
<table cellpadding="0" cellspacing="0">
	<tr>
			<th>N°</th>
			<th>Date</th>
			<th width="100">Amount (RWF)</th>
			<th width="100">Amount (USD)</th>
			<th>Invoice N°</th>
			<th>Invoice State</th>
			<th width="150">Comments</th>
			<th width="50">Action</th>
	</tr>
	
	<?php 
		$total_USD=$total_RWF=$current_client=$j=0;
		$RWF=$USD=0;
		foreach ($factures as $i=>$facture):
			if(!in_array($current_client,array($facture['Tier']['id'],0))){
					echo '<tr class="strong">';
					echo '<td colspan="2">TOTAL</td>';
					echo '<td>'.$number->format($RWF+0,$formatting).' RWF</td>';
					echo '<td>'.$number->format($USD+0,$formatting).' USD</td>';
					echo '<td colspan="4">&nbsp;</td>';
					echo '</tr>';
				}
			if($current_client != $facture['Tier']['id']){
				echo '<tr class="strong">';
				echo '<td colspan="8" style="text-align: center;">';
				echo 'Customer : '.$facture['Tier']['name'].' --- Compagnie : '.$facture['Tier']['compagnie'].' --- telephone : '.$facture['Tier']['telephone'];
				echo '</td>';
				echo '</tr>';
				$RWF=$USD=0;
				//if($current_client == 0)
					$current_client = $facture['Tier']['id'];
				$j=1;
			}
	?>
		
		<?php if(!$show_less):?>
			<tr>
					<td><?php echo $j; ?></td>
					<td><?php echo  $this->MugTime->tofrench($facture['Facture']['date']); ?></td>
					<td><?php if($facture['Facture']['monnaie']=='RWF') echo  $number->format($facture['Facture']['reste'],$formatting);?></td>
					<td><?php if($facture['Facture']['monnaie']=='USD') echo  $number->format($facture['Facture']['reste'],$formatting);?></td>
					<td >
						<?php echo $this->Html->link($facture['Facture']['numero'], array('controller' => 'factures', 'action' => 'view', $facture['Facture']['id']),array('target'=>'blank')); ?>
					</td>
					<td><?php echo $facture['Facture']['etat']; ?></td>
					<td id="<?php echo $facture['Facture']['id'];?>"><?php echo $facture['Facture']['observation']; ?></td>
					<?php if(in_array($session->read('Auth.Personnel.fonction_id'),array(3,5))):?>
						<td><button style='font-size: 8px;' onclick='set_observation(this)' facture='<?php echo $facture['Facture']['id']; ?>'>Mettre Une Observation</button></td>
					<?php else:?>
						<td></td>
					<?endif;?>
			</tr>
		<?php endif;?>

			<?php 
				$j++;
				if($facture['Facture']['monnaie']=='USD')
					$USD+=$facture['Facture']['reste'];
				else 
					$RWF+=$facture['Facture']['reste'];

					if(($i+1) == count($factures)){
					echo '<tr class="strong">';
					echo '<td  colspan="2">TOTAL</td>';
					echo '<td>'.$number->format($RWF+0,$formatting).' RWF</td>';
					echo '<td>'.$number->format($USD+0,$formatting).' USD</td>';
					echo '<td colspan="4">&nbsp;</td>';
					echo '</tr>';
					$current_client = $facture['Tier']['id'];
				}
			?>
			
	<?php 
		if($facture['Facture']['monnaie']=='USD')
					$total_USD+=$facture['Facture']['reste'];
				else 
					$total_RWF+=$facture['Facture']['reste'];
		endforeach;
	?>
		<tr class="strong">
				<td colspan="2">TOTAL</td>
				<td><?php echo  $number->format($total_RWF+0,$formatting).' RWF'; ?></td>
				<td><?php echo  $number->format($total_USD+0,$formatting).' USD'; ?></td>
				<td colspan="4">&nbsp;</td>
		</tr>
</table>
</form>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Print</li>
		<li class="link"  onclick = "recherche()" >Search Options</li>
		<li><?php echo $this->Html->link('Invoices Management', array('controller' => 'factures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link('Go back', $referer); ?> </li>
	</ul>
</div>
	
<!-- form for paiement creation -->
<?php echo $this->element('../paiements/edit',array('reste'=>0,'action'=>'mass_payment'));?>
