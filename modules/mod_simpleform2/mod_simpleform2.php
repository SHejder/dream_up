<?php
/**
 * SimpleForm2
 *
 * @package SimpleForm2
 * @author ZyX (allforjoomla.ru)
 * @copyright (C) 2010-2017 by ZyX (http://www.allforjoomla.ru)
 * @license: http://www.allforjoomla.ru/license
 *
 * 
 * Events for "simpleform2" group plugins:
 * - processLicenseKey(string &$licenseKey)
 * - getBeforeFormHTML(simpleForm2 $form, string $html):string
 * - getAfterFormHTML(simpleForm2 $form, string $html):string
 * - processBeforeSendEmail(Joomla\CMS\Mail\Mail &$mail, simpleForm2 $form, Joomla\Registry\Registry $moduleParams)
 * - processAfterSendEmail(Joomla\CMS\Mail\Mail &$mail, simpleForm2 $form, Joomla\Registry\Registry $moduleParams, bool|Exception $result)
 * - processBeforeFormBindInput(simpleForm2 $form, Joomla\CMS\Input\Input &$input)
 * - processBeforeFormValidate(simpleForm2 $form, array &$errors)  $errors = array("FORM_ELEMENT_ID"=>"ERROR_MESSAGE")
 * - processAfterFormValidate(simpleForm2 $form, array &$errors)  $errors = array("FORM_ELEMENT_ID"=>"ERROR_MESSAGE")
 * - processFormCaptchaElement(simpleForm2 $form, simpleForm2Element|false &$captchaElement)
 * 
 **/
defined('_JEXEC') or die(':)');

JLoader::register('SF2Helper', JPATH_ROOT.'/modules/mod_simpleform2/helpers/sf2.php');
JLoader::register('simpleForm2', JPATH_ROOT.'/modules/mod_simpleform2/models/form.php');
JLoader::register('simpleForm2Element', JPATH_ROOT.'/modules/mod_simpleform2/models/form.element.php');
JLoader::register('simpleForm2BaseModel', JPATH_ROOT.'/modules/mod_simpleform2/models/base.php');

$id = 'simpleForm2_'.$module->id;
$userCheckFunc = $params->get('userCheckFunc','');
$userResultFunc = $params->get('userResultFunc','');
$okText = $params->get('okText','');
$config = JFactory::getConfig();
$cache = (int)$params->get('cache',0);
$sysCache = (int)$config->get('caching',0);
$loadScriptsMode = $params->get('loadScriptsMode','body');
$formLayout = $params->get('sfLayout','blocks');
$formStyle = $params->get('sfStyle','default');
$formLayoutMode = $params->get('sfLayoutMode','full-width');

if($loadScriptsMode=='body'){
	$cache = 1;
	$sysCache = 1;
}
$jsLang = 'var SF2Lang=window.SF2Lang||{};'
        . 'SF2Lang["send"] = "'.htmlspecialchars(JText::_('MOD_SIMPLEFORM2_SEND')).'";'
        . 'SF2Lang["close"] = "'.htmlspecialchars(JText::_('MOD_SIMPLEFORM2_CLOSE')).'";';

$jsParams = 'var SF2Config=window.SF2Config||{};SF2Config["'.$id.'"]={'
        . '"ajaxURI": "'.JUri::root().'modules/mod_simpleform2/index.php",'
        . '"onBeforeSend": '.($userCheckFunc!=''?$userCheckFunc:'function(form){return true;}').','
        . '"onAfterReceive": '.($userResultFunc!=''?$userResultFunc:'function(form,responce){return true;}').','
        . '};';

if($cache>0 && $sysCache>0){
	if(!defined('SIMPLEFORM2')){
        JHtml::_('jquery.framework');
		echo '<script type="text/javascript" src="'.JUri::root().'media/mod_simpleform2/js/jquery.form.min.js"></script>'."\n";
		echo '<script type="text/javascript" src="'.JUri::root().'media/mod_simpleform2/js/simpleform2.js"></script>'."\n";
        echo '<link href="'.JUri::root().'media/mod_simpleform2/css/styles.css" rel="stylesheet" />'."\n";
        echo '<script type="text/javascript">'.$jsLang.'</script>'."\n";
	}
	echo '<script type="text/javascript">'.$jsParams.'</script>';
}
else{
    $doc = JFactory::getDocument();
	if(!defined('SIMPLEFORM2')){
        JHtml::_('jquery.framework');
        JHtml::script(JUri::root().'media/mod_simpleform2/js/jquery.form.min.js');
        JHtml::script(JUri::root().'media/mod_simpleform2/js/simpleform2.js');
        JHtml::stylesheet(JUri::root().'media/mod_simpleform2/css/styles.css');
        $doc->addCustomTag('<script type="text/javascript">'.$jsLang.'</script>');
	}
	$doc->addCustomTag('<script type="text/javascript">'.$jsParams.'</script>');
}
defined('SIMPLEFORM2') or define('SIMPLEFORM2',1);

$app = JFactory::getApplication();

$task = $app->input->getCmd('task');
$post = (array)$app->input->get('post');
$moduleID = (int)$app->input->getInt('moduleID');

$form = new simpleForm2();
$form->setID($id);
$form->moduleID = (int)$module->id;
$form->licenseKey = $params->get('domainKey','');
if(SF2Helper::checkDomain($params->get('domainKey',''))){
    $form->setLayout($formLayout);
    $form->setStyle($formStyle);
    $form->setLayoutMode($formLayoutMode);
}

if(!$form->parse($params->get('simpleCode',''))){
	echo '<div class="sf2-message sf2-type-error"><b>'.JText::_('MOD_SIMPLEFORM2_ERROR_OCURED').'</b><p>'.$form->getError().'</p></div>';
	return;
}

if(($formLayout!='blocks' || $formStyle!='default') && !SF2Helper::checkDomain($params->get('domainKey',''))){
    echo '<div class="sf2-message sf2-type-error"><p>'.JText::_('MOD_SIMPLEFORM2_LICENSE_KEY_PURCHASE').'</p></div>';
}

if($task=='sendForm' && $moduleID==(int)$module->id){
    $form->bindInput($app->input->post);
    $errors = $form->validate();
    if(count($errors)>0){
        echo '<div class="sf2-message sf2-type-error"><b>'.JText::_('MOD_SIMPLEFORM2_ERROR_OCURED').'</b><ul class="sf2-error-list"><li>'.implode('</li><li>',array_values($errors)).'</li></ul></div>';
    }
    else{
        try{
            SF2Helper::sendFormEmail($form,$params);
            echo '<div class="sf2-message sf2-type-success">'.($okText!=''?$okText:JText::_('MOD_SIMPLEFORM2_FORM_SUCCEED')).'</div>';
            return;
        }
        catch(Exception $e){
            echo '<div class="sf2-message sf2-type-error"><b>'.JText::_('MOD_SIMPLEFORM2_ERROR_OCURED').'</b><p>'.$e->getMessage().'</p></div>';
        }
    }
}

echo $form->toHtml();
