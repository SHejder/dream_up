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


<?php print $this->checkout_navigator ?>
<?php print $this->small_cart ?>

    <script type="text/javascript">
        var payment_type_check = {};
        <?php foreach($this->payment_methods as  $payment){?>
        payment_type_check['<?php print $payment->payment_class;?>'] = '<?php print $payment->existentcheckform;?>';
        <?php }?>
    </script>

    <div class="ordering-radio">
        <div class="form">
            <form id="payment_form" name="payment_form" action="<?php print $this->action ?>" method="post"
                  autocomplete="off" enctype="multipart/form-data">
                <?php print $this->_tmp_ext_html_payment_start ?>
                <div id="table_payments">
                    <?php
                    $payment_class = "";
                    foreach ($this->payment_methods as $payment) {
                        if ($this->active_payment == $payment->payment_id) $payment_class = $payment->payment_class;
                        ?>
                        <div class="form__item -radio-text mb15">
                            <label class="custom-radio">
                                <input type="radio" name="payment_method"
                                       id="payment_method_<?php print $payment->payment_id ?>"
                                       onclick="showPaymentForm('<?php print $payment->payment_class ?>')"
                                       value="<?php print $payment->payment_class ?>"
                                       <?php if ($this->active_payment == $payment->payment_id){ ?>checked<?php } ?> />
                                <span><?php print $payment->name; ?></span>
                            </label>
                        </div>
                                <?php if ($payment->price_add_text != '') { ?>
                                    <span class="payment_price">(<?php print $payment->price_add_text ?>)</span>
                                <?php } ?>
                        <div class="paymform" id="tr_payment_<?php print $payment->payment_class ?>"
                             <?php if ($this->active_payment != $payment->payment_id){ ?>style="display:none"<?php } ?>>
                            <div class="jshop_payment_method">
                                <?php print $payment->payment_description ?>
                                <?php print $payment->form ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <?php print $this->_tmp_ext_html_payment_end ?>
                <button class="homepage-bottom__form-btn btn" onclick="checkPaymentForm();" type="submit"><?php print _JSHOP_NEXT ?>"</button>

            </form>
        </div>
    </div>

<?php if ($payment_class) { ?>
    <script type="text/javascript">
        showPaymentForm('<?php print $payment_class;?>');
    </script>
<?php } ?>