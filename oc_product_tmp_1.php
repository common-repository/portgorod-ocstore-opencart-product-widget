<?if($por_showbutt == 'yes') //show alerts add to cart
{?>
<div id="notification"></div>
<?}?>

<div class="por_main_cont<?php echo $por_template_class;?>">
<div class="por_img_cont<?php echo $por_template_class;?>"><a href="<?php echo $por_url?>" title="<?php echo $por_name;?>"><img src="<?php echo $por_img_url; ?>" width="<?php echo $por_img_width;?>" height="<?php echo $por_img_height;?>" class="por_img<?php echo $por_template_class;?>"></a></div>
<div class="por_name_cont<?php echo $por_template_class;?>"><a href="<?php echo $por_url?>" title="<?php echo $por_name;?>"><?php echo $por_name;?></a></div>
<div class="por_price_cont<?php echo $por_template_class;?>"><p style="font-size:1em"><?php echo $por_beforeprice;?><?php echo $por_price;?><?php echo $por_afterprice;?></div>

<?if($por_showbutt == 'yes') // show button add to cart
{?>
<div class="por_button_cont<?php echo $por_template_class;?>"><input type="button" value="<?php echo $por_buttext; ?>" onclick="addToCart('<?php echo $por_id;?>','1','<?php echo $por_seo_main_dom;?>','');" class="button" /></div>
<?}?>

</div>
