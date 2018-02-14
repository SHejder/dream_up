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

class simpleForm2Element_Textarea extends simpleForm2Element{
	
	function getInputHtml(){
		$attribs = $this->getHtmlAttributes();
        unset($attribs['type']);
        if(is_string($this->inputValue)){
            $attribs['value'] = $this->inputValue;
        }
        $value = '';
        if(isset($attribs['value'])){
            $value = $attribs['value'];
            unset($attribs['value']);
        }
        $attribs['id'].= '_elem';
        $attribsStr = '';
        foreach($attribs as $k=>$v){
            $attribsStr.= ' '.$k.'="'.$v.'"';
        }
        $html = '<textarea '.$attribsStr.'>'.htmlspecialchars($value).'</textarea>';

        return $html;
	}
	
}