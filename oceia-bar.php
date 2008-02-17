<?php
/*
	Plugin Name: Oceia bar
	Plugin URI: http://archivemedia.org/oceia/bar/
	Description: A simple administration bar, inspired by WordPress&#8217; admin interface.
	Version: 2.3.1
	Author: Sean Hayford O&#8217;Leary
	Author URI: http://sdho.org/
*/

if(get_bloginfo('version') >= '2.1') {
	function oceiabar() {
	global $user_identity, $posts;

	if(current_user_can('read')) {
		$oceiabar_dashboard = "\t\t".'<li><a href="'.get_settings('siteurl').'/wp-admin/">My Dashboard</a></li>';
		if(current_user_can('manage_options')) {
			$oceiabar_account = "\t\t".'<li><a class="oceiabar-primary" href="'.get_settings('siteurl').'/wp-admin/profile.php">My Account</a>'."\n\t\t<ul>\n\t\t\t<li><a href=\"".get_settings('siteurl')."/wp-admin/profile.php\">Edit Profile</a></li>\n\t\t\t<li><a href=\"http://wordpress.org/support/\">Support</a></li>\n\t\t\t<li><a href=\"http://wordpress.org/\">WordPress</a></li>\n\t\t\t<li><a href=\"".get_settings('siteurl').'/wp-login.php?action=logout&#38;redirect_to=http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\">Log Out</a></li>\n\t\t</ul>\n\t".'</li>';
		} else {
			$oceiabar_account = "\t\t".'<li><a class="oceiabar-primary" href="'.get_settings('siteurl').'/wp-admin/profile.php">My Account</a>'."\n\t\t<ul>\n\t\t\t<li><a href=\"".get_settings('siteurl')."/wp-admin/profile.php\">Edit Profile</a></li>\n\t\t\t<li><a href=\"".get_settings('siteurl').'/wp-login.php?action=logout&#38;redirect_to=http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\">Log Out</a></li>\n\t\t</ul>\n\t".'</li>';
		}
		if(current_user_can('edit_posts')) {
			if(current_user_can('edit_pages')) {
				$oceiabar_new_page = "\n\t\t\t<li><a href=\"".get_settings('siteurl')."/wp-admin/page-new.php\">Page</a></li>";
			} else {
				$oceiabar_new_page = '';
			}
			$oceiabar_new = "\t\t".'<li><a class="oceiabar-primary" href="'.get_settings('siteurl').'/wp-admin/post-new.php">New Content</a>'."\n\t\t<ul>\n\t\t\t<li><a href=\"".get_settings('siteurl')."/wp-admin/post-new.php\">Post</a></li>".$oceiabar_new_page."\n\t\t</ul>\n\t".'</li>';
		}

		if(is_single()) {
			if(current_user_can('edit_post')) {
				$oceiabar_edit = "\t\t".'<li><a href="'.get_settings('siteurl').'/wp-admin/post.php?action=edit&#38;post='.$posts[0]->ID.'">Edit</a></li>';
			} else {
				$oceiabar_edit = '';
			}
		} elseif(is_page()) {
			if(current_user_can('edit_post')) {
				$oceiabar_edit = '<li><a href="'.get_settings('siteurl').'/wp-admin/page.php?action=edit&#38;post='.$posts[0]->ID.'">Edit</a></li>';
			} else {
				$oceiabar_edit = '';
			}
		}
		echo "\n<div id=\"oceiabar\">\n\t<div id=\"oceiabar-quicklinks\">\n\t\t<ul id=\"oceiabar-quicklinks-list\">\n".$oceiabar_account."\n".$oceiabar_dashboard."\n".$oceiabar_new."\n".$oceiabar_edit."\n\t</ul></div>\n<div id=\"oceiabar-bloginfo\">&#8220;".wptexturize(get_bloginfo('name'))."&#8221;</div>\n</div>\n";
	}}

	function oceiabar_css() {
		if(current_user_can('read')) {
			$oceiabar_css = "<style type=\"text/css\" media=\"all\">\n\t/* <![CDATA[ */\n\tbody {\n\t\tpadding: 28px 0 0 0 !important;\n\t}\n\n\t#oceiabar {\n\t\tbackground: #14568a url('".get_settings('siteurl')."/wp-content/plugins/oceia-bar/background.png') center top no-repeat !important;\n\t\tborder-bottom: 1px solid #3285ae !important;\n\t\tcolor: #c3def1 !important;\n\t\tfont: 12px \"lucida grande\", \"lucida sans unicode\", \"tahoma\", sans-serif !important;\n\t\tfont-style: normal !important;\n\t\theight: 27px !important;\n\t\tleft: 0 !important;\n\t\tletter-spacing: 0 !important;\n\t\tposition: absolute !important;\n\t\ttop: 0 !important;\n\t\twidth: 100% !important;\n\t}\n\n\t#oceiabar #oceiabar-bloginfo {\n\t\tmargin: 0 !important;\n\t\tpadding: 0 !important;\n\t\tposition: absolute !important;\n\t\tright: 1em !important;\n\t\ttop: 7px !important;\n\t}\n\n\t#oceiabar #oceiabar-bloginfo #name {\n\t\tbackground: inherit !important;\n\t\tcolor: #fff !important;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks ul {\n\t\tpadding: 0 !important;\n\t\tmargin: 0 !important;\n\t\tlist-style: none !important;\n\t\ttext-align: left !important;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li {\n\t\tfloat: left !important;\n\t\tposition: relative !important;\n\t\twidth: 9em !important;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li a.oceiabar-primary {\n\t\tbackground: url('".get_settings('siteurl')."/wp-content/plugins/oceia-bar/down.png') right center no-repeat !important;\n\t\tpadding-right: 5px !important;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li ul {\n\t\tbackground: #14568a !important;\n\t\tborder:1px solid #3285ae !important;\n\t\tcolor: inherit !important;\n\t\tdisplay: none !important;\n\t\tposition: absolute !important;\n\t\ttop: 1em !important;\n\t\tleft: 0 !important;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li ul li a {\n\t\ttext-align: left !important;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li ul {\n\t\ttop: auto !important;\n\t\tleft: auto !important;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li:hover ul, #oceiabar #oceiabar-quicklinks li.over ul {\n\t\tdisplay: block !important;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks ul {\n\t\tlist-style: none !important;\n\t\tmargin: 0 !important;\n\t\tpadding: 0 !important;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li a {\n\t\tbackground: inherit !important;\n\t\tcolor: #c3def1 !important;\n\t\tdisplay: block !important;\n\t\tfont-weight: normal !important;\n\t\tpadding: .5em 10px !important;\n\t\ttext-align: center !important;\n\t\ttext-decoration: none !important;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li a.oceiabar-primary {\n\t\ttext-align: left !important;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li:hover, #oceiabar #oceiabar-quicklinks li a:hover {\n\t\tbackground: #2c77a4 !important;\n\t\tcolor: #fff !important;\n\t\ttext-decoration: none !important;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li a.oceiabar-primary:hover {\n\t\tbackground: #2c77a4 url('".get_settings('siteurl')."/wp-content/plugins/oceia-bar/down.png') right center no-repeat !important;\n\t\tcolor: #fff !important;\n\t\tpadding-right: 5px !important;\n\t\ttext-decoration: none !important;\n\t}";

			if(file_exists(dirname(__FILE__).'/style.css') && is_readable(dirname(__FILE__).'/style.css')) {
				$oceiabar_customstyle = file_get_contents(dirname(__FILE__).'/style.css');
				if(!empty($oceiabar_customstyle)) {
					$oceiabar_css = str_replace(' !important', '', $oceiabar_css)."\n\n".$oceiabar_customstyle;
				}
			}

			$oceiabar_css .= "\n\t/* ]]> */\n</style>\n<style type=\"text/css\" media=\"print\">\n\t/* <![CDATA[ */\n\tbody {;\n\t\tpadding: 0 !important;\n\t}\n\n\t#oceiabar {\n\t\tdisplay: none;\n\t}\n\t/* ]]> */\n</style>\n";
			echo $oceiabar_css;
		}
	}

	function oceiabar_js() {
		if(current_user_can('read')) {
			echo "<script type=\"text/javascript\">\n\t<!-- // <![CDATA[ -->\n\toceiaBarDrop = function() {\n\t\tif (document.all&&document.getElementById) {\n\t\t\tnavRoot = document.getElementById(\"oceiabar-quicklinks-list\");\n\t\t\tfor (i=0; i<navRoot.childNodes.length; i++) {\n\t\t\t\tnode = navRoot.childNodes[i];\n\t\t\t\tif (node.nodeName == \"LI\") {\n\t\t\t\t\tnode.onmouseover=function() {\n\t\t\t\t\t\tthis.className+=\" over\";\n\t\t\t\t\t}\n\t\t\t\t\tnode.onmouseout=function() {\n\t\t\t\t\t\tthis.className=this.className.replace(\" over\", \"\");\n\t\t\t\t\t}\n\t\t\t\t}\n\t\t\t}\n\t\t}\n\t}\n\twindow.onload = oceiaBarDrop;\n\t<!-- // ]]> -->\n</script>\n";
		}
	}
	
	if(!function_exists('wp_adminbar')) {
		function wp_adminbar() {
			return TRUE;
		}
	}

	add_action('wp_head', 'oceiabar_js');
	add_action('wp_head', 'oceiabar_css');
	add_action('wp_footer', 'oceiabar');
} else {
	$oceiabar_plugin_path = ABSPATH.'wp-content'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR;
	$oceiabar_plugin = str_replace($oceiabar_plugin_path, '', __FILE__);
	$oceiabar_current = get_settings('active_plugins');
	array_splice($oceiabar_current, array_search(plugin, $oceiabar_current), 1);
	update_option('active_plugins', $oceiabar_current);
	do_action('deactivate_'.trim($oceiabar_plugin));
}
?>