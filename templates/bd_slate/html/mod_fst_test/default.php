<?php
/**
* @Copyright Freestyle Joomla (C) 2010
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
*     
* This file is part of Freestyle Testimonials
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
**/
?>
<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<?php if ($maxheight > 0): ?>
<script>

$fjqt(document).ready(function () {
	setTimeout("scrollDown()",6000);
});

function scrollDown()
{
	var settings = { 
		direction: "down", 
		step: 40, 
		scroll: true, 
		onEdge: function (edge) { 
			if (edge.y == "bottom")
			{
				setTimeout("scrollUp()",6000);
			}
		} 
	};
	$fjqt(".fst_comments_scroll").autoscroll(settings);
}

function scrollUp()
{
	var settings = { 
		direction: "up", 
		step: 40, 
		scroll: true,    
		onEdge: function (edge) { 
			if (edge.y == "top")
			{
				setTimeout("scrollDown()",6000);
			}
		} 
	};
	$fjqt(".fst_comments_scroll").autoscroll(settings);
}
</script>

<style>
#fst_comments_scroll {
	max-height: <?php echo $maxheight; ?>px;
	overflow: hidden;
}
</style>
<?php endif; ?>
<?php if (1/*count($rows) > 0*/) : ?>
<div id="fst_comments_scroll" class="fst_comments_scroll">
<?php $comments->DisplayComments($dispcount, $listtype, $maxlength); ?>
</div>
<?php if ($params->get('show_more')) : ?>
	<div class='fst_mod_test_all'><a href='<?php echo FSTRoute::_( 'index.php?option=com_fst&view=test&prodid=' . $prodid ); ?>'><?php echo JText::_("SHOW_MORE_TESTIMONIALS"); ?></a></div>
<?php endif; ?>
<?php else: ?>
No testimonials found!.
<?php endif; ?>
<?php if ($params->get('show_add') && $comments->can_add): ?>
	<div class='fst_mod_test_add'><a class='modal' href='<?php echo FSTRoute::_( 'index.php?tmpl=component&option=com_fst&view=test&layout=create&onlyprodid=' . $prodid ); ?>' rel="{handler: 'iframe', size: {x: 500, y: 500}}"><?php echo JText::_("ADD_A_TESTIMONIAL"); ?></a></div>
<?php endif; ?>
