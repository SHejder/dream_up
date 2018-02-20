<?php
/**
 * @version      4.11.0 17.09.2015
 * @author       MAXXmarketing GmbH
 * @package      Jshopping
 * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license      GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');

print $this->_tmp_category_html_start;
?>
<h1><?php print $this->category->name ?></h1>
<?php if (count($this->categories)) : ?>
    <div class="catalog-categories">
    <?php foreach($this->categories as $k=>$category) : ?>
        <div class="catalog-categories__item">
                <a href = "<?php print $category->category_link;?>">
                    <img src="<?php print $this->image_category_path;?>/<?php if ($category->category_image) print $category->category_image; else print $this->noimage;?>" alt="<?php print htmlspecialchars($category->name)?>" title="<?php print htmlspecialchars($category->name)?>" />
                </a>
            <a class="catalog-categories__item-name" href = "<?php print $category->category_link?>">
                <?php print $category->name?>
            </a>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>


<?php include(dirname(__FILE__) . "/products.php"); ?>

<?php print $this->category->description ?>


<?php print $this->_tmp_category_html_end; ?>
