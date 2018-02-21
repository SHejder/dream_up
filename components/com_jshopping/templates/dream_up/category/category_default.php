<?php
/**
 * @version      4.11.0 17.09.2015
 * @author       MAXXmarketing GmbH
 * @package      Jshopping
 * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license      GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
$template_url = $this->baseurl . '/templates/new_dream_up/' ;

print $this->_tmp_category_html_start;
?>
<h1><?php print $this->category->name ?></h1>
<?php if (count($this->categories)) : ?>
    <div class="catalog-categories">
    <?php foreach($this->categories as $k=>$category) : ?>
        <div class="catalog-categories__item">
                <a class="catalog-categories__item-img" href = "<?php print $category->category_link;?>">
                    <img src="<?php if ($category->category_image){ ?><? print $this->image_category_path;?>/<?php print $category->category_image;?><?php } else { ?><?php echo $template_url . '/images/catalog-categories-default.png' ?><?php } ?> " alt="<?php print htmlspecialchars($category->name)?>" title="<?php print htmlspecialchars($category->name)?>" />
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
