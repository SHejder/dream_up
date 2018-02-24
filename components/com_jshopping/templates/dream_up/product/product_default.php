<?php
/**
 * @version      4.10.5 09.12.2015
 * @author       MAXXmarketing GmbH
 * @package      Jshopping
 * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license      GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
$product = $this->product;
include(dirname(__FILE__) . "/load.js.php");
require_once(dirname(__FILE__) . '/../../../models/cart.php');


$session = JFactory::getSession();
$objcart = $session->get('cart');
$in_cart = unserialize($objcart);
$in = jshopCart::reCreate($in_cart);


?>
<h1><?php print $this->product->name ?></h1>

<?php print $this->_tmp_product_html_start; ?>
<?php include(dirname(__FILE__) . "/ratingandhits.php"); ?>
<?php
$messages = JFactory::getApplication()->getMessageQueue();
?>


<div class="product-cart">
    <div class="product-cart__images">
        <div class="product-cart__image-big">
            <?php print $this->_tmp_product_html_body_image ?>

            <?php if (!count($this->images)) { ?>
                <img id="main_image"
                     src="<?php print $this->image_product_path ?>/<?php print $this->noimage ?>"
                     alt="<?php print htmlspecialchars($this->product->name) ?>"/>
            <?php } ?>

            <?php foreach ($this->images as $k => $image) { ?>
                <a class="lightbox" id="main_image_full_<?php print $image->image_id ?>"
                   href="<?php print $this->image_product_path ?>/<?php print $image->image_full; ?>"
                   <?php if ($k != 0){ ?>style="display:none"<?php } ?>
                   title="<?php print htmlspecialchars($image->_title) ?>">
                    <img id="main_image_<?php print $image->image_id ?>"
                         src="<?php print $this->image_product_path ?>/<?php print $image->image_name; ?>"
                         alt="<?php print htmlspecialchars($image->_title) ?>"
                         title="<?php print htmlspecialchars($image->_title) ?>"/>
                </a>
            <?php } ?>
        </div>
        <?php print $this->_tmp_product_html_after_image; ?>
        <?php print $this->_tmp_product_html_before_image_thumb; ?>
        <?php if ((count($this->images) > 1) || (count($this->videos) && count($this->images))) { ?>

            <div class="product-cart__image-prev image-prev js-product-images-carousel">
                <div class="image-prev__nav nav-arrow">
                    <button class="image-prev__nav-btn nav-arrow__btn -prev js-nav-prev">prev</button>
                    <button class="image-prev__nav-btn nav-arrow__btn -next js-nav-next">next</button>
                </div>
                <!-- data-src-big - ссылки на большие картинки-->
                <!-- is-active - у первого image-prev__item -->
                <div class="image-prev__list owl-carousel">
                    <?php print $this->_tmp_product_html_before_image_thumb; ?>
                    <?php if ((count($this->images) > 1) || (count($this->videos) && count($this->images))) { ?>
                        <?php foreach ($this->images as $k => $image) { ?>
                            <div class="image-prev__item is-active"
                                 data-src-big="<?php print $this->image_product_path ?>/<?php print $image->image_thumb ?>">
                                <img src="<?php print $this->image_product_path ?>/<?php print $image->image_thumb ?>"
                                     alt="<?php print htmlspecialchars($image->_title) ?>"
                                     title="<?php print htmlspecialchars($image->_title) ?>"
                                     onclick="showImage(<?php print $image->image_id ?>)"/>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

    </div>

    <div class="product-cart__text">
        <div class="product-cart__price">
            <?php if ($this->product->product_old_price > 0) { ?>
                <span class="product-cart__price-old">
                    <?php print formatprice($this->product->product_old_price) ?>
                    <?php print $this->product->_tmp_var_old_price_ext; ?>
                </span>
            <?php } ?>

            <?php if ($this->product->_display_price) { ?>
                <?php print formatprice($this->product->getPriceCalculate()) ?>
                <?php print $this->product->_tmp_var_price_ext; ?>
            <?php } ?>
        </div>
        <?php print $this->product->_tmp_var_bottom_allprices; ?>
        <?php print $this->_tmp_product_html_before_buttons; ?>

        <?php if (!$this->hide_buy) { ?>

            <form name="product" method="post" action="<?php print $this->action ?>"
                  enctype="multipart/form-data"
                  autocomplete="off">
                <div class="product-cart__form">
                    <div class="product-cart__count">
                        <input type="number" name="quantity" id="quantity" onkeyup="reloadPrices();"
                               value="<?php print $this->default_count_product ?>"/><?php print $this->_tmp_qty_unit; ?>
                    </div>
                    <button type="submit" onclick="jQuery('#to').val('cart');"
                            class="product-cart__buy btn"><?php print _JSHOP_ADD_TO_CART ?></button>
                    <?php print $this->_tmp_product_html_buttons; ?>

                </div>
                <input type="hidden" name="to" id='to' value="cart"/>
                <input type="hidden" name="product_id" id="product_id"
                       value="<?php print $this->product->product_id ?>"/>
                <input type="hidden" name="category_id" id="category_id"
                       value="<?php print $this->category_id ?>"/>

            </form>

            <?php foreach ($in->products as $a => $prod_in_cart) :
                $prod_in_cart_id = $prod_in_cart['product_id'];
                settype($prod_in_cart_id, 'string');
//    var_dump($prod_in_cart_id);
//    var_dump($product->product_id);
                ?>

                <?php if ($prod_in_cart_id == $product->product_id) {
                echo '<strong class="warnings">' . 'Товар в корзине, хотите добавить еще?' . '</strong>';
            }
                ?>
            <?php endforeach; ?>
            <?php
            if (is_array($messages)) {
                echo '<div class="warnings">';
                foreach ($messages as $message)
                    echo '<div class="' . $message['type'] . '">' . $message['message'] . '</div>';
                echo '</div>';

            };
            ?>


        <?php } else { ?>
            <strong>Нет в наличии</strong>
        <?php } ?>
        <?php print $this->_tmp_product_html_after_buttons; ?>

        <?php print $this->product->description; ?>
    </div>


    <?php print $this->_tmp_product_html_end; ?>
</div>






