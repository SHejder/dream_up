<?php

defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

/**
 * @package     gantry
 * @subpackage  features
 */
class GantryFeatureBelatedPNG extends GantryFeature {
    var $_feature_name = 'belatedPNG';

    function isEnabled(){
        return true;
    }
    function isInPosition($position) {
        return false;
    }

	function isOrderable(){
		return false;
	}
    
	function init() {
        global $gantry;
		
		if ($gantry->browser->name == 'ie' && $gantry->browser->shortversion == '6') {
			$fixes = $gantry->belatedPNG;
			
			$gantry->addScript('belated-png.js');
			$gantry->addInlineScript($this->_belatedPNG($fixes));
		}
	}
	
	function _belatedPNG($fixes) {
		if (!is_array($fixes) || count($fixes) == 0) $fixes = array('.png');
		$fixes = implode("', '", $fixes);
		
		$js = "
			window.addEvent('load', function() {
				var pngClasses = ['$fixes'];
				pngClasses.each(function(fixMePlease) {
					DD_belatedPNG.fix(fixMePlease);
				});
			});
		";
		
		return $js;
	}
}