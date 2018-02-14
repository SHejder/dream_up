<?php
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureToTop extends GantryFeature {
    var $_feature_name = 'totop';

	function init() {
		global $gantry;
		
		if ($this->get('enabled')) {
			JHTML::_('behavior.framework', true);
			$gantry->addScript($gantry->gantryUrl.'/js/gantry-totop.js');
		}
	}
	
	function render($position="") {
	    ob_start();
	    ?>
		<a href="#" class="to-top" id="gantry-totop"><span class="totop-desc"><?php echo $this->get('text'); ?></span></a>
		<?php
	    return ob_get_clean();
	}
}