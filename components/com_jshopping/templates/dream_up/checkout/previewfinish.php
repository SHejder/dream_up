<?php
/**
 * @version      4.8.0 13.08.2013
 * @author       MAXXmarketing GmbH
 * @package      Jshopping
 * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license      GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<!--    --><?php //print $this->checkout_navigator?>
<?php print $this->small_cart ?>


<?php print $this->_tmp_ext_html_previewfinish_start ?>
<div class="ordering-confirm-info">
    <div class="ordering-confirm-info__item -short">
        <span>Контакт:</span>
               <?php if ($this->invoice_info['firma_name']) print $this->invoice_info['firma_name'] . ", "; ?>
            <?php print $this->invoice_info['f_name'] ?>
            <?php print $this->invoice_info['l_name'] ?>,
            <?php if ($this->invoice_info['street'] && $this->invoice_info['street_nr']) print $this->invoice_info['street'] . " " . $this->invoice_info['street_nr'] . "," ?>
            <?php if ($this->invoice_info['street'] && !$this->invoice_info['street_nr']) print $this->invoice_info['street'] . "," ?>
            <?php if ($this->invoice_info['home'] && $this->invoice_info['apartment']) print $this->invoice_info['home'] . "/" . $this->invoice_info['apartment'] . "," ?>
            <?php if ($this->invoice_info['home'] && !$this->invoice_info['apartment']) print $this->invoice_info['home'] . "," ?>
            <?php if ($this->invoice_info['state']) print $this->invoice_info['state'] . "," ?>
            <?php print $this->invoice_info['zip'] . " " . $this->invoice_info['city'] . " " . $this->invoice_info['country'] ?>
    </div>

    <?php if ($this->count_filed_delivery) { ?>
        <div class="ordering-confirm-info__item -short">
            <span><?php print _JSHOP_FINISH_DELIVERY_ADRESS ?>:</span>
                   <?php if ($this->delivery_info['firma_name']) print $this->delivery_info['firma_name'] . ", "; ?>
                <?php print $this->delivery_info['f_name'] ?>
                <?php print $this->delivery_info['l_name'] ?>
                <?php if ($this->delivery_info['street'] && $this->delivery_info['street_nr']) print $this->delivery_info['street'] . " " . $this->delivery_info['street_nr'] . "," ?>
                <?php if ($this->delivery_info['street'] && !$this->delivery_info['street_nr']) print $this->delivery_info['street'] . "," ?>
                <?php if ($this->delivery_info['home'] && $this->delivery_info['apartment']) print $this->delivery_info['home'] . "/" . $this->delivery_info['apartment'] . "," ?>
                <?php if ($this->delivery_info['home'] && !$this->delivery_info['apartment']) print $this->delivery_info['home'] . "," ?>
                <?php if ($this->delivery_info['state']) print $this->delivery_info['state'] . "," ?>
                <?php print $this->delivery_info['zip'] . " " . $this->delivery_info['city'] . " " . $this->delivery_info['country'] ?>
        </div>
    <?php } ?>

    <?php if (!$this->config->without_shipping) { ?>
        <div class="ordering-confirm-info__item -short">
            <span><?php print _JSHOP_FINISH_SHIPPING_METHOD ?>:</span>
            <?php print $this->sh_method->name ?>
            <?php if ($this->delivery_time) { ?>
                <div class="delivery_time"><strong><?php print _JSHOP_DELIVERY_TIME ?></strong>:
                    <span><?php print $this->delivery_time ?></span></div>
            <?php } ?>
            <?php if ($this->delivery_date) { ?>
                <div class="delivery_date"><strong><?php print _JSHOP_DELIVERY_DATE ?></strong>:
                    <span><?php print $this->delivery_date ?></span></div>
            <?php } ?>
        </div>
    <?php } ?>

    <?php if (!$this->config->without_payment) { ?>
        <div class="ordering-confirm-info__item -short">
            <span><?php print _JSHOP_FINISH_PAYMENT_METHOD ?>:</span>
            <?php print $this->payment_name ?>
        </div>
    <?php } ?>

    <form name="form_finish" action="<?php print $this->action ?>" method="post" enctype="multipart/form-data">
        <div class="ordering-confirm-info__item -long">
            <span><?php print _JSHOP_ADD_INFO ?></span>
        </div>

            <textarea ></textarea>
            <?php if ($this->config->display_agb) { ?>
                <div class="row_agb">
                    <input type="checkbox" name="agb" id="agb"/>
                    <a class="policy" href="#"
                       onclick="window.open('<?php print SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=agb&tmpl=component', 1); ?>','window','width=800, height=600, scrollbars=yes, status=no, toolbar=no, menubar=no, resizable=yes, location=no');return false;"><?php print _JSHOP_AGB; ?></a>
                    <?php print _JSHOP_AND; ?>
                    <a class="policy" href="#"
                       onclick="window.open('<?php print SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=return_policy&tmpl=component&cart=1', 1); ?>','window','width=800, height=600, scrollbars=yes, status=no, toolbar=no, menubar=no, resizable=yes, location=no');return false;"><?php print _JSHOP_RETURN_POLICY ?></a>
                    <?php print _JSHOP_CONFIRM; ?>
                </div>
            <?php } ?>

            <?php if ($this->no_return) { ?>
                <div class="row_no_return">
                    <input type="checkbox" name="no_return" id="no_return"/>
                    <?php print _JSHOP_NO_RETURN_DESCRIPTION; ?>
                </div>
            <?php } ?>

            <?php print $this->_tmp_ext_html_previewfinish_agb ?>
            <div class="box_button">
                <?php print $this->_tmp_ext_html_previewfinish_before_button ?>
                <input class="btn btn-primary button" type="submit" name="finish_registration"
                       value="<?php print _JSHOP_ORDER_FINISH ?>"
                       onclick="return checkAGBAndNoReturn('<?php echo $this->config->display_agb; ?>','<?php echo $this->no_return ?>');"/>
            </div>
        <?php print $this->_tmp_ext_html_previewfinish_end ?>
    </form>

</div>
