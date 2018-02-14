<?php
/**
 * @package Gantry Template Framework - RocketTheme
 * @version 3.2.15 January 25, 2012
 * @author RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );

// load and inititialize gantry class
require_once('lib/gantry/gantry.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >
    <head>
        <?php
            $gantry->displayHead();
            $gantry->addStyles(array('template.css','joomla.css','style.css','custom.css'));
        ?>
        
        <link rel="shortcut icon" href="<?php echo JURI::base().'templates/'.$this->template; ?>/images/favicon.ico"/>

        
    </head>
    <body <?php echo $gantry->displayBodyTag(); ?>>
    <!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter22759363 = new Ya.Metrika({id:22759363,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/22759363" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
      <div class="header-wrapper">
        <?php /** Begin Drawer **/ if ($gantry->countModules('drawer')) : ?>
        <div id="rt-drawer">
            <div class="rt-container">
                <?php echo $gantry->displayModules('drawer','standard','standard'); ?>
                <div class="clear"></div>
            </div>
        </div>
        <?php /** End Drawer **/ endif; ?>
    <?php /** Begin Top **/ if ($gantry->countModules('top')) : ?>
    <div id="rt-top" <?php echo $gantry->displayClassesByTag('rt-top'); ?>>
      <div class="rt-container">
        <?php echo $gantry->displayModules('top','standard','standard'); ?>
        <div class="clear"></div>
      </div>
    </div>
    <?php /** End Top **/ endif; ?>
        
    <?php /** Begin Header **/ if (($gantry->countModules('logo')) || ($gantry->countModules('navigation')) || ($gantry->countModules('search')) ) : ?>
    <div id="bd-header">
      <div class="bd-container">
              <?php /** Begin Header **/ if ($gantry->countModules('logo')) : ?>
        <div id="logo">
        <?php echo $gantry->displayModules('logo','basic','basic'); ?>
        <div class="clear"></div>
                </div>
                <?php /** End Header **/ endif; ?>
          <div class="social">
              <a class="vk" target="_blank" href="https://vk.com/club13710874"></a>
              <a class="ig" target="_blank" href="https://www.instagram.com/dream_up_rukodelie/"></a>
          </div>
                <?php /** Begin Menu **/ if ($gantry->countModules('bookmark')) : ?>
                <div id="bookmark" align="center">
                    <div id="bd-bookmark">
                        <?php echo $gantry->displayModules('bookmark','basic','basic'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
                <?php /** End Menu **/ endif; ?>
        <?php /** Begin Menu **/ if ($gantry->countModules('search')) : ?>
                <div id="search">
                    <div id="bd-search">
                        <?php echo $gantry->displayModules('search','basic','basic'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
                <?php /** End Menu **/ endif; ?>
         <?php /** Begin Menu **/ if ($gantry->countModules('navigation')) : ?>
                <div id="navigation">
                    <div id="rt-menu">
                        <?php echo $gantry->displayModules('navigation','basic','basic'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
                <?php /** End Menu **/ endif; ?>
                
      </div>
    </div>

         <?php /** End Menu **/ endif; ?>
        
    <?php /** Begin Showcase **/ if ($gantry->countModules('showcase')) : ?>
    <div id="rt-showcase">
      <div class="rt-container">
        <?php echo $gantry->displayModules('showcase','standard','basic'); ?>
        <div class="clear"></div>
      </div>
    </div>
    <?php /** End Showcase **/ endif; ?>
        </div>
<div class="body-wrapper">
    <?php /** Begin Feature **/ if ($gantry->countModules('feature')) : ?>
    <div id="rt-feature">
      <div class="rt-container">
        <?php echo $gantry->displayModules('feature','standard','standard'); ?>
        <div class="clear"></div>
      </div>
    </div>
    <?php /** End Feature **/ endif; ?>
    <?php /** Begin Utility **/ if ($gantry->countModules('utility')) : ?>
    <div id="rt-utility">
      <div class="rt-container">
        <?php echo $gantry->displayModules('utility','standard','basic'); ?>
        <div class="clear"></div>
      </div>
    </div>
    <?php /** End Utility **/ endif; ?>
    <?php /** Begin Breadcrumbs **/ if ($gantry->countModules('breadcrumb')) : ?>
    <div id="rt-breadcrumbs">
      <div class="rt-container">
        <?php echo $gantry->displayModules('breadcrumb','standard','standard'); ?>
        <div class="clear"></div>
      </div>
    </div>
    <?php /** End Breadcrumbs **/ endif; ?>
    <?php /** Begin Main Top **/ if ($gantry->countModules('maintop')) : ?>
    <div id="rt-maintop">
      <div class="rt-container">
        <?php echo $gantry->displayModules('maintop','standard','standard'); ?>
        <div class="clear"></div>
      </div>
    </div>
    <?php /** End Main Top **/ endif; ?>
    <?php /** Begin Main Body **/ ?>
      <?php echo $gantry->displayMainbody('mainbody','sidebar','standard','standard','standard','standard','standard'); ?>
    <?php /** End Main Body **/ ?>
    <?php /** Begin Main Bottom **/ if ($gantry->countModules('mainbottom')) : ?>
    <div id="rt-mainbottom">
      <div class="rt-container">
        <?php echo $gantry->displayModules('mainbottom','standard','standard'); ?>
        <div class="clear"></div>
      </div>
    </div>
    <?php /** End Main Bottom **/ endif; ?>
    <?php /** Begin Bottom **/ if ($gantry->countModules('bottom')) : ?>
    <div id="rt-bottom">
      <div class="rt-container">
        <?php echo $gantry->displayModules('bottom','standard','standard'); ?>
        <div class="clear"></div>
      </div>
    </div>
    <?php /** End Bottom **/ endif; ?>

 </div>
 <div class="footer-wrapper">
 
    <?php /** Begin Footer **/ if ($gantry->countModules('footer')) : ?>
    <div id="rt-footer">
      <div class="rt-container">
        <?php echo $gantry->displayModules('footer','standard','standard'); ?>
        <div class="clear"></div>
      </div>
    </div>
    <?php /** End Footer **/ endif; ?>
    <?php /** Begin Copyright **/ if ($gantry->countModules('copyright')) : ?>
    <div id="rt-copyright">
      <div class="rt-container">
        <?php echo $gantry->displayModules('copyright','standard','standard'); ?>
        <br/><hr/><br/>
        <div id="copyright">
            © 2013-17
            <a href="/kontakty" title="Владелец сайта">Dream Up</a>
        </div>
          <div class="social">
              <a class="vk" target="_blank" href="https://vk.com/club13710874"></a>
              <a class="ig" target="_blank" href="https://www.instagram.com/dream_up_rukodelie/"></a>
          </div>
          <div class="clear"></div>
      </div>
    </div>
    <?php /** End Copyright **/ endif; ?>
    <?php /** Begin Debug **/ if ($gantry->countModules('debug')) : ?>
    <div id="rt-debug">
      <div class="rt-container">
        <?php echo $gantry->displayModules('debug','standard','standard'); ?>
        <div class="clear"></div>
      </div>
    </div>
    <?php /** End Debug **/ endif; ?>
        
 </div>
    <?php /** Begin Analytics **/ if ($gantry->countModules('analytics')) : ?>
    <?php echo $gantry->displayModules('analytics','basic','basic'); ?>
    <?php /** End Analytics **/ endif; ?>
    <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter22759363 = new Ya.Metrika({
                    id:22759363,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/22759363" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
  </body>
</html>
<?php
$gantry->finalize();
?>
