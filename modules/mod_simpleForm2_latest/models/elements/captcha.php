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

class simpleForm2Element_Captcha extends simpleForm2Element{
    
    protected $_captchaPlugin = null;
    
    public function parse($code) {
        if(!parent::parse($code)){
            return false;
        }
        $this->defParam('send-in-email','no');
        $this->isRequired = true;
		$this->setParam('required','required');
        
        if($this->getParam('plugin','')!=''){
            if(($this->_captchaPlugin = JCaptcha::getInstance($this->getParam('plugin'), array('namespace' => 'simpleform2_'.$this->form->moduleID.'.captcha'))) == null){
                $this->setError(sprintf(JText::_('MOD_SIMPLEFORM2_NO_CAPTCHA_PLUGIN_FOUND'),$this->getParam('plugin')));
                return false;
            }
        }
        else{
            $session = JFactory::getSession();
            $this->values[] = $session->get('simpleform2_'.$this->form->moduleID.'.captcha', rand(1,99999));
        }
        return true;
    }
    
    public function toHtml(){
        $user = JFactory::getUser();
        if((int)$user->get('id')>0){
            return '';
        }
        else return parent::toHtml();
    }
    
	public function getInputHtml(){
		$attribs = $this->getHtmlAttributes();
        $attribs['type'] = 'text';
        if(is_string($this->inputValue)){
            $attribs['value'] = $this->inputValue;
        }
        if(isset($attribs['value'])){
            $attribs['value'] = htmlspecialchars($attribs['value']);
        }
        foreach(array('width','height','color','background') as $k){
            if(isset($attribs[$k])){
                unset($attribs[$k]);
            }
        }
        $attribs['id'].= '_elem';
        $attribsStr = '';
        foreach($attribs as $k=>$v){
            $attribsStr.= ' '.$k.'="'.$v.'"';
        }
        
        $imgSrc = JUri::root().'modules/mod_simpleform2/index.php?task=captcha&moduleID='.$this->form->moduleID.'&rand='.rand(1,99999);
        $onclick = 'this.src=\''.$imgSrc.'&rand=\'+Math.random();';
        
        $html = '<div class="sf2-element-captcha">';
        if(!is_null($this->_captchaPlugin)){
            $html.= $this->_captchaPlugin->display($this->getparam('name'), $this->getparam('id').'_elem', 'class="'.$this->getparam('class','').'"');
        }
        else{
            $html.= '<div class="sf2-element-captcha-image"><img class="sf2Captcha" src="'.$imgSrc.'" alt="'.JText::_('Click to refresh').'" title="'.JText::_('Click to refresh').'" onclick="'.$onclick.'"'.' style="cursor:pointer;" /></div>';
            $html.= '<div class="sf2-element-captcha-input"><input '.$attribsStr.' /></div>';
        }
        $html.= '</div>';

        return $html;
	}
    
    public function validate() {
        $user = JFactory::getUser();
		if((int)$user->get('id')>0){
            return true;
        }
        if(!is_null($this->_captchaPlugin)){
            if(!$this->_captchaPlugin->checkAnswer($this->inputValue)){
                $this->triggerInputError();
                return false;
            }
        }
        else{
            $session = JFactory::getSession();
            $session->set('simpleform2_'.$this->form->moduleID.'.captcha', rand(1,99999));
            if(count($this->values)==0 || !in_array($this->inputValue,$this->values)){
                $this->triggerInputError();
                return false;
            }
        }
        return true;
    }
    
    public function renderImage(){
        require_once(JPATH_ROOT.'/modules/mod_simpleform2/kcaptcha/kcaptcha.php');
        $width = (int)$this->getParam('width',100);
		$height = (int)$this->getParam('height',50);
		$color = $this->getParam('color',null);
		$background = $this->getParam('background','#ffffff');
        $session = JFactory::getSession();
        
		$captchaObj = new simpleCAPTCHA($width,$height,$color,$background);
		$session->set('simpleform2_'.$this->form->moduleID.'.captcha', $captchaObj->getKeyString());
    }
	
}