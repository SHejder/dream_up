<?php

defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureCopyright extends GantryFeature {
    var $_feature_name = 'copyright';

	function render($position="") {
	    ob_start();
	    ?>
		<div class="clear"></div>
		<span class="copytext"><?php echo $this->get('text'); ?></span>
		<?php
	    return ob_get_clean();
	}
}