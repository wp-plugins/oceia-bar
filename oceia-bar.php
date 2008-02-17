<?php

/* <WP Plugin Data>
 * Plugin Name: Oceia bar
 * Version: 2.0
 * Plugin URI: http://sdho.org/oceia/bar/
 * Description: A deliciously simple administration bar, inspired by WordPress&#8217; admin interface.
 * Author: Sean Hayford O&#8217;Leary
 * Author URI: http://sdho.org/
 */

$oceiabar_uriroot_path = ABSPATH.'wp-content'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR;
$oceiabar_uriroot_file = str_replace($oceiabar_uriroot_path, '', __FILE__);
$oceiabar_uriroot = str_replace('/'.basename($oceiabar_uriroot_file), '', $oceiabar_uriroot_file);

if(get_bloginfo('version') >= '2.0') {
	function oceiabar() {
	global $user_identity, $posts;
	if(current_user_can('read')) {
		$oceiabar_dashboard = '<li><a href="'.get_settings('siteurl').'/wp-admin/">My Dashboard</a></li>';
		if(current_user_can('manage_options')) {
			$oceiabar_account = '<li><a class="oceiabar-primary" href="'.get_settings('siteurl').'/wp-admin/profile.php">My Account</a>'."\n\t\t<ul>\n\t\t\t<li><a href=\"".get_settings('siteurl')."/wp-admin/profile.php\">Edit Profile</a></li>\n\t\t\t<li><a href=\"http://wordpress.org/support/\">Support</a></li>\n\t\t\t<li><a href=\"http://wordpress.org/\">WordPress</a></li>\n\t\t\t<li><a href=\"".get_settings('siteurl')."/wp-login.php?action=logout&#38;redirect_to=http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\">Log Out</a></li>\n\t\t</ul>\n\t".'</li>';
		} else {
			$oceiabar_account = '<li><a class="oceiabar-primary" href="'.get_settings('siteurl').'/wp-admin/profile.php">My Account</a>'."\n\t\t<ul>\n\t\t\t<li><a href=\"".get_settings('siteurl')."/wp-admin/profile.php\">Edit Profile</a></li>\n\t\t\t<li><a href=\"".get_settings('siteurl')."/wp-login.php?action=logout&#38;redirect_to=http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\">Log Out</a></li>\n\t\t</ul>\n\t".'</li>';
		}
		if(current_user_can('edit_posts')) {
			if(current_user_can('edit_pages')) {
				$oceiabar_new_page = "\n\t\t\t<li><a href=\"".get_settings('siteurl')."/wp-admin/page-new.php\">Page</a></li>";
			} else {
				$oceiabar_new_page = '';
			}
			if(get_bloginfo('version') >= '2.1') {
				$oceiabar_new = '<li><a class="oceiabar-primary" href="'.get_settings('siteurl').'/wp-admin/post-new.php">New Content</a>'."\n\t\t<ul>\n\t\t\t<li><a href=\"".get_settings('siteurl')."/wp-admin/post-new.php\">Post</a></li>".$oceiabar_new_page."\n\t\t</ul>\n\t".'</li>';
			} else {
				$oceiabar_new = '<li><a class="oceiabar-primary" href="'.get_settings('siteurl').'/wp-admin/post.php">New Content</a>'."\n\t\t<ul>\n\t\t\t<li><a href=\"".get_settings('siteurl')."/wp-admin/post.php\">Post</a></li>".$oceiabar_new_page."\n\t\t</ul>\n\t".'</li>';
			}
		}

		if(is_single()) {
			if(current_user_can('edit_post')) {
				$oceiabar_edit = '<li><a href="'.get_settings('siteurl').'/wp-admin/post.php?action=edit&#38;post='.$posts[0]->ID.'">Edit</a></li>';
			} else {
				$oceiabar_edit = '';
			}
		} elseif(is_page()) {
			if(get_bloginfo('version') >= '2.1') {
				if(current_user_can('edit_post')) {
					$oceiabar_edit = '<li><a href="'.get_settings('siteurl').'/wp-admin/page.php?action=edit&#38;post='.$posts[0]->ID.'">Edit</a></li>';
				} else {
					$oceiabar_edit = '';
				}
			} else {
				if(current_user_can('edit_post')) {
					$oceiabar_edit = '<li><a href="'.get_settings('siteurl').'/wp-admin/post.php?action=edit&#38;post='.$posts[0]->ID.'">Edit</a></li>';
				} else {
					$oceiabar_edit = '';
				}
			}
		}

		echo "\n<div id=\"oceiabar\">\n\t<div id=\"oceiabar-quicklinks\">\n\t\t<ul>\n".$oceiabar_account."\n".$oceiabar_dashboard."\n".$oceiabar_new."\n".$oceiabar_edit."\n\t</ul></div>\n<div id=\"oceiabar-bloginfo\">&#8220;".wptexturize(get_bloginfo('name'))."&#8221;</div>\n</div>\n";
	}}

	function oceiabar_style() {
		global $oceiabar_uriroot;
		if(current_user_can('read')) {
	print "<style type=\"text/css\">\n\t/* <![CDATA[ */\n\tbody {\n\t\tpadding: 28px 0 0 0;\n\t}\n\n\t#oceiabar {\n\t\tbackground: #14568a url('".get_settings('siteurl')."/wp-content/plugins/".$oceiabar_uriroot."/background.png') center top no-repeat;\n\t\tborder-bottom:1px solid #3285ae;\n\t\tcolor: #c3def1;\n\t\tfont: 12px \"lucida grande\", \"lucida sans unicode\", \"tahoma\", sans-serif;\n\t\tfont-style: normal;\n\t\theight: 27px;\n\t\tleft: 0;\n\t\tletter-spacing: 0;\n\t\tposition: absolute;\n\t\ttop: 0;\n\t\twidth: 100%;\n\t}\n\n\t#oceiabar #oceiabar-bloginfo {\n\t\tmargin: 0;\n\t\tpadding: 0;\n\t\tposition: absolute;\n\t\tright: 1em;\n\t\ttop: 7px;\n\t}\n\n\t#oceiabar #oceiabar-bloginfo #name {\n\t\tbackground: inherit;\n\t\tcolor: #fff;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks {\n\t\tpadding: 0;\n\t\tmargin: 0;\n\t\tlist-style: none;\n\t\ttext-align: left;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li {\n\t\tfloat: left;\n\t\tposition: relative;\n\t\twidth: 9em;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li a.oceiabar-primary {\n\t\tbackground: url('".get_settings('siteurl')."/wp-content/plugins/".$oceiabar_uriroot."/down.gif') right center no-repeat;\n\t\tpadding-right: 5px;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li ul {\n\t\tbackground: #14568a;\n\t\tborder:1px solid #3285ae;\n\t\tcolor: inherit;\n\t\tdisplay: none;\n\t\tposition: absolute;\n\t\ttop: 1em;\n\t\tleft: 0;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li ul li a {\n\t\ttext-align: left;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li>ul {\n\t\ttop: auto;\n\t\tleft: auto;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li:hover ul, #oceiabar #oceiabar-quicklinks li.over ul {\n\t\tdisplay: block;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks ul {\n\t\tlist-style: none;\n\t\tmargin: 0;\n\t\tpadding: 0;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li a {\n\t\tbackground: inherit;\n\t\tcolor: #c3def1;\n\t\tdisplay: block;\n\t\tfont-weight: normal;\n\t\tpadding: .5em 10px;\n\t\ttext-align: center;\n\t\ttext-decoration: none;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li a.oceiabar-primary {\n\t\ttext-align: left;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li:hover, #oceiabar #oceiabar-quicklinks li a:hover {\n\t\tbackground: #2c77a4;\n\t\tcolor: #fff;\n\t\ttext-decoration: none;\n\t}\n\n\t#oceiabar #oceiabar-quicklinks li a.oceiabar-primary:hover {\n\t\tbackground: #2c77a4 url('".get_settings('siteurl')."/wp-content/plugins/".$oceiabar_uriroot."/down.gif') right center no-repeat;\n\t\tcolor: #fff;\n\t\tpadding-right: 5px;\n\t\ttext-decoration: none;\n\t}";

	if(file_exists(dirname(__FILE__).'/style.css')) {
		$oceiabar_customstyle = file_get_contents(dirname(__FILE__).'/style.css');
		if(!empty($oceiabar_customstyle)) {
			print "\n\n".$oceiabar_customstyle;
		}
	}

	print "\n\t/* ]]> */\n</style>\n";
		}
	}

	function oceiabar_js() {
		if(current_user_can('read')) {
			echo "<script type=\"text/javascript\">\n// <![CDATA[\nstartList = function() {\n\tif (document.all&&document.getElementById) {\n\t\tnavRoot = document.getElementById(\"oceiabar\").getElementById(\"quicklinks\");\n\t\tfor (i=0; i<navRoot.childNodes.length; i++) {\n\t\t\tnode = navRoot.childNodes[i];\n\t\t\tif (node.nodeName==\"LI\") {\n\t\t\t\tnode.onmouseover=function() {\n\t\t\t\t\tthis.className+=\" over\";\n\t\t\t\t}\n\t\t\t\tnode.onmouseout=function() {\n\t\t\t\t\tthis.className=this.className.replace(\" over\", \"\");\n\t\t\t\t}\n\t\t\t}\n\t\t}\n\t}\n}\nwindow.onload=startList;\n// ]]>\n</script>\n";
		}
	}

	if($_GET['preview'] !== 'true') {
		add_action('wp_head', 'oceiabar_js');
		add_action('wp_head', 'oceiabar_style');
		add_action('wp_footer', 'oceiabar');
	}
} else {
	$oceiabar_plugin_path = ABSPATH.'wp-content'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR;
	$oceiabar_plugin = str_replace($oceiabar_plugin_path, '', __FILE__);
	$oceiabar_current = get_settings('active_plugins');
	array_splice($oceiabar_current, array_search(plugin, $oceiabar_current), 1);
	update_option('active_plugins', $oceiabar_current);
	do_action('deactivate_'.trim($oceiabar_plugin));
} ?>