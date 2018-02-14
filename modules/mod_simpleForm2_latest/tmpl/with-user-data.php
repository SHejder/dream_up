<?php
/**
 * SimpleForm2
 *
 * @package SimpleForm2
 * @author ZyX (allforjoomla.ru)
 * @copyright (C) 2010-2017 by ZyX (http://www.allforjoomla.ru)
 * @license: http://www.allforjoomla.ru/license
 **/
defined('_JEXEC') or die(':)');

$user = JFactory::getUser();
 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SimpleForm2</title>
</head>
<body>
<p>
    <?php echo JText::_('MOD_SIMPLEFORM2_HELLO');?><br>
    <?php echo JText::_('MOD_SIMPLEFORM2_SENT_FROM_PAGE');?>: <a href="<?php echo $url;?>" target="_blank"><?php echo $url;?></a><br>
    <?php echo JText::_('MOD_SIMPLEFORM2_DATE');?>: <?php echo $date;?><br>
    <?php echo JText::_('MOD_SIMPLEFORM2_USER_IP');?>: <?php echo $ip;?>
</p>
<p>
	Username: <?php echo $user->get('username');?><br>
	ID: <?php echo (int)$user->get('id');?><br>
	Name: <?php echo $user->get('name');?><br>
	E-mail: <?php echo $user->get('email');?>
</p>
<table cellpadding="0" cellspacing="0">
<tr>
<th colspan="2" style="text-align:left;padding:15px 0 5px 0;"><font size="+1"><?php echo JText::_('MOD_SIMPLEFORM2_FORM_CONTENT');?>:</font></th>
</tr>
<?php
foreach($form->getElements() as $element){
    if($element->getParam('send-in-email','')=='no'){
        continue;
    }
    ?>
    <tr>
        <td style="padding:5px 15px 5px 0;"><strong><?php echo $element->getParam('label','');?></strong></td>
        <td style="padding:5px 0 5px 0;"><?php echo $element->getValueDisplay();?></td>
    </tr>
    <?php
}
?>
</table>
</body>
</html>