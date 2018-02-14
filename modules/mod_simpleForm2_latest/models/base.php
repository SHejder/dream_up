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

class simpleForm2BaseModel extends JObject{
    private $params = array();
    
    public function getParam($name,$default=null){
        if(isset($this->params[$name])){
            return $this->params[$name];
        }
        return $default;
    }
    
    public function setParam($name,$value){
        $prevValue = null;
        if(isset($this->params[$name])){
            $prevValue = $this->params[$name];
        }
        $this->params[$name] = $value;
        return $prevValue;
    }
    
    public function defParam($name,$value){
        if(isset($this->params[$name])){
            return $this->params[$name];
        }
        return $this->setParam($name, $value);
    }
    
    public function setParams($params){
        $this->params = array_merge($this->params,$params);
    }
    
    public function getParams(){
        return $this->params;
    }
}