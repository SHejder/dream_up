<?php

defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

/**
 * @package     gantry
 * @subpackage  features
 */
class GantryFeaturelogo extends GantryFeature {
	var $_feature_name = 'logo';
    var $_autosize = false;


	function render($position="") {
        global $gantry;

		if($gantry->get("logo-logowidth")){
			$logo_width = 'width='.$gantry->get("logo-logowidth").'px';
		}
		else {
			$logo_width = '';
		}
		if($gantry->get("logo-logoheight")){
			$logo_height = 'height='.$gantry->get("logo-logoheight").'px';
		}
		else {
			$logo_height = '';
		}
		
        if ($gantry->get("logo-autosize")) {

            jimport ('joomla.filesystem.file');
            //$path = $gantry->templatePath.DS.'images'.DS.'logo';
            $logocss = $gantry->get('logo-css','body #rt-logo');

            // append logo file
            $path = trim($gantry->get('logo-znlogo'));

            // if the logo exists, get it's dimentions and add them inline
            if (JFile::exists($path)) {
                $logosize = getimagesize($path);
                if (isset($logosize[0]) && isset($logosize[1])) {
                    $gantry->addInlineStyle($logocss.' {background:url('.JURI::base().''.$gantry->get('logo-znlogo').');width:'.$logosize[0].'px;height:'.$logosize[1].'px;display:block;}');
                }
            } 
         }
		 elseif(!$gantry->get("logo-autosize") && $gantry->get("logo-logowidth") && $gantry->get("logo-logoheight")){
			
			$logocss = $gantry->get('logo-css','body #rt-logo');
			$gantry->addInlineStyle($logocss.' {background:url('.JURI::base().''.$gantry->get('logo-znlogo').');width:'.$gantry->get("logo-logowidth").'px;height:'.$gantry->get("logo-logoheight").'px;display:block;}');
		 }

		
	    ob_start();
	    ?>
        <div class="rt-block">
			<a href="<?php echo $gantry->baseUrl; ?>" id="rt-logo"><br><br><br><p style="margin:5px"><font color="#000">Материалы для творчества и рукоделия</font></p></a>
        </div>
        <?php
	    return ob_get_clean();
	}
}