<?
/*
Plugin Name: Portgorod OcStore & Opencart product widget
Plugin URI: http://artofrapture.com/smd/show-opencart-products-in-wordpress.html
Description: Shows products from your ocstore on your wp
Author: Dmitrii Smirnov
Version: 1.2
Author URI: smd@mail.ru
*/
/*
Special thanks to this man: http://www.opencart.com/index.php?route=extension/extension&filter_username=freelancer_.
*/

/*  Copyright 2013  Dmitrii Smirnov  (email: smd@mail.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function portgorod_addtohead() {
	$portgorod_file_css = plugins_url( 'oc_product.css', __FILE__ );
	$portgorod_img_close = plugins_url( 'close.png', __FILE__ );
	$portgorod_img_success = plugins_url( 'success.png', __FILE__ );
	echo "\n" . '<link type = "text/css" rel = "stylesheet" href = "' . $portgorod_file_css . '" />' . "\n";
	$por_showbutt = get_option('por_openopt_showbutt');
	if($por_showbutt == 'yes')
	{
		?>
<style>
.success .close {
	padding-top: 4px;
	padding-right: 4px;
	cursor: pointer;
}
.success {
	background: #EAF7D9 url('<?php echo $portgorod_img_success; ?>') 10px center no-repeat;
	border: 1px solid #BBDF8D;
	padding-left: 30px;
	padding: 3px 3px 3px 30px;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$('.success img').live('click', function() {
		$(this).parent().fadeOut('slow', function() {
			$(this).remove();
		});
	});
});


function addToCart(product_id, quantity, xurl, xredirect) {
   quantity = typeof(quantity) != 'undefined' ? quantity : 1;
        xurl = typeof(xurl) != 'undefined' ? xurl : false;
        xredirect = typeof(xredirect) != 'undefined' ? xredirect : false;

   $.ajax({
      url: xurl + 'index.php?route=checkout/cart/add',
      type: 'post',
      data: 'product_id=' + product_id + '&quantity=' + quantity,
      dataType: 'json',
      success: function(json) {
         $('.success, .warning, .attention, .information, .error').remove();

         if (json['redirect']) {
            location = json['redirect'];
         }

         if (json['success']) {
            $('#notification').html('<div class="success" style="display: none;">' + json['success'] + '&nbsp;<img src="<?php echo $portgorod_img_close; ?>" alt="" class="close" /></div>');
            $('.success').fadeIn('slow');
            $('#cart-total').html(json['total']);
//            $('html, body').animate({ scrollTop: 0 }, 'slow');
         }

                        if(xredirect != false){
                            window.location.href = xredirect;
                        }
      }
   });
}
</script>

<?

	}

}

class portgorod_opencart_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'portgorod_opencart_widget_1', // Base ID
			'Portgorod opencart widget', // Name
			array( 'description' => __( 'A widget to show OcStore & Opencart products', 'por_openopt_dom' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];

		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$por_seo_is_seo = get_option('por_openopt_is_seo');
$por_seo_is_html = get_option('por_openopt_is_html');
$por_seo_is_subcat = get_option('por_openopt_is_subcat');
$por_seo_main_dom = get_option('por_openopt_main_dom');
//$por_seo_dom = get_option('por_openopt_dom');
$por_img_def = plugins_url( 'no_image.jpg', __FILE__ );
$por_img_cha_folder = 'portgorod_ocstore_pipka';
$por_img_qua = get_option('por_openopt_img_qua');
$por_buttext = get_option('por_openopt_buttext');
$por_showbutt = get_option('por_openopt_showbutt');
$por_beforeprice = get_option('por_openopt_beforeprice');
$por_afterprice = get_option('por_openopt_afterprice');

$por_dbname = get_option('por_openopt_db_name');
$por_dbhost = get_option('por_openopt_db_host');
$por_dbport = get_option('por_openopt_db_port');
$por_dblogin = get_option('por_openopt_db_login');
$por_dbpass = get_option('por_openopt_dbpass');
$por_dbprefix = get_option('por_openopt_db_prefix');

$por_prtag = $instance[ 'por_prtag' ];
$por_num = $instance[ 'por_num' ];
$por_template = $instance[ 'por_template' ];
$por_cat_to_look = $instance[ 'por_cat_to_look' ];

$por_img_size_w = $instance[ 'por_img_size_w' ];
$por_img_size_h = $instance[ 'por_img_size_h' ];
$por_img_rtype = get_option('por_openopt_img_rtype');
$por_img_bg = get_option('por_openopt_img_bg');
$por_language = '1';

$por_template_class = $por_template;
$por_template = dirname( __FILE__ ) . '/'. 'oc_product_tmp_'.$por_template.'.php';

// include ( str_replace(end(explode('/',$uploads['basedir'].'/'.plugin_basename(__FILE__))), '', $uploads['basedir'].'/'.plugin_basename(__FILE__)).$shablon  );
$uploads = wp_upload_dir();
define('TABLE_PREFIX', $por_dbprefix);


$por_db = mysql_connect($por_dbhost, $por_dblogin, $por_dbpass, TRUE);
mysql_select_db($por_dbname, $por_db);
if(!mysql_set_charset('utf8')) mysql_query("SET NAMES 'utf8'");
$por_prtag='%'.trim($por_prtag).'%';
$por_cat_to_look='%'.$por_cat_to_look.'%';


//функция для извлечения юрл к товару
function portgorod_get_product_url($por_product_id, $por_is_html, $por_is_subcat, $por_is_seo, $por_seo_main_dom)
{
	if(($por_is_seo=='yes')and($por_is_subcat=='yes'))
	{
		$por_seocatq=mysql_query("SELECT category_id FROM `" . TABLE_PREFIX . "product_to_category` WHERE main_category='1' AND product_id='$por_product_id'");
		$por_seocata=mysql_fetch_array($por_seocatq);
        $por_pre_url_c='';
		$por_cn_s='0';
		while($por_seocata[$por_cn_s] !== '0')
		{
			$por_seocatarrq=mysql_query("SELECT parent_id FROM `" . TABLE_PREFIX . "category` WHERE category_id='$por_seocata[$por_cn_s]'");
			$por_seocatarra=mysql_fetch_array($por_seocatarrq);
			$por_cn_s++;
			$por_seocata[$por_cn_s] = $por_seocatarra['0'];

			$por_get_cat_seo_pr = 'category_id='.$por_seocata[$por_cn_s-1];
			$por_get_cat_seo_q = mysql_query("SELECT keyword FROM `" . TABLE_PREFIX . "url_alias` WHERE query='$por_get_cat_seo_pr'");
			$por_get_cat_seo_a = mysql_fetch_array($por_get_cat_seo_q);

			$por_pre_url_c = $por_get_cat_seo_a['0'].'/'.$por_pre_url_c;

			$por_qseo='product_id='.$por_product_id;
			$por_seoq=mysql_query("SELECT keyword FROM `" . TABLE_PREFIX . "url_alias` WHERE query='$por_qseo'");
			$por_seoa=mysql_fetch_array($por_seoq);

			$por_pre_url=$por_pre_url_c.$por_seoa['0'];

		}
	}
	elseif(($por_is_seo == 'yes')and($por_is_subcat == 'no'))
	{

		$por_qseo='product_id='.$por_product_id;
		$por_seoq=mysql_query("SELECT keyword FROM `" . TABLE_PREFIX . "url_alias` WHERE query = '$por_qseo'");
		$por_seoa=mysql_fetch_array($por_seoq);
		$por_pre_url = $por_seoa['0'];
	}
	elseif($por_is_seo=='no')
	{

		$por_pre_url = 'index.php?route=product/product&product_id='.$por_product_id;
	}
	if($por_is_html !== '0')
	{

		$por_pre_url=$por_pre_url.$por_is_html;
	}
	$por_pre_url=$por_seo_main_dom.$por_pre_url;

return $por_pre_url;
}


function portgorod_img_crop($por_img, $por_img_destination, $por_img_need_w, $por_img_need_h, $por_img_bg, $por_img_qua, $por_img_folder, $por_img_rtype)
{
	$uploads = wp_upload_dir();

	$por_img_chache_dir = $uploads['basedir'].'/'.htmlspecialchars(str_replace(array('/', '\\'), '', $por_img_folder));
	if(!is_dir($por_img_chache_dir))
	{
		mkdir($por_img_chache_dir);
	}

	if (file_exists($por_img_chache_dir.'/'.$por_img_destination.'-'.$por_img_need_w.'x'.$por_img_need_h.'-'.$por_img_rtype.'.jpg'))
	{
		$por_img_final = $por_img_folder.'/'.$por_img_destination.'-'.$por_img_need_w.'x'.$por_img_need_h.'-'.$por_img_rtype.'.jpg';
		return $por_img_final;
	}
	else
	{
		$url_por_img = str_replace (' ', '%20', $por_img);
		$por_img_get_size = getimagesize($url_por_img);
		if ($por_img_get_size === false) return  'Get file sizes error. File is: '.$por_img;
		$por_img_get_format = strtolower(substr($por_img_get_size['mime'], strpos($por_img_get_size['mime'], '/')+1));
		$por_img_icfunc = "imagecreatefrom" . $por_img_get_format;
		if (!function_exists($por_img_icfunc))
		{
			return 'image create function type error';
		}
		elseif ($por_img_get_format == 'jpeg')
		{
			$por_img_c = imagecreatefromjpeg($por_img);
		}
		elseif ($por_img_get_format == 'png')
		{
			$por_img_c = imagecreatefrompng($por_img);
		}
		elseif ($por_img_get_format == 'gif')
		{
			$por_img_c = imagecreatefromgif($por_img);
		}


		if ($por_img_rtype == '1')
		{


			if($por_img_get_size['0'] > $por_img_get_size['1'])
			{

				if($por_img_get_size['0'] <= $por_img_need_w)
				{

					$por_img_calc_cut_w = $por_img_get_size['0'];
					$por_img_calc_cut_h = $por_img_get_size['1'];
					$por_img_calc_cut_t = '0';
					$por_img_calc_cut_l = '0';
					$por_img_calc_put_t = '0';
					$por_img_calc_put_l = '0';
					$por_img_calc_put_w = $por_img_get_size['0'];
					$por_img_calc_put_h = $por_img_get_size['1'];
				}
				else
				{

					$por_img_calc_cut_w = $por_img_get_size['0'];
					$por_img_calc_cut_h = $por_img_get_size['1'];
					$por_img_calc_cut_t = '0';
					$por_img_calc_cut_l = '0';
					$por_img_calc_put_t = '0';
					$por_img_calc_put_l = '0';
					$por_img_calc_put_w = $por_img_need_w;
					$por_img_calc_put_h = floor(( $por_img_get_size['1'] / $por_img_get_size['0'] ) * $por_img_need_w);
				}
			}
			elseif($por_img_get_size['0'] < $por_img_get_size['1'])
			{

				if($por_img_get_size['1'] <= $por_img_need_w)
				{

					$por_img_calc_cut_w = $por_img_get_size['0'];
					$por_img_calc_cut_h = $por_img_get_size['1'];
					$por_img_calc_cut_t = '0';
					$por_img_calc_cut_l = '0';
					$por_img_calc_put_t = '0';
					$por_img_calc_put_l = '0';
					$por_img_calc_put_w = $por_img_get_size['0'];
					$por_img_calc_put_h = $por_img_get_size['1'];
				}
				else
				{

					$por_img_calc_cut_w = $por_img_get_size['0'];
					$por_img_calc_cut_h = $por_img_get_size['1'];
					$por_img_calc_cut_t = '0';
					$por_img_calc_cut_l = '0';
					$por_img_calc_put_t = '0';
					$por_img_calc_put_l = '0';
					$por_img_calc_put_w = floor(( $por_img_get_size['0'] / $por_img_get_size['1'] ) * $por_img_need_w);
					$por_img_calc_put_h = $por_img_need_w;
				}
			}
			elseif($por_img_get_size['0'] == $por_img_get_size['1'])
			{
				if($por_img_get_size['1'] <= $por_img_need_w)
				{

					$por_img_calc_cut_w = $por_img_get_size['0'];
					$por_img_calc_cut_h = $por_img_get_size['1'];
					$por_img_calc_cut_t = '0';
					$por_img_calc_cut_l = '0';
					$por_img_calc_put_t = '0';
					$por_img_calc_put_l = '0';
					$por_img_calc_put_w = $por_img_get_size['0'];
					$por_img_calc_put_h = $por_img_get_size['1'];
				}
				else
				{

					$por_img_calc_cut_w = $por_img_get_size['0'];
					$por_img_calc_cut_h = $por_img_get_size['1'];
					$por_img_calc_cut_t = '0';
					$por_img_calc_cut_l = '0';
					$por_img_calc_put_t = '0';
					$por_img_calc_put_l = '0';
					$por_img_calc_put_w = $por_img_need_w;
					$por_img_calc_put_h = $por_img_need_w;
				}
			}

			$por_img_dest = imagecreatetruecolor($por_img_calc_put_w, $por_img_calc_put_h);

		}
		elseif ($por_img_rtype == '2')
		{

			if(($por_img_need_w <= $por_img_get_size['0']) or ($por_img_need_h <= $por_img_get_size['1']))
			{

				if($por_img_get_size['0'] > $por_img_get_size['1'])
				{

					$por_img_calc_cut_w = $por_img_get_size['0'];
					$por_img_calc_cut_h = $por_img_get_size['1'];
					$por_img_calc_cut_t = '0';
					$por_img_calc_cut_l = '0';
					$por_img_calc_put_t = floor(( $por_img_need_h - (( $por_img_need_w / $por_img_get_size['0'] ) * $por_img_get_size['1'])) / 2);
					$por_img_calc_put_l = '0';
					$por_img_calc_put_w = $por_img_need_w;
					$por_img_calc_put_h = floor(( $por_img_need_w / $por_img_get_size['0'] ) * $por_img_get_size['1']);
				}
				elseif($por_img_get_size['0'] < $por_img_get_size['1'])
				{

					$por_img_calc_cut_w = $por_img_get_size['0'];
					$por_img_calc_cut_h = $por_img_get_size['1'];
					$por_img_calc_cut_t = '0';
					$por_img_calc_cut_l = '0';
					$por_img_calc_put_t = '0';
					$por_img_calc_put_l = floor(( $por_img_need_w - (( $por_img_need_h / $por_img_get_size['1'] ) * $por_img_get_size['0'])) / 2);
					$por_img_calc_put_w = floor(( $por_img_need_h / $por_img_get_size['1'] ) * $por_img_get_size['0']);
					$por_img_calc_put_h = $por_img_need_h;
				}
				elseif($por_img_get_size['0'] == $por_img_get_size['1'])
				{

					if($por_img_need_w > $por_img_need_h)
					{
						$por_img_calc_cut_w = $por_img_get_size['0'];
						$por_img_calc_cut_h = $por_img_get_size['1'];
						$por_img_calc_cut_t = '0';
						$por_img_calc_cut_l = '0';
						$por_img_calc_put_t = '0';
						$por_img_calc_put_l = floor(($por_img_need_w - $por_img_need_h)/2);
						$por_img_calc_put_w = $por_img_need_h;
						$por_img_calc_put_h = $por_img_need_h;
					}
					elseif($por_img_need_w < $por_img_need_h)
					{
						$por_img_calc_cut_w = $por_img_get_size['0'];
						$por_img_calc_cut_h = $por_img_get_size['1'];
						$por_img_calc_cut_t = '0';
						$por_img_calc_cut_l = '0';
						$por_img_calc_put_t = floor(($por_img_need_h - $por_img_need_w)/2);
						$por_img_calc_put_l = '0';
						$por_img_calc_put_w = $por_img_need_w;
						$por_img_calc_put_h = $por_img_need_w;
					}
					elseif($por_img_need_w == $por_img_need_h)
					{
						$por_img_calc_cut_w = $por_img_get_size['0'];
						$por_img_calc_cut_h = $por_img_get_size['1'];
						$por_img_calc_cut_t = '0';
						$por_img_calc_cut_l = '0';
						$por_img_calc_put_t = '0';
						$por_img_calc_put_l = '0';
						$por_img_calc_put_w = $por_img_need_w;
						$por_img_calc_put_h = $por_img_need_h;
					}
				}
			}
			else
			{
				$por_img_calc_cut_w = $por_img_get_size['0'];
				$por_img_calc_cut_h = $por_img_get_size['1'];
				$por_img_calc_cut_t = '0';
				$por_img_calc_cut_l = '0';
				$por_img_calc_put_t = floor(($por_img_need_h - $por_img_get_size['1']) / 2);
				$por_img_calc_put_l = floor(($por_img_need_w - $por_img_get_size['0']) / 2);
				$por_img_calc_put_w = $por_img_get_size['0'];
				$por_img_calc_put_h = $por_img_get_size['1'];
			}

			$por_img_dest = imagecreatetruecolor($por_img_need_w, $por_img_need_h);
		}
		elseif ($por_img_rtype == '3')
		{

			if(($por_img_need_w < $por_img_get_size['0']) & ($por_img_need_h < $por_img_get_size['1']))
			{
				if(($por_img_get_size['0'] / $por_img_need_w) > ($por_img_get_size['1'] / $por_img_need_h))
				{
					$por_img_calc_cut_w = floor(($por_img_need_w * $por_img_get_size['1']) / $por_img_need_h);
					$por_img_calc_cut_h = $por_img_get_size['1'];
					$por_img_calc_cut_t = '0';
					$por_img_calc_cut_l = floor(($por_img_get_size['0'] - $por_img_calc_cut_w) / 2);
					$por_img_calc_put_t = '0';
					$por_img_calc_put_l = '0';
					$por_img_calc_put_w = $por_img_need_w;
					$por_img_calc_put_h = $por_img_need_h;
				}
				elseif(($por_img_get_size['0'] / $por_img_need_w) < ($por_img_get_size['1'] / $por_img_need_h))
				{
					$por_img_calc_cut_w = $por_img_get_size['0'];
					$por_img_calc_cut_h = floor(($por_img_need_h * $por_img_get_size['0']) / $por_img_need_w);
					$por_img_calc_cut_t = floor(($por_img_get_size['1'] - $por_img_calc_cut_h) / 2);
					$por_img_calc_cut_l = '0';
					$por_img_calc_put_t = '0';
					$por_img_calc_put_l = '0';
					$por_img_calc_put_w = $por_img_need_w;
					$por_img_calc_put_h = $por_img_need_h;
				}
				elseif(($por_img_get_size['0'] / $por_img_need_w) == ($por_img_get_size['1'] / $por_img_need_h))
				{
					$por_img_calc_cut_w = $por_img_get_size['0'];
					$por_img_calc_cut_h = $por_img_get_size['1'];
					$por_img_calc_cut_t = '0';
					$por_img_calc_cut_l = '0';
					$por_img_calc_put_t = '0';
					$por_img_calc_put_l = '0';
					$por_img_calc_put_w = $por_img_need_w;
					$por_img_calc_put_h = $por_img_need_h;
				}
			}
			elseif(($por_img_need_w >= $por_img_get_size['0'])&($por_img_need_h >= $por_img_get_size['1']))
			{
				$por_img_calc_cut_w = $por_img_get_size['0'];
				$por_img_calc_cut_h = $por_img_get_size['1'];
				$por_img_calc_cut_t = '0';
				$por_img_calc_cut_l = '0';
				$por_img_calc_put_t = floor(($por_img_need_h - $por_img_get_size['1']) / 2);
				$por_img_calc_put_l = floor(($por_img_need_w - $por_img_get_size['0']) / 2);
				$por_img_calc_put_w = $por_img_get_size['0'];
				$por_img_calc_put_h = $por_img_get_size['1'];
			}
			elseif(($por_img_need_w > $por_img_get_size['0'])&($por_img_need_h < $por_img_get_size['1']))
			{
				$por_img_calc_cut_w = $por_img_get_size['0'];
				$por_img_calc_cut_h = $por_img_need_h;
				$por_img_calc_cut_t = floor(($por_img_get_size['1'] - $por_img_need_h) / 2);
				$por_img_calc_cut_l = '0';
				$por_img_calc_put_t = '0';
				$por_img_calc_put_l = floor(($por_img_need_w - $por_img_get_size['0']) / 2);
				$por_img_calc_put_w = $por_img_get_size['0'];
				$por_img_calc_put_h = $por_img_need_h;
			}
			elseif(($por_img_need_w < $por_img_get_size['0'])&($por_img_need_h > $por_img_get_size['1']))
			{
				$por_img_calc_cut_w = $por_img_need_w;
				$por_img_calc_cut_h = $por_img_get_size['1'];
				$por_img_calc_cut_t = '0';
				$por_img_calc_cut_l = floor(($por_img_get_size['0'] - $por_img_need_w) / 2);
				$por_img_calc_put_t = floor(($por_img_need_h - $por_img_get_size['1']) / 2);
				$por_img_calc_put_l = '0';
				$por_img_calc_put_w = $por_img_need_w;
				$por_img_calc_put_h = $por_img_get_size['1'];
			}
			elseif(($por_img_need_w < $por_img_get_size['0'])&($por_img_need_h == $por_img_get_size['1']))
			{
				$por_img_calc_cut_w = $por_img_need_w;
				$por_img_calc_cut_h = $por_img_need_h;
				$por_img_calc_cut_t = '0';
				$por_img_calc_cut_l = floor(($por_img_get_size['0'] - $por_img_need_w) / 2);
				$por_img_calc_put_t = '0';
				$por_img_calc_put_l = '0';
				$por_img_calc_put_w = $por_img_need_w;
				$por_img_calc_put_h = $por_img_need_h;
			}
			elseif(($por_img_need_w == $por_img_get_size['0'])&($por_img_need_h < $por_img_get_size['1']))
			{
				$por_img_calc_cut_w = $por_img_need_w;
				$por_img_calc_cut_h = $por_img_need_h;
				$por_img_calc_cut_t = floor(($por_img_get_size['1'] - $por_img_need_h) / 2);
				$por_img_calc_cut_l = '0';
				$por_img_calc_put_t = '0';
				$por_img_calc_put_l = '0';
				$por_img_calc_put_w = $por_img_need_w;
				$por_img_calc_put_h = $por_img_need_h;
			}
			else
			{
				return 'Error: forgot something in thumb class. Hmmm... is it possible?<br /> Please, contact mailnaprimer@gmail.com';
			}

			$por_img_dest = imagecreatetruecolor($por_img_need_w, $por_img_need_h);
		}

		imagefill($por_img_dest, 0, 0, $por_img_bg);
		imagecopyresampled($por_img_dest, $por_img_c, $por_img_calc_put_l, $por_img_calc_put_t, $por_img_calc_cut_l, $por_img_calc_cut_t, $por_img_calc_put_w, $por_img_calc_put_h, $por_img_calc_cut_w, $por_img_calc_cut_h);

		$por_img_final_d = $por_img_chache_dir.'/'.$por_img_destination.'-'.$por_img_need_w.'x'.$por_img_need_h.'-'.$por_img_rtype.'.jpg';
		imagejpeg($por_img_dest, $por_img_final_d, $por_img_qua);

		imagedestroy($por_img_c);
		imagedestroy($por_img_dest);

		$por_img_final = $por_img_folder.'/'.$por_img_destination.'-'.$por_img_need_w.'x'.$por_img_need_h.'-'.$por_img_rtype.'.jpg';

		return $por_img_final;
	}
}

$por_query = mysql_query("SELECT COUNT(*) FROM `" . TABLE_PREFIX . "product_description` WHERE tag LIKE '$por_prtag'");
$por_row = mysql_fetch_row($por_query);
$por_total = $por_row[0];

if(($por_total < $por_num) and ($por_total !== '0'))
{

	$por_r = mysql_query("SELECT product_id FROM `" . TABLE_PREFIX . "product_description` WHERE tag LIKE '$por_prtag' AND language_id='$por_language'");
	$por_uids = array();
	while ($por_row = mysql_fetch_row($por_r))
	{
		$por_uids[]=$por_row[0];
	}
	$por_i=$por_num;
	if ($por_i > mysql_num_rows($por_r))
	{
		$por_i = mysql_num_rows($por_r);
	}
	$por_banners_to_show = array();
	$por_c = mysql_num_rows($por_r)-1;
	while ($por_i > 0)
	{
		$por_x = mt_rand(0, $por_c);
		if (!isset($por_banners_to_show[$por_x]))
		{
			$por_i--;
			$por_product_id = mysql_result($por_r, $por_x, 'product_id');
			$por_banners_to_show[$por_x]=$por_product_id;
		}
	}
	$por_r = mysql_query("SELECT product_id, name FROM `" . TABLE_PREFIX . "product_description` WHERE product_id IN (".implode(', ',$por_banners_to_show).") AND language_id='$por_language'");
	while ($por_row = mysql_fetch_assoc($por_r))
	{
		$por_imgq=mysql_query("SELECT image, price FROM `" . TABLE_PREFIX . "product` WHERE product_id='$por_row[product_id]'");
		$por_imga=mysql_fetch_array($por_imgq);

		///выводим
		$por_url=portgorod_get_product_url($por_row['product_id'], $por_seo_is_html, $por_seo_is_subcat, $por_seo_is_seo, $por_seo_main_dom);

		$por_img_url_se = !strstr($por_imga['image'], '/') ?  $por_img_def : $por_seo_main_dom.'image/'.$por_imga['image'];

//		$por_img_tochange = ($por_seo_dom == '') ?  $_SERVER["DOCUMENT_ROOT"].$por_img_url_se : $por_img_url_se;
		$por_img_tochange = $por_img_url_se;
		$por_img = portgorod_img_crop($por_img_tochange, $por_row['product_id'], $por_img_size_w, $por_img_size_h, $por_img_bg, $por_img_qua, $por_img_cha_folder, $por_img_rtype);

        $por_img_url = $uploads['baseurl'] .'/'. $por_img;
        $por_img_sizes = getimagesize($uploads['basedir'] .'/'. $por_img);
        $por_img_width = $por_img_sizes[0];
        $por_img_height = $por_img_sizes[1];

		$por_name=$por_row['name'];
		$por_price=rtrim(rtrim($por_imga['price'], '0'), '.');
		$por_id=$por_row['product_id'];
		include $por_template;
	}
	$por_restnum = $por_num-$por_total;

	if ($por_cat_to_look !== '%%')
	{
		$por_r = mysql_query("
			SELECT a.product_id
			FROM `" . TABLE_PREFIX . "product_to_category` AS a
			LEFT JOIN `" . TABLE_PREFIX . "product_description` AS b ON a.product_id = b.product_id
			WHERE b.tag NOT LIKE '$por_prtag'
			AND b.language_id = '$por_language'
			AND a.category_id LIKE '$por_cat_to_look'
			AND a.main_category = '1'
		");
	}
	else
	{
		$por_r = mysql_query("SELECT product_id FROM `" . TABLE_PREFIX . "product_description` WHERE tag NOT LIKE '$por_prtag' AND language_id='$por_language'");
	}
	$por_uids = array();
	while ($por_row = mysql_fetch_row($por_r))
	{
		$por_uids[]=$por_row[0];
	}
	$por_i=$por_restnum;
	if ($por_i > mysql_num_rows($por_r))
	{
		$por_i = mysql_num_rows($por_r);
	}
	$por_banners_to_show = array();
	$por_c = mysql_num_rows($por_r)-1;
	while ($por_i > 0)
	{
		$por_x = mt_rand(0, $por_c);
		if (!isset($por_banners_to_show[$por_x]))
		{
			$por_i--;
			$por_product_id = mysql_result($por_r, $por_x, 'product_id');
			$por_banners_to_show[$por_x]=$por_product_id;
		}
	}
	$por_r = mysql_query("SELECT product_id, name FROM `" . TABLE_PREFIX . "product_description` WHERE product_id IN (".implode(', ',$por_banners_to_show).") AND language_id='$por_language'");
	while ($por_row = mysql_fetch_assoc($por_r))
	{
		$por_imgq=mysql_query("SELECT image, price FROM `" . TABLE_PREFIX . "product` WHERE product_id='$por_row[product_id]'");
		$por_imga=mysql_fetch_array($por_imgq);


		$por_url=portgorod_get_product_url($por_row['product_id'], $por_seo_is_html, $por_seo_is_subcat, $por_seo_is_seo, $por_seo_main_dom);

		$por_img_url_se = !strstr($por_imga['image'], '/') ?  $por_img_def : $por_seo_main_dom.'image/'.$por_imga['image'];

//		$por_img_tochange = ($por_seo_dom == '') ?  $_SERVER["DOCUMENT_ROOT"].$por_img_url_se : $por_img_url_se;
		$por_img_tochange = $por_img_url_se;
		$por_img = portgorod_img_crop($por_img_tochange, $por_row['product_id'], $por_img_size_w, $por_img_size_h, $por_img_bg, $por_img_qua, $por_img_cha_folder, $por_img_rtype);

        $por_img_url = $uploads['baseurl'] .'/'. $por_img;
        $por_img_sizes = getimagesize($uploads['basedir'] .'/'. $por_img);
        $por_img_width = $por_img_sizes[0];
        $por_img_height = $por_img_sizes[1];

		$por_name=$por_row['name'];
		$por_price=rtrim(rtrim($por_imga['price'], '0'), '.');
		$por_id=$por_row['product_id'];
		include $por_template;

	}
}
elseif (($por_total > $por_num) or ($por_total == $por_num) )
{
	$por_r = mysql_query("SELECT product_id FROM `" . TABLE_PREFIX . "product_description` WHERE tag LIKE '$por_prtag' AND language_id='$por_language'");
	$por_uids = array();
	while ($por_row = mysql_fetch_row($por_r))
	{
		$por_uids[]=$por_row[0];
	}
	$por_i=$por_num;
	if ($por_i > mysql_num_rows($por_r))
	{
		$por_i = mysql_num_rows($por_r);
	}
	$por_banners_to_show = array();
	$por_c = mysql_num_rows($por_r)-1;
	while ($por_i > 0)
	{
		$por_x = mt_rand(0, $por_c);
		if (!isset($por_banners_to_show[$por_x]))
		{
			$por_i--;
			$por_product_id = mysql_result($por_r, $por_x, 'product_id');
			$por_banners_to_show[$por_x]=$por_product_id;
		}
	}
	$por_r = mysql_query("SELECT product_id, name FROM `" . TABLE_PREFIX . "product_description` WHERE product_id IN (".implode(', ',$por_banners_to_show).") AND language_id='$por_language'");
	while ($por_row = mysql_fetch_assoc($por_r))
	{
		$por_imgq=mysql_query("SELECT image, price FROM `" . TABLE_PREFIX . "product` WHERE product_id='$por_row[product_id]'");
		$por_imga=mysql_fetch_array($por_imgq);

		$por_url=portgorod_get_product_url($por_row['product_id'], $por_seo_is_html, $por_seo_is_subcat, $por_seo_is_seo, $por_seo_main_dom);

		$por_img_url_se = !strstr($por_imga['image'], '/') ?  $por_img_def : $por_seo_main_dom.'image/'.$por_imga['image'];

//		$por_img_tochange = ($por_seo_dom == '') ?  $_SERVER["DOCUMENT_ROOT"].$por_img_url_se : $por_img_url_se;
		$por_img_tochange = $por_img_url_se;
		$por_img = portgorod_img_crop($por_img_tochange, $por_row['product_id'], $por_img_size_w, $por_img_size_h, $por_img_bg, $por_img_qua, $por_img_cha_folder, $por_img_rtype);

        $por_img_url = $uploads['baseurl'] .'/'. $por_img;
        $por_img_sizes = getimagesize($uploads['basedir'] .'/'. $por_img);
        $por_img_width = $por_img_sizes[0];
        $por_img_height = $por_img_sizes[1];

		$por_name=$por_row['name'];
		$por_price=rtrim(rtrim($por_imga['price'], '0'), '.');
		$por_id=$por_row['product_id'];
		include $por_template;

	}
}
elseif ($por_total == '0')
{
	if ($por_cat_to_look !== '%%')
	{
		$por_r = mysql_query("
			SELECT a.product_id
			FROM `" . TABLE_PREFIX . "product_to_category` AS a
			LEFT JOIN `" . TABLE_PREFIX . "product_description` AS b ON a.product_id = b.product_id
			WHERE b.tag NOT LIKE '$por_prtag'
			AND b.language_id = '$por_language'
			AND a.category_id LIKE '$por_cat_to_look'
			AND a.main_category = '1'
		");
	}
	else
	{
		$por_r = mysql_query("SELECT product_id FROM `" . TABLE_PREFIX . "product_description` WHERE tag NOT LIKE '$por_prtag' AND language_id='$por_language'");
	}
	$por_uids = array();
	while ($por_row = mysql_fetch_row($por_r))
	{
		$por_uids[]=$por_row[0];
	}
	$por_i=$por_num;
	if ($por_i > mysql_num_rows($por_r))
	{
		$por_i = mysql_num_rows($por_r);
	}
	$por_banners_to_show = array();
	$por_c = mysql_num_rows($por_r)-1;
	while ($por_i > 0)
	{
		$por_x = mt_rand(0, $por_c);
		if (!isset($por_banners_to_show[$por_x]))
		{
			$por_i--;
			$por_product_id = mysql_result($por_r, $por_x, 'product_id');
			$por_banners_to_show[$por_x]=$por_product_id;
		}
	}
	$por_r = mysql_query("SELECT product_id, name FROM `" . TABLE_PREFIX . "product_description` WHERE product_id IN (".implode(', ',$por_banners_to_show).") AND language_id='$por_language'");
	while ($por_row = mysql_fetch_assoc($por_r))
	{
		$por_imgq=mysql_query("SELECT image, price FROM `" . TABLE_PREFIX . "product` WHERE product_id='$por_row[product_id]'");
		$por_imga=mysql_fetch_array($por_imgq);

		$por_url=portgorod_get_product_url($por_row['product_id'], $por_seo_is_html, $por_seo_is_subcat, $por_seo_is_seo, $por_seo_main_dom);

		$por_img_url_se = !strstr($por_imga['image'], '/') ?  $por_img_def : $por_seo_main_dom.'image/'.$por_imga['image'];

//		$por_img_tochange = ($por_seo_dom == '') ?  $_SERVER["DOCUMENT_ROOT"].$por_img_url_se : $por_img_url_se;
		$por_img_tochange = $por_img_url_se;
		$por_img = portgorod_img_crop($por_img_tochange, $por_row['product_id'], $por_img_size_w, $por_img_size_h, $por_img_bg, $por_img_qua, $por_img_cha_folder, $por_img_rtype);

        $por_img_url = $uploads['baseurl'] .'/'. $por_img;
        $por_img_sizes = getimagesize($uploads['basedir'] .'/'. $por_img);
        $por_img_width = $por_img_sizes[0];
        $por_img_height = $por_img_sizes[1];

		$por_name=$por_row['name'];
		$por_price=rtrim(rtrim($por_imga['price'], '0'), '.');
		$por_id=$por_row['product_id'];
		include $por_template;
	}

}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'Awesome products' ;
		$por_prtag = isset( $instance[ 'por_prtag' ] ) ? $instance[ 'por_prtag' ] : '' ;
		$por_num = isset( $instance[ 'por_num' ] ) ? $instance[ 'por_num' ] : '3' ;
		$por_template = isset( $instance[ 'por_template' ] ) ? $instance[ 'por_template' ] : '1' ;
		$por_cat_to_look = isset( $instance[ 'por_cat_to_look' ] ) ? $instance[ 'por_cat_to_look' ] : '' ;
		$por_img_size_w = isset( $instance[ 'por_img_size_w' ] ) ? $instance[ 'por_img_size_w' ] : '100' ;
		$por_img_size_h = isset( $instance[ 'por_img_size_h' ] ) ? $instance[ 'por_img_size_h' ] : '100' ;
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php echo __( 'Title:', 'por_openopt_dom' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /><br /><br />

		<label for="<?php echo $this->get_field_name( 'por_prtag' ); ?>"><?php echo  __( 'Products tag to show:', 'por_openopt_dom' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'por_prtag' ); ?>" name="<?php echo $this->get_field_name( 'por_prtag' ); ?>" type="text" value="<?php echo esc_attr( $por_prtag ); ?>" /><br /><br />

		<label for="<?php echo $this->get_field_name( 'por_num' ); ?>"><?php echo  __( 'Number of products:', 'por_openopt_dom' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'por_num' ); ?>" name="<?php echo $this->get_field_name( 'por_num' ); ?>" type="text" value="<?php echo esc_attr( $por_num ); ?>" /><br /><br />

		<label for="<?php echo $this->get_field_name( 'por_template' ); ?>"><?php echo  __( 'Template to show:', 'por_openopt_dom' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'por_template' ); ?>" name="<?php echo $this->get_field_name( 'por_template' ); ?>" type="text" value="<?php echo esc_attr( $por_template ); ?>" /><br /><br />

		<label for="<?php echo $this->get_field_name( 'por_cat_to_look' ); ?>"><?php echo  __( 'Category id to show products from, after products with tag:', 'por_openopt_dom' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'por_cat_to_look' ); ?>" name="<?php echo $this->get_field_name( 'por_cat_to_look' ); ?>" type="text" value="<?php echo esc_attr( $por_cat_to_look ); ?>" /><br /><br />

		<label for="<?php echo $this->get_field_name( 'por_img_size_w' ); ?>"><?php echo  __( 'Thumb width:', 'por_openopt_dom' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'por_img_size_w' ); ?>" name="<?php echo $this->get_field_name( 'por_img_size_w' ); ?>" type="text" value="<?php echo esc_attr( $por_img_size_w ); ?>" /><br /><br />

		<label for="<?php echo $this->get_field_name( 'por_img_size_h' ); ?>"><?php echo  __( 'Thumb height:', 'por_openopt_dom' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'por_img_size_h' ); ?>" name="<?php echo $this->get_field_name( 'por_img_size_h' ); ?>" type="text" value="<?php echo esc_attr( $por_img_size_h ); ?>" /><br /><br />

		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = htmlspecialchars($new_instance['title']);
		$instance['por_prtag'] = htmlspecialchars($new_instance['por_prtag']);
		$instance['por_num'] = htmlspecialchars($new_instance['por_num']);
		$instance['por_template'] = htmlspecialchars($new_instance['por_template']);
		$instance['por_cat_to_look'] = htmlspecialchars($new_instance['por_cat_to_look']);
		$instance['por_img_size_w'] = htmlspecialchars($new_instance['por_img_size_w']);
		$instance['por_img_size_h'] = htmlspecialchars($new_instance['por_img_size_h']);

		return $instance;
	}
} // class portgorod_opencart_widget


// register widget
function register_portgorod_opencart_widget() {
    register_widget( 'portgorod_opencart_widget' );
}

function portgorod_opencart_admin()
{
    require('portgorod_opencart_admin.php');
    exit;
}

function portgorod_opencart_admin_go()
{
    add_options_page('Portgorod Opencart & OcStore settings', 'Portgorod OcStore', 1, "PortgorodOpencartMenu", "portgorod_opencart_admin");
}

add_action('admin_menu', 'portgorod_opencart_admin_go');
add_action( 'widgets_init', 'register_portgorod_opencart_widget' );
add_action('wp_head', 'portgorod_addtohead');
?>