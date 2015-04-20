<?
// search css for a given day
//exit(debug($abscences));
function css($day,$abscences){
	$day=($day<10)?'0'.$day:$day;
	foreach($abscences as $abscence){
		if($abscence['Abscence']['day']==$day)
			return 'day-'.$abscence['Abscence']['type'];
	}
	return '';
}

function id($day,$abscences){
	$day=($day<10)?'0'.$day:$day;
	foreach($abscences as $abscence){
		if($abscence['Abscence']['day']==$day)
			return $abscence['Abscence']['id'];
	}
	return 0;
}
//Draw Calendar
function draw_calendar($month,$year,$abscences){

	// Draw table for Calendar 
	$calendar = '<table id="abscence_calendar" cellpadding="0" cellspacing="0" class="calendar" month="'.$month.'" year="'.$year.'">';

	// Draw Calendar table headings 
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	//days and weeks variable for now ... 
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	// row for week one 
	$calendar.= '<tr class="calendar-row">';

	// Display "blank" days until the first of the current week 
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		$days_in_this_week++;
	endfor;

	// Show days.... 
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		if($list_day==date('d') && $month==date('n'))
		{
			$currentday='currentday';
		}else
		{
			$currentday='';
		}
		$calendar.= '<td class="calendar-day '.$currentday.' '.css($list_day,$abscences).' " day="'.$list_day.'" id="'.id($list_day,$abscences).'">';
		
			// Add in the day number
			if($list_day<date('d') && $month==date('n'))
			{
				$showtoday='<strong class="overday">'.$list_day.'</strong>';
			}else
			{
				$showtoday=$list_day;
			}
			$calendar.= '<div class="day-number">'.$showtoday.'</div>';

		// Draw table end
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	// Finish the rest of the days in the week
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		endfor;
	endif;

	// Draw table final row
	$calendar.= '</tr>';

	// Draw table end the table 
	$calendar.= '</table>';
	
	// Finally all done, return result 
	return $calendar;
}
?>
<!--recherche form -->
<div id="recherche_boxe" style="display:none" title="Options de Recherche">
<div class="dialog">
	<?php echo $this->Form->create('Abscence',array('id'=>'recherche'));?>
	<span class="left">
		<?php
			echo $this->Form->input('personnel_id',array('id'=>'personnelId','label'=>__('Personnel',true),'selected'=>$id));
			
		?>
	</span>
	<span class="right">
		<?php
			echo $this->Form->input('month',array('label'=>__('Mois',true),'type'=>'date','dateFormat'=>'M'));
			echo $this->Form->input('year',array('label'=>__('Year',true), 'type'=>'date','dateFormat'=>'Y'));	
		?>
	</span>
	</form>
<div style="clear:both"></div>
</div>
</div>
<script>
	jQuery(document).ready(function(){
		var longpress = false;

		jQuery(".calendar-day").on('click', function (e) {
			jQuery('.calendar-day').removeClass('selected-day');
			jQuery(this).addClass('selected-day');
			
		    if(longpress){
		    	e.preventDefault();
		    	abscence(this,true);
		    }
		    else {
		    	abscence(this);
		    }
		});

		var startTime, endTime;
		jQuery(".calendar-day").on('mousedown', function () {
    		startTime = new Date().getTime();
		});

		jQuery(".calendar-day").on('mouseup', function () {
    		endTime = new Date().getTime();

   			if (endTime - startTime < 250) {
    		    longpress = false;
    		} 
    		else if (endTime - startTime >= 300) {
        		longpress = true;
	    	}
	 	});
	})
</script>
<div id='view'>
<div class="document">
<h3><?php 
	echo __('Feuille de présences de : ',true).$personnels[$id].__(' pour le mois de ',true).$this->MugTime->giveMonth($month).' '.$year;
	?>
</h3>
<br>
<?
echo draw_calendar($month,$year,$abscences);
?>

</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="link" onclick = "print_documents()" >Imprimer</li>
		<li class="link"  onclick = "recherche()" >Options de Recherche</li>
	</ul>
</div>

<!--abscence box-->
<div id="abscence_boxe" style="display:none" title="<?__('Enregistrer une abscence');?>">
	<?php echo $this->element('../abscences/edit');?>
</div>