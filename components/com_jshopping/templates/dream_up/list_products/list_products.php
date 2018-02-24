<?php
/**
 * @version      4.9.1 13.08.2013
 * @author       MAXXmarketing GmbH
 * @package      Jshopping
 * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license      GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
require_once (dirname(__FILE__).'/../../../models/cart.php');

$session = JFactory::getSession();
//$objcart = $session->get('cart');
//$in_cart = unserialize($objcart);
//$in = jshopCart::reCreate($in_cart);
//foreach ($in->products as $a=>$prod_in_cart) {
//    var_dump($prod_in_cart['product_id']);}
var_dump($session);
?>


<div class="catalog">

    <?php print $this->_tmp_list_products_html_start ?>
<!--    <p style="width: 600px">    --><?php //var_dump($in->products);?>
<!--    </p>-->


    <?php foreach ($this->rows as $k => $product) : ?>

        <!--        --><?php //if ($k % $this->count_product_to_row == 0) : ?>
        <!--        --><?php //endif; ?>

        <!--        <div class="sblock--><?php //echo $this->count_product_to_row; ?><!--">-->
        <div class="catalog__item">
            <?php include(dirname(__FILE__) . "/" . $product->template_block_product); ?>
        </div>
        <!--        </div>-->

        <?php if ($k % $this->count_product_to_row == $this->count_product_to_row - 1) : ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

