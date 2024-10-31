<?php
if($_POST['opcimp_hidden'] == 'Y') {

    $por_seo_is_seo = $_POST['por_openopt_is_seo'];
    update_option('por_openopt_is_seo', $por_seo_is_seo);
    $por_seo_is_html = $_POST['por_openopt_is_html'];
    update_option('por_openopt_is_html', $por_seo_is_html);
    $por_seo_is_subcat = $_POST['por_openopt_is_subcat'];
    update_option('por_openopt_is_subcat', $por_seo_is_subcat);
    $por_seo_main_dom = $_POST['por_openopt_main_dom'];
    update_option('por_openopt_main_dom', $por_seo_main_dom);
    $por_img_qua = $_POST['por_openopt_img_qua'];
    update_option('por_openopt_img_qua', $por_img_qua);
    $por_dbname = $_POST['por_openopt_db_name'];
    update_option('por_openopt_db_name', $por_dbname);
    $por_dbhost = $_POST['por_openopt_db_host'];
    update_option('por_openopt_db_host', $por_dbhost);
    $por_dbport = $_POST['por_openopt_db_port'];
    update_option('por_openopt_db_port', $por_dbport);
    $por_dblogin = $_POST['por_openopt_db_login'];
    update_option('por_openopt_db_login', $por_dblogin);
    $por_dbpass = $_POST['por_openopt_dbpass'];
    update_option('por_openopt_dbpass', $por_dbpass);
    $por_dbprefix = $_POST['por_openopt_db_prefix'];
    update_option('por_openopt_db_prefix', $por_dbprefix);
    $por_buttext = $_POST['por_openopt_buttext'];
    update_option('por_openopt_buttext', $por_buttext);
    $por_img_bg = $_POST['por_openopt_img_bg'];
    update_option('por_openopt_img_bg', $por_img_bg);
    $por_img_rtype = $_POST['por_openopt_img_rtype'];
    update_option('por_openopt_img_rtype', $por_img_rtype);

    $por_showbutt = $_POST['por_openopt_showbutt'];
    update_option('por_openopt_showbutt', $por_showbutt);
    $por_beforeprice = $_POST['por_openopt_beforeprice'];
    update_option('por_openopt_beforeprice', $por_beforeprice);
    $por_afterprice = $_POST['por_openopt_afterprice'];
    update_option('por_openopt_afterprice', $por_afterprice);

	echo  _e('Options saved.') ;

} else {

$por_seo_is_seo = get_option('por_openopt_is_seo');
$por_seo_is_html = get_option('por_openopt_is_html');
$por_seo_is_subcat = get_option('por_openopt_is_subcat');
$por_seo_main_dom = get_option('por_openopt_main_dom');
$por_img_def = get_option('por_openopt_img_def');
$por_img_cha_folder = get_option('por_openopt_img_cha_folder');
$por_img_qua = get_option('por_openopt_img_qua');
$por_buttext = get_option('por_openopt_buttext');
$por_img_bg = get_option('por_openopt_img_bg');

$por_dbname = get_option('por_openopt_db_name');
$por_dbhost = get_option('por_openopt_db_host');
$por_dbport = get_option('por_openopt_db_port');
$por_dblogin = get_option('por_openopt_db_login');
$por_dbpass = get_option('por_openopt_dbpass');
$por_dbprefix = get_option('por_openopt_db_prefix');
$por_img_rtype = get_option('por_openopt_img_rtype');

$por_showbutt = get_option('por_openopt_showbutt');
$por_beforeprice = get_option('por_openopt_beforeprice');
$por_afterprice = get_option('por_openopt_afterprice');

}
?>

	<?php echo "<h2>" . __( 'Portgorod Opencart & OcStore widget settings', 'por_openopt_dom' ) . "</h2>"; ?>
	<form name="por_openopt_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="opcimp_hidden" value="Y">
	<?php  echo "<h3>" . __( 'Database settings', 'por_openopt_dom' ) . "</h3>"; ?>
	<table border=0 cellspacing=5 cellpadding=5>
	<tr><td align="left" valign="top" width=150><?php _e('Db name: ', 'por_openopt_dom' ); ?></td><td><input type="text" name="por_openopt_db_name" value="<?php echo $por_dbname; ?>" size="50"></td><td><?php _e('For example: dbname', 'por_openopt_dom'  ); ?></td></tr>
	<tr><td align="left" valign="top"><?php _e('Db host: ', 'por_openopt_dom' ); ?></td><td><input type="text" name="por_openopt_db_host" value="<?php echo $por_dbhost; ?>" size="50"></td><td><?php _e('For example: localhost', 'por_openopt_dom'  ); ?></td></tr>
	<tr><td align="left" valign="top"><?php _e('Db port: ', 'por_openopt_dom' ); ?></td><td><input type="text" name="por_openopt_db_port" value="<?php echo $por_dbport; ?>" size="50"></td><td><?php _e('For example: 3306 (switched off in this version)', 'por_openopt_dom'  ); ?></td></tr>
	<tr><td align="left" valign="top"><?php _e('Db login: ', 'por_openopt_dom' ); ?></td><td><input type="text" name="por_openopt_db_login" value="<?php echo $por_dblogin; ?>" size="50"></td><td><?php _e('For example: dbuser', 'por_openopt_dom'  ); ?></td></tr>
	<tr><td align="left" valign="top"><?php _e('Db password: ', 'por_openopt_dom' ); ?></td><td><input type="text" name="por_openopt_dbpass" value="<?php echo $por_dbpass; ?>" size="50"></td><td><?php _e('For example: password', 'por_openopt_dom'  ); ?></td></tr>
	<tr><td align="left" valign="top"><?php _e('Db tables prefix: ', 'por_openopt_dom' ); ?></td><td><input type="text" name="por_openopt_db_prefix" value="<?php echo $por_dbprefix; ?>" size="50"></td><td><?php _e('For example: oc_ ', 'por_openopt_dom'  ); ?></td></tr>
	</table>
	<hr>
	<?php echo "<h3>" . __( 'OcStore shop settings', 'por_openopt_dom' ) . "</h2>"; ?>
	<table border=0 cellspacing=5 cellpadding=5>
	<tr><td align="left" valign="top" width=150><?php _e('Button text: ', 'por_openopt_dom' ); ?></td><td><input type="text" name="por_openopt_buttext" value="<?php echo $por_buttext; ?>" size="50"></td><td><?php _e('For example: <b><i>Buy now!</i></b>', 'por_openopt_dom'  ); ?></td></tr>
	<tr><td align="left" valign="top"><?php _e('SEO settings on store: ', 'por_openopt_dom' ); ?></td><td><input type=radio name="por_openopt_is_seo" value="yes" <?php if($por_seo_is_seo=='yes')echo "checked";?>> Yes &nbsp;&nbsp;&nbsp;<input type=radio name="por_openopt_is_seo" value="no" <?php if($por_seo_is_seo=='no')echo "checked";?>> No</td><td><?php _e('Chose "yes" if seo-urls switched on in yor web-shop server settings (admin pannel -> settings -> server settings)', 'por_openopt_dom'  ); ?></td></tr>
	<tr><td align="left" valign="top"><?php _e('SEO-pro ending: ', 'por_openopt_dom' ); ?></td><td><input type="text" name="por_openopt_is_html" value="<?php echo $por_seo_is_html; ?>" size="50"></td><td><?php _e('For example: <b><i>.html</i></b>  &nbsp;&nbsp;&nbsp;Only if you have this setting in (admin pannel -> settings -> server settings) <b>Only for SEO Pro Opencart plugin</b>', 'por_openopt_dom'  ); ?></td></tr>
	<tr><td align="left" valign="top"><?php _e('Products subcategories: ', 'por_openopt_dom' ); ?></td><td><input type=radio name="por_openopt_is_subcat" value="yes" <?php if($por_seo_is_subcat == 'yes')echo "checked";?>> Yes &nbsp;&nbsp;&nbsp;<input type=radio name="por_openopt_is_subcat" value="no" <?php if($por_seo_is_subcat == 'no')echo "checked";?>> No</td><td><?php _e('show url with subcat site.com<b>/catego/subcateg/sub/</b>prod.html', 'por_openopt_dom'  ); ?></td></tr>

	<tr><td align="left" valign="top"><?php _e('Thumb create type: ', 'por_openopt_dom' ); ?></td><td>

	<select name="por_openopt_img_rtype">
	<option <?php if($por_img_rtype == '1')echo "selected";?> value="1">Resize image bigger side to necessary (put necessary size to width field in widget settings)</option>
	<option <?php if($por_img_rtype == '2')echo "selected";?> value="2">Make picture with necessary width and height and put product image into it</option>
	<option <?php if($por_img_rtype == '3')echo "selected";?> value="3">Make picture with necessary width and height and put adaptive-cutted product image into it</option>
	</select>
	</td><td><?php _e('Select type and set width and height on widget settings', 'por_openopt_dom'  ); ?></td></tr>

	<tr><td align="left" valign="top"><?php _e('Store folder: ', 'por_openopt_dom' ); ?></td><td><input type="text" name="por_openopt_main_dom" value="<?php echo $por_seo_main_dom; ?>" size="50"></td><td><?php _e('For example: <b>http://SiteWithShop.com/shop/</b> or <b>http://SiteWithShop.com/</b>&nbsp;&nbsp;&nbsp; url and folder where store locates (must be end by /)', 'por_openopt_dom'  ); ?></td></tr>
	<tr><td align="left" valign="top"><?php _e('Image quality: ', 'por_openopt_dom' ); ?></td><td><input type="text" name="por_openopt_img_qua" value="<?php echo $por_img_qua; ?>" size="50"></td><td><?php _e('For example: <b>100</b>&nbsp;&nbsp;&nbsp; thumb quality', 'por_openopt_dom'  ); ?></td></tr>
	<tr><td align="left" valign="top"><?php _e('Thumb bg color: ', 'por_openopt_dom' ); ?></td><td><input type="text" name="por_openopt_img_bg" value="<?php echo $por_img_bg; ?>" size="50"></td><td><?php _e('For example: <b>0xFFFFFF</b>  &nbsp;&nbsp;&nbsp;Thumb bgcolor', 'por_openopt_dom'  ); ?></td></tr>

	<tr><td align="left" valign="top"><?php _e('More ', 'por_openopt_dom' ); ?></td><td>Before price:&nbsp;<input type="text" name="por_openopt_beforeprice" value="<?php echo htmlspecialchars($por_beforeprice); ?>" size="10">&nbsp;&nbsp;&nbsp;After price:&nbsp;<input type="text" name="por_openopt_afterprice" value="<?php echo htmlspecialchars($por_afterprice); ?>" size="10">&nbsp;&nbsp;&nbsp;Show Button:&nbsp;<input type="checkbox" name="por_openopt_showbutt" value="yes" <?php if($por_showbutt == 'yes')echo "checked";?>></td><td><?php _e('For example: <b>&euro;</b>', 'por_openopt_dom'  ); ?></td></tr>

	<tr><td align="left" valign="top"><font color="red"><?php _e('Destroy previews: ', 'por_openopt_dom' ); ?></font></td><td><input type="checkbox" name="por_openopt_clear_chache" value="yes"></td><td><?php _e('Re create all thumbs', 'por_openopt_dom'  ); ?></td></tr>
	<tr><td align="left" valign="top">&nbsp;</td><td><input type="submit" name="Submit" value="<?php _e('Update Options', 'opcimp_trdom' ) ?>" /></td><td>&nbsp;</td></tr>
	</table>

</form>

