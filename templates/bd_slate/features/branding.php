<?php

defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureBranding extends GantryFeature {
    var $_feature_name = 'branding';

	function render($position="") {
	    ob_start();
	    ?>
		<div class="clear"></div>
		<div class="rt-block">
			<div id="developed-by">
				<a href="http://www.bdtheme.com/" title="Powered by www.bdthemes.com" id="bdThemes">Powered by BDThemes</a>
			</div>
		</div>
		<?php
	    return ob_get_clean();
	}
}