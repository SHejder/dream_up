<?php 
/**
* @version      4.8.0 13.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
?>
<div class="sorting">
<!--    --><?php //var_dump($_POST);?>

    Сортировать товары
    <form action="<?php print $this->action;?>" method="post" name="sort_count" id="sort_count" >
        <a class="sort <?php if ($_POST['order']=="1" && $_POST['orderby']=="0") { ?>is-active<?php } ?>" onclick="submitListProductFilters(this)" >по алфавиту (А-Я)</a>
<!--                <input type="submit" value="по алфавиту (А-Я)" >-->
        <input type="hidden" name="order" id="order" value="1" />
        <input type="hidden" name="orderby" id="orderby" value="0" />
        <input type="hidden" name="limitstart" value="0" />
    </form>
    <form action="<?php print $this->action;?>" method="post" name="sort_count" id="sort_count" >
        <a class="sort <?php if ($_POST['order']=="1" && $_POST['orderby']=="1") { ?>is-active<?php } ?>" onclick="submitListProductFilters(this)" >по алфавиту (Я-А)</a>

<!--                <input type="submit" value="о алфавиту (Я-А)" >-->
        <input type="hidden" name="order" id="order" value="1" />
        <input type="hidden" name="orderby" id="orderby" value="1" />
        <input type="hidden" name="limitstart" value="0" />
    </form>
    <form action="<?php print $this->action;?>" method="post" name="sort_count" id="sort_count" >
        <a class="sort <?php if ($_POST['order']=="2" && $_POST['orderby']=="0") { ?>is-active<?php } ?>" onclick="submitListProductFilters(this)" >по возрастанию цены</a>

<!--                <input type="submit" value="по возрастанию цены" >-->
        <input type="hidden" name="order" id="order" value="2" />
        <input type="hidden" name="orderby" id="orderby" value="0" />
        <input type="hidden" name="limitstart" value="0" />
    </form>
    <form action="<?php print $this->action;?>" method="post" name="sort_count" id="sort_count" >
        <a class="sort <?php if ($_POST['order']=="2" && $_POST['orderby']=="1") { ?>is-active<?php } ?>" onclick="submitListProductFilters(this)" >по убыванию цены</a>
<!--        <input type="submit" value="по убыванию цены" >-->
        <input type="hidden" name="order" id="order" value="2" />
        <input type="hidden" name="orderby" id="orderby" value="1" />
        <input type="hidden" name="limitstart" value="0" />
    </form>
</div>


<?php //echo $this->sorting?>
