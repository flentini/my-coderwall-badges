=== My Coderwall Badges ===
Contributors: tpk
Tags: coderwall, badges
Requires at least: 3.0
Tested up to: 3.3.1
Stable tag: 0.1

gets your badges from coderwall website and let you show them on your blog.

== Description ==

this simple plugin lets you get your coderwall.com badges and show them on your blog. 
install and activate the plugin and set your username in the CW Badges Panel.
Then you have these functions available: 

echo $cwb->get_username() -> display username
echo $cwb->get_name() -> display name
echo $cwb->get_location() -> display location
echo $cwb->get_badges() -> display user badges

you can call them inside your theme's files.  

== Installation ==

1. Upload my-coderwall-badges directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= When I activate the plugin I get: Fatal error: Call to undefined function curl_init() =

this plugin uses cURL to get user informations from the coderwall website. If you get this error, it's probably not enabled.
If you have direct access to your host machine, you can enable cURL by uncommenting the "extension=php_curl" in your php.ini.

== Screenshots ==

1. Setup Panel

== Changelog ==

= 0.1 =
* First release.