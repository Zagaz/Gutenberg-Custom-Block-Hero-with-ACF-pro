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
