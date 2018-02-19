<?php
/**
 * @version      4.11.1 18.08.2013
 * @author       MAXXmarketing GmbH
 * @package      Jshopping
 * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license      GNU/GPL
 */
defined('_JEXEC') or die();
$order = $this->order;
?>

<?php print $this->_tmp_html_start; ?>
<h1>Заказ №<?php print $order->order_number ?> </h1>
<?php print $order->_tmp_ext_order_number; ?>
<div class="user-profile -order-info">

    <div class="user-profile__item">
        <div class="user-profile__item-name">Дата заказа</div>
        <div class="user-profile__item-val"><?php print formatdate($order->order_date, 0) ?></div>
    </div>

    <div class="user-profile__item">
        <div class="user-profile__item-name">Статус заказа</div>
        <div class="user-profile__item-val">
        <span class="order-status <?php if ($order->status_name == "Новый заказ") { ?>
                                -in-progress
                                <?php } elseif ($order->status_name == "ЗАВЕРШЕН") { ?>
                                -is-cancelled
                                <?php } else { ?>
                                -is-done
            <?php } ?>"><?php print $order->status_name ?></span>
        </div>
    </div>
    <?php print $order->_tmp_ext_status_name; ?>
</div>


<div class="cart">
    <table>
        <tr class="cart__title">
            <th>Изображение</th>
            <th>Название</th>
            <th>Цена <br> за единицу</th>
            <th>Кол-во</th>
            <th>Сумма</th>
        </tr>
        <?php
        $i = 1;
        $countprod = count($order->items);
        addLinkToProducts($order->items, 0, 1);

        foreach ($order->items as $key_id => $prod) {
            $files = unserialize($prod->files);
            ?>

            <tr>
                <td data-text="Изображение:"><a href="<?php print $prod->product_link ?>" class="cart__prev">
                        <img src="<?php print $this->image_path."/". $prod->thumb_image ?>" alt=""></a></td>
                <td data-text="Название:"><a href="<?php print $prod->product_link ?>" class="cart__name"><?php print $prod->product_name ?></a></td>
                <td data-text="Цена за единицу:"><?php print formatprice($prod->product_item_price, $order->currency_code) ?>
                    <?php print $prod->_ext_price_html ?></td>
                <td data-text="Кол-во:">
                    <strong><?php print formatqty($prod->product_quantity); ?><?php print $prod->_qty_unit; ?>
                    </strong></td>
                <td data-text="Сумма:">
                    <strong><?php print formatprice($prod->product_item_price * $prod->product_quantity, $order->currency_code); ?>
                        <?php print $prod->_ext_price_total_html ?></strong></td>
            </tr>
            <?php $i++;
        } ?>

        <tr class="cart__total">
            <th colspan="4" class="cart__total-text">Сумма к оплате:</th>
            <th colspan="1"
                class="cart__total-cost"><?php print formatprice($order->order_total, $order->currency_code); ?>
                <?php print $this->_tmp_ext_total ?></th>
        </tr>
    </table>
</div>
<?php print $this->_tmp_html_end; ?>
