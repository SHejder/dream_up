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

class simpleForm2Element_Checkbox extends simpleForm2Element{
    
    public function bindInput($input){
		$this->inputValue = (array)$input->get($this->getParam('name'),null,'array');
	}
    
    public function validate(){
        if($this->isRequired && count($this->inputValue)==0){
            $this->triggerInputError();
            return false;
        }
        if(count($this->inputValue)>0){
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
        }
        
		return true;
	}
    
	function getInputHtml(){
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
        $name = $this->getParam('name');
        
        if(count($this->options)>0){
            $html = $this->code;
            $html = preg_replace('~{element ([^}]+)}~','<div class="sf2-checkboxes">',$html);
            if(count($this->options)>1 && $this->getParam('type')=='checkbox'){
                $name.= '[]';
            }
            foreach($this->options as $option){
                $tmp = '<label class="sf2-checkbox-label"><input type="'.$this->getParam('type').'" name="'.$name.'" value="'.htmlspecialchars($option->params['value']).'" '.(in_array($option->params['value'],$selected)?'checked="checked"':'').'/><i></i>'.$option->params['label'].'</label>';
                $html = str_replace($option->code,$tmp,$html);
            }
            $html = str_replace('{/element}','</div>',$html);
        }
        else{
            $html = '<div class="sf2-checkboxes">';
            $html.= '<label class="sf2-checkbox-label"><input type="'.$this->getParam('type').'" name="'.$name.'" value="'.htmlspecialchars($this->getParam('value')).'" '.(in_array($this->getParam('value'),$selected)?'checked="checked"':'').'/><i></i>'.$this->getParam('label').'</label>';
            $html.= '</div>';
        }
        return $html;
	}
	
}