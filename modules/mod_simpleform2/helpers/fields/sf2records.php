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


class JFormFieldSF2Records extends JFormFieldText
{
	protected $type = 'SF2Records';
    
    public function __construct($form = null){
        $lang = JFactory::getLanguage();
        $doc = JFactory::getDocument();
        $doc->addCustomTag('<script type="text/javascript">var SF2Lang=window.SF2Lang||{};'
            .'SF2Lang["sure-to-delete-record"] = "'.htmlspecialchars(JText::_('MOD_SIMPLEFORM2_SURE_DEL_RECORD')).'";'
            .'</script>');
        $doc->addCustomTag('<script type="text/javascript">var SF2Config=window.SF2Config||{};SF2Config["records"]={'
                .'"ajaxURI": "'.JUri::root().'modules/mod_simpleform2/index.php",'
                .'"lang": "'.$lang->getTag().'",'
            .'};'
            .'</script>');
        JHtml::_('jquery.framework');
        JHtml::script(JUri::root().'media/mod_simpleform2/js/simpleform2.js');
        JHtml::script(JUri::root().'media/mod_simpleform2/js/backend.js');
//        JHtml::stylesheet(JUri::root().'media/mod_simpleform2/css/styles.css');
        JHtml::stylesheet(JUri::root().'media/mod_simpleform2/css/backend.css');
        return parent::__construct($form);
    }
    
	public function getInput()
	{
        $key = $this->_getKeyFromParams();
		if(SF2Helper::checkDomain($key)){
            $lang = JFactory::getLanguage();
            SF2Helper::checkDB();
            $records = $this->_getRecords();
            $html = '<table class="table table-striped" id="sf2Records">'
				.'<thead>'
                    .'<tr>'
                        .'<th>'.JText::_('JDATE').'</th>'
                        .'<th class="nowrap" width="100%">'.JText::_('MOD_SIMPLEFORM2_MAIL_SUBJECT').'</th>'
                        .'<th class="nowrap">'.JText::_('MOD_SIMPLEFORM2_RECIEVE_EMAIL').'</th>'
                        .'<th class="nowrap">'.JText::_('MOD_SIMPLEFORM2_SENT_FROM_PAGE').'</th>'
                        .'<th class="nowrap">'.JText::_('JFIELD_LANGUAGE_LABEL').'</th>'
                        .'<th class="nowrap">'.JText::_('MOD_SIMPLEFORM2_USER').'</th>'
                        .'<th class="nowrap">IP</th>'
                        .'<th class="nowrap">&nbsp;</th>'
                    .'</tr>'
                .'</thead>'
                .'<tbody>';
                if(count($records)){
                    foreach($records as $record){
                        $viewURI = JUri::root().'modules/mod_simpleform2/index.php?token='.SF2Helper::getToken().'&task=getRecord&id='.$record['id'].'&lang='.$lang->getTag();
                        $delURI = JUri::root().'modules/mod_simpleform2/index.php?token='.SF2Helper::getToken().'&task=delRecord&id='.$record['id'].'&lang='.$lang->getTag();
                        $html.= '<tr>';
                        $html.= '<td>'.JHtml::_('date', $record['created_at'], 'd.m.Y H:i:s').'</td>';
                        $html.= '<td class="nowrap"><a href="'.$viewURI.'" target="_blank" class="sf2-record-view-link">'.htmlspecialchars($record['subject']).'</a></td>';
                        $html.= '<td>'.$record['recipient'].'</td>';
                        $html.= '<td><a href="'.$record['uri'].'" target="_blank">'.(JString::strlen($record['uri'])>30?JString::substr($record['uri'],0,30).'...':$record['uri']).'</a></td>';
                        $html.= '<td class="nowrap">'.$record['lang'].'</td>';
                        if((int)$record['user_id']>0){
                            $user = JFactory::getUser((int)$record['user_id']);
                            $html.= '<td><a href="'.JRoute::_('index.php?option=com_users&task=user.edit&id='.(int)$record['user_id']).'" target="_blank">'.$user->name.' ('.$user->username.')</a></td>';
                        }
                        else{
                            $html.= '<td>'.JText::_('MOD_SIMPLEFORM2_GUEST').'</td>';
                        }
                        $html.= '<td class="nowrap">'.$record['ip'].'</td>';
                        $html.= '<td><a href="'.$delURI.'" class="btn btn-danger sf2-record-del-link">'.JText::_('JACTION_DELETE').'</a></td>';
                        $html.= '</tr>';
                    }
                }
                else{
                    $html.= '<tr>';
                    $html.= '<td colspan="8">'.JText::_('MOD_SIMPLEFORM2_NO_RECORDS_FOUND').'</td>';
                    $html.= '</tr>';
                }
            $html.= '</tbody></table>';
            
        }
        else{
            $html = '<div style="padding: 5px 0 5px 15px;background: #fff;color: #333;border: 0px solid #da4f49;border-left-width: 4px;margin: 15px 0;line-height: 1.3;">'.JText::_('MOD_SIMPLEFORM2_LICENSE_KEY_PURCHASE').'</div>';
        }
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
    
    private function _getRecords(){
        $id = (int)$this->form->getValue('id');
        $db = JFactory::getDbo();
        $q = $db->getQuery(true);
        $q->select('*');
        $q->from($db->quoteName('#__sf2_records'));
        $q->where($db->quoteName('module_id').'='.$id);
        $q->order('id DESC');

        $db->setQuery($q);

        return (array)$db->loadAssocList();
    }

}
