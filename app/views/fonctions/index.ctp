<div class="fonctions index">
	<h2><?php __('Fonctions');?></h2>
	<?php echo $this->Form->create('Fonction',array('name'=>'checkbox','id'=>'Fonction_fonctions'));?>	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><input type="checkbox" name="master" value="" onclick="checkAll(document.checkbox)"></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
		</tr>
	<?php
	$i = 0;
	$j = 0;
	foreach ($fonctions as $fonction):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Form->input('Id.'.$j.'',array('label'=>'','type'=>'checkbox','value'=>$fonction['Fonction']['id'])); ?>
		</td>
		<td><?php echo $fonction['Fonction']['id']; ?>&nbsp;</td>
		<td><?php echo $fonction['Fonction']['name']; ?>&nbsp;</td>
		<td><?php echo $fonction['Fonction']['description']; ?>&nbsp;</td>
	</tr>
<?php  $j++; endforeach; ?>
	</table>
</form>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing  %current% records out of %count%, from %start%, to %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div id="separator" class="back" title="Hide the Menu" onclick="hider()"></div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
	</ul>
</div>
