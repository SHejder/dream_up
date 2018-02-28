<?php
/**
 * @version      4.10.0 13.08.2013
 * @author       MAXXmarketing GmbH
 * @package      Jshopping
 * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license      GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<!--<div class = "jshop pagelogin" id="comjshop">    -->
<?php //print $this->checkout_navigator ?>
<?php
$config_fields = $this->config_fields;
?>


<h1><?php print _JSHOP_LOGIN ?></h1>


<div class="ordering">
    <?php
    $messages = JFactory::getApplication()->getMessageQueue();
    if (is_array($messages)) {
        echo '<div class="warnings">';
        foreach ($messages as $message) echo '<div class="' . $message['type'] . '">' . $message['message'] . '</div>';
        echo '</div>';
    };
    ?>


    <?php if ($this->config->shop_user_guest && $this->show_pay_without_reg) : ?>
        <p>Выберите удобный Вам способ оформления заказа:</p>
    <?php endif; ?>

    <?php echo $this->tmpl_login_html_1 ?>
    <?php echo $this->tmpl_login_html_2 ?>
    <div class="ordering__item">
        <?php if ($this->config->shop_user_guest && $this->show_pay_without_reg) : ?>
        <button class="ordering__item-title"><span>У меня уже есть учетная запись</span></button>
        <div class="ordering__item-content form">
            <?php endif; ?>

            <form method="post"
                  action="<?php print SEFLink('index.php?option=com_jshopping&controller=user&task=loginsave', 1, 0, $this->config->use_ssl) ?>"
                  name="jlogin" class="form-horizontal">
                <div class="form__item -name has-content">
                    <label><?php print _JSHOP_USERNAME ?></label>
                    <input type="text" name="username" placeholder="Логин">
                    <div class="form__item-error"></div>
                </div>
                <div class="form__item -email-password">
                    <label><?php print _JSHOP_PASSWORT ?></label>
                    <input type="password" name="passwd" placeholder="Пароль">
                </div>
                <div class="custom-checkbox">
                    <label class="required">
                        <input type="checkbox" name="remember" value="1" checked="">
                        <span><?php print _JSHOP_REMEMBER_ME ?></span>
                    </label>
                </div>
                <button class="homepage-bottom__form-btn btn" type="submit">Отправить</button>
                <a href="<?php print $this->href_lost_pass ?>"><?php print _JSHOP_LOST_PASSWORD ?></a>
                <input type="hidden" name="return" value="<?php print $this->return ?>"/>
                <?php echo JHtml::_('form.token'); ?>
                <?php echo $this->tmpl_login_html_3 ?>
            </form>
            <?php if ($this->config->shop_user_guest && $this->show_pay_without_reg) : ?>

        </div>
    <?php endif; ?>

    </div>
    <?php if ($this->config->shop_user_guest && $this->show_pay_without_reg) : ?>
        <div class="ordering__item">
            <button class="ordering__item-title"><span>Я хочу зарегистрироваться и оформить заказ</span></button>
            <?php $hideheaderh1 = 1;
            include(dirname(__FILE__) . "/register.php"); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->config->shop_user_guest && $this->show_pay_without_reg) : ?>
    <div class="ordering__item">
        <button class="ordering__item-title"><span>Я хочу оформить заказ БЕЗ регистрации</span></button>
        <div class="ordering__item-content form">

            <form action="/katalog/checkout/step2save" method="post" name="loginForm"
                  onsubmit="return validateCheckoutAdressForm('<?php print $this->live_path ?>', this.name)"
                  class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
                <?php print $this->_tmp_ext_html_address_start ?>

                <?php if ($config_fields['l_name']['display']) { ?>
                    <div class="form__item -name has-content">
                        <label>Фамилия</label>
                        <input type="text" name="l_name" placeholder="Фамилия" id="l_name"
                               value="<?php print $this->user->l_name ?>"/>
                        <div class="form__item-error"></div>
                    </div>
                <?php } ?>
                <?php if ($config_fields['f_name']['display']) { ?>
                    <div class="form__item -name has-content">
                        <label>Имя</label>
                        <input type="text" name="f_name" id="f_name" placeholder="Имя"
                               value="<?php print $this->user->f_name ?>"/>
                        <div class="form__item-error"></div>
                    </div>
                <?php } ?>
                <?php if ($config_fields['m_name']['display']) { ?>

                    <div class="form__item -name has-content">
                        <label>Отчество</label>
                        <input type="text" name="m_name" id="m_name" placeholder="Отчество"
                               value="<?php print $this->user->m_name ?>"/>
                        <div class="form__item-error"></div>
                    </div>
                <?php } ?>
                <?php if ($config_fields['email']['display']) { ?>
                    <div class="form__item -name has-content">
                        <label>Email</label>
                        <input type="text" name="email" placeholder="E-mail" id="email"
                               value="<?php print $this->user->email ?>"/>
                        <div class="form__item-error"></div>
                    </div>
                <?php } ?>
                <?php echo $this->_tmpl_address_html_2 ?>

                <?php if ($config_fields['mobil_phone']['display']) { ?>

                    <div class="form__item -name has-content">
                        <label>Мобильный телефон</label>
                        <input type="text" name="mobil_phone" placeholder="Телефон" id="mobil_phone"
                               value="<?php print $this->user->mobil_phone ?>"/>
                        <div class="form__item-error"></div>
                    </div>
                <?php } ?>
                <?php echo $this->_tmpl_address_html_3 ?>
                <!--                        --><?php //if ($this->count_filed_delivery > 0){?>
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

                <!--                        --><?php //}?>

                <div id="div_delivery" class="jshop_register"
                     style="padding-bottom:0px;<?php if (!$this->delivery_adress) { ?>display:none;<?php } ?>">
                    <?php echo $this->_tmpl_address_html_5 ?>
                    <div class="form__item">
                        <label><?php print _JSHOP_ZIP ?> *</label>
                        <input type="text" name="d_zip" id="d_zip" value="<?php print $this->user->d_zip ?>"/>
                    </div>
                    <div class="form__item">
                        <label>Регион *</label>
                            <input type="text" name="d_state" id="d_state" value="<?php print $this->user->d_state ?>" />
                    </div>
                    <div class="form__item">
                        <label>Населённый пункт *</label>
                            <input type="text" name="d_city" id="d_city" value="<?php print $this->user->d_city ?>"
                                   />
                        </div>
                    <div class="form__item">
                        <label>Улица *</label>

                            <input type="text" name="d_street" id="d_street"
                                   value="<?php print $this->user->d_street ?>" />
                        </div>
                    <div class="form__item">
                        <label><?php print _JSHOP_HOME ?> *</label>
                            <input type="text" name="d_home" id="d_home" value="<?php print $this->user->d_home ?>"
                                   />
                        </div>
                    <div class="form__item">
                        <label><?php print _JSHOP_APARTMENT ?> *</label>

                            <input type="text" name="d_apartment" id="d_apartment"
                                   value="<?php print $this->user->d_apartment ?>" />
                        </div>
                    <?php echo $this->_tmpl_address_html_6 ?>
                </div>


                <div class="custom-checkbox">
                    <label class="required">
                        <input type="checkbox" value="1" required="" checked="">
                        <span>Я согласен на обработку персональных данных. <a
                                    href="">Политика конфиденциальности</a></span>
                    </label>
                </div>
                <button class="homepage-bottom__form-btn btn" type="submit">Отправить</button>
            </form>
        </div>

    </div>
</div>
<?php endif; ?>

<?php if ($this->config->shop_user_guest && !$this->show_pay_without_reg) : ?>
    <!--    </div>-->
    <div class="ordering__item">


        <?php echo $this->tmpl_login_html_4 ?>
        <?php if ($this->allowUserRegistration) { ?>
            <?php if (!$this->config->show_registerform_in_logintemplate) { ?>
                <span class="small_header"><?php print _JSHOP_HAVE_NOT_ACCOUNT ?>?</span>
                <div class="logintext">
                    <a href="<?php print $this->href_register ?>">Зарегистрируйтесь</a> пожалуйста!
                    <!--                        --><?php //print _JSHOP_REGISTER ?>
                </div>
            <?php } else { ?>
                <?php $hideheaderh1 = 1;
                include(dirname(__FILE__) . "/register.php"); ?>
            <?php } ?>
        <?php } ?>
        <?php echo $this->tmpl_login_html_5 ?>
    </div>
<?php endif; ?>


<!--</div>-->
<?php echo $this->tmpl_login_html_6 ?>
