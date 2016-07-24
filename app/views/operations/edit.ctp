
<div class="dialog">
<?php echo $this->Form->create('Operation',array('id'=>'edit_form'));?>
	<span class="left">
		<?php
		echo $this->Form->input('date',array('type'=>'text','id'=>'DateEdit'));
		echo $this->Form->input('model1',array('id'=>'model1-1','label'=>'Source','options'=>$model1s,'selected'=>$selected_source));
		echo '<span id="retrait-1">'.$this->Form->input('Operation.element1',array('id'=>'element1-1','label'=>'Préciser La Source','options'=>$elements1,'selected'=>$selected_element1)).'</span>';
		echo $ajax->observeField('model1-1',array('url' => array('controller'=>'operations','action'=>'update/1'),'update' => 'retrait-1'));
		echo $this->Form->input('libelle');
		?>
	</span>
	<span class="right">
		<?php
		echo $this->Form->input('montant');
		echo $this->Form->input('ordre');
		echo $this->Form->input('monnaie',array('label'=>'Currency'));
		echo $this->Form->input('model2',array('id'=>'model2-1','label'=>'Destination','options'=>$model2s ,'selected'=>$selected_destination));
		echo '<span id="ajout-1">'.$this->Form->input('Operation.element2',array('label'=>'Préciser La Déstination','options'=>$elements2,'selected'=>$selected_element2)).'</span>';
		echo $ajax->observeField('model2-1',array('url' => array('controller'=>'operations','action'=>'update/2'),'update' => 'ajout-1'));
		echo $this->Form->input('op_num',array('type'=>'hidden'));
			echo $this->Form->input('personnel_id',array('type'=>'hidden'));

		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>