<?php defined('_JEXEC') or die(); ?>
<?php print $product->_tmp_var_start?>

<table border="1px" bordercolor="#cccccc" width="265px" height="275px" style="margin:3px 10px 3px 10px; padding:5 10 5 10">
<tr>
    <td  width="220px" align="center">
        <?php if ($product->image){?>
        <div >
            <?php if ($product->label_id){?>
                <div class="product_label">
                    <?php if ($product->_label_image){?>
                        <img src="<?php print $product->_label_image?>" alt="<?php print htmlspecialchars($product->_label_name)?>" />
                    <?php }else{?>
                        <span class="label_name"><?php print $product->_label_name;?></span>
                    <?php }?>
                </div>
            <?php }?>
            <a href="<?php print $product->product_link?>">
                <img class="jshop_img" src="<?php print $product->image?>" alt="<?php print htmlspecialchars($product->name);?>" />
            </a>
        </div>
        
                <div align="center">
            <h3><a href="<?php print $product->product_link?>"><?php print $product->name?></a></h3>
        </div>



  


        <?php }?>
        <?php if ($product->vendor){?>
            <div class="vendorinfo"><?php print _JSHOP_VENDOR?>: <a href="<?php print $product->vendor->products?>"><?php print $product->vendor->shop_name?></a></div>
        <?php }?>
        <?php if ($this->config->product_list_show_qty_stock){?>
            <div class="qty_in_stock"><?php print _JSHOP_QTY_IN_STOCK?>: <span><?php print sprintQtyInStock($product->qty_in_stock)?></span></div>
        <?php }?>
        <?php print $product->_tmp_var_top_buttons;?>
	
		<tr><td>
<table width="265px" >
<tr><td width="100px" align="right" style="padding:0 10px 0 0">
<?php if ($product->product_old_price > 0){?>
<div class="old_price"><?php if ($this->config->product_list_show_price_description) print _JSHOP_OLD_PRICE.": ";?><span><?php print formatprice($product->product_old_price)?></span></div>
<?php }?>
</td>        
<td  width="100px">
<?php if ($this->config->product_list_show_price_description) print _JSHOP_PRICE.": ";?>
<?php if ($product->show_price_from) print _JSHOP_FROM." ";?>
<span><big><b><font color="#b60000"><?php print formatprice($product->product_price);?></font></b></big></span>
</td>
<td  width="65px" align="right" valign="bottom">
<div style="margin:0px 3px 3px 0; padding: 2px 9px 2px 2px; -webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px; background: #bb88cc;">
<?php if ($product->buy_link){?>
<a href="<?php print $product->buy_link?>"><font color="#fff"><?php print _JSHOP_BUY?></font></a><?php } else{?> <font color="#fff"><?php print "Отсутствует"?></font><?php }?>

</div>
</td>
</tr>
</table>

        </td></tr>
    </td>
</tr>
</table>
<?php print $product->_tmp_var_end?>
