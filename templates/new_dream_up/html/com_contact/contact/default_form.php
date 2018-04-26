<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

?>
<div class="contacts__form form">
    <?php
    $messages = JFactory::getApplication()->getMessageQueue();
    if (is_array($messages)) {
        echo '<div class="warnings">';
        foreach ($messages as $message) echo '<div class="' . $message['type'] . '">' . $message['message'] . '</div>';
        echo '</div>';
    };
    ?>

    <h2>Остались вопросы? Напишите нам!</h2>
    <form action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate form-horizontal well">
        <div class="col-1">
            <div class="form__item -name has-content">
                <label for="form__item-name">Ваше имя</label>
                <input name="jform[contact_name]" type="text" id="form__item-name" placeholder="Имя">
                <div class="form__item-error"></div>
            </div>
            <div class="form__item -email-phone">
                <label for="form__item-email-phone">Email*</label>
                <input required="required" type="email" name="jform[contact_email]" id="form__item-email-phone"
                       placeholder="Email">
                <!--            <div class="error"><ul><li>Неверный формат</li></ul></div>-->
            </div>
        </div>
        <div class="col-2">
            <div class="form__item -text">
                <label for="form__item-text">Сообщение</label>
                <textarea name="jform[contact_message]" placeholder="Сообщение" id="form__item-text"></textarea>
                <div class="form__item-error"></div>
            </div>
        </div>
        <div class="col-3">
            <div class="custom-checkbox">
                <label for="app_sample_choice_privacy-policy-3" class="required">
                    <input type="checkbox" id="app_sample_choice_privacy-policy-3" value="1" required="" checked="">
                    <span>Я согласен на обработку персональных данных. <a href="">Политика конфиденциальности</a></span>
                </label>
            </div>
            <button class="contacts__form-btn btn" type="submit">Отправить</button>
            <input type="hidden" name="option" value="com_contact"/>
            <input type="hidden" name="task" value="contact.submit"/>
            <input type="hidden" name="return" value="<?php echo $this->return_page; ?>"/>
            <input type="hidden" name="id" value="<?php echo $this->contact->slug; ?>"/>
            <?php echo JHtml::_('form.token'); ?>
        </div>

        <div class="g-recaptcha" data-sitekey="6LfJwE0UAAAAAFlrvixKHHqfR4fLdrjW1Y9H3spi"></div>
        <input name="jform[contact_subject]" id="jform_contact_emailmsg" style="visibility: hidden" value="Новое сообщение" class="required invalid" size="60" required="required" aria-required="true" aria-invalid="true" type="text">

    </form>

</div><!-- homepage-bottom__form end -->

