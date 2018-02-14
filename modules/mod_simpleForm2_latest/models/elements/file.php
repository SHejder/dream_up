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

class simpleForm2Element_File extends simpleForm2Element{
	
    protected $_extensions = array();
    protected $_maxSize = 0;
    protected $_minFiles = 0;
    protected $_maxFiles = 1;
    
    public function parse($code) {
        if(!parent::parse($code)){
            return false;
        }
        $this->defParam('send-in-email','no');
        
        $this->_maxSize = SF2Helper::getMaxFileUploadSize();
        $this->_extensions = array();
        if($this->getParam('extensions','')!=''){
            foreach(explode(',',$this->getParam('extensions')) as $tmpExt){
                $tmpExt = trim($tmpExt);
                if(preg_match('~^[a-z0-9]{2,5}$~i',$tmpExt)) $this->_extensions[] = strtolower($tmpExt);
            }
        }
        if($this->getParam('maxsize','')!=''){
            $size = str_replace(array('kb','mb'),array('K','M'),$this->getParam('maxsize'));
            $this->_maxSize = SF2Helper::getBytes($size);
        }
        $this->_minFiles = (int)$this->getParam('minfiles',$this->_minFiles);
        $this->_maxFiles = (int)$this->getParam('maxfiles',$this->_maxFiles);
        return true;
    }
    
    public function bindInput($input){
		$this->inputValue = (array)$input->files->get($this->getParam('name'), array(), 'array');
	}
    
    public function getAttachments(){
        return $this->inputValue;
    }
    
    public function validate(){
        $numFiles = count($this->inputValue);
        if($numFiles<$this->_minFiles || $numFiles>$this->_maxFiles){
            $this->triggerInputError();
            return false;
        }
        $match = true;
        
        foreach($this->inputValue as $k=>$fileData){
            if((isset($fileData['error']) && $fileData['error']!='') || (int)$fileData['size']<1){
                $this->triggerInputError();
                return false;
            }
            if((int)$fileData['size'] > $this->_maxSize){
                $this->setError(sprintf(JText::_('MOD_SIMPLEFORM2_FILE_SIZE_IS_TOO_BIG'),$fileData['name'],SF2Helper::getSizeDisplay($this->_maxSize)));
                return false;
            }
            $fileExt = '';
            preg_match('~\.([a-z0-9]+)$~i',$fileData['name'],$match);
            if(is_array($match) && isset($match[1])){
                $fileExt = strtolower($match[1]);
            }
            if($fileExt==''){
                $match = false;
                break;
            }
            if(count($this->_extensions) && !in_array($fileExt,$this->_extensions)){
                $this->setError(sprintf(JText::_('MOD_SIMPLEFORM2_FILE_EXTENSION_IS_FORBIDDEN'),$fileData['name'],implode(', ',$this->_extensions)));
                return false;
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
        unset($attribs['class']);
        $attribs['id'].= '_elem';
        $attribs['name'].= '[]';
        if($this->_maxFiles>1){
            $attribs['multiple'] = 'multiple';
        }
        $attribsStr = '';
        foreach($attribs as $k=>$v){
            $attribsStr.= ' '.$k.'="'.$v.'"';
        }
        $html = '<div class="sf2-input-file-wrap"><input '.$attribsStr.' /></div>';

        return $html;
	}
	
}