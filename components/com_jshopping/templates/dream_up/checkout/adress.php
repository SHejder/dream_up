<?php 
/**
* @version      4.9.1 13.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
?>
<!--    --><?php //print $this->checkout_navigator?>
    <?php print $this->small_cart?>
    <div class="form">
        <?php
        $config_fields = $this->config_fields;
        ?>

        <form action = "<?php print $this->action ?>" method = "post" name = "loginForm" onsubmit = "return validateCheckoutAdressForm('<?php print $this->live_path ?>', this.name)" class = "form-horizontal" autocomplete="off" enctype="multipart/form-data">
            <?php print $this->_tmp_ext_html_address_start?>

            <?php if ($config_fields['l_name']['display']){?>
            <div class="form__item -name has-content">
                <label>Фамилия</label>
                <input type = "text" name = "l_name" id = "l_name" value = "<?php print $this->user->l_name ?>" />
                <div class="form__item-error"></div>
            </div>
            <?php } ?>
            <?php if ($config_fields['f_name']['display']){?>
            <div class="form__item -name has-content">
                <label>Имя</label>
                <input type = "text" name = "f_name" id = "f_name" value = "<?php print $this->user->f_name ?>" />
                <div class="form__item-error"></div>
            </div>
            <?php } ?>
            <?php if ($config_fields['m_name']['display']){?>

            <div class="form__item -name has-content">
                <label>Отчество</label>
                <input type = "text" name = "m_name" id = "m_name" value = "<?php print $this->user->m_name ?>" />
                <div class="form__item-error"></div>
            </div>
            <?php } ?>
            <?php if ($config_fields['email']['display']){?>
            <div class="form__item -name has-content">
                <label>Email</label>
                <input type = "text" name = "email" id = "email" value = "<?php print $this->user->email ?>"  />
                <div class="form__item-error"></div>
            </div>
            <?php } ?>
            <?php echo $this->_tmpl_address_html_2?>

            <?php if ($config_fields['mobil_phone']['display']){?>

            <div class="form__item -name has-content">
                <label>Мобильный телефон</label>
                <input type = "text" name = "mobil_phone" id = "mobil_phone" value = "<?php print $this->user->mobil_phone ?>" />
                <div class="form__item-error"></div>
            </div>
            <?php } ?>
            <?php echo $this->_tmpl_address_html_3?>

            <?php if ($this->count_filed_delivery > 0){?>
                <div class="form__item -radio">
                    <label>Доставка на ваш адрес?
                        <label class="custom-radio">
                            <input type="radio" name="delivery_adress" id="delivery_adress_1"
                                   value="0" <?php if (!$this->delivery_adress) { ?> checked="checked" <?php } ?>
                                   onclick="jQuery('#div_delivery').hide()"/>
                            <span><?php print _JSHOP_NO ?></span>

                        </label>
                        <label class="custom-radio">
                            <input type="radio" name="delivery_adress" id="delivery_adress_2"
                                   value="1" <?php if ($this->delivery_adress) { ?> checked="checked" <?php } ?>
                                   onclick="jQuery('#div_delivery').show()"/>
                            <span><?php print _JSHOP_YES ?></span>

                        </label>
                    </label>

                </div>
            <?php }?>

            <div id = "div_delivery" class = "jshop_register" style = "padding-bottom:0px;<?php if (!$this->delivery_adress){ ?>display:none;<?php } ?>">
                <?php echo $this->_tmpl_address_html_5 ?>
                <?php if ($config_fields['d_zip']['display']){?>

                <div class="form__item">
                    <label><?php print _JSHOP_ZIP ?> *</label>
                    <input type="text" name="d_zip" id="d_zip" value="<?php print $this->user->d_zip ?>"/>
                </div>
                <?php } ?>
                <?php if ($config_fields['d_state']['display']){?>

                <div class="form__item">
                    <label>Регион *</label>
                    <input type="text" name="d_state" id="d_state" value="<?php print $this->user->d_state ?>" />
                </div>
                <?php } ?>
                <?php if ($config_fields['d_city']['display']){?>

                <div class="form__item">
                    <label>Населённый пункт *</label>
                    <input type="text" name="d_city" id="d_city" value="<?php print $this->user->d_city ?>"
                    />
                </div>
                <?php } ?>
                <?php if ($config_fields['d_street']['display']){?>

                <div class="form__item">
                    <label>Улица *</label>

                    <input type="text" name="d_street" id="d_street"
                           value="<?php print $this->user->d_street ?>" />
                </div>
                <?php } ?>
                <?php if ($config_fields['d_home']['display']){?>

                <div class="form__item">
                    <label><?php print _JSHOP_HOME ?> *</label>
                    <input type="text" name="d_home" id="d_home" value="<?php print $this->user->d_home ?>"
                    />
                </div>
                <?php } ?>
                <?php if ($config_fields['d_apartment']['display']){?>

                <div class="form__item">
                    <label><?php print _JSHOP_APARTMENT ?> *</label>

                    <input type="text" name="d_apartment" id="d_apartment"
                           value="<?php print $this->user->d_apartment ?>" />
                </div>
                <?php } ?>

                <?php echo $this->_tmpl_address_html_6 ?>

            </div>



            <div class="custom-checkbox">
                <label class="required">
                    <input type="checkbox" value="1" required="" checked="">
                    <span>Я согласен на обработку персональных данных. <a href="">Политика конфиденциальности</a></span>
                </label>
            </div>
            <button onclick="return checkAGBAndNoReturn('0','0');" class="homepage-bottom__form-btn btn" type="submit">Отправить</button>
        </form>
    </div>

