<a class="header-top__cart" href="<?php print SEFLink('index.php?option=com_jshopping&controller=cart&task=view', 1)?>">
    <span class="header-top__cart-cost"><?php print formatprice($cart->getSum(0,1))?></span>
    <span class="header-top__cart-count"><?php print $cart->count_product?> шт</span>
</a>

