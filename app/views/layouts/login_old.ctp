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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
		echo $this->Html->css('pop');
		echo $this->Html->css('trontastic/jquery-ui-1.8.11.custom');
		 if (isset($javascript)) {
     		echo $html->script('prototype');
      		echo $html->script('scriptaculous');
      		echo $html->script('jscript');
      		echo $html->script('jquery');
      		echo $html->script('jquery-ui-1.8.11.custom.min');
      		echo $html->script('jquery.validate.min');
      		echo $html->script('messages_fr');
      		echo $html->script('tiny_mce/tiny_mce');
      		echo $html->script('jquery.form');
		}

		echo $scripts_for_layout;
	?>
	<script>
     jQuery.noConflict();
     jQuery(document).ready(function(){
     	message();
     	validator();
     });
   </script>

</head>
<body class="body">
	<div>
	<div id="container">
	<?php echo $this->element('menu',array('enabled'=>false)); ?>
	<div id="wraper">
		<div id="wraper1">
			
			<?php echo $this->Session->flash();
			      echo $session->flash('auth');
			 ?>

			<?php echo $content_for_layout; ?>
			<div style="clear:both;"></div>
		</div>
	</div>
		<div id="footer">
			Logiciel <b>Aser Manager</b> par Mugabo Armand | Tél: +25779853419 | Email:<?php echo $this->Html->link(__('armug@yahoo.fr', true), 'mailto:armug@yahoo.fr'); ?> | Tous droits réservés © 2010
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>