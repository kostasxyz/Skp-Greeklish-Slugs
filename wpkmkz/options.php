<?php

add_action('admin_menu', 'wpkmkz_greeklish_slugs_add_page');

function wpkmkz_greeklish_slugs_add_page() {
    add_plugins_page(
        __('WPkmkz Greeklish Slugs', 'wpkmkz'),
        __('Greeklish Slugs', 'wpkmkz'),
        'manage_options',
        'wpkmkz-greeklish-slugs',
        'wpkmkz_greeklish_slugs_cb'
    );
}

function wpkmkz_greeklish_slugs_cb() {
    ?>
    <div>
        <form action="options.php" method="post">
            <?php settings_fields('wpkmkz_greeklish_slugs'); ?>
            <?php do_settings_sections('wpkmkz-greeklish-slugs'); ?>
            <input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
        </form>
    </div>
    <?php
}

/**
 * Register Settings
 */
add_action('admin_init', 'register_setting_wpkmkz_greeklish_slugs');
function register_setting_wpkmkz_greeklish_slugs() {
    register_setting( 'wpkmkz_greeklish_slugs', 'wpkmkz_greeklish_slugs', 'wpkmkz_greeklish_slugs_options_validate' );
    add_settings_section(
         'wpkmkz_greeklish_slugs_main_section',
         __('WPkmkz Greeklish Slugs Options', 'wpkmkz'),
         'wpkmkz_greeklish_slugs_main_section_cb',
         'wpkmkz-greeklish-slugs'
    );
    add_settings_field(
        'wpkmkz_greeklish_slugs_char',
        __('<b>Αφαίρεση λέξεων με έναν χαρακτήρα.</b><br/> (πχ. ο, ή)', 'wpkmkz'), 'wpkmkz_greeklish_slugs_char_cb',
        'wpkmkz-greeklish-slugs',
        'wpkmkz_greeklish_slugs_main_section'
    );
    add_settings_field(
        'wpkmkz_greeklish_slugs_chars',
        __('<b>Αφαίρεση λέξεων με δύο χαρακτήρες.</b><br/> (πχ. το, τι)', 'wpkmkz'), 'wpkmkz_greeklish_slugs_chars_cb',
        'wpkmkz-greeklish-slugs',
        'wpkmkz_greeklish_slugs_main_section'
    );
    add_settings_field(
        'wpkmkz_greeklish_slugs_stopw',
        __('<b>Λίστα απαγορευμένων λέξεων.</b><br/>
           Εισάγετε λέξεις χωρισμένες με κόμμα που θέλετε να αφαιρούντε απο το slug.<br/>
           πχ. σκύλος, γάτα, τρελός', 'wpkmkz'),
        'wpkmkz_greeklish_slugs_stopw_cb',
        'wpkmkz-greeklish-slugs',
        'wpkmkz_greeklish_slugs_main_section'
    );
}

/**
 * Settings section
 */
function wpkmkz_greeklish_slugs_main_section_cb() {
    echo '<b>Ρυθμίσεις:</b><hr>';
}

/**
 * Settings section fields
 */
function wpkmkz_greeklish_slugs_char_cb() {
    $options = get_option('wpkmkz_greeklish_slugs');

    $checked = $options['char'] == 1 ? ' checked="checked"' : '';
    ?>
    <input type="checkbox"
        name="wpkmkz_greeklish_slugs[char]"
        id="wpkmkz_greeklish_slugs_char"
        value="1" <?php echo $checked; ?>/>
    <?php
}

function wpkmkz_greeklish_slugs_chars_cb() {
    $options = get_option('wpkmkz_greeklish_slugs');
    $checked = $options['chars'] == 1 ? ' checked="checked"' : '';
    ?>
    <input type="checkbox"
        name="wpkmkz_greeklish_slugs[chars]"
        id="wpkmkz_greeklish_slugs_chars"
        value="1" <?php echo $checked; ?>/>
    <?php
}

function wpkmkz_greeklish_slugs_stopw_cb() {
    $options = get_option('wpkmkz_greeklish_slugs');
    $stopw = $options['stopw'] != '' ? $options['stopw'] : '';
    ?>
    <textarea name="wpkmkz_greeklish_slugs[stopw]" id="wpkmkz_greeklish_slugs_stopw" cols="60" rows="8">
        <?php echo trim($stopw); ?>
    </textarea>
    <?php
}

/**
 * Validation
 */
function wpkmkz_greeklish_slugs_options_validate($input) {
    $options = get_option('wpkmkz_greeklish_slugs');
    $options['char']  = sanitize_text_field( $input['char'] );
    $options['chars'] = sanitize_text_field( $input['chars'] );
    $options['stopw'] = sanitize_text_field( $input['stopw'] );
    return $options;
}