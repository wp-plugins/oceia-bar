=== Oceia bar ===Contributors: hayfordolearyTags: adminRequires at least: 2.1Tested up to: 2.3.1Stable tag: 2.3.1

It's a vex of us all: we're reading our posts, need to change something, but how do we get to the administration? That's what Oceia bar is all about.

== Description ==
It's a peeve of us all: we're reading our posts, decide we want to add something new, but how do we get to the administration? In the default theme, there's a link, but we certainly don't all use that. That's what Oceia bar is for -- it provides quick, visible access to the admin for just to basic Dashboard, to editing a specific post, or adding a new one.In fact you can basically try this out on [WordPress.com](http://wordpress.com) if you have an account. (Oceia bar is based on the WordPress.com bar's functionality -- the bar WP.com uses is not distributed to the public.)

== Updates ==
As of 2007/12/06:

* Drop-downs on Oceia bar 2.3 and earlier did not work on Internet Explorer 6. This incompatibility has been fixed; quick thanks to user Adam for reporting the issue.
* Oceia Bar 2.3 contains a new function called `wp_adminbar()`. This doesn't do much for regular users, but it's useful for theme designers, who can use `function_exists()` to see if Oceia bar is installed and hide the theme's "Edit this entry" text. I'm trying to get other admin bars to implement this same function, too.
* Oceia bar 2.1.1 contained a filter that is no longer necessary in WordPress 2.2. This version is still compatible with 2.1, though.
* Oceia bar 2.0 had a smart filter to detect what directory it was being placed in (for displaying CSS images). Unfortunately, this wasn't functioning properly on Windows Server. Anyway, this has been removed, so you *must* upload the entire `oceia-bar` directory if you want the bar to look right.
* This version is almost identical to 2.0.9, but all legacy WordPress 2.0.x code has been removed. Thus, this version is only compatible with WordPress 2.1+.
* This README has been updated to the [new WordPress README standards](http://wordpress.org/extend/plugins/about/#readme).

== Installation ==
= Fresh install =
You must have PHP 4.3 or higher installed. Should work like any other WordPress plugin. Upload the `oceia-bar` directory to `wp-content/plugins`. Turn it on under Plugins in the WordPress administration.

Just a note -- you need `wp_head()` in your header file and `wp_footer()` in your footer file for Oceia bar to work out of the box. See the FAQ for workarounds.

= Upgrades =
WordPress recommends turning off a plug-in before you upgrade it, but Oceia bar doesn't use any database connections, so you probably don't need to. Other than that, all you've got to do to upgrade is upload the updated `oceia-bar` directory and you're good to go.

If you're upgrading from Oceia bar 1.x, you'll want to re-do your custom CSS: the process has changed considerably.

== Customization ==
We all want our stuff to look the way we want it to look. But nobody likes hacking core files, then re-hacking them every time you need to upgrade. That's why Oceia bar makes CSS customization easy: just create a file called `style.css` and upload it to your Oceia bar directory. Boom: any CSS you put in there will override the default Oceia bar CSS.

Note that if you do choose to use custom CSS, Oceia bar takes out all the `!important` flags in CSS. This doesn't matter most of the time, but it could get kind of quirky with some themes.

== Frequently Asked Questions ==
= What's the license? =
Oceia bar is released under the GNU General Public License. See [http://gnu.org/copyleft/gpl.html](http://gnu.org/copyleft/gpl.html)

= Uggh! My bar is showing up in the wrong place! =This can be an issue in some themes, since certain positions in CSS can override Oceia bar's position: absolute;. Generally you can resolve this by making sure `wp_footer();` is not contained within any elements other than the `<body>`.

= I `position: absolute;` my links and they don't work when I have Oceia bar turned on! =Oceia bar can be problematic if you use `position: absolute;` to control the location of hyperlinks or other content. This occurs because Oceia's default CSS puts a 30px padding on the `<body>`, so most content is shoved down 30px but your `position; absolute;` content is not. Fortunately, it's relatively easy to resolve (though Oceia bar will cover up your top 30px of content):1. Create a file called `style.css`2. Add the following: `body { margin: 0; padding: 0; }`3. Upload `style.css` to your `oceia-bar` directory on `wp-content/plugins`.= This thing is ugly. How do I make it not ugly? =Pretty much the same the previous question:1. Create a file called `style.css`2. Add whatever CSS you want. Note that any CSS you put will take precedence over Oceia"s default CSS.3. Upload `style.css` to your oceia-bar directory on `wp-content/plugins`.= I found a bug!/Why doesn't it do {x}?/I have an idea to improve Oceia bar =[Tell me about it](http://sdho.org/contact/).
= My question isn't answered. That's rude. =Again, [tell me about it](http://sdho.org/contact/).