	<?php

/* <WP Plugin Data>
 * Plugin Name: Oceia bar
 * Version: 1.2.1m
 * Plugin URI: http://sdho.org/oceia/bar/
 * Description: A special version of the deliciously simple administration bar, designed for use with the <a href="http://rephrase.net/box/word/multiply/">Multiply plug-in</a> (this version of Oceia bar will not work without Multiply installed).
 * Author: Sean Hayford O&#8217;Leary
 * Author URI: http://sdho.org/
 */

if(get_bloginfo("version") >= "2.0" && class_exists("Multiply")) {
	function oceiabar() {
	global $user_identity, $posts, $mb_press_id;
	if(current_user_can("read")) {
		print "<div id=\"oceiabar\">\n\t<div id=\"quicklinks\">\n\t\t<ul>";

		// Special case for edit
		if(is_single()) {
			$edit_array = array("".__("Edit this post")."", array("edit_post", $posts[0]->ID), "post.php?action=edit&#38;post=".$posts[0]->ID."&#38;set_press_id=".$mb_press_id, "edit-link");
		} elseif(is_page()) {
			if(get_bloginfo("version") >= "2.1") {
				$edit_array = array("".__("Edit this page")."", array("edit_post", $posts[0]->ID), "page.php?action=edit&#38;post=".$posts[0]->ID."&#38;set_press_id=".$mb_press_id, "edit-link");
			} else {
				$edit_array = array("".__("Edit this page")."", array("edit_post", $posts[0]->ID), "post.php?action=edit&#38;post=".$posts[0]->ID."&#38;set_press_id=".$mb_press_id, "edit-link");
			}
		}

		// Set menu items
		if(get_bloginfo("version") >= "2.1") {
			$menu = array(array(__("My Dashboard"), "read", "?set_press_id=".$mb_press_id, ""), array("New Post", "edit_posts", "post-new.php?set_press_id=".$mb_press_id, "write-link", ""), $edit_array);
		} else {
			$menu = array(array(__("My Dashboard"), "read", "?set_press_id=".$mb_press_id, ""), array("New Post", "edit_posts", "post.php?set_press_id=".$mb_press_id, "write-link", ""), $edit_array);
		}
		$menu = apply_filters("oceiabar", $menu);
		foreach($menu as $item) {
			list($name, $user_caps, $url, $class) = $item;
			$class = $class ? ' class="'.$class.'"' : '';
			if(!is_array($user_caps)) {
				$user_caps = array($user_caps);
			}

			if(call_user_func_array("current_user_can", $user_caps))
				print "\n\t\t\t<li><a href=\"".get_settings("siteurl")."/wp-admin/".$url."\">".$name."</a></li>";
		}

		// Welcome message
		print "\n\t\t</ul>\n\t</div>\n\t<div id=\"loginout\">Howdy, <span id=\"name\">".$user_identity."</span> &nbsp; ";

		// Login, logout, and profile links
		print "[<a href=\"".get_settings("siteurl")."/wp-login.php?action=logout&#38;redirect_to=http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\">Sign Out</a>, ";
		print "<a href=\"".get_settings("siteurl")."/wp-admin/profile.php?set_press_id=".$mb_press_id."\">My Account</a>]</div>";
		print "\n</div>\n";
	}}

	function oceiabar_style() {
		if(current_user_can("read")) {
	print "<style type=\"text/css\">
	body {
		padding: 30px 0 0 0;
	}

	#oceiabar {
		background: #14568a;
		color: #c3def1;
		font: 12px \"lucida grande\", \"lucida sans unicode\", \"tahoma\", sans-serif;
		height: 30px;
		left: 0;
		position: absolute;
		top: 0;
		width: 100%;
	}

	#oceiabar #loginout {
		margin: 0;
		padding: 0;
		position: absolute;
		right: 1em;
		top: 7px;
	}

	#oceiabar #loginout a, #oceiabar #loginout a:hover {
		background: inherit;
		color: #fff;
		text-decoration: none;
	}

	#oceiabar #loginout #name {
		background: inherit;
		color: #fff;
	}

	#oceiabar #quicklinks ul {
		list-style: none;
		margin: 0;
		padding: 0;
	}

	#oceiabar #quicklinks li {
		float: left;
	}

	#oceiabar #quicklinks li a {
		background: inherit;
		color: #c3def1;
		display: block;
		font-weight: normal;
		padding: .5em 1em;
		text-decoration: none;
	}

	#oceiabar #quicklinks li a:hover {
		background: #6da6d1;
		color: #000;
		text-decoration: none;
	}";

	if(file_exists(dirname(__FILE__)."/style.css")) {
		$oceiabar_customstyle = file_get_contents(dirname(__FILE__)."/style.css");
		if(!empty($oceiabar_customstyle)) {
			print "\n\n".$oceiabar_customstyle;
		}
	}

	print "\n</style>\n";
		}
	}

	add_action("wp_head", "oceiabar_style");
	add_action("wp_footer", "oceiabar");
} else {
	$oceiabar_plugin_path = ABSPATH."wp-content".DIRECTORY_SEPARATOR."plugins".DIRECTORY_SEPARATOR; 
	$oceiabar_plugin = str_replace($oceiabar_plugin_path, "", __FILE__); 
	$oceiabar_current = get_settings("active_plugins"); 
	array_splice($oceiabar_current, array_search(plugin, $oceiabar_current), 1);
	update_option("active_plugins", $oceiabar_current); 
	do_action("deactivate_".trim($oceiabar_plugin)); 
}?>