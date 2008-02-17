<?php

/* <WP Plugin Data>
 * Plugin Name: Oceia bar
 * Version: 1.0
 * Plugin URI: http://sdho.org/oceia/bar?version=1.0
 * Description: A deliciously simple administration bar, inspired by the WordPress admin interface.
 * Author: Sean Hayford O&#8217;Leary
 * Author URI: http://sdho.org/
 */

function oceiabar() {
global $user_identity, $posts;

if(current_user_can('read')) {
	print "<div id=\"oceiabar\">\n\t<div id=\"quicklinks\">\n\t\t<ul>";

	// Special case for edit
	if(is_single()) {
		$edit_array = array(''.__('Edit this post').'', array('edit_post', $posts[0]->ID), 'post.php?action=edit&amp;post='.$posts[0]->ID, 'edit-link');
	} elseif(is_page()) {
		$edit_array = array(''.__('Edit this page').'', array('edit_post', $posts[0]->ID), 'post.php?action=edit&amp;post='.$posts[0]->ID, 'edit-link');
	}

	// Set menu items
	$menu = array(array(__('My Dashboard'), 'read', '', ''), array('New Post', 'edit_posts', 'post.php', 'write-link', ''), $edit_array);
	$menu = apply_filters('oceiabar', $menu);
	foreach ($menu as $item) {
		list ($name, $user_caps, $url, $class) = $item;
		$class = $class ? ' class="'. $class .'"' : '';
		if (!is_array($user_caps)) $user_caps = array($user_caps);

		if (call_user_func_array('current_user_can', $user_caps))
			print "\n\t\t\t<li><a href=\"".get_settings('siteurl')."/wp-admin/$url\">$name</a></li>";
	}

	// Welcome message
	print "\n\t\t</ul>\n\t</div>\n\t<div id=\"loginout\">Howdy, ".$user_identity." &nbsp; ";

	// Login, logout, and profile links
	print "[<a href=\"".get_settings('siteurl')."/wp-login.php?action=logout\">Sign Out</a>, ";
	print "<a href=\"".get_settings('siteurl')."/wp-admin/profile.php\">My Account</a>]</div>";
	print "\n</div>\n";
}}

function oceiabar_getstyle() {
	include "style.css";
}

function oceiabar_style () {
	global $user_level;

	if(isset($user_level)) { // only add style if user logged in.
print "<style type=\"text/css\">\n";
oceiabar_getstyle();
print "\n</style>\n";
	}
}

add_action('wp_head','oceiabar_style');
add_action('wp_footer','oceiabar'); ?>