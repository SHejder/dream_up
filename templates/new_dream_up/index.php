<?php
defined('_JEXEC') or die;
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$menu = $app->getMenu();
$lang = JFactory::getLanguage();
$user = JFactory::getUser();

$template_url = $this->baseurl . '/templates/' . $this->template;
$doc->addStyleSheet($template_url . '/css/vendor.min.css');
$doc->addStyleSheet($template_url . '/css/ui.min.css');
$doc->addStyleSheet($template_url . '/css/main.css');

$is_home_page = $menu->getActive() == $menu->getDefault($lang->getTag());
$urls=array('/katalog/cart/view','/component/users/','/katalog/checkout/step2',
    '/katalog/checkout/step3','/katalog/checkout/step4','/katalog/checkout/step5',);

?>

<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <jdoc:include type="head"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body class="<?php if ($is_home_page) { ?>homepage<?php } else { ?>inner-page<?php } ?> <?php if (($menu->getActive()->title == "Вход в личный кабинет") || in_array(JFactory::getURI()->getPath(),$urls))  { ?>head-over-heels<?php } ?>">
<!-- WRAPPER begin -->
<div class="layout-wrapper">
    <!-- HEADER begin -->
    <header class="layout-header">
        <div class="header-top">
            <div class="header-top__center">
                <div class="header-top__left-block">
                    <div class="header-top__phone">
                        <a class="header-top__phone-number" href="tel:+79101855497">+7 (910) 185-54-97</a>
<!--                        <a class="header-top__phone-call" href="">Заказать обратный звонок</a>-->
                        <jdoc:include type="modules" name="call_back"/>
                    </div>
                    <div class="header-top__work-time">
                        Пн-Пт с 10<sup>00</sup> до 20<sup>00</sup>
                        <span>•</span>
                        Сб-Вс с 10<sup>00</sup> до 19<sup>00</sup>
                    </div>
                </div>
                <div class="header-top__right-block">
                    <?php if ($user->get('id')) { ?>
                        <span class="header-top__sing-in">Здравствуйте, <a
                                    href="/vkhod-v-lichnyj-kabinet/myaccount"><?php echo $user->get('username') ?></a> !</span>
                    <?php } else { ?>
                        <jdoc:include type="modules" name="klienti"/>
                    <?php } ?>
                    <div class="header-top__social">
                        <a class="header-top__social-item" href="https://www.instagram.com/dream_up_rukodelie/" target="_blank" rel="noreferrer noopener">
                            <img src="<?php echo $template_url . '/images/social-item__inst.png' ?>" alt="Instagram"
                                 title="Instagram">
                        </a>
                        <a class="header-top__social-item" href="https://vk.com/club13710874" target="_blank" rel="noreferrer noopener">
                            <img src="<?php echo $template_url . '/images/social-item__vk.png' ?>" alt="VKontakte"
                                 title="VKontakte">
                        </a>
                        <a class="header-top__social-item" href="https://www.facebook.com/%D0%9B%D0%B0%D0%B2%D0%BA%D0%B0-%D1%80%D1%83%D0%BA%D0%BE%D0%B4%D0%B5%D0%BB%D0%B8%D1%8F-Dream-Up-1057985020935693/" target="_blank" rel="noreferrer noopener">
                            <img src="<?php echo $template_url . '/images/social-item__fb.png' ?>" alt="FaceBook"
                                 title="FaceBook">
                        </a>
                        <a class="header-top__social-item" href="https://www.youtube.com/user/kyanlu1988/" target="_blank" rel="noreferrer noopener">
                            <img src="<?php echo $template_url . '/images/social-item__yt.png' ?>" alt="YouTube"
                                 title="YouTube">
                        </a>
                        <a class="header-top__social-item" href="https://ok.ru/profile/575127092127" target="_blank" rel="noreferrer noopener">
                            <img src="<?php echo $template_url . '/images/social-item__ok.png' ?>" alt="Одноклассники"
                                 title="Одноклассники">
                        </a>
                        <a class="header-top__social-item" href="whatsapp://send?phone=+79101855497&abid=+79101855497" target="_blank" rel="noreferrer noopener">
                            <img src="<?php echo $template_url . '/images/social-item__whatsapp.png' ?>" alt="Whats App"
                                 title="Whats App">
                        </a>
                        <a class="header-top__social-item" href="viber://chat?number=+79101855497" target="_blank" rel="noreferrer noopener">
                            <img src="<?php echo $template_url . '/images/social-item__viber.png' ?>" alt="Viber"
                                 title="Viber">
                        </a>
                    </div>
                    <jdoc:include type="modules" name="cart"/>
                </div>
                <a href="<?php echo $this->baseurl ?>" class="header-top__logo"><img src="<?php echo $template_url . '/images/logo-header.png' ?>"
                                                          alt="Интернет-магазин Dream Up — товары для творчества и рукоделия"></a>
            </div>
        </div><!-- header-top end -->
        <div class="slider-header">
            <div class="owl-carousel js-slider-header">
                <div class="item slider-header__item">
                    <img class="slider-header__img" src="<?php echo $template_url . '/images/slide-1.jpg' ?>"
                         alt="Слайд">
                    <div class="slider-header__text-container">
                        <p class="-title">Все материалы</p>
                        <div class="slider-header__sep"></div>
                        <p>для рукоделия и творчества в одном месте</p>
                    </div>
                </div>
                <div class="item slider-header__item">
                    <img class="slider-header__img" src="<?php echo $template_url . '/images/slide-2.jpg' ?>"
                         alt="Второй слайд">
                    <div class="slider-header__text-container">
                        <p class="-title">Толстая пряжа для ручного вязания</p>
                        <div class="slider-header__sep"></div>
                        <p>100% шерсть мериноса</p>
                    </div>
                </div>
            </div>
        </div><!-- header-slider end -->
        <nav class="menu-top">
            <jdoc:include type="modules" name="navigation"/>
        </nav>

    </header>

    <!-- шапка для адаптива -->
    <div class="header-mobile">
        <div class="header-mobile__bar">
            <a href="" class="header-mobile__logo">
                <img src="<?php echo $template_url . '/images/header-mobile__logo.png' ?>" alt="">
            </a>
            <div class="header-mobile__toolbar">
                <button class="header-mobile__toolbar-item" data-class="-user"><img
                            src="<?php echo $template_url . '/images/header-mobile-toolbar-item-user.png' ?>" alt="">
                </button>
                <button class="header-mobile__toolbar-item" data-class="-phone"><img
                            src="<?php echo $template_url . '/images/header-mobile-toolbar-item-phone.png' ?>" alt="">
                </button>
                <button class="header-mobile__toolbar-item" data-class="-search"><img
                            src="<?php echo $template_url . '/images/header-mobile-toolbar-item-search.png' ?>" alt="">
                </button>
                <button class="header-mobile__toolbar-item" data-class="-cart"><img
                            src="<?php echo $template_url . '/images/header-mobile-toolbar-item-cart.png' ?>" alt="">
                </button>
                <button class="header-mobile__toolbar-item" data-class="-menu"><img
                            src="<?php echo $template_url . '/images/header-mobile-toolbar-item-menu.png' ?>" alt="">
                </button>
            </div>
        </div>
        <div class="header-mobile__switch-elements">
            <div class="header-mobile__element -user">
                <?php if ($user->get('id')) { ?>
                <div class="header-top__sing-in-wrap">Здравствуйте, <?php echo $user->get('username') ?></div>
                    <nav class="menu-top">
                        <ul>
                            <li><a href="/vkhod-v-lichnyj-kabinet/myaccount">Профиль</a></li>
                            <li><a href="/vkhod-v-lichnyj-kabinet/orders">Мои заказы</a></li>
                            <li><a href="/vkhod-v-lichnyj-kabinet/logout" >Выход </a></li>
                        </ul>
                    </nav>
                <?php } else {?>

                <div class="header-mobile__form form">
                    <p class="header-mobile__form-title">Авторизация</p>
                    <form method="post"
                          action="<?php print SEFLink('index.php?option=com_jshopping&controller=user&task=loginsave', 1, 0, $this->config->use_ssl) ?>"
                          name="jlogin" class="form-horizontal">
                        <div class="form__item -name has-content">
                            <label><?php print _JSHOP_USERNAME ?></label>
                            <input type="text" name="username" placeholder="Логин">
                            <div class="form__item-error"></div>
                        </div>
                        <div class="form__item -email-password">
                            <label><?php print _JSHOP_PASSWORT ?></label>
                            <input type="password" name="passwd" placeholder="Пароль">
                            <!--                    <div class="error">-->
                            <!--                        <ul>-->
                            <!--                            <li>Неверный пароль</li>-->
                            <!--                        </ul>-->
                            <!--                    </div>-->
                        </div>
                        <div class="custom-checkbox">
                            <label class="required">
                                <input type="checkbox" name="remember" value="1" required="" checked="">
                                <span><?php print _JSHOP_REMEMBER_ME ?></span>
                            </label>
                        </div>
                        <button class="homepage-bottom__form-btn btn" type="submit">Отправить</button>
                        <a href="<?php print $this->href_lost_pass ?>"><?php print _JSHOP_LOST_PASSWORD ?></a>
                        <input type="hidden" name="return" value="<?php print $this->return ?>"/>
                        <?php echo JHtml::_('form.token'); ?>
                        <?php echo $this->tmpl_login_html_3 ?>
                    </form>
                    <?php if (!$this->config->show_registerform_in_logintemplate) { ?>
                        <span class="small_header"><?php print _JSHOP_HAVE_NOT_ACCOUNT ?>?</span>
                        <div class="logintext">
                            <a href="<?php print $this->href_register ?>">Зарегистрируйтесь</a> пожалуйста!
                        </div>
                    <?php } ?>

                </div>
                <?php } ?>
                <!-- homepage-bottom__form end -->
            </div>
            <div class="header-mobile__element -phone"></div>
            <div class="header-mobile__element -search"></div>
            <div class="header-mobile__element -cart"></div>
            <div class="header-mobile__element -menu"></div>
        </div>
    </div><!-- header-mobile end -->
    <!-- HEADER end -->

    <!-- MAIN begin -->
    <div class="layout-main">

        <div class="container">

            <div class="layout-sidebar">
                <div class="form-search">
                    <jdoc:include type="modules" name="search"/>
                </div>
                <div class="menu-left">
                    <p class="menu-left__title">Каталог товаров</p>
                    <nav>
                        <jdoc:include type="modules" name="sidebar-cat"/>
                    </nav>
                </div>
            </div><!-- layout-sidebar end -->
            <main class="layout-content">
                <?php if (!$is_home_page) { ?>
                    <jdoc:include type="modules" name="breadcrumb"/>
                <?php } ?>
                <jdoc:include type="component"/>

                <?php if ($is_home_page) { ?>
                    <div class="plus js-plus-list">
                        <h2>6 причин выбрать нас</h2>
                        <div class="plus__list">
                            <div class="plus__item">
                                <div class="plus__item-img">
                                    <img src="<?php echo $template_url . '/images/plus-1.png' ?>" alt="Все материалы ">
                                </div>
                                <p class="plus__item-name">Все материалы </p>
                                <p class="plus__item-text">для рукоделия в одном месте</p>
                            </div>
                            <div class="plus__item">
                                <div class="plus__item-img">
                                    <img src="<?php echo $template_url . '/images/plus-2.png' ?>"
                                         alt="Широкий ассортимент">
                                </div>
                                <p class="plus__item-name">Широкий ассортимент</p>
                                <p class="plus__item-text">более 7000 товаров</p>
                            </div>
                            <div class="plus__item">
                                <div class="plus__item-img">
                                    <img src="<?php echo $template_url . '/images/plus-3.png' ?>"
                                         alt="Бесплатная доставка">
                                </div>
                                <p class="plus__item-name">Бесплатная доставка</p>
                                <p class="plus__item-text">от 3000 ₽</p>
                            </div>
                            <div class="plus__item">
                                <div class="plus__item-img">
                                    <img src="<?php echo $template_url . '/images/plus-4.png' ?>" alt="Более 8 лет">
                                </div>
                                <p class="plus__item-name">Более 8 лет</p>
                                <p class="plus__item-text">работаем на рынке рукоделия</p>
                            </div>
                            <div class="plus__item">
                                <div class="plus__item-img">
                                    <img src="<?php echo $template_url . '/images/plus-5.png' ?>" alt="Короткие сроки">
                                </div>
                                <p class="plus__item-name">Короткие сроки</p>
                                <p class="plus__item-text">сборки заказов</p>
                            </div>
                            <div class="plus__item">
                                <div class="plus__item-img">
                                    <img src="<?php echo $template_url . '/images/plus-6.png' ?>" alt="Удобный сервис">
                                </div>
                                <p class="plus__item-name">Удобный сервис</p>
                                <p class="plus__item-text">и грамотные специалисты</p>
                            </div>
                        </div>
                    </div><!--plus end -->

                    <div class="product-carousel js-product-carousel">

                        <h2>Лидеры продаж</h2>

                        <jdoc:include type="modules" name="bestseller"/>
                    </div><!-- product-carousel end -->

                    <div class="product-carousel js-product-carousel">

                        <h2>Новинки</h2>
                        <jdoc:include type="modules" name="last_products"/>
                    </div><!-- product-carousel end -->
                <?php } ?>

            </main><!-- layout-content end -->


        </div>

    </div>
    <!-- MAIN end -->
    <?php if ($is_home_page) { ?>

        <div class="homepage-bottom">

            <div class="homepage-bottom__videos js-homepage-bottom-videos">
                <h2>Наши видеоматериалы</h2>
                <div class="homepage-bottom__videos-list owl-carousel">
                    <div class="homepage-bottom__videos-item">
                        <div>
                            <iframe src="https://www.youtube.com/embed/yIB6999LGUc" gesture="media"
                                    allow="encrypted-media"
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="homepage-bottom__videos-item">
                        <div>
                            <iframe src="https://www.youtube.com/embed/EgiCpZqR5qk" gesture="media"
                                    allow="encrypted-media"
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="homepage-bottom__videos-item">
                        <div>
                            <iframe src="https://www.youtube.com/embed/-5baPi3H1wQ" gesture="media"
                                    allow="encrypted-media"
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div><!-- homepage-bottom__videos end -->

            <div class="homepage-bottom__form form">
                <h2>Остались вопросы? Напишите нам!</h2>
                <jdoc:include type="modules" name="feedback"/>
            </div>


            <div class="homepage-bottom__map">
                <iframe src="https://yandex.ru/map-widget/v1/-/CBalvVBd~B"></iframe>
            </div><!-- homepage-bottom__map end -->

        </div><!-- homepage-bottom end -->
    <?php } ?>

    <!-- FOOTER begin -->
    <footer class="layout-footer">
        <div class="footer">
            <div class="footer__center">
                <div class="footer__contacts">
                    <a class="footer__phone" href="tel:+79101855497">+7 (910) 185-54-97</a>
                    <p class="footer__copywrite">© 2013 — <?php echo date('Y') ?> г. Dream Up, все права защищены.</p>
                </div>
                <div class="footer__social">
                    <a class="footer__social-item" href="https://www.instagram.com/dream_up_rukodelie/" target="_blank" rel="noreferrer noopener">
                        <img src="<?php echo $template_url . '/images/social-item-footer__inst.png' ?>" alt="Instagram"
                             title="Instagram">
                    </a>
                    <a class="footer__social-item" href="https://vk.com/club13710874" target="_blank" rel="noreferrer noopener">
                        <img src="<?php echo $template_url . '/images/social-item-footer__vk.png' ?>" alt="VKontakte"
                             title="VKontakte">
                    </a>
                    <a class="footer__social-item" href="https://www.facebook.com/%D0%9B%D0%B0%D0%B2%D0%BA%D0%B0-%D1%80%D1%83%D0%BA%D0%BE%D0%B4%D0%B5%D0%BB%D0%B8%D1%8F-Dream-Up-1057985020935693/" target="_blank" rel="noreferrer noopener">
                        <img src="<?php echo $template_url . '/images/social-item-footer__fb.png' ?>" alt="FaceBook"
                             title="FaceBook">
                    </a>
                    <a class="footer__social-item" href="https://www.youtube.com/user/kyanlu1988/" target="_blank" rel="noreferrer noopener">
                        <img src="<?php echo $template_url . '/images/social-item-footer__yt.png' ?>" alt="YouTube"
                             title="YouTube">
                    </a>
                    <a class="footer__social-item" href="https://ok.ru/profile/575127092127" target="_blank" rel="noreferrer noopener">
                        <img src="<?php echo $template_url . '/images/social-item-footer__ok.png' ?>" alt="Одноклассники"
                             title="Одноклассники">
                    </a>
                    <a class="footer__social-item" href="whatsapp://send?phone=+79101855497&abid=+79101855497" target="_blank" rel="noreferrer noopener">
                        <img src="<?php echo $template_url . '/images/social-item-footer__whatsapp.png' ?>" alt="Whats App"
                             title="Whats App">
                    </a>
                    <a class="footer__social-item" href="viber://chat?number=+79101855497" target="_blank" rel="noreferrer noopener">
                        <img src="<?php echo $template_url . '/images/social-item-footer__viber.png' ?>" alt="Viber"
                             title="Viber">
                    </a>
                </div>


                <a class="footer__logo" href="">
                    <img src="<?php echo $template_url . '/images/logo-footer.png' ?>" alt="">
                </a>
            </div>
        </div>
    </footer>
    <!-- FOOTER end -->

    <button class="scroll-top js-scroll-top" data-speed="500" data-offset-top="105" style="display:none;">to top
    </button>


    <!--scripts-->
    <!--/scripts-->
</div>
<!-- WRAPPER end -->
<script src="<?php echo $template_url . '/js/vendor.min.js' ?>"></script>
<script src="<?php echo $template_url . '/js/main.js' ?>"></script>
<script src="<?php echo $template_url . '/js/globals.js' ?>"></script>
<script src="<?php echo $template_url . '/js/ajax-link.js' ?>"></script>
<script src="<?php echo $template_url . '/js/ajax-form.js' ?>"></script>

</body>
</html>
