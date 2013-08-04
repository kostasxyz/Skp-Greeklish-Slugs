<?php
/*
    Plugin Name: WPkmkz Greeklish Slugs
    Plugin URI: http://www.wpkamikaze.com
    Description: Translates greek character slugs to latin (greeklish) for posts, terms, files.
    Author: Kostas Skapator Charal
    Version: 1.0
    Author URI: http://www.skapator.com/
    License: GPL
    Copyright: Kostas Skapator Charal
*/

if(is_admin()) {
    require_once('wpkmkz/options.php');
}

// Based on https://github.com/dyrer/greeklish-permalinks
if ( !function_exists('wpkmkz_greeklish_slugs') ) {

    add_filter('sanitize_title', 'wpkmkz_greeklish_slugs', 1);

    function wpkmkz_greeklish_slugs($text) {

        if ( !is_admin() ) return $text;

        $options = get_option('wpkmkz_greeklish_slugs');

        $expressions = array(
            '/[αΑ][ιίΙΊ]/u' => 'e',
            '/[οΟΕε][ιίΙΊ]/u' => 'i',

            '/[αΑ][υύΥΎ]([θΘκΚξΞπΠσςΣτTφΡχΧψΨ]|\s|$)/u' => 'af$1',
            '/[αΑ][υύΥΎ]/u' => 'av',
            '/[εΕ][υύΥΎ]([θΘκΚξΞπΠσςΣτTφΡχΧψΨ]|\s|$)/u' => 'ef$1',
            '/[εΕ][υύΥΎ]/u' => 'ev',
            '/[οΟ][υύΥΎ]/u' => 'ou',

            //'/(^|\s)[μΜ][πΠ]/u' => '$1b',
            //'/[μΜ][πΠ](\s|$)/u' => 'b$1',
            '/[μΜ][πΠ]/u' => 'mp',
            '/[νΝ][τΤ]/u' => 'nt',
            '/[τΤ][σΣ]/u' => 'ts',
            '/[τΤ][ζΖ]/u' => 'tz',
            '/[γΓ][γΓ]/u' => 'ng',
            '/[γΓ][κΚ]/u' => 'gk',
            '/[ηΗ][υΥ]([θΘκΚξΞπΠσςΣτTφΡχΧψΨ]|\s|$)/u' => 'if$1',
            '/[ηΗ][υΥ]/u' => 'iu',

            '/[θΘ]/u' => 'th',
            '/[χΧ]/u' => 'ch',
            '/[ψΨ]/u' => 'ps',

            '/[αάΑΆ]/u' => 'a',
            '/[βΒ]/u' => 'v',
            '/[γΓ]/u' => 'g',
            '/[δΔ]/u' => 'd',
            '/[εέΕΈ]/u' => 'e',
            '/[ζΖ]/u' => 'z',
            '/[ηήΗΉ]/u' => 'i',
            '/[ιίϊΙΊΪ]/u' => 'i',
            '/[κΚ]/u' => 'k',
            '/[λΛ]/u' => 'l',
            '/[μΜ]/u' => 'm',
            '/[νΝ]/u' => 'n',
            '/[ξΞ]/u' => 'x',
            '/[οόΟΌ]/u' => 'o',
            '/[πΠ]/u' => 'p',
            '/[ρΡ]/u' => 'r',
            '/[σςΣ]/u' => 's',
            '/[τΤ]/u' => 't',
            '/[υύϋΥΎΫ]/u' => 'i',
            '/[φΦ]/iu' => 'f',
            '/[ωώ]/iu' => 'o',

            '/[«]/iu' => '',
            '/[»]/iu' => ''
        );

        if ( $options['stopw'] &&  $options['stopw'] != '')
        {
            $words = explode(',', $options['stopw']);

            foreach ($words as $word) {
                $word = trim($word);
                $text = str_replace($word, '', $text);
            }
        }

        $text = preg_replace( array_keys($expressions), array_values($expressions), $text );

        if ( $options['char'] && $options['char'] == 1)
        {
            $text = preg_replace('/\s+\D{1}(?!\S)|(?<!\S)\D{1}\s+/', '', $text);
        }

        if ( $options['chars'] && $options['chars'] == 1 )
        {
            $text = preg_replace('/\s+\D{2}(?!\S)|(?<!\S)\D{2}\s+/', '', $text);
        }


        return $text;
    }
}
