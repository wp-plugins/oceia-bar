=========================================================================
OCEIA BAR 1.0                                                (2006/03/18)
=========================================================================

1. COMPATIBILITY
   Oceia bar is intended for WordPress 2.0 and above. At the time of this README,
   it has been tested on 2.0.2 (stable) and 2.1 alpha (unstable). It is known to
   be functional with the latest builds of WordPress MU as well.

2. INSTALLATION
   Should work like any other WordPress plugin. Upload the "oceia-bar" directory
   to wp-content/plugins. Turn it on under Plugins in the WordPress administration.

3. CUSTOMISATION
   CSS is separated into its own file -- "style.css." Go ahead and visually hack it
   up there. There are known CSS issues if your design uses "position: absolute;" --
   to solve these issues, comment out the padding under "body" in the CSS file.

   It is recommended that you flush and re-hack your custom CSS file with each new version number
   (e.g., If you hacked version "1.0," re-do it for "2.0" but not "1.3")

4. FEEDBACK
   Whether you don't like the way something looks, or you noticed a bug (especially if you noticed
   a bug), please send a message my way. I can be contacted at http://sdho.org/contact.

5. UPDATES
   Every now and again, go to http://sdho.org/oceia/bar and check to make sure your Oceia bar is
   up-to-date.


Just a note -- you need wp_head() in your header file and wp_footer() in your footer file for
Oceia bar to work out of the box. If you absolutely don't want to use these functions for
some reason, insert "oceiabar()" in your footer and "oceiabar_style()" in your header.

And remember, for FAQs, known issues, updates, and everything else, check out the official
Oceia bar page at http://sdho.org/oceia/bar.