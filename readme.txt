=== Plugin Name ===
Contributors: Usernaprimer
Tags: opencart, product, ocstore, display, show, widget
Requires at least: 3.0.1
Tested up to: 3.8
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=V6RR4L2T3ASCG

This plugin creates simpe widget to show products from your opencart or ocstore in your wordpress.

== Description ==

This plugin creates simpe widget to show products from your opencart or ocstore in your wordpress. It takes from shop bd the right amount of random products with "tag". If amount wit "tag" is less than need, it takes random product from category (you can setup this category). If there are no setuped category, it shows just random products.

A few notes about the sections above:

*   You can set up domain of store or it's adress (blog.com -> shop.com or blog.com -> blog.com/shop/) different ways
*   Plugin works correctly with different type of urls:
/shop/category/product.html ("seopro" plugin for ocstore or opencart)
/shop/category/product ("seopro" plugin for ocstore or opencart)
/shop/index.php?route=product/product&path=20&product_id=40 (clean ocstore or opencart)
*   You can select db prefix of store tables
*   Works perfect with "display widget" plugin (you can show different products in different pages or categories of blog)
*   You can edit template. It is very simple, because template is .html file.
*   You can create your own different templates.
*   You can chose "tag" to show (you should set up tag in product page in admin pannel of shop)
*   You can chose number of products
*   Different ways to create thumbs
*   If your blog and your shop on one domian, you can try to set up "add to cart" button right from blog



== Installation ==

1. Unzip portgorod-ocstore.zip

2. Upload `portgorod-ocstore` folder to the `/wp-content/plugins/` directory

3. Activate the plugin through the 'Plugins' menu in WordPress

4. Admin panel -> settings -> Portgorod OcStore (PLEASE FILL IT!)

5. Setup widget

6. ?? enjoy!

== Frequently Asked Questions ==

= Can i set up plugin to work with remote db? =

Yes. But only if you can set up remote db for connections



== Screenshots ==

1. screenshot-1.jpg How it looks
2. screenshot-2.jpg Admin panel
3. screenshot-3.jpg Widget settings
4. screenshot-4.jpg Produst in ocstore admin settings (tag to show)

== Changelog ==

= 0.2b =
Still testing
= 1.0 =
First stable version

added prefix support

added different templates

added "display widgets" support
= 1.1 =
Fixed bugs with thumb create
= 1.2 =
Fixed bugs with png file photos

Strange bug with spaces in files path - fixed

Little bug with default images is fixed too


== Upgrade Notice ==

No notes.