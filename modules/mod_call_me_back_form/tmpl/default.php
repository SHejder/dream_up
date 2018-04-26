<?php
    /*
    # ------------------------------------------------------------------------
    # Extensions for Joomla 3.x
    # ------------------------------------------------------------------------
    # Copyright (C) 2015 standardcompany.ru. All Rights Reserved.
    # @license - PHP files are GNU/GPL V2.
    # Author: standardcompany.ru
    # Websites:  http://standardcompany.ru
    # Date modified: 11/10/2015
    # ------------------------------------------------------------------------
    */

defined('_JEXEC') or die;

JHtml::_('jquery.framework');

JHtml::script(JURI::base() . 'modules/mod_call_me_back_form/assets/js/jquery.maskedinput.min.js');
JHtml::stylesheet(JURI::base() . 'modules/mod_call_me_back_form/assets/css/call-me-back-form.css');

$my_email = $params->get('my_email');
$subject_mail = $params->get('subject_mail');

$use_as = $params->get('use_as');
$id_module = $module->id;

$form_title = $params->get('form_title');
$form_description = $params->get('form_description');
$form_thanks = $params->get('form_thanks');

$input_name = $params->get('input_name');
$input_phone = $params->get('input_phone');
$phone_mask = $params->get('phone_mask');
$send_button = $params->get('send_button');
$send_button_after = $params->get('send_button_after');

$input_name_required = $params->get('input_name_required');
$input_phone_required = $params->get('input_phone_required');

JPluginHelper::importPlugin('captcha');
$dispatcher = JDispatcher::getInstance();
$dispatcher->trigger('onInit','dynamic_recaptcha_2');
?>


<?php
    if($_POST["cmbf-phone-".$id_module] && $_POST["sp-text"] == '') {

        $cmbf_phone = $_POST["cmbf-phone-".$id_module];
        $cmbf_name = $_POST["cmbf-name-".$id_module];

        $body = $input_name.': '.$cmbf_name.'<br>'.$input_phone.': '.$cmbf_phone;
        
        $config = JFactory::getConfig();
        $sender = array( 
            $config->get( 'mailfrom' ),
            $config->get( 'fromname' ) 
        );
        
        $mailer = JFactory::getMailer();
        
        $mailer->setSender($sender);
        $mailer->addRecipient($my_email);
        $mailer->setSubject($subject_mail);
        $mailer->setBody($body);
        $mailer->isHTML();
        $mailer->send();
    }
?>


<?php if ( $use_as != 'inline-form' ) : ?>
<!--    <button id="cmbf-button-container---><?php //echo $id_module; ?><!--" class="cmbf-button-container cmbf---><?php //echo $use_as; ?><!--">--><?php //echo $params->get('button_name'); ?><!--</button>-->
 <!--   <a id="cmbf-button-container-<?php echo $id_module; ?>" class="header-top__phone-call"><?php echo $params->get('button_name'); ?></a>
    <div class="cmbf-obfuscator" id="cmbf-obfuscator-<?php echo $id_module; ?>"></div> -->
	<a class="header-top__phone-call js-callback" href="#">Заказать обратный звонок</a>
<?php endif; ?>



<div id="cmbf-form-container-<?php echo $id_module; ?>" class="overlay -callback <?php if ($use_as != 'inline-form') { echo 'cmbf-form-modal';} else { echo 'cmbf-form-inline'; }?>">
    <button class="overlay__bg"></button>

    <div class="overlay__center">
        <button id="cmbf-form-close-<?php echo $id_module; ?>" class="overlay__close">Закрыть</button>
        <p class="overlay__heading"><?php echo $form_title; ?></p>
        <div class="overlay__content">
            <p><?php echo $form_description; ?></p>
            <div class="overlay__form form ">
                <form id="cmbf-form-<?php echo $id_module; ?>" class="cmbf-form-class" method="post" action="">
                    <div class="cmbf-field-container col-1">
                        <div class="form__item -name has-content">
                            <label for="form__item-name">Ваше имя</label>
                            <input type="text" required name="cmbf-name-<?php echo $id_module; ?>" placeholder="<?php echo $input_name; ?>">
                            <div class="form__item-error"></div>
                        </div>
                    </div>
                    <div class="cmbf-field-container col-2">
                        <div class="form__item -email-phone">
                            <label for="form__item-email-phone">Телефон*</label>
                            <input type="text" required name="cmbf-phone-<?php echo $id_module; ?>" id="cmbf-phone-<?php echo $id_module; ?>" placeholder="<?php echo $input_phone; ?>">
<!--                            <div class="error"><ul><li>Неверный формат</li></ul></div>-->
                        </div>
                    </div>
                    <div class="cmbf-field-container col-3">
                        <div class="custom-checkbox">
                            <label for="app_sample_choice_privacy-policy-3" class="required">
                                <input type="checkbox" id="app_sample_choice_privacy-policy-3" value="1" required="" checked="">
                                <span>Я согласен на обработку персональных данных. <a href="">Политика конфиденциальности</a></span>
                            </label>
                        </div>
                        <input name="sp-text" style="display: none" >
                        <input class="contacts__form-btn btn" type="submit" name="submit-<?php echo $id_module; ?>" value="<?php echo $send_button; ?>">
                    </div>

                    <div class="cmbf-success">
                        <?php echo $form_thanks; ?>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>



<script>
    jQuery("#cmbf-phone-<?php echo $id_module; ?>").mask("<?php echo $phone_mask ?>");

    jQuery('document').ready(function() {
        jQuery('#cmbf-form-<?php echo $id_module; ?> input').focus( function() { 
                jQuery(this).parents().eq(1).removeClass("valid-error");
        });
        jQuery('#cmbf-form-<?php echo $id_module; ?>').on('submit', function (event) {
            var form = jQuery(this);
            var error = false;

            form.find('input[type="text"]').each(function() {
                if (!jQuery(this).val().length) {
                    jQuery(this).parents().eq(1).addClass("valid-error");
                    error = true;
                }
            });

            if (!error)
            {
                ajaxsendmessage();
            }

            function ajaxsendmessage() {
                jQuery.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: form.serialize(),
                    cache: false,
                    beforeSend: function() {
                        form.find('input[type="submit"]').attr('value', '<?php echo $send_button_after; ?>');
                        form.find('input[type="submit"]').attr('disabled', 'disabled');
                    },
                    success: function () {
                            form.find('.cmbf-field-container').slideUp('fast');
                            form.find('.cmbf-success').slideDown("fast");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        event.preventDefault();
        });

        jQuery('#cmbf-button-container-<?php echo $id_module; ?>').click(function() {
            jQuery('#cmbf-form-container-<?php echo $id_module; ?>, #cmbf-obfuscator-<?php echo $id_module; ?>').fadeIn('slow');
        });

        jQuery('#cmbf-obfuscator-<?php echo $id_module; ?>, #cmbf-form-close-<?php echo $id_module; ?>').click(function() {
            jQuery('#cmbf-form-container-<?php echo $id_module; ?>, #cmbf-obfuscator-<?php echo $id_module; ?>').fadeOut('slow');
        });
    }); 
</script>



