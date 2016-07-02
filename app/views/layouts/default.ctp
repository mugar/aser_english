
<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE HTML>
<head>
	<?php echo $html->charset(); ?>
	<title>
		Aser Manager ::
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('style');
		echo $this->Html->css('ui-lightness/jquery-ui-1.8.11.custom');
		echo $this->Html->css('jquery.jqplot.min');
	//	echo $this->Html->css('calendar');
		if (isset($javascript)) {
     		echo $html->script('prototype');
      		echo $html->script('scriptaculous');
      		echo $html->script('jscript');
      		echo $html->script('jscript1');
      		echo $html->script('jquery-1.7.1.min');
      		echo $html->script('jquery-ui-1.8.12.custom.min');
      		echo $html->script('jquery.validate.min');
      		echo $html->script('messages_fr');
      		echo $html->script('tinymce/tinymce.min');
      		echo $html->script('jquery.form');
      		echo $html->script('jquery.contextMenu');
      		echo $html->script('jquery.ajax-cross-origin.min');
      		echo $html->script('stupidtable');
      		echo $html->script('idle-timer');
      		echo $html->script('jquery.jqplot.min');
      		echo $html->script('plugins/jqplot.categoryAxisRenderer.min');
      		echo $html->script('plugins/jqplot.canvasAxisTickRenderer.min');
      		echo $html->script('plugins/jqplot.trendline.min');
      		echo $html->script('plugins/jqplot.pointLabels.min');
      		echo $html->script('jquery.select-filter.min');
		}

		echo $scripts_for_layout;
	?>
	<script>
     jQuery.noConflict();
     jQuery(document).ready(function(){
     	rightClick();
     	mouseup();
     	date();
     	message();
     	validator();
     	indicator();
     });
   </script>

<?php
 if(in_array($session->read('Auth.Personnel.fonction_id'),array(1,2))
 	&&Configure::read('aser.touchscreen')
	&&Configure::read('aser.auto_logout')
	):?>
 
<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
			jQuery(document).idleTimer(120000);
			jQuery( document ).on( "idle.idleTimer", function(){
				document.location.href=getBase()+'personnels/logout';
			});
	});
</script>
<?php endif;?>
<!-- reminder stuff-->
<?php
	$sessionTest=$session->read('Auth.Personnel');
	if(false):
?>	
<script>
 jQuery.noConflict();
     jQuery(document).ready(function(){
		setInterval(function(){
			rappel();
		},
		10000
		);
	});
</script>
<?php endif;?>
</head>
<body class="body" name="<?php echo Configure::read('aser.name');?>">
	
	<div id="printers"
	first="<?php echo Configure::read('printer.caissier');?>"
	second="<?php echo Configure::read('printer.barman');?>"
	third="<?php echo Configure::read('printer.cuisine');?>"
	></div>
	<div id="indicator" > Loading ...</div>
		<?php echo $this->element('defaulter'); ?>
	<div id="container">
	<?php echo $this->element('menu',array('enabled'=>$enabled)); ?>
	<div id="wraper" >
		<div id="wraper1">
			<?php echo $session->flash();
					echo $session->flash('auth');
			 ?>
			<?php echo $content_for_layout; ?>
			<div style="clear:both;"></div>
		</div>
	</div>
		<div id="footer">
			 <b>Aser Manager</b> Software created by Mugabo Armand | Tél: +257 75 854 201/ 79 853 419 | Email:<?php echo $this->Html->link(__('mugarmug@gmail.com', true), 'mailto:mugarmug@gmail.com'); ?> | All rights reserved © <?php echo '2012 - '.date('Y');?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
	
<!--printing iframe -->
<iframe id="printPage" name="printPage" src='' style="position:absolute;top:0px; left:0px;width:0px; height:0px;border:0px;overfow:none; z-index:-1"></iframe>
</body>
</html>
