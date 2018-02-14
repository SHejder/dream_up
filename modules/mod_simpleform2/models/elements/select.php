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

class simpleForm2Element_Select extends simpleForm2Element{
	
    public function bindInput($input){
		$this->inputValue = (array)$input->get($this->getParam('name'),null,'array');
	}
    
    public function validate(){
        if($this->isRequired && count($this->inputValue)==0){
            $this->triggerInputError();
            return false;
        }
        $match = true;
        foreach($this->inputValue as $k=>$inputValue){
            if(!in_array($inputValue,$this->values)){
                $match = false;
                break;
            }
            if($this->getParam('regex','')!='' && !preg_match($this->getParam('regex'),$inputValue)){
                $match = false;
                break;
            }
        }
        if(!$match){
            $this->triggerInputError();
            return false;
        }
        
		return true;
	}
    
	function getInputHtml(){
		$attribs = $this->getHtmlAttributes();
        if(isset($attribs['value'])){
            unset($attribs['value']);
        }
        if($this->getParam('multiple','')=='multiple'){
            $attribs['name'].='[]';
        }
        $attribs['id'].= '_elem';
        $attribsStr = '';
        foreach($attribs as $k=>$v){
            $attribsStr.= ' '.$k.'="'.$v.'"';
        }
        $selected = array();
        if(is_array($this->inputValue)){
            $selected = $this->inputValue;
        }
        else{
            foreach($this->options as $option){
                if($option->isSelected){
                    $selected[] = $option->params['value'];
                }
            }
        }
        $html = '<select '.$attribsStr.'>';
        foreach($this->options as $option){
            $html.= '<option value="'.htmlspecialchars($option->params['value']).'" '.(in_array($option->params['value'],$selected)?'selected="selected"':'').'>'.htmlspecialchars($option->params['label']).'</option>';
        }
        $html.= '</select>';

        return $html;
	}
	
}