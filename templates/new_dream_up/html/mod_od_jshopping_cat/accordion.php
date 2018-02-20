<?php if (!empty($arResult)): ?>
    <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>-->
    <?php ////
//$url = 'modules/mod_od_jshopping_cat/tmpl/accordion/js/accordion.js';
//$document->addScript(JURI::base() . $url);
//?>
    <ul id="nav_list_first">
    <?php
    $previousLevel = 0;
foreach ($arResult

    as $arItem): ?>
    <?php if ($previousLevel && $arItem["DEPTH"] < $previousLevel): ?>
        <?php echo str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH"])); ?>
    <?php endif ?>
    <?php if ($arItem["IS_PARENT"]): ?>
    <?php if ($arItem["DEPTH"] == 1): ?>
    <li class="has-dropdown">
    <a href="<?php echo $arItem["LINK"] ?>">
        <?php echo $arItem["NAME"] ?><?php if ($count) {
            echo ' (' . $arItem["COUNT"] . ')';
        } ?>
    </a>
    <div class="dropdown">
    <ul>
    <?php else: ?>
    <li class="has-dropdown <?php if ($arItem["SELECTED"]): ?> active<?php endif ?>">
    <a href="<?php echo $arItem["LINK"] ?>" class="parent<?php if ($arItem["SELECTED"]): ?> active<?php endif ?>">
        <?php echo $arItem["NAME"] ?><?php if ($count) {
            echo ' (' . $arItem["COUNT"] . ')';
        } ?>
    </a>
    <div class="dropdown">
    <ul>
    <?php endif ?>
    <?php else: ?>
        <?php if ($arItem["DEPTH"] == 1): ?>
            <li >
                <a href="<?php echo $arItem["LINK"] ?>"
                   class="root<?php if ($arItem["SELECTED"]): ?> active<?php endif ?>">
                    <?php echo $arItem["NAME"] ?><?php if ($count) {
                        echo ' (' . $arItem["COUNT"] . ')';
                    } ?>
                </a>
            </li>
        <?php else: ?>
            <li>
                <a href="<?php echo $arItem["LINK"] ?>" <?php if ($arItem["SELECTED"]): ?>class="active"<?php endif ?>>
                    <?php echo $arItem["NAME"] ?><?php if ($count) {
                        echo ' (' . $arItem["COUNT"] . ')';
                    } ?>
                </a>
            </li>
        <?php endif ?>
    <?php endif ?>
    <?php $previousLevel = $arItem["DEPTH"]; ?>
<?php endforeach ?>
    <?php if ($previousLevel > 1)://close last item tags?>
        <?php echo str_repeat("</ul></div></li>", ($previousLevel - 1)); ?>
    <?php endif ?>
    </ul>
<?php endif ?>