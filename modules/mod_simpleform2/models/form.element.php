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

class simpleForm2Element extends simpleForm2BaseModel{
	public $code = '';
	protected $form = '';
    public $values = array();
    public $inputValue = null;
    public $options = array();
    public $isRequired = false;
    public $nonHtmlParams = array('label', 'regex', 'error', 'send-in-email', 'help');
	
	public function __construct(&$form){
        $this->form = $form;
	}
    
    public function parse($code){
        $this->code = $code;
        preg_match('~{element (.*?)(?=[\'"]\s*/?})[\'"]\s*/?}~is',$this->code,$matches);
        if(!is_array($matches) || !isset($matches[1])){
            $this->setError(sprintf(JText::_('MOD_SIMPLEFORM2_ELEMENT_WITHOUT_PARAMETERS_FOUND'),$this->code));
            return false;
        }
        $this->setParams(SF2Helper::parseParams($matches[1]));
        if(count($this->getParams())==0){
            $this->setError(sprintf(JText::_('MOD_SIMPLEFORM2_ELEMENT_WITHOUT_PARAMETERS_FOUND'),$this->code));
            return false;
        }
        foreach($this->getParams() as $pK=>$pV){
            if($pV!='' && in_array($pK,$this->form->params2mask)){
                $this->setParam($pK,base64_decode($pV));
            }
        }
        
        if($this->getParam('type','')==''){
            $this->setError(sprintf(JText::_('MOD_SIMPLEFORM2_ELEMENT_TYPE_NOT_SET'),$this->code));
            return false;
        }
        
        if($this->getParam('name','')==''){
            if($this->getParam('label','')!=''){
                $this->setParam('name',SF2Helper::transliterate($this->getParam('label')));
            }
            else{
                $this->setParam('name',md5($this->code));
            }
        }
        else{
            $this->setParam('name',SF2Helper::transliterate($this->getParam('name')));
        }
        $this->setParam('id',$this->form->getID().'_'.$this->getParam('name'));

        $this->isRequired = (bool)($this->getParam('required','')=='required');
        
        if(!is_null($this->getParam('value'))) $this->values[] = $this->getParam('value');
        
        preg_match_all('~{option ([^}]+)}~is',$this->code,$matchesO);
        if(is_array($matchesO) && isset($matchesO[0]) && is_array($matchesO[0])){
            foreach($matchesO[0] as $k=>$optionCode){
                $option = new stdclass;
                $option->code = $optionCode;
                $option->params = array(
                    'label' => '',
                    'value' => '',
                    'selected' => '',
                );
                $option->params = array_merge($option->params,SF2Helper::parseParams($matchesO[1][$k]));
                foreach($option->params as $pK=>$pV){
                    if($pV!='' && in_array($pK,$this->form->params2mask)){
                        $option->params[$pK] = base64_decode($pV);
                    }
                }
                $option->isSelected = (bool)$option->params['selected']=='selected';
                if($option->params['label']=='' && $option->params['value']==''){
                    $this->setError(sprintf(JText::_('MOD_SIMPLEFORM2_ELEMENT_OPTION_MISSING_PARAMS'),$option->code));
                    return false;
                }
                $this->values[] = $option->params['value'];
                $this->options[] = $option;
            }
        }
        return true;
    }
	
	public function bindInput($input){
		$this->inputValue = $input->get($this->getParam('name'),'','string');
	}
    
    public function validate(){
        if(($this->isRequired && $this->inputValue=='') || ($this->getParam('regex','')!=''&&!preg_match($this->getParam('regex'),$this->inputValue))){
            $this->triggerInputError();
            return false;
        }
		return true;
	}
    
    public function getValue(){
        return $this->inputValue;
    }
    
    public function getValueDisplay(){
        if(is_array($this->inputValue)){
            return implode(', ',$this->inputValue);
        }
        else{
            return (string)$this->inputValue;
        }
    }
    
    protected function triggerInputError(){
        if($this->getParam('error','')!=''){
            $this->setError($this->getParam('error'));
        }
        else{
            $el = $this->getParam('name');
            if($this->getParam('label','')!=''){
                $el = $this->getParam('label');
            }
            $this->setError(sprintf(JText::_('MOD_SIMPLEFORM2_ENTER_VALUE_FOR'),$el));
        }
    }
    
    public function getHtmlAttributes(){
        $attribs = array();
        foreach($this->getParams() as $k=>$v){
            if(!in_array($k,$this->nonHtmlParams)){
                $attribs[$k] = $v;
            }
        }
        if(!isset($attribs['class'])){
            $attribs['class'] = '';
        }
        $attribs['class'].= '';
        return $attribs;
    }
    
    public function getAttachments(){
        return array();
    }
	
	public function toHtml(){
        $class = 'sf2-form-item';
        $attribs = '';
        if(count($this->getErrors())>0){
            $class.= ' sf2-element-state-error';
            $attribs.= ' data-error="'.htmlspecialchars($this->getError()).'"';
        }
		$html = '<div class="'.$class.'" id="'.$this->getParam('id').'" '.$attribs.'>';
            if($this->getParam('label','')!=''){
                $html.= '<div class="sf2-form-label-wrap"><label for="'.$this->getParam('id').'_elem">'.$this->getParam('label').($this->isRequired?' <span class="sf2-required">*</span>':'').'</label></div>';
            }
            $html.= '<div class="sf2-form-element-wrap">';
                $html.= $this->getInputHtml();
                if($this->getParam('help','')!=''){
                    $html.= '<span class="sf2-element-help">'.$this->getParam('help','').'</span>';
                }
            $html.= '</div>';
        $html.= '</div>';
        return $html;
	}

}