
		<td><?php echo $this->Form->input('date',array('label'=>'','type'=>'text'));?></td>
		
			<td><?php 
				echo $this->Form->input('compte_id',array('label'=>'','options'=>$comptes,'id'=>'compteId'));
			?></td>
		<?php if($mode=='index'):?>
			<td><?php echo $this->Form->input('piece',array('label'=>''));?></td>
			<td><?php echo $this->Form->input('libelle',array('label'=>'','type'=>'textarea'));?></td>
		<?php endif;?>
			<td><?php echo $this->Form->input('debit',array('label'=>''));?></td>
			<td><?php echo $this->Form->input('credit',array('label'=>''));?></td>
		
		<?php echo $this->Form->input('mode',array('type'=>'hidden','value'=>$mode));?>
		<td><input type="submit" value="Envoyer"/></td>
		<?php echo $this->Form->input('journal',array('id'=>'compte','type'=>'hidden','value'=>$journal));?>