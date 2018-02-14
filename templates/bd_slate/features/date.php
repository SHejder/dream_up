<?php

defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');
/**
 * @package     gantry
 * @subpackage  features
 */
class GantryFeatureDate extends GantryFeature {
    var $_feature_name = 'date';
   
	function render($position="") {
		global $gantry;
		ob_start();

		$now = &JFactory::getDate();		
		$format = $this->get('formats');

	    ?>
		<span class="rt-date-feature"><span><?php echo $now->toFormat($format); ?></span></span>
		<?php
	    return ob_get_clean();
	}
	
}