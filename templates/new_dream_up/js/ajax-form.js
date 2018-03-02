// $(document).ready(function () {
//     $('body').on('submit', 'form[action][method].ajax', function (e) {
//         e.preventDefault();
//
//         var $form = $(this);
//         console.log($form.find('.product__buy'));
//
//         if ($form.data('submitted')) {
//             return;
//         }
//
//
//         ajaxSubmit($form.data('submitted', true));
//         $form.find('.product__buy').addClass('add_more');
//         $form.find('.product__buy').val('ДОБАВИТЬ ЕЩЕ');
//
//     });
//
// });

jQuery(document).ready(function () {
       jQuery('body').on('submit', 'form[action][method].ajax', function (e) {
        e.preventDefault();
        var $form = jQuery(this);

        ajaxSubmit($form.data('submitted', true));
        // return false;

    });



});

