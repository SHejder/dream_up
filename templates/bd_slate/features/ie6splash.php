<?php


defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');
/**
 * @package     gantry
 * @subpackage  features
 */
class GantryFeatureIE6Splash extends GantryFeature {
    var $_feature_name = 'ie6splash';
    
    
    function isEnabled(){
    	if ($this->get('enabled')) {
        	return true;
        }
    }
    
    function isInPosition($position) {
        return false;
    }
    function isOrderable(){
        return true;
    }
    
    function init() {
        global $gantry;
        
        if (JRequest::getString('tmpl')!='unsupported' && $gantry->browser->name == 'ie' && $gantry->browser->shortversion == '6') {
            header("Location: ".$gantry->baseUrl."?tmpl=unsupported");
        }
    }
}