=== Cyanotype ===

Contributors: automattic
Tags: blue, white, dark, one-column, fixed-layout, responsive-layout, custom-background, custom-header, custom-menu, editor-style, featured-images, flexible-header, rtl-language-support, sticky-post, translation-ready

Requires at least: 4.1
Tested up to: 4.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Cyanotype is a monochromatic blog theme with a bold, yet simple look that sets your blog apart from the rest. Pick your favorite background color or image to lend your personal flair.

== Description ==

Cyanotype is a monochromatic blog theme with a bold, yet simple look that sets your blog apart from the rest. Pick your favorite background color or image to lend your personal flair.

* Responsive layout
* Custom Background
* Custom Header
* Custom Menu
* Editor Style
* Featured Images
* Flexible Header
* RTL language support
* Sticky Post
* Translation Ready
* Social Links
* Jetpack compatibility for Infinite Scroll, Responsive Videos, Site Logo.
* The GPL v2.0 or later license. :) Use it to make something cool.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= Where can I add widgets? =

Cyanotype includes one optional widget area in an off-screen panel that appears when the eliipsis icon (three dots) clicked in the header.

= How do I add the Social Links to the sidebar? =

Cyanotype allows you display links to your social media profiles, like Twitter and Facebook, with icons.

1. Create a new Custom Menu, and assign it to the Social Links Menu location.
2. Add links to each of your social services using the Links panel.
3. Icons for your social links will automatically appear if it's available.

Available icons: (Linking to any of the following sites will automatically display its icon in your social menu).

* Codepen
* Digg
* Dribbble
* Dropbox
* Email (mailto: links)
* Facebook
* Flickr
* Foursquare
* GitHub
* Google+
* Instagram
* LinkedIn
* Pinterest
* Pocket
* PollDaddy
* Reddit
* RSS Feed (URLs with /feed/)
* Spotify
* StumbleUpon
* Tumblr
* Twitch
* Twitter
* Vimeo
* WordPress
* YouTube

Social networks that aren't currently supported will be indicated by a generic share icon.

== Quick Specs ==

1. The main column width is 704px.
2. The sidebar width is 704px.
3. Featured Images are 960px wide by 593px high.
4. Custom Header Image is 2000px wide by 320px high.

== Changelog ==

= 7 June 2017 =
* Update JavaScript that toggles hidden widget area, to make sure new video and audio widgets are displaying correctly when opened.

= 28 March 2017 =
* Check for post parent before outputting next, previous, and image attachment information to prevent fatals.

= 22 March 2017 =
* add Custom Colors annotations directly to the theme
* move fonts annotations directly into the theme

= 2 February 2017 =
* remove from CSS in wp-content/themes/pub
* Check for is_wp_error() before outputting get_the_tag_list() to avoid fatal errors.
* Check for is_wp_error() in cases when using get_the_tag_list() to avoid potential fatal errors; replace get_the_tag_list() with the_tags() for a more straightforward approach that prevents potential fatal errors.

= 29 December 2016 =
* clean up retired a8c widget Time Machine styles.

= 16 June 2016 =
* Add a class of .widgets-hidden to the body tag when the sidebar is active; allows the widgets to be targeted by Direct Manipulation.

= 12 May 2016 =
* Add new classic-menu tag.

= 4 February 2016 =
* Adding author-bio tag, to keep things in sync with the Showcase.

= 14 August 2015 =
* Give more accurate viewport size to layout related JS functions. Also some clean-up code style.

= 15 July 2015 =
* Always use https when loading Google Fonts. See #3221;

= 14 July 2015 =
* Make sure escape custom header image attributes.

= 8 July 2015 =
* Declare the global post for portfolio meta to avoid php notice.

= 9 June 2015 =
* Fix aria-expanded attribute for sidebar and sidebar toggle.
* Change the sidebar toggle button text accordingly so that it's more specific.

= 8 June 2015 =
* Fix aria-hidden for sidebar and sidebar toggle change correctly.
* Remove navigation role attribute from socila navigation because they are external links.

= 19 May 2015 =
* Add accessibility-ready tag.

= 29 April 2015 =
* Add the blog name as an alt attribute in the custom header image.

= 24 April 2015 =
* Correct version numbers.
* ready for .org submission.

= 22 April 2015 =
* Overhanging large size image.

= 21 April 2015 =
* Add postMessage support for background image and remove text shadow when there is a background image.
* Add a comment to the last change.
* Remove text shadow when you add a background image.
* Reset a custom background arguments for WP.com to use the default callback.

= 17 April 2015 =
* Minor style tweak.

= 16 April 2015 =
* Fix Custom Background option for self hosted version.
* Remove unusued file.

= 14 April 2015 =
* Add arrows to image and comment navigation so that they look obvious as navigation items.
* Reduce opacity for hover on links in related posts.
* Adjust border width for the ads.
* Minor style adjustments.

= 13 April 2015 =
* Remove Flying Focus script and license text.
* Remove flying focus script since it makes horizontal scrollbar when open the sidebar and resized.
* Edit the theme description.
* Remove focus outline from flush button style links, and make sure skip to content link is on top of the admin bar.
* Add POT file to the theme.
* Style tweak for blockquotes.
* Readme.text
* Give hover feedback for links in widgets.

= 10 April 2015 =
* RTL.
* Remove custom background color stuff in favour of Colors in WP.com
* More work on custom color.
* More work on the color option.
* Keep text on input fields grey.
* Minor color adjustments.
* Minor style tweak.
* Minor style tweaks.
* Few bug
* Cleanup.
* Apply the new caption style to editor style.
* Tweak the caption style.

= 9 April 2015 =
* Remove unneeded minified files.
* Edit the widget description so that it's more accurate.
* More work on postMessage for background color option.
* More work on postMessage for background color option.
* More styling for Jetpack comment form.
* Fix a typo.
* CLeanup the last change.
* Scale up some fonts for small screens.
* Thinner underline for post titles.
* Keep sub-pixel rendering for all screen.
* Less underlines from links.
* Make sure the submenu background is white on hover.
* Add postMessage support for background color.
* Cleanup
* Adjust infinite scroll style.
* Add border to all avatars in this theme.
* Avoid fake bold.
* Make sure the sidebar toggle shows up correctly.

= 8 April 2015 =
* Editor style.
* Remove sub-pixel rendering from non retina screen.
* Change a custom body class to be more semantic.
* Custom Header style.
* Style tweak for Goodreads widget.
* More styling WP.com stuff.
* More styling wp.com specific stuff.
* More styling for WP.com and Jetpack stuff.
* Adjust vertical spacing around comments area, hentry, and post navugation.

= 7 April 2015 =
* Full width post navigation.
* Style tweak for WP.com specific stuff
* Initial import.

== Credits ==

* Genericons: font by Automattic (http://automattic.com/), licensed under [GPL2](https://www.gnu.org/licenses/gpl-2.0.html)
