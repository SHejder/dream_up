<div id="jshop_module_cart" style="width: 200px; padding: 0px 15px 5px 15px; margin:-10px 0 0 0">
    <h3 align="left"><a href="<?php print SEFLink('index.php?option=com_jshopping&controller=cart&task=view', 1) ?>"
                        title="Перейти к оформлению заказа"><font color="#fff">Моя корзина</font></a></h3>

    <font color="#FFFFFF">
        <span id="jshop_quantity_products">Товаров: &nbsp;<strong><?php print $cart->count_product ?></strong></span>

        <br>
        <span id="jshop_quantity_products">Общая сумма: &nbsp;<strong><?php print formatprice($cart->getSum(0, 1)) ?></strong></span>
    </font>
</div>