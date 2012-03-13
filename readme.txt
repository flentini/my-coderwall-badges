=== My Coderwall Badges ===
Contributors: tpk
Tags: coderwall, badges
Requires at least: 3.0
Tested up to: 3.3.1
Stable tag: 0.4

gets your badges from coderwall website and let you show them on your blog.

== Description ==

this simple plugin lets you get your coderwall.com badges and show them on your blog. 
install, activate the plugin and set your username in the CW Badges Panel.
You can display your badges using the [cwbadges] shortcode inside your pages/posts.
You have also these functions available: 

echo $cwb->get_username() -> display username

echo $cwb->get_name() -> display name

echo $cwb->get_location() -> display location

echo $cwb->get_badges() -> display user badges

you can call them inside your theme's files.

There's also a widget which waits to be activated by you in the theme options.

== Installation ==

1. Upload my-coderwall-badges directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. Setup Panel

== Changelog ==

= 0.4 =
* German translation

= 0.3 =
* Added a simple widget.

= 0.2 =
* Minor fixes, added shortcode, removed curl functions.

= 0.1 =
* First release.
