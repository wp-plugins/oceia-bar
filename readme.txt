==========================================================================================
OCEIA BAR 2.0                                                                 (2006/10/19)
==========================================================================================

1. WHAT'S NEW
   The entire back-end of the plugin has been rewritten, the original code was based on
   code from a competing administrative bar: this has no longer the case. Compatibility
   with WordPress 2.1 has been greatly increased. Most noticeable, the front-end of the
   bar has changed to match the changes on WordPress.com -- though the functionality
   does still vary somewhat.

2. COMPATIBILITY
   Oceia bar is intended for WordPress 2.x. It will deactivate itself on anything less
   than 2.0. There were problems between Oceia bar 1.1 and WordPress 2.1. These
   issues have been resolved. Though it has not been tested, it should be functional
   with the latest builds of WordPress MU.

   Also, you'll need to be running PHP 4.3 or higher (at the time of this
   README, WordPress requires 4.2).

3. INSTALLATION
   Should work like any other WordPress plugin. Upload the "oceia-bar" directory
   to wp-content/plugins. Turn it on under Plugins in the WordPress administration.

4. UPGRADES
   WordPress recommends turning off a plug-in before you upgrade it, but Oceia bar
   doesn't use any database connections, so you probably don't need to. Other
   than that, all you've got to do to upgrade is upload the updated README and
   "oceia-bar.php" and you're good to go.

   NOTE: If you're upgrading from Oceia bar 1.x, you'll want to re-do your custom
   CSS: the process has changed considerably.

5. CUSTOMIZATION
   We all want our stuff to look the way we want it to look. But nobody likes hacking core
   files, then re-hacking them every time you need to upgrade. That's why Oceia bar makes CSS
   customization easy: just create a file called "style.css" and upload it to your Oceia
   Bar directory. Boom: any CSS you put in there will override the default Oceia Bar CSS.

6. FEEDBACK
   Whether you don't like the way something looks, or you noticed a bug (especially if you noticed
   a bug), please send a message my way. I can be contacted at http://sdho.org/contact/

7. UPDATES
   Every now and again, go to http://sdho.org/oceia/bar/ and check to make sure your Oceia bar is
   up-to-date.

8. LICENSE
   Oceia bar is released under the GNU General Public License. Details can be found at
   http://sdho.org/oceia/bar/license/

Just a note -- you need wp_head() in your header file and wp_footer() in your footer file for
Oceia bar to work out of the box. If you absolutely don't want to use these functions for
some reason, insert the following code in your footer:

<?php if(function_exists('oceiabar')) { oceiabar(); } ?>

and this in your header:

<?php if(function_exists('oceiabar_style')) { oceiabar_style(); } ?>

And remember, for FAQs, known issues, updates, and everything else, check out the official
Oceia bar page at http://sdho.org/oceia/bar/