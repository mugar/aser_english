<div id='view'>
<div class="document">
<h3>Historique : <?php if($model!='Reservation') echo $model; else echo 'Réservation';?></h3>
<br />
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Temps','created');?></th>
			<th><?php echo $this->Paginator->sort('personnel_id');?></th>
			<th><?php echo $this->Paginator->sort('Opération','operation');?></th>
		</tr>
	<?php
	foreach ($traces as $trace):
		
	?>
	<tr>
		
		<td><?php echo $trace['Trace']['created']; ?>&nbsp;</td>
		<td>
			<?php echo $trace['Personnel']['name']; ?>
		</td>
		<td><?php echo $trace['Trace']['operation']; ?>&nbsp;</td>
	</tr>
<?php  endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% de %pages%, affichage de %current% enregistrements sur %count% au total, à partir du numéro %start%, jusqu\'au numéro %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('précédent', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('suivant', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>

</div>
</div>
<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Imprimer</li>
		<li><?php echo $this->Html->link('Retour En Arrière', $referer); ?> </li>

	</ul>
</div>
