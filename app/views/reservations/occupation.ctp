
<tr name="other" class="stats">
	<td colspan="3" name="occupation">Personnes actuellement hébergées</td>
	<?php foreach($occupation['in'] as $in): ?>
		<td><?php echo $in; ?></td>
	<?php endforeach; ?>
</tr>
<tr name="other" class="stats">
	<td colspan="3"  name="occupation">Total des personnes actuellement hébergées</td>
	<td colspan="<?php echo $days; ?>"><?php echo $occupation['in-total'];?></td>
</tr>
<tr name="other" class="stats">
	<td colspan="3" name="occupation">Personnes hébergées</td>
	<?php foreach($occupation['hosted'] as $hosted): ?>
		<td><?php echo $hosted; ?></td>
	<?php endforeach; ?>
</tr>
<tr name="other" class="stats">
	<td colspan="3"  name="occupation">Total des personnes hébergées</td>
	<td colspan="<?php echo $days; ?>"><?php echo $occupation['hosted-total'];;?></td>
</tr>
<tr name="other" class="stats">
	<td colspan="3" name="occupation">Taux d'occupation journalière (%)</td>
	<?php foreach($occupation['journalier'] as $pourcentage): ?>
		<td><?php echo $number->precision($pourcentage,0); ?></td>
	<?php endforeach; ?>
</tr>
<tr name="other" class="stats">
	<td colspan="3"  name="occupation">Taux d'occupation mensuelle (%)</td>
	<td colspan="<?php echo $days; ?>"><?php echo $number->precision($occupation['mensuelle'],0);?></td>
</tr>