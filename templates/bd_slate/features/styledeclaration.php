<?php

defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureStyleDeclaration extends GantryFeature {
    var $_feature_name = 'styledeclaration';

    function isEnabled() {
        global $gantry;
        $menu_enabled = $this->get('enabled');

        if (1 == (int)$menu_enabled) return true;
        return false;
    }

	function init() {
        global $gantry;

		$this->_disableRokBoxForiPhone();


		
		//inline css for dynamic stuff
        $css  = '.header-wrapper {background-color:'.$gantry->get('headerstyle-headerbgcolor').'; background-image:url('.JURI::base().'templates/bd_slate/images/body/pattern/'.$gantry->get('headerstyle-headerbgpattern').'.png);}';
		$css .= '.body-wrapper {background-color:'.$gantry->get('bodystyle-bodybgcolor').'; background-image:url('.JURI::base().'templates/bd_slate/images/body/pattern/'.$gantry->get('bodystyle-bodybgpattern').'.png);}';
		$css .= '.footer-wrapper {background-color:'.$gantry->get('footerstyle-footerbgcolor').'; background-image:url('.JURI::base().'templates/bd_slate/images/body/pattern/'.$gantry->get('footerstyle-footerbgpattern').'.png);}';
		//$css .= 'a.readon, .button-more, #rt-main button.button, #rt-main .button, #rt-main input[type="submit"], #rt-main button  {color:'.$gantry->get('button-txtcolor').'; border: 1px solid '.$gantry->get('button-bordercolor').'; }';
		$css .= 'a.readon, .button-more, #rt-main button.button, #rt-main .button, #rt-main input[type="submit"], #rt-main button   {
		background:'.$gantry->get('buttongradient-from').';
		background: -moz-linear-gradient(top, '.$gantry->get('buttongradient-from').' 0%, '.$gantry->get('buttongradient-to').' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$gantry->get('buttongradient-from').'), color-stop(100%,'.$gantry->get('buttongradient-to').'));
		background: -webkit-linear-gradient(top, '.$gantry->get('buttongradient-from').' 0%,'.$gantry->get('buttongradient-to').' 100%);
		background: -o-linear-gradient(top, '.$gantry->get('buttongradient-from').' 0%,'.$gantry->get('buttongradient-to').' 100%);
		background: -ms-linear-gradient(top, '.$gantry->get('buttongradient-from').' 0%,'.$gantry->get('buttongradient-to').' 100%);
		background: linear-gradient(top, '.$gantry->get('buttongradient-from').' 0%,'.$gantry->get('buttongradient-to').' 100%);
		border: 1px solid 	'.$gantry->get('buttongradient-bordercolor').';
		color: '.$gantry->get('buttongradient-linkcolor').';
		border-radius: '.$gantry->get('buttongradient-round').'px;}';
		
		$css .= 'a.readon:active, .button-more:active, #rt-main button.button:active, #rt-main .button:active, #rt-main input[type="submit"]:active, #rt-main button:active   {
		background:'.$gantry->get('buttongradient-from').';
		background: -moz-linear-gradient(top, '.$gantry->get('buttongradient-to').' 0%, '.$gantry->get('buttongradient-from').' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$gantry->get('buttongradient-to').'), color-stop(100%,'.$gantry->get('buttongradient-from').'));
		background: -webkit-linear-gradient(top, '.$gantry->get('buttongradient-to').' 0%,'.$gantry->get('buttongradient-from').' 100%);
		background: -o-linear-gradient(top, '.$gantry->get('buttongradient-to').' 0%,'.$gantry->get('buttongradient-from').' 100%);
		background: -ms-linear-gradient(top, '.$gantry->get('buttongradient-to').' 0%,'.$gantry->get('buttongradient-from').' 100%);
		background: linear-gradient(top, '.$gantry->get('buttongradient-to').' 0%,'.$gantry->get('buttongradient-from').' 100%);}';
        $css .= 'body a {color:'.$gantry->get('linkcolor').';}';

        
        $gantry->addInlineStyle($css);

        //style stuff
        $gantry->addStyle($gantry->get('cssstyle').".css");
		if ($gantry->get('typography-enabled')) $gantry->addStyle('typography.css');
		if ($gantry->get('jomshopping-enabled')) $gantry->addStyle('jshopping.css');

	}
	
	
	

	function _disableRokBoxForiPhone() {
		global $gantry;

		if ($gantry->browser->platform == 'iphone') {
			$gantry->addInlineScript("window.addEvent('domready', function() {\$\$('a[rel^=rokbox]').removeEvents('click');});");
		}
	}

}
