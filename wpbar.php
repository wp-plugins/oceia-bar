<?php

/* <WP Plugin Data>
 * Plugin Name: WP Bar
 * Version: 0.9
 * Plugin URI: http://sdho.hayfordoleary.com/
 * Description: A simplified version of <a href="http://mattread.com/projects/wp-admin-bar-20/">Matt Read&#8217;s WP-Admin-Bar</a>. Designed to be identical to bar found on <a href="http://wordpress.com">WordPress.com</a>.
 * Author: Sean Hayford O&#8217;Leary
 * Author URI: http://sdho.hayfordoleary.com/
 */

function wpbar() {
	global $user_identity, $posts;

	if ( current_user_can('read') ) {
		$randomGreetings = array('Howdy,');

		print "<div id=\"wpbar\">\n\t<div id=\"quicklinks\">\n\t\t<ul>";

		# Special case for edit
		if (is_single() || is_page())
			if (is_single()) { $edit_array = array(''.__('Edit this post').'', array('edit_post', $posts[0]->ID), 'post.php?action=edit&amp;post='.$posts[0]->ID, 'edit-link'); }
			else { $edit_array = array(''.__('Edit this page').'', array('edit_post', $posts[0]->ID), 'post.php?action=edit&amp;post='.$posts[0]->ID, 'edit-link'); }

		# Special case for write Link Name
		$write_text = (is_single() || is_page()) ? __('New Post') : ''.__('New Post').'';

		# Set menu items
		$menu = array(
			array(__('My Dashboard'), 'read', '', ''),
			array($write_text, 'edit_posts', 'post.php', 'write-link', ''),
			$edit_array
			);
		$menu = apply_filters('wpbar', $menu);

		foreach ($menu as $item) {
			list ($name, $user_caps, $url, $class) = $item;
			$class = $class ? ' class="'. $class .'"' : '';
			if (!is_array($user_caps)) $user_caps = array($user_caps);

			if ( call_user_func_array('current_user_can', $user_caps) )
				echo "\n\t\t\t<li><a href=\"".get_settings('siteurl')."/wp-admin/$url\">$name</a></li>";
		}

		# Welcome message
		print "\n\t\t</ul>\n\t</div>\n\t<div id=\"loginout\">".$randomGreetings[rand(0, count($randomGreetings)-1)]." ".$user_identity." &nbsp; ";

		# Login, logout, and profile links
		// echo "\n\t["; wp_loginout(); echo ", ";
		print "[<a href=\"".get_settings('siteurl')."/wp-login.php?action=logout\">Sign Out</a>, ";
		print "<a href=\"".get_settings('siteurl')."/wp-admin/profile.php\">My Account</a>]</div>";
		print "\n</div>\n";
	}
}

function wpbar_style ()
{
	global $user_level;

	if ( isset($user_level) ) { // only add style if user logged in.
		ob_start();

	?>
<style type="text/css">
	#wpbar {
		position: absolute;
		top: 0;
		left: 0;
		background: #14568a;
		width: 100%;
		height: 30px;
		font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Verdana;
		font-size: 12px;
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
		display: block;
		padding: .5em 1em;
		color: #c3def1;
		text-decoration: none;
		font-weight: normal;
	}

	#quicklinks a:hover {
		background: #6da6d1;
		color: #000;
	}

	#loginout {
		position: absolute;
		right: 1em;
		top: 7px;
		margin: 0;
		padding: 0;
		color: #c3def1;
	}

	#loginout strong {
		color: #c3def1;
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

	body {
		padding: 31px 0 0 0;
	}
</style>
	<?php

		$css = ob_get_contents();
		ob_end_clean();
		print($css);
	}
}

add_action('wp_head','wpbar_style');
add_action('wp_footer','wpbar');

?>