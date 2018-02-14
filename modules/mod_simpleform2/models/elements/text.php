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

class simpleForm2Element_Text extends simpleForm2Element{
	
	function getInputHtml(){
		$attribs = $this->getHtmlAttributes();
        if(is_string($this->inputValue)){
            $attribs['value'] = $this->inputValue;
        }
        if(isset($attribs['value'])){
            $attribs['value'] = htmlspecialchars($attribs['value']);
        }
        $attribs['id'].= '_elem';
        $attribsStr = '';
        foreach($attribs as $k=>$v){
            $attribsStr.= ' '.$k.'="'.$v.'"';
        }
        $html = '<input '.$attribsStr.' />';

        return $html;
	}
	
}