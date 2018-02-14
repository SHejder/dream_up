var j$ = jQuery.noConflict();
jQuery(document).ready(function () {
    var ajlinks = jQuery('a.product__quick-show');
    jQuery(ajlinks).each(function (idx, el) {
        var oldhref = jQuery(el).attr('href');
        jQuery(el).attr('href', oldhref + '?ajcom=shop');
    });
    j$(ajlinks).fancybox({
        maxWidth: 800,
        maxHeight: 600,
        fitToView: false,
        width: '60%',
        height: '60%',
        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none'
    });
});