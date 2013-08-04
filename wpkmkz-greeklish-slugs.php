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

// Based on https://github.com/dyrer/greeklish-permalinks

if(is_admin()) {
    require_once('wpkmkz/options.php');
}

require_once('wpkmkz/greeklish-slugs.php');

//yeap.