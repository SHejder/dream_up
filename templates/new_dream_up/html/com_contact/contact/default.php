<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.html.html.bootstrap');

$cparams = JComponentHelper::getParams('com_media');
$tparams = $this->item->params;

?>

		<h1>
			<?php echo $this->escape($tparams->get('page_heading')); ?>
		</h1>
<button class="print-page js-print-page"><span>Распечатать страницу</span></button>
<?php echo $this->contact->misc; ?>
<?php echo $this->loadTemplate('form'); ?>








	<?php echo $this->item->event->afterDisplayContent; ?>
