<?php
/*
    Plugin Name: Skp Greeklish Slugs
    Plugin URI: https://github.com/skapator/Skp-Greeklish-Slugs
    Description: Translates greek character slugs to latin (greeklish) for posts, terms, files.
    Author: Kostas Skapator Charalampidis
    Version: 1.0
    Author URI: http://www.skapator.com/
    License: GPL
    Copyright: Kostas Skapator Charalampidis
*/

// Based on https://github.com/dyrer/greeklish-permalinks

if(is_admin()) require_once('skp/options.php');

require_once('skp/greeklish-slugs.php');
