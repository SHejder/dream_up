$(document).ready(function () {
    $('body').on('submit', 'form[action][method].ajax', function (e) {
        e.preventDefault();

        var $form = $(this);

        if ($form.data('submitted')) {
            return;
        }


        // ajaxSubmit($form.data('submitted', true));
    });

});
