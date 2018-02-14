<?php
/**
 * SimpleForm2
 *
 * @package SimpleForm2
 * @author ZyX (allforjoomla.ru)
 * @copyright (C) 2010-2017 by ZyX (http://www.allforjoomla.ru)
 * @license: http://www.allforjoomla.ru/license
 **/
define('_JEXEC', 1);

define('JPATH_BASE', realpath('../../'));
require_once JPATH_BASE . '/includes/defines.php';
require_once JPATH_BASE . '/includes/framework.php';

$app = JFactory::getApplication('site');
$langParams = JComponentHelper::getParams('com_languages');
$lang = $app->input->getCmd('language',$langParams->get('site','ru-RU'));

JFactory::getConfig()->set('language',$lang);

$language = JFactory::getLanguage();
$language->load('mod_simpleform2', JPATH_SITE);

$user	= JFactory::getUser();
$task = $app->input->getCmd('task');
$moduleID = (int)$app->input->getInt('moduleID',0);
$inputToken = $app->input->getString('token');

JLoader::register('SF2Helper', JPATH_ROOT.'/modules/mod_simpleform2/helpers/sf2.php');
JLoader::register('simpleForm2', JPATH_ROOT.'/modules/mod_simpleform2/models/form.php');
JLoader::register('simpleForm2Element', JPATH_ROOT.'/modules/mod_simpleform2/models/form.element.php');
JLoader::register('simpleForm2BaseModel', JPATH_ROOT.'/modules/mod_simpleform2/models/base.php');
        
$responce = array(
    'status' => 'error',
    'message' => JText::_('MOD_SIMPLEFORM2_ERROR')
);
try{
    
    if($task=='getRecord' || $task=='delRecord'){
        $token = SF2Helper::getToken();
        $db = JFactory::getDbo();
        if($inputToken!=$token){
            throw new Exception(JText::_('MOD_SIMPLEFORM2_ACCESS_NOT_ALLOWED'));
        }
        $recordID = (int)$app->input->getInt('id',0);
        if($task=='delRecord'){
            $q = $db->getQuery(true);
            $q->delete();
            $q->from($db->quoteName('#__sf2_records'));
            $q->where($db->quoteName('id').'='.$recordID);
            $db->setQuery($q);
            $db->execute();
            $responce = array(
                'status' => 'success',
            );
        }
        else{
            $q = $db->getQuery(true);
            $q->select('*');
            $q->from($db->quoteName('#__sf2_records'));
            $q->where($db->quoteName('id').'='.$recordID);
            $db->setQuery($q);
            $record = $db->loadAssoc();
            if(is_array($record) && isset($record['id']) && (int)$record['id']==$recordID){
                preg_match('~<body>(.*?)(?=</body>)~is',$record['message'],$match);
                $responce = array(
                    'status' => 'success',
                    'html' => $match[1]
                );
            }
            else{
                $responce['message'] = JText::_('MOD_SIMPLEFORM2_RECORD_NOT_FOUND');
            }
        }
    }
    else{
        if($moduleID<=0){
            throw new Exception(JText::_('MOD_SIMPLEFORM2_FORM_NOT_FOUND'));
        }
        $module = JTable::getInstance('module');
        $module->load($moduleID);
        if((int)$module->id<=0 || (int)$module->id!=$moduleID){
            throw new Exception(JText::_('MOD_SIMPLEFORM2_FORM_NOT_FOUND'));
        }
        $params = new JRegistry;
        $params->loadString($module->params);

        $id = 'simpleForm2_'.$module->id;
        $okText = $params->get('okText','');

        $form = new simpleForm2();
        $form->setID($id);
        $form->moduleID = (int)$module->id;
//        $form->licenseKey = $params->get('domainKey','');

        if(!$form->parse($params->get('simpleCode',''))){
            throw new Exception('<b>'.JText::_('MOD_SIMPLEFORM2_ERROR_OCURED').'</b><p>'.$form->getError().'</p>');
            return;
        }
        switch($task){
            case 'sendForm':
                $form->bindInput($app->input->post);
                $errors = $form->validate();
                if(count($errors)>0){
                    $responce['elements'] = $errors;
                    throw new Exception('<b>'.JText::_('MOD_SIMPLEFORM2_ERROR_OCURED').'</b><ul class="sf2-error-list"><li>'.implode('</li><li>',array_values($errors)).'</li></ul>');
                }
                else{
                    SF2Helper::sendFormEmail($form,$params);
                    $responce['status'] = 'success';
                    $responce['message'] = ($okText!=''?$okText:JText::_('MOD_SIMPLEFORM2_FORM_SUCCEED'));
                    $responce['html'] = '<div class="sf2-message sf2-type-success">'.($okText!=''?$okText:JText::_('MOD_SIMPLEFORM2_FORM_SUCCEED')).'</div>';
                }
            break;
            case 'captcha':
                $captchaElem = $form->getCaptchaElement();
                if($captchaElem===false){
                    throw new Exception(JText::_('MOD_SIMPLEFORM2_FORM_HAS_NO_CAPTCHA'));
                }
                $captchaElem->renderImage();
                $app->close();
            break;
        }
    }
    
} catch (Exception $e) {
    $responce['status'] = 'error';
    $responce['message'] = $e->getMessage();
}

header('Content-Type: application/json; charset="utf-8"',true);
echo json_encode($responce);
$app->close();
