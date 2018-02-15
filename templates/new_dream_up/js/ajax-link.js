$(document).ready(function () {
    $('body')
        .on('click', 'a[href].ajax', function (e) {
            e.preventDefault();

            var $link = $(this);

            if ($link.data('clicked')) {
                return;
            }

            var linkContent = $link.html();
            $link.data('clicked', true).html(AJAX_LOADER);

            $.ajax({
                url: $link.attr('href')
            }).done(function (html) {
                if (html) {
                    var $html = $(html);
                    var $replacement = $html.is('.product-cart') ? $html : $html.find('.product-cart:first');
                    console.log($replacement[0]);
                    $('body').append(
                    '<div class="overlay -quick-veiw">'+
                        '<button class="overlay__bg"></button>'+
                        '<div class="overlay__center">'+
                        '<button class="overlay__close">Закрыть</button>'+
                        '<div class="overlay__content">'+


                        $replacement[0].innerHTML +
                        '</div>' +
                        '</div>'+
                        '</div>'
                    );
                    jQuery('.overlay input[type="number"]').customNumber();
                    (function productsImagesWidget() {
                        jQuery(".js-product-images-carousel").each(function () {
                            var productsImagesWidget = {
                                carousel : jQuery(this).find(".owl-carousel"),
                                items : jQuery(this).find('.image-prev__item'),
                                nextBtn : jQuery(this).find(".js-nav-next"),
                                prevBtn : jQuery(this).find(".js-nav-prev")
                            };
                            productsImagesWidget.carousel.owlCarousel({
                                center: false,
                                nav: false,
                                dots: false,
                                loop: true,
                                autoWidth: false,
                                margin: 10,
                                items:3
                            });
                            productsImagesWidget.nextBtn.click(function() {
                                productsImagesWidget.carousel.trigger('next.owl.carousel');
                            });
                            productsImagesWidget.prevBtn.click(function() {
                                productsImagesWidget.carousel.trigger('prev.owl.carousel');
                            });

                            productsImagesWidget.items.on('click', function () {
                                jQuery('.product-cart__image-big').find("img").attr('src', jQuery(this).attr("data-src-big"));
                                productsImagesWidget.items.removeClass('is-active');
                                jQuery(this).addClass('is-active');
                            });
                        });

                    }());


                }



            }).always(function () {
                $link.removeData('clicked').html(linkContent);
            }).fail(onAjaxFail);
        })
        .on('click', '#window', function (e) {
            if (e.target === this) {
                $(this).find('.window__close:first').trigger('click');
            }
        })
        .on('click', '.window__close', function (e) {
            e.preventDefault();

            $('#window').remove();
            $('.overlay_dark').remove();
        })
        .on('click', '.overlay_dark', function (e) {
            if (e.target === this) {
                $('body').find('#overlay_close').trigger('click');
                $('.overlay_dark').remove();
            }
        })
        .on('click', '#window .window__close', function (e) {
            e.preventDefault();

            $('#window').remove();
            $('.overlay_dark').remove();
        });
});
