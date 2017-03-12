=== Greeklish Slugs ===
Contributors: skapator
Tags: greeklish, slugs, translitaration, stop words, permalinks
Requires at least: 3.0
Tested up to: 4.7.4-alpha-40272
Stable tag: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Translitaration of greek characters to latin for post permalinks with some extra options. (greeklish)

== Description ==

Convert Greek characters to Latin (greeklish)
Using [greeklish-permalinks](https://github.com/dyrer/greeklish-permalinks) with some extra functionality.

### Features

* Converts post, pages, taxonomy and category slugs to greeklish automatically
* Hooks in the sanitize_title() function
* You can use ```skp_greeklish_slugs($your_text)``` in your template files (good for dynamic css classes etc.)
* Select to strip out 1 letter words
* Select to strip out 2 letter words
* Define stop words that will be striped out of the slugs
* You can modify the translitaration array of regex via `apply_filter('skp_greeklish_slugs_regex', 'your_callback')`

### Filter the regex array

You can use `apply_filter('skp_greeklish_slugs_regex', 'your_callback')` and modify the regex array used to transliterate

`
<?php
function your_callback( $expressions ) {
	// the $expressions parameter is the array with all expressions used

  // view the expressions
  var_damp( expressions )

  // Change/remove items
	$new_expressions = array(
    ...
    '/[μΜ][πΠ]/u' => 'mp',
    '/[νΝ][τΤ]/u' => 'nt',
    '/[τΤ][σΣ]/u' => 'ts'
    ...
	);

	// Add them
	$expressions = array_merge( $new_expressions, $expressions );

  // Replace some
  $expressions = array_unique( array_merge( $new_expressions, $expressions ) );

	return $expressions;
}
add_filter( 'skp_greeklish_slugs_regex', 'your_callback' );
?>
`

Fork on [github](https://github.com/skapator/Skp-Greeklish-Slugs "Link to github").

[noveldigital.pro](https://noveldigital.pro "Link to github")

== Installation ==

1. Upload the files to the /wp-content/plugins/skp-greeklish-slugs/ directory.
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==
.

== Screenshots ==
1. The options page

== Changelog ==

= 1.1.2 =
*Added uninstall file

= 1.1.1 =
*Code cleanup

= 1.1.0 =
*Added greek transaltions
*Added regex array filter

= 1.0.1 =
* Added screenshots

= 1.0 =
* Release


== Upgrade Notice ==
.