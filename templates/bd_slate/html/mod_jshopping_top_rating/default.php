<div class="top_rating">
<?php foreach($list as $curr){ ?>
    <div class="block_item">
        <?php if ($show_image) { ?>
        <div class="item_image">
            <a href="<?php print $curr->product_link?>">               
                <img src = "<?php print $jshopConfig->image_product_live_path?>/<?php if ($curr->product_thumb_image) print $curr->product_thumb_image; else print $noimage?>" alt="" />
            </a>
        </div>
        <?php } ?>
        <div class="item_name">
            <a href="<?php print $curr->product_link?>"><?php print $curr->name?></a>
        </div>
        <div class="item_price">
            <?php print formatprice($curr->product_price);?>
        </div>
        <div class="clear"></div>
    </div>       
<?php } ?>
</div>