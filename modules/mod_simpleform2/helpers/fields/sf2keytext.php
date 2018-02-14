<?php
/**
 * SimpleForm2
 *
 * @package SimpleForm2
 * @author ZyX (allforjoomla.ru)
 * @copyright (C) 2010-2017 by ZyX (http://www.allforjoomla.ru)
 * @license: http://www.allforjoomla.ru/license
 *
 **/
defined('_JEXEC') or die(':)');

JLoader::register('SF2Helper', JPATH_ROOT.'/modules/mod_simpleform2/helpers/sf2.php');

JFormHelper::loadFieldClass('text');


class JFormFieldSF2KeyText extends JFormFieldText
{
	protected $type = 'SF2KeyText';

	public function getInput()
	{
        $key = $this->_getKeyFromParams();
//		$html = parent::getInput();
//        $html.= ' '.(SF2Helper::checkDomain($key)?'':'<a href="https://allforjoomla.ru/" target="_blank">');
//        $html.= '<img src="'.JUri::root().'media/mod_simpleform2/images/icon-'.(SF2Helper::checkDomain($key)?'ok':'bad').'.png" title="'.(SF2Helper::checkDomain($key)?JText::_('MOD_SIMPLEFORM2_DOMAIN_KEY_ACTIVE'):JText::_('MOD_SIMPLEFORM2_DOMAIN_KEY')).'" data-content="'.JText::_('MOD_SIMPLEFORM2_LICENSE_KEY_PURCHASE').'" class="'.(SF2Helper::checkDomain($key)?'':'hasPopover').'" valign="middle" width="24" height="24" />';
//        $html.= ' '.(SF2Helper::checkDomain($key)?'':'</a>');
        return $html;
	}
    
    private function _getKeyFromParams(){
        $params = $this->form->getValue('params');
        $key = '';
        if(is_object($params) && isset($params->domainKey)){
            $key = $params->domainKey;
        }
        return $key;
    }
}
