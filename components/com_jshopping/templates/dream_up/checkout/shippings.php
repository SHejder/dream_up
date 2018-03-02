<?php
/**
 * @version      4.9.0 13.08.2013
 * @author       MAXXmarketing GmbH
 * @package      Jshopping
 * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license      GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<h1>Оформление заказа без регистрации</h1>

<div id="comjshop">
    <?php print $this->checkout_navigator ?>
    <?php print $this->small_cart ?>

    <div class="ordering-radio">
        <div class="form">
            <form id="shipping_form" name="shipping_form" action="<?php print $this->action ?>" method="post"
                  onsubmit="return validateShippingMethods()" autocomplete="off" enctype="multipart/form-data">
                <?php print $this->_tmp_ext_html_shipping_start ?>
                <div class="form__item -radio-text">
                    <?php foreach ($this->shipping_methods as $shipping) { ?>

                        <label class="custom-radio">
                            <input type="radio" name="sh_pr_method_id"
                                   id="shipping_method_<?php print $shipping->sh_pr_method_id ?>"
                                   value="<?php print $shipping->sh_pr_method_id ?>"
                                   <?php if ($shipping->sh_pr_method_id == $this->active_shipping){ ?>checked="checked"<?php } ?>
                                   />
                            <span><?php print $shipping->name ?> (<?php print formatprice($shipping->calculeprice); ?>)</span>
                        </label>
                        <?php print $shipping->description ?>

                            <?php if ($this->config->show_list_price_shipping_weight && count($shipping->shipping_price)) { ?>
                                <table class="shipping_weight_to_price">
                                    <?php foreach ($shipping->shipping_price as $price) { ?>
                                        <tr>
                                            <td class="weight">
                                                <?php if ($price->shipping_weight_to != 0) { ?>
                                                    <?php print formatweight($price->shipping_weight_from); ?> - <?php print formatweight($price->shipping_weight_to); ?>
                                                <?php } else { ?>
                                                    <?php print _JSHOP_FROM . " " . formatweight($price->shipping_weight_from); ?>
                                                <?php } ?>
                                            </td>
                                            <td class="price">
                                                <?php print formatprice($price->shipping_price); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            <?php } ?>


                            <div id="shipping_form_<?php print $shipping->shipping_id ?>"
                                 class="shipping_form <?php if ($shipping->sh_pr_method_id == $this->active_shipping) print 'shipping_form_active' ?>"><?php print $shipping->form ?></div>

                            <?php if ($shipping->delivery) { ?>
                                <div class="shipping_delivery"><?php print _JSHOP_DELIVERY_TIME . ": " . $shipping->delivery ?></div>
                            <?php } ?>

                            <?php if ($shipping->delivery_date_f) { ?>
                                <div class="shipping_delivery_date"><?php print _JSHOP_DELIVERY_DATE . ": " . $shipping->delivery_date_f ?></div>
                            <?php } ?>
                    <?php } ?>
                </div>
                <?php print $this->_tmp_ext_html_shipping_end ?>

                <script>function checkDeliveryAddress()
                    {
                        var checkResult = true;
                        var shippingMethod = document.getElementById('shipping_method_' + document.shipping_form.sh_pr_method_id.value).nextSibling.nextSibling.innerText;
                        shippingMethod = shippingMethod.substr(0, shippingMethod.indexOf(' ('));
                        if ((shippingMethod != 'Самовывоз') && (shippingMethod != 'ТК «Деловые линии»') && (sessionStorage.getItem('deliveryAddress') == '0'))
                        {
                            alert('Вы выбрали доставку на Ваш адрес, но не указали его на предыдущем шаге!');
                            checkResult = false;
                        };
                        return checkResult;
                    };
                </script>

                <input type="submit" class="btn btn-primary button" value="<?php print _JSHOP_NEXT ?>" onclick="return checkDeliveryAddress();"/>
            </form>
        </div>
    </div>
</div>