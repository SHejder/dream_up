
<?php

$mainframe =& JFactory::getApplication();

$total = $this->category->getCountProducts($filters);

$limitstart = JRequest::getInt('limitstart');

$limit = $mainframe->getUserStateFromRequest( 'jshoping.list.front.productlimit', 'limit', $this->category->products_page, 'int');

jimport('joomla.html.pagination');

$pagination = new JPagination($total, $limitstart, $limit);

?>
<table class="jshop_pagination">

<tr>

<td><div class="pagination"><?php print $this->pagination?> <span class="allpage">Всего страниц: <?php print $pagination->get('pages.total')?></span></div></td></tr>

</table>