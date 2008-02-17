<?php

/* <WP Plugin Data>
 * Plugin Name: Oceia bar
 * Version: 0.9.1
 * Plugin URI: http://sdho.hayfordoleary.com/oceia/bar?version=0.9.1
 * Description: A deliciously simple administration bar plugin, inspired by <a href="http://wordpress.com">WordPress.com</a> and built on Matt Read&#8217;s <a href="http://mattread.com/projects/wp-plugins/wp-admin-bar-20">WP Admin Bar</a>.
 * Author: Sean Hayford O&#8217;Leary
 * Author URI: http://sdho.hayfordoleary.com/
 */

function ob() {
global $user_identity, $posts;

if ( current_user_can('read') ) {
	print "<div id=\"ob\">\n\t<div id=\"quicklinks\">\n\t\t<ul>";

	// Special case for edit
	if (is_single()) { $edit_array = array(''.__('Edit this post').'', array('edit_post', $posts[0]->ID), 'post.php?action=edit&amp;post='.$posts[0]->ID, 'edit-link'); }
	elseif (is_page()) { $edit_array = array(''.__('Edit this page').'', array('edit_post', $posts[0]->ID), 'post.php?action=edit&amp;post='.$posts[0]->ID, 'edit-link'); }

	// Set menu items
	$menu = array(
		array(__('My Dashboard'), 'read', '', ''),
		array('New Post', 'edit_posts', 'post.php', 'write-link', ''),
		$edit_array
		);
	$menu = apply_filters('ob', $menu);
	foreach ($menu as $item) {
		list ($name, $user_caps, $url, $class) = $item;
		$class = $class ? ' class="'. $class .'"' : '';
		if (!is_array($user_caps)) $user_caps = array($user_caps);

		if ( call_user_func_array('current_user_can', $user_caps) )
			print "\n\t\t\t<li><a href=\"".get_settings('siteurl')."/wp-admin/$url\">$name</a></li>";
	}

	// Welcome message
	print "\n\t\t</ul>\n\t</div>\n\t<div id=\"loginout\">Howdy, ".$user_identity." &nbsp; ";

	// Login, logout, and profile links
	print "[<a href=\"".get_settings('siteurl')."/wp-login.php?action=logout\">Sign Out</a>, ";
	print "<a href=\"".get_settings('siteurl')."/wp-admin/profile.php\">My Account</a>]</div>";
	print "\n</div>\n";
}}

function ob_style ()
{
	global $user_level;

	if ( isset($user_level) ) { // only add style if user logged in.
		ob_start();

print "\n<style type=\"text/css\">
	body {
		padding: 31px 0 0 0;
	}

	#loginout {
		color: #c3def1;
		margin: 0;
		padding: 0;
		position: absolute;
		right: 1em;
		top: 7px;
	}

	#loginout a {
		text-decoration: none;
	}

	#loginout a:hover {
		text-decoration: underline;
	}

	#loginout a, #loginout a:hover {
		color: #fff;
	}

	#ob {
		background: #14568a;
		font: 12px \"lucida grande\", \"lucida sans unicode\", \"tahoma\", sans-serif;
		height: 30px;
		left: 0;
		position: absolute;
		top: 0;
		width: 100%;
	}

	#quicklinks ul {
		list-style: none;
		margin: 0;
		padding: 0;
	}

	#quicklinks li {
		float: left;
	}

	#quicklinks a {
		color: #c3def1;
		display: block;
		font-weight: normal;
		padding: .5em 1em;
		text-decoration: none;
	}

	#quicklinks a:hover {
		background: #6da6d1;
		color: #000;
	}
</style>\n";

		$css = ob_get_contents();
		ob_end_clean();
		print($css);
	}
}

add_action('wp_head','ob_style');
add_action('wp_footer','ob'); ?>