<!--<div class="latest_products jshop jshop_list_product">-->
<?php
$db = &JFactory::getDBO();
$q = "SELECT $adv_result  FROM `#__jshopping_products` AS prod               
    INNER JOIN `#__jshopping_products_to_categories` AS pr_cat ON pr_cat.product_id = prod.product_id
      LEFT JOIN `#__jshopping_categories` AS cat ON pr_cat.category_id = cat.category_id
      $adv_from
      WHERE label_id = 3 AND prod.product_publish = '1' AND cat.category_publish='1' " . $adv_query . " 
      GROUP BY prod.product_id $order_query DESC LIMIT " . $count;
$db->setQuery($q);
$data_row = $db->loadObjectList();
$data_row = listProductUpdateData($data_row);
$jshopConfig = JSFactory::getConfig();
$hide_buy = 0;
$cart_prod=[];
for ($i=0 ;$i < count($in->products);$i++ ) {
    $cart_prod[$i]=$in->products[$i]['product_id'];
}


addLinkToProducts($data_row, 0, 1);


?>
<!--        --><?php //var_dump($data_row)?>

<div class="product-carousel__carousel owl-carousel">
    <?php foreach ($data_row

                   as $product) { ?>
        <?php
        if ($jshopConfig->user_as_catalog) $hide_buy = 1;
        if ($jshopConfig->hide_buy_not_avaible_stock && $product->product_quantity <= 0) $hide_buy = 1;
        if (!$product->_display_price) $hide_buy = 1;
        ?>


        <div class="product-carousel__item product">
            <?php if ($show_image && $product->image){// option modul  show_image ?>
            <div class="product__img">

                <?php print $product->_tmp_var_image_block; ?>

                <a class="product__img-link" href="<?php print $product->product_link ?>">
                    <img class="jshop_img" src="<?php print $product->image ?>"
                         alt="<?php print htmlspecialchars($product->name); ?>"
                         title="<?php print htmlspecialchars($product->name); ?>"/>
                </a>
                <?php } ?>
                <a href="<?php print $product->product_link ?>" class="product__quick-show ajax">Быстрый просмотр</a>
                <?php print $product->_tmp_var_bottom_foto; ?>

            </div>

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
                        <span class="product__price"><?php print formatprice($product->product_price); ?><?php print $product->_tmp_var_price_ext; ?></span>
                    <?php } ?>

                    <?php print $product->_tmp_var_bottom_price; ?>
                    <?php if (!$hide_buy) { ?>

                        <div class="product__count">
                            <input type="number" name="quantity" id="quantity" onkeyup="reloadPrices();"
                                   class="inputbox"
                                   value="1"/><?php print $product->_tmp_qty_unit; ?>
                        </div>
                    <?php } ?>


                </div>
                <?php if (!$hide_buy) { ?>
                    <?php if (in_array($product->product_id, $cart_prod)) { ?>
                        <input type="submit" class="product__buy add_more" value="ДОБАВИТЬ ЕЩЕ"
                               onclick="jQuery('#to').val('cart');"/>
                    <?php } else { ?>

                        <input type="submit" class="product__buy" value="<?php print _JSHOP_ADD_TO_CART ?>"
                               onclick="jQuery('#to').val('cart');"/>
                    <?php } ?>
                <?php } ?>

                <input type="hidden" name="to" id='to' value="cart"/>
                <input type="hidden" name="product_id" id="product_id"
                       value="<?php print $product->product_id ?>"/>
                <input type="hidden" name="category_id" id="category_id"
                       value="<?php print $product->category_id; ?>"/>
                <?php print $product->_tmp_var_bottom_buttons; ?>
            </form>
            <?php if ($hide_buy) { ?>
                <strong class="not-available">Нет в наличии</strong>
            <?php } ?>


        </div>
    <?php } ?>


    <?php print $product->_tmp_var_end ?>


</div>


<div class="product-carousel__nav nav-arrow">
    <button class="product-carousel__nav-btn nav-arrow__btn -prev js-nav-prev">prev</button>
    <button class="product-carousel__nav-btn nav-arrow__btn -next js-nav-next">next</button>
</div>
