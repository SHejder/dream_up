// Constants
var AJAX_LOADER = '<img src="/templates/new_dream_up/images/loader.svg" width="20" height="20">';
var NOTY_TIMEOUT = 1000;

// Functions
var notify = function (text, type) {
    if (!text) {
        return;
    }

    type = type || 'success';

    new Noty({
        text: Translator.trans(text),
        type: type,
        timeout: NOTY_TIMEOUT
    }).show();
};

var onAjaxFail = function (jqXHR) {
    var translation = 'error.' + jqXHR.status;
    var text = Translator.trans(translation);

    notify(text !== translation ? text : [jqXHR.status, jqXHR.statusText].join(' '), 'error');
};

var ajaxSubmit = function (form) {
    var $form = jQuery(form);

    jQuery.ajax({
        url: $form.attr('action'),
        dataType: 'json',
        type: $form.attr('method'),
        data: new FormData($form[0]),
        processData: false,
        contentType: false
    }).always(
        function (data) {
            console.log(data);
            if (Array.isArray(data)) {
                alert(data[0]['message']);
            }
            else if (data.type_cart !== undefined) {
                jQuery('.header-top__cart-cost').text(data.price_product + ' ₽');
                jQuery('.header-top__cart-count').text(data.count_product + ' шт');
                alert('Товар добавлен в корзину!');
            } else {
                alert ('что то не так');
            }


        })
};
