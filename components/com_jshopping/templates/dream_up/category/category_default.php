<?php 
/**
* @version      4.11.0 17.09.2015
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');

print $this->_tmp_category_html_start;
?>
    <h1><?php print $this->category->name?></h1>



    <?php include(dirname(__FILE__)."/products.php");?>
	
	<?php print $this->_tmp_category_html_end;?>
