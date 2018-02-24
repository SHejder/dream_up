<?php defined('_JEXEC') or die('Restricted access');
$quantity = JshopHelpersRequest::getQuantity();

?>

<?php print $product->_tmp_var_start ?>
<?php
$table_product = JTable::getInstance('product', 'jshop');
$table_product->load($product->product_id);
$table_attributes;

$attributesDatas = $table_product->getAttributesDatas($back_value['attr']);
$table_product->setAttributeActive($attributesDatas['attributeActive']);
$attributeValues = $attributesDatas['attributeValues'];

$attributes = $table_product->getBuildSelectAttributes($attributeValues, $attributesDatas['attributeSelected']);
if (count($attributes)) {
    $_attributevalue = JTable::getInstance('AttributValue', 'jshop');
    $all_attr_values = $_attributevalue->getAllAttributeValues();
} else {
    $all_attr_values = array();
}
$jshopConfig = JSFactory::getConfig();
$hide_buy = 0;
if ($jshopConfig->user_as_catalog) $hide_buy = 1;
if ($jshopConfig->hide_buy_not_avaible_stock && $product->product_quantity <= 0) $hide_buy = 1;
if (!$product->_display_price) $hide_buy = 1;

$session = JFactory::getSession();
$objcart = $session->get('cart');
$in_cart = unserialize($objcart);
$in = jshopCart::reCreate($in_cart);

//var_dump(getFilters());

?>


    <div class="product productitem_<?php print $product->product_id ?>">
        <?php foreach ($in->products as $a => $prod_in_cart) :
            $prod_in_cart_id = $prod_in_cart['product_id'];
            settype($prod_in_cart_id, 'string');
//    var_dump($prod_in_cart_id);
//    var_dump($product->product_id);
            ?>

            <?php if ($prod_in_cart_id == $product->product_id) {
            echo '<strong class="warnings">' . 'Товар в корзине' . '</strong>';
        }
            ?>
        <?php endforeach; ?>



        <?php if ($product->image) { ?>
        <div class="product__img">

            <?php print $product->_tmp_var_image_block; ?>

            <a class="product__img-link" href="<?php print $product->product_link ?>">
                <img class="jshop_img" src="<?php print $product->image ?>"
                     alt="<?php print htmlspecialchars($product->name); ?>"
                     title="<?php print htmlspecialchars($product->name); ?>"/>
            </a>
            <?php } ?>
            <a href="<?php print $product->product_link ?>" class="product__quick-show ajax"
               data-fancybox-type="iframe">Быстрый просмотр</a>
            <?php print $product->_tmp_var_bottom_foto; ?>

        </div>


        <?php print $product->_tmp_var_bottom_price; ?>
        <form name="product" method="post"
              action="?option=com_jshopping&amp;controller=cart&amp;task=add&amp;Itemid=0"
              enctype="multipart/form-data" autocomplete="off">

            <div class="product__text">
                <div class="product__name">
                    <a href="<?php print $product->product_link ?>">
                        <?php print $product->name ?>
                    </a>
                </div>


                <?php if ($product->_display_price) { ?>
                    <span class="product__price">
                    <?php if ($product->product_old_price > 0) { ?>
                        <span class="product__price-old"><?php print formatprice($product->product_old_price) ?><?php print $product->_tmp_var_old_price_ext ?></span>
                    <?php } ?>

                        <?php print formatprice($product->product_price); ?><?php print $product->_tmp_var_price_ext; ?></span>
                <?php } ?>



                <?php if (!$hide_buy) { ?>

                    <div class="product__count">
                        <input type="number" name="quantity" id="quantity" onkeyup="reloadPrices();" class="inputbox"
                               value="1"/><?php print $product->_tmp_qty_unit; ?>
                    </div>
                <?php } ?>

            </div>

            <?php if (!$hide_buy) { ?>

                <input type="submit" class="product__buy" value="<?php print _JSHOP_ADD_TO_CART ?>"
                       onclick="jQuery('#to').val('cart');"/>
            <?php } ?>


            <input type="hidden" name="to" id='to' value="cart"/>
            <input type="hidden" name="product_id" id="product_id" value="<?php print $product->product_id ?>"/>
            <input type="hidden" name="category_id" id="category_id" value="<?php print $product->category_id; ?>"/>
            <?php print $product->_tmp_var_bottom_buttons; ?>

        </form>
        <?php if ($hide_buy) { ?>
            <strong>Нет в наличии</strong>
        <?php } ?>


    </div>

<?php print $product->_tmp_var_end ?>
<?php //var_dump($product) ?>