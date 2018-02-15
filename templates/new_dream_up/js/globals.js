// Constants
var AJAX_LOADER  = '<img src="/assets/images/loader.svg" width="20" height="20">';
var NOTY_TIMEOUT = 1000;

// Functions
var notify = function (text, type) {
    if (!text) {
        return;
    }

    type = type || 'success';

    new Noty({
        text:    Translator.trans(text),
        type:    type,
        timeout: NOTY_TIMEOUT
    }).show();
};

var onAjaxFail = function (jqXHR) {
    var translation = 'error.' + jqXHR.status;
    var text = Translator.trans(translation);

    notify(text !== translation ? text : [jqXHR.status, jqXHR.statusText].join(' '), 'error');
};

var ajaxSubmit = function (form) {
    var $form = $(form);

    var $submit       = $form.find('button[type="submit"]:first');
    var submitContent = null;

    if ($submit.length) {
        submitContent = $submit.html();
        $submit.html(AJAX_LOADER);
    }

    if($form.data('button-id') !== undefined)
    {
        var $submit_link       = $('#'+$form.data('button-id'));
        var submitLinkContent = null;
        if($submit_link !== undefined){
            if ($submit_link.length) {
                submitLinkContent = $submit_link.html();
                $submit_link.html(AJAX_LOADER);
            }
        }
    }

    $.ajax({
        url:         $form.attr('action'),
        type:        $form.attr('method'),
        data:        new FormData($form[0]),
        processData: false,
        contentType: false
    }).done(
        /**
         * @param data.html
         * @param data.message
         * @param data.redirectUrl
         * @param data.success
         */
        function (data) {
            notify(data.message, data.success ? 'success' : 'error');

            if (data.redirectUrl) {
                setTimeout(function () {
                    location.href = data.redirectUrl;
                }, NOTY_TIMEOUT);

                return;
            }
            if (data.success) {
                var event = new $.Event('app.ajaxSubmit');

                $form.trigger(event, data);

                if (event.isDefaultPrevented()) {
                    return;
                }
            }
            if (data.html) {
                var $html = $(data.html);
                var $replacement = $html.is('form') ? $html : $html.find('form:first');

                $form.replaceWith($replacement.length ? $replacement : $html);
            }
        }
    ).always(function () {
        $form.removeData('submitted');

        if ($submit.length) {
            $submit.html(submitContent);
        }

        if($form.data('button-id') !== undefined)
        {
            if($submit_link !== undefined){
                $submit_link.html(submitLinkContent);
            }
        }

    }).fail(onAjaxFail);
};
