<?php
/**
 * Ajax_scroll
 *
 * @version 	1.3
 * @author		ELLE support@joomext.ru
 * @url			joomext.ru
 * @copyright	© 2013. All rights reserved.
 * @license 	GNU/GPL v.3 or later.
 */

// no direct access
defined('_JEXEC') or die('(@)|(@)');

class plgSystemAjax_scroll extends JPlugin
{

	/**
	 * Constructor
	 *
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}


	public function onBeforeCompileHead ()
	{
	    $app = JFactory::getApplication();
		$doc = JFactory::getDocument();


		if ($app->isAdmin())
		{
			return true;
		}

        $mobileparam = $this->params->get('mobile');
        if($mobileparam){
        $mobiles = array("iPhone","iPod","iPad","Android","Blackberry","Blackberry","Mobi","Moby","Opera.Mini","PPC","pda","mobile","pocket","phone","iemobile","windows.ce");

         foreach( $mobiles as $mobile ) {
            if( preg_match( "#".$mobile."#i", $_SERVER['HTTP_USER_AGENT'] ) ) {
            return true;
            }
         }
        }

        $urlrulesparams = $this->params->get( 'urlrules');
        if(!empty($urlrulesparams)){
        $urlrules = explode("\r\n",$urlrulesparams);
        $nowurl = http_build_query($_REQUEST);
        $ff = '';
        foreach($urlrules as $url){
           if(substr_count($nowurl, $url) == 1) $ff = '1';
        }
        if(!$ff) return true;
        }



        $container = $this->params->get( 'container');
        $item = $this->params->get( 'item');
        $pagination = $this->params->get( 'pagination');
        $next = $this->params->get( 'next');
        $autoscroll = $this->params->get( 'triggerPageThreshold');
		$more = $this->params->get( 'more');
        $none = $this->params->get( 'none');
        $jquery = $this->params->get( 'jquery');
        $onRenderComplete = $this->params->get( 'onrendercomplete');
        $limit = '';
        if (isset($jquery)) {
           $doc->addScript('//ajax.googleapis.com/ajax/libs/jquery/'.$jquery.'/jquery.min.js');
        }

        if($autoscroll) {
           $limit = '9999';
           }else{
            $limit = '1';
           }

        $doc->addScript(JURI::root(true) . '/media/ajax_scroll/assets/jquery-ias.js');
        $init = '
                    jQuery.ias({
                     container :  "'.$container.'",
                     item: "'.$item.'",
                     pagination: "'.$pagination.'",
                     next: "'.$next.'",
                     triggerPageThreshold: "'.$limit.'",
					 trigger: "'.$more.'",
                     loader: "<img src=\"/media/ajax_scroll/assets/loader.gif\"/>",
                     noneleft: "<i class=\"Jext_more\">'.$none.'</i>",
                     onRenderComplete: function () {'.$onRenderComplete.'}
              });
        ';

        $doc->addCustomTag('<script type="text/javascript">'.$init.'</script>');
		
		$style = 'div.ias_trigger{text-align: center;margin: 15px 0;} 
		div.ias_trigger a {border: 1px solid #ccc;padding: 5px;border-radius: 5px;background: #f1f1f1;}
        '.$pagination.' {display:none !important;}';
         
		$doc->addStyleDeclaration($style);
		
		


	}
}
?>