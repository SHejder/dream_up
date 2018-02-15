<?php
defined('_JEXEC') or die();
$countprod = count($this->products);
$session = JFactory::getSession();

?>
<h1>Корзина</h1>


<div class="cart">
    <form action="<?php print SEFLink('index.php?option=com_jshopping&controller=cart&task=refresh'); ?>"
          method="post"
          name="updateCart">


        <?php if ($countprod > 0) { ?>
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
                <th>
                    <?php print _JSHOP_REMOVE; ?>
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
                        <div class="cart__count">
                            <input type="number" name="quantity[<?php print $key_id; ?>]"
                                   value="<?php print $prod['quantity']; ?>">
                            <?php print $prod['_qty_unit']; ?>
                        </div>
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
                    <td data-text="Удалить:">
                        <a href="<?php print $prod['href_delete']; ?>" class="cart__delete"
                           onclick="return confirm('<?php print _JSHOP_CONFIRM_REMOVE; ?>')">
                            <img src="<?php print $this->image_path; ?>images/delete.png"
                                 alt="<?php print _JSHOP_DELETE; ?>" title="<?php print _JSHOP_DELETE; ?>">
                        </a>
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
    <?php } else { ?>
        <div class="cart_empty_text"><?php print _JSHOP_CART_EMPTY; ?></div>
        <?php $session->set('show_pay_without_reg', 0); ?>
        <?php $session->set('cart',null); ?>
    <?php } ?>
    <?php if ($this->config->summ_null_shipping > 0 && $min_order_summ != 0) { ?>
        <div class="cart__info-item -free-deliver"><?php printf(_JSHOP_FROM_PRICE_SHIPPING_FREE, formatprice($this->config->summ_null_shipping, null, 1)); ?></div>
    <?php } ?>
</div>
<?php if ($countprod > 0) { ?>

    <a id="checkout" class="cart__btn btn"
       href="<?php print $this->href_checkout; ?>"><?php print _JSHOP_CHECKOUT; ?></a>
<?php } ?>


<?php print $this->_tmp_ext_html_before_discount; ?>
<?php if ($this->use_rabatt && $countprod > 0) { ?>
    <br/><br/>
    <form name="rabatt" method="post"
          action="<?php print SEFLink('index.php?option=com_jshopping&controller=cart&task=discountsave'); ?>">
        <table class="jshop">
            <tr>
                <td>
                    <?php print _JSHOP_RABATT; ?>
                    <input type="text" class="inputbox" name="rabatt" value=""/>
                    <input type="submit" class="button" value="<?php print _JSHOP_RABATT_ACTIVE; ?>"/>
                </td>
            </tr>
        </table>

    </form>
<?php } ?>

