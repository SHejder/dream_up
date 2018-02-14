<?php
/**
 * @version      4.11.1 13.08.2013
 * @author       MAXXmarketing GmbH
 * @package      Jshopping
 * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license      GNU/GPL
 */
defined('_JEXEC') or die();

$config_fields = $this->config_fields;

$uri =& JFactory::getURI();
$url = $uri->toString(array('path', 'query', 'fragment'));

?>

<div class="jshop myorders_list" id="comjshop">

    <h1>Личный кабинет</h1>

    <nav class="lk-menu">
        <ul>
            <li>
                <a href="/vkhod-v-lichnyj-kabinet/myaccount"><?php print _JSHOP_EDIT_DATA ?></a>
            </li>
            <li>
                <a <?php if ($url == '/vkhod-v-lichnyj-kabinet/orders') { ?>class="is-active"<?php } ?>
                   href="/vkhod-v-lichnyj-kabinet/orders"><?php print _JSHOP_SHOW_ORDERS ?>
                    ( <?php echo count($this->orders); ?> )</a>
            </li>
            <li>
                <a href="<?php print $this->href_logout ?>"><?php print _JSHOP_LOGOUT ?></a>
            </li>
        </ul>
    </nav>


    <?php print $this->_tmp_html_before_user_order_list; ?>

    <?php if (count($this->orders)) { ?>
    <div class="user-orders">
        <table>
            <tr class="user-orders__title">
                <th>Дата</th>
                <th>Номер заказа</th>
                <th>Сумма заказа</th>
                <th>Статус заказа</th>
            </tr>
            <?php foreach ($this->orders as $order) { ?>

                <tr>
                    <td data-text="Дата:"><?php print formatdate($order->order_date, 0) ?></td>
                    <?php print $order->_ext_price_html ?>
                    <td data-text="Номер заказа:"><a href="<?php print $order->order_href ?>" class="user-orders__name">Заказ
                            №<?php print $order->order_number ?></a>
                    </td>
                    <?php print $order->_tmp_ext_order_number; ?>
                    <?php print $order->_tmp_ext_but_info; ?>


                    <td data-text="Сумма заказа:"><?php print formatprice($order->order_total, $order->currency_code) ?></td>
                    <td data-text="Статус заказа:"><span
                                class="order-status <?php if ($order->status_name == "Новый заказ") { ?>
                                -in-progress
                                <?php } elseif ($order->status_name == "ЗАВЕРШЕН") { ?>
                                -is-cancelled
                                <?php } else { ?>
                                -is-done
            <?php } ?>
                    "><?php print $order->status_name ?></span>
                    </td>
                    <?php print $order->_tmp_ext_status_name; ?>
                </tr>
            <?php } ?>


        </table>
        <?php } else { ?>
            <div class="myorders_no_orders">
                <?php print _JSHOP_NO_ORDERS ?>
            </div>
        <?php } ?>


