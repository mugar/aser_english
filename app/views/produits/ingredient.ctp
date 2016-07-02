<div class="dialog">
	<span class="left">
		<?php echo $this->Form->input('ingredient_id',array('id'=>'ing_id','options'=>$ingList));?>
	</span>
	<span class="right">
		<?php echo $this->Form->input('qte',array('id'=>'ing_qte','label'=>'Quantite'));?>
	</span>
	<div style="clear:both"></div>
	<button style="margin:10px 0 10px 100px ;" onclick="ingredient_add_row();return false;">Ajouter/Enlever</button>
	<?php echo $this->Form->create('Product',array('id'=>'ing_form','action'=>'ingredient'));?>
		<table id="ing_table">
			<th></th>
			<th>Ingredient</th>
			<th>Qte</th>
			<?php foreach($ingredients as $i=>$ing):?>
				<tr>
					<td><input type="checkbox" name="checkbox" value="<?php echo $i;?>"/></td>
    	 			<td><select name="<?php echo 'data[Ingredient]['.$i.'][ingredient_id]';?>">
    	 					<option value="<?php echo $ing['Ingredient']['ingredient_id'];?>">
    	 						<?php echo $ing['Compose']['name'];?>
    	 					</option>
    	 				</select>
    	 			</td>
    	 			<td><input type="text" name="<?php echo 'data[Ingredient]['.$i.'][qte]';?>" value="<?php echo $ing['Ingredient']['qte'];?>"/></td>
				</tr>
			<?php endforeach;?>
		</table>
	</form>
<div style="clear:both"></div>
</div>
