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
        include(dirname(__FILE__)."/adress.js.php");
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


            <div class="custom-checkbox">
                <label class="required">
                    <input type="checkbox" value="1" required="" checked="">
                    <span>Я согласен на обработку персональных данных. <a href="">Политика конфиденциальности</a></span>
                </label>
            </div>
            <button onclick="return checkAGBAndNoReturn('0','0');" class="homepage-bottom__form-btn btn" type="submit">Отправить</button>
        </form>
    </div>

