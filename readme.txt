=== Pocket Read It Later Links ===
Contributors: johnbillion
Tags: pocket, getpocket, bookmark, read it later, read later, social bookmarking
Donate link: http://lud.icro.us/donations/
Requires at least: 3.3
Tested up to: 3.4
Stable tag: trunk
License: GPLv2 or later

Allows you to automatically display Pocket 'Read It Later' links next to your blog posts.

== Description ==

This plugin allows you to display [Pocket](http://getpocket.com/) 'Read It Later' links next to each post on your blog. You can see an example on [the Pocket blog](http://getpocket.com/blog/). You can automatically insert the links adjacent to your blog posts or you can use the template tag to insert the links wherever you like.

== Installation ==

You can install this plugin directly from your WordPress dashboard:

 1. Go to the *Plugins* menu and click *Add New*.
 2. Search for *Pocket Read It Later Links*.
 3. Click *Install Now* next to the Pocket Read It Later Links plugin.
 4. Activate the plugin.

Alternatively, see the guide to [Manually Installing Plugins](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

Once activated, check out the front page of your blog. A 'Read It Later' link will now show adjacent to each post.

= Usage =

By default, this plugin adds a 'Read It Later' link adjacent to each blog post on your blog. You can control where the 'Read It Later' links show up by going to the Settings -> Pocket Links menu in WordPress.

If you choose not to automatically display links, you'll need to add the following code to your theme in order insert the 'Read It Later' link for each post:

`<php do_action('pocket_read_it_later'); ?>`

The code should be inside the WordPress loop. If used outside the loop, it accepts an optional second parameter for the post ID.

== Screenshots ==

1. 'Read It Later' links inserted automatically into the WordPress default theme

2. The options screen

== Frequently Asked Questions ==

= What the hell is Pocket? =

From getpocket.com:

> Pocket (formerly Read It Later) helps people who discover an interesting article, video or web page, but don't have time to view it. Once saved to Pocket, the list of content is visible on any device -- phone, tablet or computer. It can be viewed while waiting in line, on the couch or during commutes or travel -- even offline.

Check out [getpocket.com](http://getpocket.com/) for all the details and to sign up.

= Will the Read It Later links show up on custom post types? =

No, you will need to manually add the following template tag to your custom post type templates where you want the links to appear:

`<php do_action('pocket_read_it_later'); ?>`

= Is this an official Pocket plugin? =

No.

= This is just like your Instapaper Read Later Links plugin isn't it? =

Yep. I actually prefer Instapaper, but Pocket is cool too.

== Changelog ==

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.0 =
* Initial release.
