
<div id="recherche_boxe" style="display:none" title="Search Options">
<div class="dialog">
	<div id="message_recherche"></div>
	<?php echo $this->Form->create('Product',array('id'=>'recherche','action'=>$action));?>
	<span class="left">
		<?php
			echo $this->Form->input('name',array('label'=>'Nom Du Product','value'=>''));
			echo $this->element('combobox',array('n°'=>1));
			if(Configure::read('aser.comptabilite'))
				echo $this->Form->input('groupe_comptable_id',array('options'=>(array(0=>'',-1=>'Sans Groupe')+$groupeComptables)));
			if($action=='rapport'){
				echo $this->Form->input('stock_id');
			}
		?>
	</span>
	<span class="right">
		<?php
			
			echo $this->Form->input('type',array('options'=>$typeDeProduits1,'label'=>'Type De Product','selected'=>0));
			echo $this->Form->input('actif',array('options'=>array(''=>'','oui'=>'oui','non'=>'non')));
			if($action=='rapport'){
				echo $this->Form->input('quantite',array('options'=>array(' > 0'=>' > 0','toutes'=>'toutes')));
				echo $this->Form->input('export',array('label'=>'Exporter Vers Excel','type'=>'checkbox'));
			}
			if($action=='index')
				echo $this->Form->input('show',array('label'=>'Affichage',
												'options'=>array(20=>'20',
																50=>'50',
																100=>'100',
																200=>'200',
																'all'=>'all',
																)));
			
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>