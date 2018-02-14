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

class simpleForm2Element_Submit extends simpleForm2Element_Button{
	
	function getInputHtml(){
        $html = parent::getInputHtml();
        return '<span class="sf2-submit-container">'.$html.'</span>';
	}
	
}