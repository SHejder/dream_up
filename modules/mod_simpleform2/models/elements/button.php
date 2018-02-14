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

class simpleForm2Element_Button extends simpleForm2Element{
	
	public function parse($code) {
        if(!parent::parse($code)){
            return false;
        }
        $this->defParam('send-in-email','no');
        return true;
    }
    
    public function checkInput($input){
        return true;
    }
    
    public function getInputHtml(){
		$attribs = $this->getHtmlAttributes();
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
        $html = '<button '.$attribsStr.'>'.$value.'</button>';
        return $html;
	}
	
}