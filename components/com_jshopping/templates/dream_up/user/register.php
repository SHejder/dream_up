<?php 
/**
* @version      4.8.0 18.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
?>
<?php
$config_fields = $this->config_fields;
include(dirname(__FILE__)."/register.js.php");
?>
<div class="ordering form">
    <?php if (!isset($hideheaderh1)) : ?>
        <h1><?php print _JSHOP_REGISTRATION;?></h1>
    <?php endif; ?>

    <form action = "<?php print SEFLink('index.php?option=com_jshopping&controller=user&task=registersave',1,0, $this->config->use_ssl)?>" class = "form-validate form-horizontal" method = "post" name = "loginForm" onsubmit = "return validateRegistrationForm('<?php print $this->urlcheckdata?>', this.name)" autocomplete="off" enctype="multipart/form-data">
        <?php echo $this->_tmpl_register_html_1?>

        <?php if ($config_fields['l_name']['display']) : ?>
        <div class="form__item -name has-content">
            <label><?php print _JSHOP_L_NAME ?> <?php if ($config_fields['l_name']['require']) : ?><span>*</span><?php endif; ?></label>
            <input name = "l_name" value = "<?php print $this->user->l_name?>"  type="text" placeholder="Фамилия">
            <div class="form__item-error"></div>
        </div>
        <?php endif; ?>

        <?php if ($config_fields['f_name']['display']) : ?>
        <div class="form__item -name has-content">
            <label> <?php print _JSHOP_F_NAME ?> <?php if ($config_fields['f_name']['require']) : ?><span>*</span><?php endif; ?></label>
            <input name = "f_name" type="text" placeholder="Имя" value="<?php print $this->user->f_name?>">
            <div class="form__item-error"></div>
        </div>
        <?php endif; ?>

        <?php if ($config_fields['m_name']['display']) : ?>
        <div class="form__item -name has-content">
            <label><?php print _JSHOP_M_NAME ?> <?php if ($config_fields['m_name']['require']) : ?><span>*</span><?php endif; ?></label>
            <input name = "m_name" value = "<?php print $this->user->m_name?>" type="text" placeholder="Отчество">
            <div class="form__item-error"></div>
        </div>
        <?php endif; ?>

        <?php if ($config_fields['email']['display']) : ?>
        <div class="form__item -name has-content">
            <label><?php print _JSHOP_EMAIL ?> <?php if ($config_fields['email']['require']) : ?><span>*</span><?php endif; ?></label>
            <input name = "email" value = "<?php print $this->user->email?>" type="email" placeholder="example@mail.ru">
            <div class="form__item-error"></div>
        </div>
        <?php endif; ?>

        <?php echo $this->_tmpl_register_html_2?>

        <br>
        <?php if ($config_fields['mobil_phone']['display']) : ?>
        <div class="form__item -name has-content">
            <label><?php print _JSHOP_MOBIL_PHONE ?> <?php if ($config_fields['mobil_phone']['require']) : ?><span>*</span><?php endif; ?></label>
            <input name = "phone" value = "<?php print $this->user->mobil_phone?>" type="text" placeholder="+7 (920) 000-00-00">
            <div class="form__item-error"></div>
        </div>
        <?php endif; ?>
        <?php echo $this->_tmpl_register_html_3?>
        <br>

        <?php if ($config_fields['u_name']['display']) : ?>
        <div class="form__item -name has-content">
            <label><?php print _JSHOP_USERNAME ?> <?php if ($config_fields['u_name']['require']) : ?><span>*</span><?php endif; ?></label>
            <input type="text" name = "u_name" value = "<?php print $this->user->u_name?>" placeholder="Логин">
            <div class="form__item-error"></div>
        </div>
        <?php endif; ?>

        <?php if ($config_fields['password']['display']) : ?>
        <div class="form__item -email-password">
            <label><?php print _JSHOP_PASSWORD ?> <?php if ($config_fields['password']['require']) : ?><span>*</span><?php endif; ?></label>
            <input type="password" name = "password" placeholder="Пароль">
<!--            <div class="error">-->
<!--                <ul>-->
<!--                    <li>Неверный пароль</li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>
        <?php endif; ?>

        <?php if ($config_fields['password_2']['display']) : ?>
        <div class="form__item -email-password">
            <label><?php print _JSHOP_PASSWORD_2 ?> <?php if ($config_fields['password_2']['require']) : ?><span>*</span><?php endif; ?></label>
            <input type="password" name = "password_2" placeholder="Подтвердить пароль">
<!--            <div class="error">-->
<!--                <ul>-->
<!--                    <li>Неверный пароль</li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>
        <?php endif; ?>


<!--        <div class="custom-checkbox">-->
<!--            <label class="required">-->
<!--                <input type="checkbox" value="1" required="" checked="">-->
<!--                <span>Я согласен на обработку персональных данных. <a href="">Политика конфиденциальности</a></span>-->
<!--            </label>-->
<!--        </div>-->
        <?php echo $this->_tmpl_register_html_4?>

        <button class="homepage-bottom__form-btn btn" type="submit">Отправить</button>
        <?php echo JHtml::_('form.token');?>
    </form>
</div>

<!--        --><?php //if ($config_fields['privacy_statement']['display']) : ?>
<!--        <div class = "control-group">-->
<!--          <div class = "control-label name">-->
<!--            <a class="privacy_statement" href="#" onclick="window.open('--><?php //print SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=privacy_statement&tmpl=component', 1);?>
<!--              ','window','width=800, height=600, scrollbars=yes, status=no, toolbar=no, menubar=no, resizable=yes, location=no');return false;">-->
<!--            --><?php //print _JSHOP_PRIVACY_STATEMENT?><!-- --><?php //if ($config_fields['privacy_statement']['require']) : ?><!--<span>*</span>--><?php //endif; ?>
<!--            </a>            -->
<!--          </div>-->
<!--          <div class = "controls">-->
<!--            <input type="checkbox" name="privacy_statement" id="privacy_statement" value="1" />-->
<!--          </div>-->
<!--        </div>-->
<!--        --><?php //endif; ?>
    <?php echo $this->_tmpl_register_html_5?>
<!--    <div class = "control-group box_button">-->
<!--        <div class = "controls">-->
<!--            <div class="requiredtext">* --><?php //print _JSHOP_REQUIRED?><!--</div>-->
<!--            --><?php //echo $this->_tmpl_register_html_6?>
<!--            <input type="submit" value = "--><?php //print _JSHOP_SEND_REGISTRATION ?><!--" class = "btn btn-primary button" />-->
<!--        </div>-->
<!--    </div>-->
<!--    --><?php //echo JHtml::_('form.token');?>
<!--    </form>-->
<!--</div>-->