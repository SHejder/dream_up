<?php 
/**
* @version      4.12.2 22.10.2014
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die();
?>
<div class="cart">

    <table>
        <tr class="cart__title">
            <th>
                <?php print _JSHOP_IMAGE; ?>
            </th>
            <th>
                <?php print _JSHOP_ITEM; ?>
            </th>
            <th>
                <?php print _JSHOP_SINGLEPRICE; ?>
            </th>
            <th>
                <?php print _JSHOP_NUMBER; ?>
            </th>
            <th>
                <?php print _JSHOP_PRICE_TOTAL; ?>
            </th>
        </tr>
        <?php
        $i = 1;
        foreach ($this->products as $key_id => $prod) {
            ?>
            <tr <?php if ($i % 2 == 0) print "even"; else print "odd"; ?>>
                <td data-text="Изображение:">
                    <a href="<?php print $prod['href']; ?>" class="cart__prev">
                        <img src="<?php print $this->image_product_path; ?>/<?php if ($prod['thumb_image'])
                            print $prod['thumb_image']; else print $this->no_image; ?>"
                             alt="<?php print htmlspecialchars($prod['product_name']); ?>">
                    </a>
                </td>
                <td data-text="Название:">
                    <a href="<?php print $prod['href']; ?>"
                       class="cart__name"><?php print $prod['product_name']; ?></a>
                </td>
                <td data-text="Цена за единицу:">
                    <?php print formatprice($prod['price']); ?>
                    <?php print $prod['_ext_price_html']; ?>
                    <?php if ($this->config->show_tax_product_in_cart && $prod['tax'] > 0) { ?>
                        <span class="taxinfo"><?php print productTaxInfo($prod['tax']); ?></span>
                    <?php } ?>
                    <?php if ($this->config->cart_basic_price_show && $prod['basicprice'] > 0) { ?>
                        <div class="basic_price"><?php print _JSHOP_BASIC_PRICE; ?>:
                            <span><?php print sprintBasicPrice($prod); ?></span></div>
                    <?php } ?>
                </td>
                <td data-text="Кол-во:">
                    <strong><?php print $prod['quantity']; ?><?php print $prod['_qty_unit']; ?></strong>
                </td>
                <td data-text="Сумма:">
                    <strong>
                        <?php print formatprice($prod['price'] * $prod['quantity']); ?>
                        <?php print $prod['_ext_price_total_html']; ?>
                        <?php if ($this->config->show_tax_product_in_cart && $prod['tax'] > 0) { ?>
                            <span class="taxinfo"><?php print productTaxInfo($prod['tax']); ?></span>
                        <?php } ?>
                    </strong>
                </td>

            </tr>
            <?php
            $i++;
        }
        ?>
        <?php if (!$this->hide_subtotal) { ?>
            <tr>
                <th colspan="4" class="cart__total-text"><?php print _JSHOP_SUBTOTAL; ?></th>
                <th colspan="2"
                    class="cart__total-cost"><?php print formatprice($this->summ); ?><?php print $this->_tmp_ext_subtotal; ?></th>
            </tr>
        <?php } ?>
        <?php if ($this->discount > 0) { ?>
            <tr>
                <th colspan="4" class="cart__total-text"><?php print _JSHOP_RABATT_VALUE; ?></th>
                <th colspan="2"
                    class="cart__total-cost"><?php print formatprice(-$this->discount); ?><?php print $this->_tmp_ext_discount; ?></th>
            </tr>
        <?php } ?>
        <?php if (!$this->config->hide_tax) { ?>
            <?php foreach ($this->tax_list as $percent => $value) { ?>
                <tr>
                    <th colspan="4" class="cart__total-text"><?php print displayTotalCartTaxName(); ?>
                        <?php if ($this->show_percent_tax) print formattax($percent) . "%"; ?></th>
                    <th colspan="2"
                        class="cart__total-cost"><?php print formatprice($value); ?><?php print $this->_tmp_ext_tax[$percent]; ?></th>
                </tr>

            <?php } ?>
        <?php } ?>
        <tr>
            <th colspan="4" class="cart__total-text"><?php print _JSHOP_PRICE_TOTAL; ?></th>
            <th colspan="2"
                class="cart__total-cost"><?php print formatprice($this->fullsumm); ?><?php print $this->_tmp_ext_total; ?></th>
        </tr>
        <?php if ($this->config->show_plus_shipping_in_product) { ?>
            <tr>
                <th colspan="4" class="cart__total-text"><?php print _JSHOP_PRICE_TOTAL; ?></th>
                <th colspan="2"
                    class="cart__total-cost"><?php print sprintf(_JSHOP_PLUS_SHIPPING, $this->shippinginfo); ?></th>
            </tr>

        <?php } ?>
        <?php if ($this->free_discount > 0) { ?>
            <tr>
                <th colspan="4" class="cart__total-text"><?php print _JSHOP_PRICE_TOTAL; ?></th>
                <th colspan="2"
                    class="cart__total-cost"><?php print _JSHOP_FREE_DISCOUNT; ?>
                    : <?php print formatprice($this->free_discount); ?></th>
            </tr>

        <?php } ?>

    </table>
    </form>
</div>


<div class="cart__info">
    <?php
    preg_match_all('!\d+!', $this->cartdescr, $matches);
    $min_order_summ = implode(' ', $matches[0]);
    if (!is_numeric($min_order_summ)) $min_order_summ = 0;
    ?>
    <div class="cart__info-item -min-cost<?php if ($this->summ < $min_order_summ) echo ' min_order_summ'; ?>"><?php print $this->cartdescr; ?></div>

<div class="cartdescr"><?php print $this->checkoutcartdescr;?></div>
  
<table class = "jshop jshop_subtotal">
    <?php if (!$this->hide_subtotal){?>
        <tr class="subtotal">    
            <td class = "name">
                <?php print _JSHOP_SUBTOTAL ?>
            </td>
            <td class = "value">
                <?php print formatprice($this->summ);?><?php print $this->_tmp_ext_subtotal?>
            </td>
        </tr>
    <?php } ?>

    <?php print $this->_tmp_html_after_subtotal?>

    <?php if ($this->discount > 0){ ?>
        <tr class="discount">
            <td class = "name">
                <?php print _JSHOP_RABATT_VALUE ?><?php print $this->_tmp_ext_discount_text?>
            </td>
            <td class = "value">
                <?php print formatprice(-$this->discount);?><?php print $this->_tmp_ext_discount?>
            </td>
        </tr>
    <?php } ?>

    <?php if (isset($this->summ_delivery)){?>
        <tr class="shipping">
            <td class = "name">
                <?php print _JSHOP_SHIPPING_PRICE;?>
            </td>
            <td class = "value">
                <?php print formatprice($this->summ_delivery);?><?php print $this->_tmp_ext_shipping?>
            </td>
        </tr>
    <?php } ?>

    <?php if (isset($this->summ_package)){?>
        <tr class="package">
            <td class = "name">
                <?php print _JSHOP_PACKAGE_PRICE;?>
            </td>
            <td class = "value">
                <?php print formatprice($this->summ_package);?><?php print $this->_tmp_ext_shipping_package?>
            </td>
        </tr>
    <?php } ?>

    <?php if ($this->summ_payment != 0){ ?>
        <tr class="payment">
            <td class = "name">
                <?php print $this->payment_name;?>
            </td>
            <td class = "value">
                <?php print formatprice($this->summ_payment);?><?php print $this->_tmp_ext_payment?>
            </td>
        </tr>
    <?php } ?>

    <?php if (!$this->config->hide_tax){ ?>
        <?php foreach($this->tax_list as $percent=>$value){?>
            <tr class="tax">
                <td class = "name">
                    <?php print displayTotalCartTaxName();?>
                    <?php if ($this->show_percent_tax) print formattax($percent)."%"?>
                </td>
                <td class = "value">
                    <?php print formatprice($value);?><?php print $this->_tmp_ext_tax[$percent]?>
                </td>
            </tr>
        <?php } ?>
    <?php } ?>

    <tr class="total">
        <td class = "name">
            <?php print $this->text_total; ?>
        </td>
        <td class = "value">
            <?php print formatprice($this->fullsumm)?><?php print $this->_tmp_ext_total?>
        </td>
    </tr>

    <?php print $this->_tmp_html_after_total?>

    <?php if ($this->free_discount > 0){?>  
        <tr class="free_discount">
            <td colspan="2" align="right">    
                <span class="free_discount">
                    <?php print _JSHOP_FREE_DISCOUNT;?>:
                    <span><?php print formatprice($this->free_discount); ?></span>
                </span>
            </td>
        </tr>
    <?php }?>  
</table>

<?php print $this->_tmp_html_after_checkout_cart?>

</div>