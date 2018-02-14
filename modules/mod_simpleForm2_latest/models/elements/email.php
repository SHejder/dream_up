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

class simpleForm2Element_Email extends simpleForm2Element_Text{
	
	public function checkInput($input){
		$this->inputValue = $input->get($this->getParam('name'),'','string');
        if(($this->isRequired && $this->inputValue=='') || ($this->inputValue!=''&&!SF2Helper::isEmail($this->inputValue))){
            $this->triggerInputError();
            return false;
        }
		return true;
	}
	
}