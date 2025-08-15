<?php

/**
 * Plugin Name: ACF Block
 * Description: A dinamic hero block using ACF Pro.
 * Version: 1.0.0
 * Author: Andre Ranulfo
 * Plugin URI:      https://github.com/Zagaz/Gutenberg-Custom-Block-Hero-with-ACF-pro
 * Version:           1.0.0
 * Requires at least: 5.7
 * Requires PHP:      7.0
 * Author:            André Ranulfo
 * Author URI:        https://www.linkedin.com/in/andre-ranulfo/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       acf-block-hero
 * Domain Path:       /languages
 * Requires Plugins:  Advanced Custom Fields PRO
 * 
 */

// You shall not pass! 
if (! defined('ABSPATH')) {
    exit;
}


// Encapsulated ACF Hero block registration
require_once __DIR__ . '/includes/acf_hero_init.php';

// Include ACF data to make this file standalone
require_once __DIR__ . '/includes/acf-fields.php';

// Calculate the appropriate text color (black or white) based on background color
require_once __DIR__ . '/includes/calculate_contrast_color.php';

// Checks if ACF pro is installed and active
require_once __DIR__ . '/includes/acf-cheker.php';

