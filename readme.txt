=== My Coderwall Badges ===
Contributors: tpk
Tags: coderwall, badges
Requires at least: 3.0
Tested up to: 3.3.1
Stable tag: 0.5

gets your badges from coderwall website and let you show them on your blog.

== Description ==

This simple plugin lets you get your [Coderwall](http://coderwall.com) badges and show them on your blog.
Install, activate the plugin and set your username in the CW Badges Panel.
You can display your badges using the [cwbadges] shortcode inside your pages/posts.
You also have these functions available:

echo $cwb->get_username() -> display username

echo $cwb->get_name() -> display name

echo $cwb->get_location() -> display location

echo $cwb->get_badges() -> display user badges

You can call them inside your theme's files.

There's also a widget which waits to be activated by you in the theme options.

== Installation ==

1. Upload my-coderwall-badges directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Copy the style in `css/style.css` to your theme's stylesheet and adapt it to your needs.

== Screenshots ==

1. Setup Panel

== Changelog ==

= 0.5 =
* Added option to show Coderwall endorsements (http://coderwall.com/blog/2012-01-16-the-hacker-version-of-an-embeddable-social-button)

= 0.4 =
* German translation

= 0.3 =
* Added a simple widget.

= 0.2 =
* Minor fixes, added shortcode, removed curl functions.

= 0.1 =
* First release.
