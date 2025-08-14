<?php 



add_action('acf/init', 'acf_hero_init');

function acf_hero_init()
{
    $block_name = 'acf-hero'; // Block name (should be lowercase and without spaces)
    $block_title = 'ACF Hero';
    $block_text_domain = 'acf-block-hero';
    $block_render_template = dirname(__DIR__) . '/blocks/hero/hero.php';

    if (function_exists('acf_register_block_type')) {
        $plugin_url = plugin_dir_url(dirname(__DIR__) . '/acf_hero.php');
        acf_register_block_type(array(
            'name'              => $block_name,
            'title'             => __($block_title, $block_text_domain),
            'description'       => __('A custom hero block.', $block_text_domain),
            'render_template'   => $block_render_template,
            'category'          => 'formatting',
            'icon'              => 'superhero-alt',
            'keywords'          => array('hero', 'quote'),
            'enqueue_style'     => $plugin_url . 'assets/css/style.css',
            'enqueue_script'    => $plugin_url . 'assets/js/script.js',
            'supports'          => array(
                'anchor' => true,
                'customClassName' => true,
            ),
        ));
    }
}
