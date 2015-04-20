<script>
 jQuery.noConflict();
 jQuery(document).ready(function(){
 	date();
});
</script>
<div class="dialog">
	<span class="left">
		<?php echo $this->Form->input('date',array('id'=>'Date'));?>
		<?php echo $this->Form->input('tier_id',array('id'=>'tier_id','options'=>$tiers));?>
		<?php echo $this->Form->input('type_service_id',array('id'=>'type_service_id','options'=>$typeServices));?>
		
	</span>
	<span class="right">
		<?php echo $this->Form->input('description',array('id'=>'serv_description'));?>
		<?php echo $this->Form->input('montant',array('id'=>'serv_montant'));?>
	</span>
	<div style="clear:both"></div>
	<button style="margin:10px 0 10px 100px ;" onclick="service_add_row();return false;">Ajouter/Enlever</button>
	<?php echo $this->Form->create('Service',array('id'=>'serv_form','action'=>'gerer'));?>
		<table id="serv_table">
			<th></th>
			<th>Description</th>
			<th>Montant</th>
			<?php foreach($services as $i=>$service):?>
				<tr>
					<td><input type="checkbox" name="checkbox" value="<?php echo $i;?>"/></td>
    	 			<td><input type="text" name="<?php echo 'data[Ingredient]['.$i.'][description]';?>" value="<?php echo $service['Ingredient']['description'];?>"/></td>
    	 			<td><input type="text" name="<?php echo 'data[Ingredient]['.$i.'][montant]';?>" value="<?php echo $service['Ingredient']['montant'];?>"/></td>
				</tr>
			<?php endforeach;?>
		</table>
	</form>
<div style="clear:both"></div>
</div>
