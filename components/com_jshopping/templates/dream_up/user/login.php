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
<h1><?php print _JSHOP_LOGIN ?></h1>
<div class="ordering">
    <?php print $this->checkout_navigator ?>

    <?php if ($this->config->shop_user_guest && $this->show_pay_without_reg) : ?>
        <span class="text_pay_without_reg"><?php print _JSHOP_ORDER_WITHOUT_REGISTER_CLICK ?> <a
                    href="<?php print SEFLink('index.php?option=com_jshopping&controller=checkout&task=step2', 1, 0, $this->config->use_ssl); ?>"><?php print _JSHOP_HERE ?></a></span>
    <?php endif; ?>

    <?php echo $this->tmpl_login_html_1 ?>
    <div class="row-fluid">
        <!--        <div class="span6 login_block">-->
        <?php echo $this->tmpl_login_html_2 ?>
        <!--            <div class="small_header">--><?php //print _JSHOP_HAVE_ACCOUNT ?><!--</div>-->
        <!--            <div class="logintext">--><?php //print _JSHOP_PL_LOGIN ?><!--</div>-->
        <div class="ordering__item">
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
                    <!--                    <div class="error">-->
                    <!--                        <ul>-->
                    <!--                            <li>Неверный пароль</li>-->
                    <!--                        </ul>-->
                    <!--                    </div>-->
                </div>
                <div class="custom-checkbox">
                    <label class="required">
                        <input type="checkbox" name="remember" value="1" required="" checked="">
                        <span><?php print _JSHOP_REMEMBER_ME ?></span>
                    </label>
                </div>
                <button class="homepage-bottom__form-btn btn" type="submit">Отправить</button>
                <a href="<?php print $this->href_lost_pass ?>"><?php print _JSHOP_LOST_PASSWORD ?></a>
                <input type="hidden" name="return" value="<?php print $this->return ?>"/>
                <?php echo JHtml::_('form.token'); ?>
                <?php echo $this->tmpl_login_html_3 ?>
            </form>
        </div>

<!--    </div>-->
    <div class="span6 register_block">
        <?php echo $this->tmpl_login_html_4 ?>
        <?php if ($this->allowUserRegistration) { ?>
            <span class="small_header"><?php print _JSHOP_HAVE_NOT_ACCOUNT ?>?</span>
            <div class="logintext"><?php print _JSHOP_REGISTER ?></div>
            <?php if (!$this->config->show_registerform_in_logintemplate) { ?>
                <div class="block_button_register">
                    <input type="button" class="btn button" value="<?php print _JSHOP_REGISTRATION ?>"
                           onclick="location.href='<?php print $this->href_register ?>';"/>
                </div>
            <?php } else { ?>
                <?php $hideheaderh1 = 1;
                include(dirname(__FILE__) . "/register.php"); ?>
            <?php } ?>
        <?php } ?>
        <?php echo $this->tmpl_login_html_5 ?>
    </div>
</div>
    <!--</div>-->
    <?php echo $this->tmpl_login_html_6 ?>
