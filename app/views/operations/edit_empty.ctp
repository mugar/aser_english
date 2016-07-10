<table cellpadding="0" cellspacing="0" class="advanced1">
	
	<tr>
			
		<th>Date</th>
		<?php if($mode=='index'):?>
			<th>Source :</th>
			<th>Préciser</th>	
			<th>Amount</th>
			<th>Description</th>
			<th>N° Pièce Justificative</th>
			<th>Destination :</th>
			<th>Préciser</th>
		<?php elseif($mode=='report') :?>
			<th>Catégorie</th>
			<th>Préciser</th>	
			<th>Amount</th>
		<?php endif;?>
		<th>Actions</th>
	</tr>
	<?php for($i=0;$i<1;$i++): ?>
	<tr name="<?php echo $i?>">
		<?php echo $this->Form->create('Operation',array('action'=>'add'));?>
		
		<td><?php echo $this->Form->input('date',array('label'=>'','type'=>'text'));?></td>
		<?php if($mode=='index'):?>
			<td><?php echo $this->Form->input('model1',array('id'=>'model1','label'=>'','options'=>$model1s));?></td>
			<td><?php echo '<span id="retrait">'.$this->Form->input('Operation.element1',array('label'=>'','options'=>$list)).'</span>';
				echo $ajax->observeField('model1',array('url' => array('controller'=>'operations','action'=>'update/1'),'update' => 'retrait','indicator'=>'loading'.$i));
			?></td>
			<td><?php echo $this->Form->input('montant',array('label'=>''));?></td>
			<td><?php echo $this->Form->input('libelle',array('label'=>'','type'=>'textarea'));?></td>
			<td><?php echo $this->Form->input('piece',array('label'=>''));?></td>
			<td><?php echo $this->Form->input('model2',array('id'=>'model2','label'=>'','options'=>$model2s));?></td>
			<td><?php echo '<span id="ajout">'.$this->Form->input('Operation.element2',array('label'=>'','options'=>$list)).'</span>';
				echo $ajax->observeField('model2',array('url' => array('controller'=>'operations','action'=>'update/2'),'update' => 'ajout','indicator'=>'loading'.$i));
			?></td>
		<?php elseif($mode=='report') :?>
			<td><?php echo $this->Form->input('model1',array('id'=>'model1','label'=>'','options'=>$models));?></td>
			<td><?php echo '<span id="retrait">'.$this->Form->input('Operation.element1',array('label'=>'','options'=>$list)).'</span>';
				echo $ajax->observeField('model1',array('url' => array('controller'=>'operations','action'=>'update/1'),'update' => 'retrait','indicator'=>'loading'.$i));
			?></td>
			<td><?php echo $this->Form->input('montant',array('label'=>''));?></td>
		<?php endif;?>
		<?php echo $this->Form->input('mode',array('type'=>'hidden','value'=>$mode));?>
		<?php echo $this->Form->input('id1',array('type'=>'hidden','value'=>null));?>
		<?php echo $this->Form->input('id2',array('type'=>'hidden','value'=>null));?>
		<td><input type="submit" value="Save"/></td>
		</form>
		
	</tr>
	<?php endfor; ?>
</table>