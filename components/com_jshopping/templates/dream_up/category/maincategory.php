<?php 
/**
* @version      4.10.5 13.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');

print $this->_tmp_maincategory_html_start;
$template_url = $this->baseurl . '/templates/new_dream_up/' ;

?>
<?php //if ($this->params->get('show_page_heading') && $this->params->get('page_heading')){?>
    <h1>Каталог товаров</h1>
<!--    <h1>--><?php //print $this->params->get('page_heading')?><!--</h1>-->

<div class="catalog-categories">

    <?php if (count($this->categories)) : ?>
    
        <?php foreach ($this->categories as $k => $category) : ?>
            <div class="catalog-categories__item">
                <a class="catalog-categories__item-img" href = "<?php print $category->category_link;?>">
                    <img src="<?php if ($category->category_image){ ?><? print $this->image_category_path;?>/<?php print $category->category_image;?><?php } else { ?><?php echo $template_url . '/images/catalog-categories-default.png' ?><?php } ?> " alt="<?php print htmlspecialchars($category->name)?>" title="<?php print htmlspecialchars($category->name)?>" />
                </a>
                <a class="catalog-categories__item-name" href = "<?php print $category->category_link?>">
                    <?php print $category->name?>
                </a>
            </div>
        <?php endforeach;?>
        

    <?php endif; ?>

<?php print $this->category->description?>

    
    <?php print $this->_tmp_maincategory_html_end;?>
</div>