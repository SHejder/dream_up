<?php
/**
 * @version      4.15.1 13.08.2013
 * @author       MAXXmarketing GmbH
 * @package      Jshopping
 * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license      GNU/GPL
 */
defined('_JEXEC') or die();

$config_fields = $this->config_fields;
include(dirname(__FILE__) . "/editaccount.js.php");
$uri =& JFactory::getURI();
$url = $uri->toString(array('path', 'query', 'fragment'));
$user = JFactory::getUser();
$model = JSFactory::getModel('userOrders', 'jshop');

JshopHelpersMetadata::userOrders();

$model->setUserId(JFactory::getUser()->id);
$orders = $model->getListOrders();

?>
<h1>Личный кабинет</h1>
<nav class="lk-menu">
    <ul>
        <li>
            <a <?php if ($url == '/vkhod-v-lichnyj-kabinet/myaccount') { ?>class="is-active"<?php } ?>
               href="/vkhod-v-lichnyj-kabinet/myaccount"><?php print _JSHOP_EDIT_DATA ?></a>
        </li>
        <li>
            <a href="<?php print $this->href_show_orders ?>"><?php print _JSHOP_SHOW_ORDERS ?> ( <?php echo count($orders);?> ) </a>
        </li>
        <li>
            <a href="<?php print $this->href_logout ?>"><?php print _JSHOP_LOGOUT ?></a>
        </li>
    </ul>
</nav>


<?php echo $this->tmpl_my_account_html_start ?>
<div class="user-profile">

    <?php if ($config_fields['f_name']['display'] || $config_fields['l_name']['display']) { ?>
        <div class="user-profile__item">
            <div class="user-profile__item-name">ФИО</div>
            <div class="user-profile__item-val">
                <?php print $this->user->f_name . " " . $this->user->l_name; ?>
            </div>
        </div>
    <?php } ?>

    <?php if ($this->config->display_user_group) { ?>
        <div class="user-profile__item">
            <div class="user-profile__item-name">Скидка</div>
            <div class="user-profile__item-val"><?php print $this->user->discountpercent ?>%</div>
        </div>

    <?php } ?>
    <?php if ($config_fields['email']['display']) { ?>

        <div class="user-profile__item">
            <div class="user-profile__item-name">Email</div>
            <div class="user-profile__item-val">
                <div class="user-profile__item-val-curr"><?php print $this->user->email ?>
                    <button class="user-profile__btn-change"><span>Сменить email</span></button>
                </div>
                <div class="user-profile__item-form form">
                    <form action="/vkhod-v-lichnyj-kabinet/accountsave" method="post" name="loginForm"
                          onsubmit="return validateEditAccountForm('<?php print $this->live_path ?>', this.name)"
                          enctype="multipart/form-data">
                        <?php echo $this->_tmpl_editaccount_html_1 ?>
                        <div class="form__item -name has-content">
                            <label>Новый email</label>
                            <input type="text" name="email" id="email" value="<?php print $this->user->email ?>"
                                   placeholder="Новый email">
                        </div>
                        <?php echo $this->_tmpl_editaccount_html_8 ?>
                        <button class="user-profile__form-btn" type="submit">
                            <span>Сохранить новый email</span></button>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($config_fields['phone']['display']) { ?>
        <div class="user-profile__item">
            <div class="user-profile__item-name">Телефон</div>
            <div class="user-profile__item-val">
                <div class="user-profile__item-val-curr">
                    <?php print $this->user->phone ?>
                    <button class="user-profile__btn-change"><span>Сменить телефон</span></button>
                </div>
                <div class="user-profile__item-form form">
                    <form action="/vkhod-v-lichnyj-kabinet/accountsave" method="post" name="loginForm"
                          onsubmit="return validateEditAccountForm('<?php print $this->live_path ?>', this.name)"
                          enctype="multipart/form-data">
                        <?php echo $this->_tmpl_editaccount_html_3 ?>
                        <div class="form__item -name has-content">
                            <label>Новый телефон</label>
                            <input placeholder="Новый телефон" type="text" name="phone" id="phone"
                                   value="<?php print $this->user->phone ?>">
                        </div>
                        <?php echo $this->_tmpl_editaccount_html_8 ?>
                        <button class="user-profile__form-btn" type="submit">
                            <span>Сохранить новый телефон</span></button>
                    </form>
                </div>
            </div>
        </div>

    <?php } ?>
    <?php if ($user->get('id')) { ?>
        <div class="user-profile__item">
            <div class="user-profile__item-name">Логин</div>
            <div class="user-profile__item-val"><?php echo $user->get('username') ?></div>
        </div>
    <?php } ?>
    <div class="user-profile__item">
        <div class="user-profile__item-name">Пароль</div>
        <div class="user-profile__item-val">
            <div class="user-profile__item-val-curr">********
                <button class="user-profile__btn-change"><span>Сменить пароль</span></button>
            </div>
            <div class="user-profile__item-form form">
                <form action="/vkhod-v-lichnyj-kabinet/accountsave" method="post" name="loginForm"
                      onsubmit="return validateEditAccountForm('<?php print $this->live_path ?>', this.name)"
                      enctype="multipart/form-data">
                    <!--                    <div class="form__item -name has-content">-->
                    <!--                        <label>Старый пароль</label>-->
                    <!--                        <input type="text" placeholder="Старый пароль">-->
                    <!--                        <div class="form__item-error"></div>-->
                    <!--                    </div>-->
                    <?php echo $this->_tmpl_editaccount_html_4 ?>
                    <?php if ($config_fields['password']['display']) { ?>
                        <div class="form__item -name has-content">
                            <label>Новый пароль</label>
                            <input type = "password" name = "password" value="<?php print $this->user->password ?>" placeholder="Новый пароль">
                        </div>
                    <?php } ?>
                    <?php if ($config_fields['password_2']['display']) { ?>
                        <div class="form__item -name has-content">
                            <label>Повторите пароль</label>
                            <input type = "password" name = "password_2" value="<?php print $this->user->password ?>" placeholder="Повторите пароль">
                        </div>
                    <?php } ?>
                    <button class="user-profile__form-btn" type="submit">
                        <span>Сохранить новый пароль</span></button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $this->tmpl_my_account_html_end ?>
