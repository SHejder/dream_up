<?php
/**
 * @package 	Gantry Template Framework - RocketTheme
 * @version 	3.2.13 December 1, 2011
 * @author 		RocketTheme http://www.rockettheme.com
 * @copyright	Copyright (C) 2007 - 2011 RocketTheme, LLC
 * @license 	http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();

$gantry_config_mapping = array(
    'belatedPNG' => 'belatedPNG',
	'ie6Warning' => 'ie6Warning'
);

$gantry_presets = array(
    'presets' => array(
        'preset1' => array(
            'name' => 'Preset 1',
			'headerstyle-headerbgcolor' => '#222222',
			'headerstyle-headerbgpattern' => '19',
			'bodystyle-bodybgcolor' => '#FFFFFF',
			'bodystyle-bodybgpattern' => '12',
            'footerstyle-footerbgcolor' => '#222222',
			'footerstyle-footerbgpattern' => '19',
			'buttongradient-from' => '#FFFFFF',
			'buttongradient-to' => '#DDDDDD',
			'buttongradient-bordercolor' => '#BBBBBB',
			'buttongradient-linkcolor' => '#333333',
			'buttongradient-round' => '2',
			'linkcolor' => '#666666',
            'font-family' => 'titillium'
        ),
        'preset2' => array(
            'name' => 'Preset 2',
            'headerstyle-headerbgcolor' => '#2b0000',
			'headerstyle-headerbgpattern' => '20',
			'bodystyle-bodybgcolor' => '#FFFFFF',
			'bodystyle-bodybgpattern' => '19',
            'footerstyle-footerbgcolor' => '#2b0000',
			'footerstyle-footerbgpattern' => '20',
			'buttongradient-from' => '#a80000',
			'buttongradient-to' => '#7a0101',
			'buttongradient-bordercolor' => '#540000',
			'buttongradient-linkcolor' => '#FFFFFF',
			'buttongradient-round' => '3',
			'linkcolor' => '#7a0101',
            'font-family' => 'titillium'
        ),
        'preset3' => array(
            'name' => 'Preset 3',
            'headerstyle-headerbgcolor' => '#192b00',
			'headerstyle-headerbgpattern' => '22',
			'bodystyle-bodybgcolor' => '#FFFFFF',
			'bodystyle-bodybgpattern' => '12',
            'footerstyle-footerbgcolor' => '#192b00',
			'footerstyle-footerbgpattern' => '22',
			'buttongradient-from' => '#62a800',
			'buttongradient-to' => '#4e7a01',
			'buttongradient-bordercolor' => '#355400',
			'buttongradient-linkcolor' => '#FFFFFF',
			'buttongradient-round' => '3',
			'linkcolor' => '#355400',
            'font-family' => 'titillium'
        ),
		'preset4' => array(
            'name' => 'Preset 4',
            'headerstyle-headerbgcolor' => '#00212b',
			'headerstyle-headerbgpattern' => '29',
			'bodystyle-bodybgcolor' => '#FFFFFF',
			'bodystyle-bodybgpattern' => '14',
            'footerstyle-footerbgcolor' => '#00212b',
			'footerstyle-footerbgpattern' => '29',
			'buttongradient-from' => '#008fa8',
			'buttongradient-to' => '#01687a',
			'buttongradient-bordercolor' => '#004354',
			'buttongradient-linkcolor' => '#FFFFFF',
			'buttongradient-round' => '3',
			'linkcolor' => '#004354',
            'font-family' => 'titillium'
        ),
        'preset5' => array(
            'name' => 'Preset 5',
            'headerstyle-headerbgcolor' => '#6e3300',
			'headerstyle-headerbgpattern' => '26',
			'bodystyle-bodybgcolor' => '#FFFFFF',
			'bodystyle-bodybgpattern' => '9',
            'footerstyle-footerbgcolor' => '#6e3300',
			'footerstyle-footerbgpattern' => '26',
			'buttongradient-from' => '#a85700',
			'buttongradient-to' => '#7a4a01',
			'buttongradient-bordercolor' => '#542e00',
			'buttongradient-linkcolor' => '#FFFFFF',
			'buttongradient-round' => '15',
			'linkcolor' => '#7a4a01',
            'font-family' => 'titillium'
        )
    )
);

$gantry_browser_params = array(
    'ie6' => array(
        'backgroundlevel' => 'low',
        'bodylevel' => 'low'
    )
);

$gantry_belatedPNG = array('.png','#rt-logo');

$gantry_ie6Warning = "<h3>IE6 DETECTED: Currently Running in Compatibility Mode</h3><h4>This site is compatible with IE6, however your experience will be enhanced with a newer browser</h4><p>Internet Explorer 6 was released in August of 2001, and the latest version of IE6 was released in August of 2004.  By continuing to run Internet Explorer 6 you are open to any and all security vulnerabilities discovered since that date.  In March of 2009, Microsoft released version 8 of Internet Explorer that, in addition to providing greater security, is faster and more standards compliant than both version 6 and 7 that came before it.</p> <br /><a class='external'  href='http://www.microsoft.com/windows/internet-explorer/?ocid=ie8_s_cfa09975-7416-49a5-9e3a-c7a290a656e2'>Download Internet Explorer 8 NOW!</a>";
