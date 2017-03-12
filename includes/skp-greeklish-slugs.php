<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;

/**
 * Parse characters and add filter for title
 */
if ( ! function_exists( 'skp_greeklish_slugs' ) ) :
function skp_greeklish_slugs($text) {

    if ( ! is_admin() ) return $text;

    $options = get_option( 'skp_greeklish_slugs' );

    $expressions = array(
        '/[αΑ][ιίΙΊ]/u' => 'ai',
        //'/[οΟ][ιίΙΊ]/u' => 'ei',
        //'/[Εε][ιίΙΊ]/u' => 'oi',

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
        '/[ξΞ]/u' => 'ks',
        '/[οόΟΌ]/u' => 'o',
        '/[πΠ]/u' => 'p',
        '/[ρΡ]/u' => 'r',
        '/[σςΣ]/u' => 's',
        '/[τΤ]/u' => 't',
        '/[υύϋΥΎΫ]/u' => 'y',
        '/[φΦ]/iu' => 'f',
        '/[ωώ]/iu' => 'o',

        '/[«]/iu' => '',
        '/[»]/iu' => ''
    );

    // Add filter to customize the regex array
    if( has_filter( 'skp_greeklish_slugs_regex' ) ) {
		$expressions = apply_filters( 'skp_greeklish_slugs_regex', $expressions );
	}


    // Remove stopwords
    if ( isset( $options['stopw'] ) &&  $options['stopw'] != '') {
        $stop_words = esc_attr( $options['stopw'] );
        $stop_words = explode( ',' , $stop_words );
        $text = str_replace( $stop_words, '', $text );
    }

    // Translitaration
    $text = preg_replace(
        array_keys( $expressions ),
        array_values( $expressions ),
        $text
    );

    // Remove one letter words
    if ( $options['char'] && $options['char'] == 1) {
        $text = preg_replace('/\s+\D{1}(?!\S)|(?<!\S)\D{1}\s+/', '', $text);
    }

    // Remove two letter words
    if ( $options['chars'] && $options['chars'] == 1 ) {
        $text = preg_replace('/\s+\D{2}(?!\S)|(?<!\S)\D{2}\s+/', '', $text);
    }

    return $text;
}
add_filter('sanitize_title', 'skp_greeklish_slugs', 1);
endif;