<?php 



function acf_hero_init()
{
    $block_name = 'acf-hero'; // Block name (should be lowercase and without spaces)
    $block_title = 'ACF Hero Block';
    $block_text_domain = 'acf-block-hero';
    $block_render_template = 'blocks/hero/hero.php';

    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => $block_name,
            'title'             => __($block_title, $block_text_domain),
            'description'       => __('A custom hero block.', $block_text_domain),
            'render_template'   => plugin_dir_path(__FILE__) . $block_render_template,
            'category'          => 'formatting',
            'icon'              => 'superhero-alt',
            'keywords'          => array('hero', 'quote', 'acf'),
            'enqueue_style'     => plugin_dir_url(__FILE__) . 'assets/css/style.css',
            'enqueue_script'    => plugin_dir_url(__FILE__) . 'assets/js/script.js',
            'supports'          => array(
                'anchor' => true,
                'customClassName' => true,            
            ),
        ));
    }
}

add_action('acf/init', 'acf_hero_init');