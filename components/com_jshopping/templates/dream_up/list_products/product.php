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
?>
    <div class="product productitem_<?php print $product->product_id ?>">


        <?php if ($product->image) { ?>
        <div class="product__img">

            <?php print $product->_tmp_var_image_block; ?>

            <a class="product__img-link" href="<?php print $product->product_link ?>">
                <img class="jshop_img" src="<?php print $product->image ?>"
                     alt="<?php print htmlspecialchars($product->name); ?>"
                     title="<?php print htmlspecialchars($product->name); ?>"/>
            </a>
            <?php } ?>
            <a href="<?php print $product->product_link ?>" class="product__quick-show ajax" data-fancybox-type="iframe">Быстрый просмотр</a>
            <?php print $product->_tmp_var_bottom_foto; ?>

        </div>
        <div class="product__text">
            <div class="product__name">
                <a href="<?php print $product->product_link ?>">
                    <?php print $product->name ?>
                </a>
            </div>
            <?php if ($product->_display_price) { ?>
                <span class="product__price"><?php print formatprice($product->product_price); ?><?php print $product->_tmp_var_price_ext; ?></span>
            <?php } ?>

            <?php print $product->_tmp_var_bottom_price; ?>
            <form name="product" method="post"
                  action="?option=com_jshopping&amp;controller=cart&amp;task=add&amp;Itemid=0"
                  enctype="multipart/form-data" autocomplete="off">

                <div class="product__count">
                    <input type="number" name="quantity" id="quantity" onkeyup="reloadPrices();" class="inputbox"
                           value="1"/><?php print $product->_tmp_qty_unit; ?>
                </div>

        </div>
        <input type="submit" class="product__buy" value="<?php print _JSHOP_ADD_TO_CART ?>"
               onclick="jQuery('#to').val('cart');"/>
        <input type="hidden" name="to" id='to' value="cart"/>
        <input type="hidden" name="product_id" id="product_id" value="<?php print $product->product_id ?>"/>
        <input type="hidden" name="category_id" id="category_id" value="<?php print $product->category_id; ?>"/>
        <?php print $product->_tmp_var_bottom_buttons; ?>

        </form>
    </div>


<?php print $product->_tmp_var_end ?>
<?php //var_dump($product) ?>