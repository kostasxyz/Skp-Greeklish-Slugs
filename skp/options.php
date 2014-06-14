<?php

add_action('admin_menu', 'wpkmkz_greeklish_slugs_add_page');

function wpkmkz_greeklish_slugs_add_page() {
    add_options_page(
        __('Skp Greeklish Slugs', 'skp_greeklish_slugs'),
        __('Greeklish Slugs', 'skp_greeklish_slugs'),
        'manage_options',
        'skp-greeklish-slugs',
        'skp_greeklish_slugs_cb'
    );
}

function skp_greeklish_slugs_cb() {
    ?>
    <div>
        <form action="options.php" method="post">
            <?php settings_fields('skp_greeklish_slugs'); ?>
            <?php do_settings_sections('skp-greeklish-slugs'); ?>
            <input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes', 'skp_greeklish_slugs'); ?>" />
        </form>
    </div>
    <?php
}

/**
 * Register Settings
 */
add_action('admin_init', 'register_settings_skp_greeklish_slugs');
function register_settings_skp_greeklish_slugs() {
    register_setting( 'skp_greeklish_slugs', 'skp_greeklish_slugs', 'skp_greeklish_slugs_options_validate' );
    add_settings_section(
         'skp_greeklish_slugs_main_section',
         __('Skp Greeklish Slugs Options', 'skp_greeklish_slugs'),
         'skp_greeklish_slugs_main_section_cb',
         'skp-greeklish-slugs'
    );
    add_settings_field(
        'skp_greeklish_slugs_char',
        __('<b>Αφαίρεση λέξεων με έναν χαρακτήρα.</b><br/> (πχ. ο, ή)', 'skp_greeklish_slugs'), 'skp_greeklish_slugs_char_cb',
        'skp-greeklish-slugs',
        'skp_greeklish_slugs_main_section'
    );
    add_settings_field(
        'skp_greeklish_slugs_chars',
        __('<b>Αφαίρεση λέξεων με δύο χαρακτήρες.</b><br/> (πχ. το, τι)', 'skp_greeklish_slugs'), 'skp_greeklish_slugs_chars_cb',
        'skp-greeklish-slugs',
        'skp_greeklish_slugs_main_section'
    );
    add_settings_field(
        'skp_greeklish_slugs_stopw',
        __('<b>Λίστα απαγορευμένων λέξεων.</b><br/>
           Εισάγετε λέξεις χωρισμένες με κόμμα που θέλετε να αφαιρούνται απο το slug.<br/>
           πχ. σκύλος, γάτα, τρελός', 'skp_greeklish_slugs'),
        'skp_greeklish_slugs_stopw_cb',
        'skp-greeklish-slugs',
        'skp_greeklish_slugs_main_section'
    );
}

/**
 * Settings section
 */
function skp_greeklish_slugs_main_section_cb() {
    echo '<b>' . __('Ρυθμίσεις:', 'skp_greeklish_slugs') . '</b><hr>';
}

/**
 * Settings section fields
 */
function skp_greeklish_slugs_char_cb() {
    $options = get_option('skp_greeklish_slugs');

    $checked = $options['char'] == 1 ? ' checked="checked"' : '';
    ?>
    <input type="checkbox"
        name="skp_greeklish_slugs[char]"
        id="skp_greeklish_slugs_char"
        value="1" <?php echo $checked; ?>/>
    <?php
}

function skp_greeklish_slugs_chars_cb() {
    $options = get_option('skp_greeklish_slugs');
    $checked = $options['chars'] == 1 ? ' checked="checked"' : '';
    ?>
    <input type="checkbox"
        name="skp_greeklish_slugs[chars]"
        id="skp_greeklish_slugs_chars"
        value="1" <?php echo $checked; ?>/>
    <?php
}

function skp_greeklish_slugs_stopw_cb() {
    $options = get_option('skp_greeklish_slugs');
    $stopw = $options['stopw'] != '' ? $options['stopw'] : '';
    ?>
    <textarea name="skp_greeklish_slugs[stopw]" id="skp_greeklish_slugs_stopw" cols="60" rows="8"><?php echo trim( esc_attr($stopw) ); ?></textarea>
    <?php
}

/**
 * Validation
 */
function skp_greeklish_slugs_options_validate($input) {
    $options = get_option('skp_greeklish_slugs');
    $options['char']  = sanitize_text_field( $input['char'] );
    $options['chars'] = sanitize_text_field( $input['chars'] );
    $options['stopw'] = sanitize_text_field( trim($input['stopw']) );
    return $options;
}