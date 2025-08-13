<?php

/**
 * Plugin Name: ACF Block
 * Description: A simple ACF block example.
 * Version: 1.0.0
 * Author: Andre Ranulfo
 */

// You shall not pass! 

if (! defined('ABSPATH')) {
    exit;
}

// Using ACF JSON approach for field definitions
// Fields are stored in acf-json/group_689b72e47a74f.json

/**
 * Calculate the appropriate text color (black or white) based on background color
 * 
 * @param string $bg_color Background color in hex format (e.g., #FFFFFF)
 * @return string Text color in hex format (#000000 or #FFFFFF)
 */


add_action('acf/init', 'acf_hero_init');

function acf_hero_init()
{
    $block_name = 'acf-hero'; // Block name (should be lowercase and without spaces)
    $block_title = 'ACF Hero';
    $block_text_domain = 'acf-block';
    $block_render_template = 'blocks/hero/hero.php';

    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => $block_name,
            'title'             => __($block_title, $block_text_domain),
            'description'       => __('A custom hero block.', $block_text_domain),
            'render_template'   => plugin_dir_path(__FILE__) . $block_render_template,
            'category'          => 'formatting',
            'icon'              => 'superhero-alt',
            'keywords'          => array('hero', 'quote'),
            'enqueue_style'     => plugin_dir_url(__FILE__) . 'assets/css/style.css',
            'enqueue_script'    => plugin_dir_url(__FILE__) . 'assets/js/script.js',
            'supports'          => array(
                'anchor' => true,
                'customClassName' => true,
                'align' => true,
                'alignWide' => true,
                'alignText' => true,
            ),
        ));
    }
}

// Calculate the appropriate text color (black or white) based on background color
function calculate_contrast_color($bg_color) {
    // Remove the hash if present
    $bg_color = ltrim($bg_color, '#');
    
    // Convert hex to RGB
    $r = hexdec(substr($bg_color, 0, 2));
    $g = hexdec(substr($bg_color, 2, 2));
    $b = hexdec(substr($bg_color, 4, 2));
    
    // Calculate the relative luminance
    // Formula: 0.299*R + 0.587*G + 0.114*B
    $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
    
    // Return black for light background, white for dark background
    return $luminance > 0.5 ? '#000000' : '#FFFFFF';
}
