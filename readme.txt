==========================================================================================
OCEIA BAR 1.1                                                                 (2006/06/14)
==========================================================================================

1. COMPATIBILITY
   Oceia bar is intended for WordPress 2.0.x. It will NOT work with
   anything less than 2.0. There are known problems between it and the
   current builds of 2.1. A new version of Oceia bar will be made available
   when WordPress 2.1 is released. These problems may also apply to recent
   builds of WordPress MU.

   Also, you'll need to be running PHP 4.3 or higher (at the time of this
   README, WordPress requires 4.2).

2. INSTALLATION
   Should work like any other WordPress plugin. Upload the "oceia-bar" directory
   to wp-content/plugins. Turn it on under Plugins in the WordPress administration.

3. UPGRADES
   WordPress recommends turning off a plug-in before you upgrade it, but Oceia bar
   doesn't use any database connections, so you probably don't need to. Other
   than that, all you've got to do to upgrade is upload the updated README and
   "oceia-bar.php" and you're good to go.

   NOTE: If you're upgrading from Oceia bar 1.0, you'll want to re-do your custom
   CSS: the process has changed considerably.

4. CUSTOMISATION
   We all want our stuff to look the way we want it to look. But nobody likes hacking core
   files, then re-hacking them every time you need to upgrade. That's why Oceia bar makes CSS
   customisation easy: just create a file called "style.css" and upload it to your Oceia
   Bar directory. Boom: any CSS you put in there will override the default Oceia Bar CSS.

5. FEEDBACK
   Whether you don't like the way something looks, or you noticed a bug (especially if you noticed
   a bug), please send a message my way. I can be contacted at http://sdho.org/contact/

6. UPDATES
   Every now and again, go to http://sdho.org/oceia/bar/ and check to make sure your Oceia bar is
   up-to-date.

7. LICENSE
   Oceia bar is released under the GNU General Public License. Details can be found at
   http://sdho.org/oceia/bar/license/

Just a note -- you need wp_head() in your header file and wp_footer() in your footer file for
Oceia bar to work out of the box. If you absolutely don't want to use these functions for
some reason, insert the following code in your footer:

<?php if(function_exists("oceiabar")) { oceiabar(); } ?>

and this in your header:

<?php if(function_exists("oceiabar_style")) { oceiabar_style(); } ?>

And remember, for FAQs, known issues, updates, and everything else, check out the official
Oceia bar page at http://sdho.org/oceia/bar/