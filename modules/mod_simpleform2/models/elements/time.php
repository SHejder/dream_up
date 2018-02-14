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

class simpleForm2Element_Time extends simpleForm2Element_Text{
	
    public function bindInput($input){
        $hours = $input->get($this->getParam('name').'-hours',-1,'int');
        $minutes = $input->get($this->getParam('name').'-minutes',-1,'int');
        
        if($hours>=0 && $hours<=23 && $minutes>=0 && $minutes<=59){
            $this->inputValue = $hours.':'.$minutes;
        }
        else $this->inputValue = '';
	}
    
    public function validate(){
        if($this->isRequired && !preg_match('~^[0-9]{1,2}\:[0-9]{1,2}$~',$this->inputValue)){
            $this->triggerInputError();
            return false;
        }
		return true;
	}
    
    function getInputHtml(){
		$attribs = $this->getHtmlAttributes();
        if(is_string($this->inputValue)){
            $attribs['value'] = $this->inputValue;
        }
        if(isset($attribs['value'])){
            $attribs['value'] = htmlspecialchars($attribs['value']);
        }
        $attribs['id'].= '_elem';
        
        $hAttribs = $mAttribs = $attribs;
        
        unset($hAttribs['type']);
        $hAttribs['class'].= ' sf2-element-hours';
        $hAttribs['name'].= '-hours';
        $hAttribsStr = '';
        foreach($hAttribs as $k=>$v){
            $hAttribsStr.= ' '.$k.'="'.$v.'"';
        }
        
        $mAttribs['class'].= ' sf2-element-minutes';
        $mAttribs['name'].= '-minutes';
        $mAttribs['type'] = 'number';
        $mAttribs['min'] = 0;
        $mAttribs['max'] = 59;
        $mAttribs['placeholder'] = JText::_('MOD_SIMPLEFORM2_MINUTES');
        $mAttribsStr = '';
        foreach($mAttribs as $k=>$v){
            $mAttribsStr.= ' '.$k.'="'.$v.'"';
        }
        
        $html = '<div class="sf2-form-inline">';
            $html.= '<select '.$hAttribsStr.'>';
            $html.= '<option value="-1">'.JText::_('MOD_SIMPLEFORM2_HOURS').'</option>';
            for($i=0;$i<=23;$i++){
                $html.= '<option>'.$i.'</option>';
            }
            $html.= '</select>';
            $html.= ' : ';
            $html.= '<input '.$mAttribsStr.'>';
        $html.= '</div>';
        
        return $html;
	}
}