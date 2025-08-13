<?php
/**
 * Hero Block Template
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block content (empty string).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering content against.
 */

// Create id attribute allowing for custom "anchor" value
$id = 'hero-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Block
$block_name = 'acf-hero'; // Block name (should be lowercase and without spaces)

// Handle text alignment
$block_align_text = isset($block['align_text']) ? $block['align_text'] : 'left';
$block_align = $block_name . '-text-align-' . $block_align_text;

// Create class attribute allowing for custom "className" and "align" values
$classes = 'hero-block';

// Add editor and preview classes if in editor
$is_preview = isset($block['is_preview']) && $block['is_preview'];
$is_editor = $is_preview ? ' is-editor' : '';
$preview_class = $is_preview ? ' is-preview' : '';

if( !empty($block['className']) ) {
    $classes .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $classes .= ' align' . $block['align'];
}

// Load field values
$title       = get_field('hero_title') ? get_field('hero_title') : "";
$subtitle    = get_field('hero_subtitle') ? get_field('hero_subtitle') : "";
$description = get_field('hero_description') ? get_field('hero_description') : "";
$bg          = get_field('bg') ? get_field('bg') : "";
$cta         = get_field('cta') ? get_field('cta') : "";


// Background style
$style = '';
if($bg['bg_type'] === 'Color' && !empty($bg['bg_color'])) {
    $style = 'background-color: ' . $bg['bg_color'] . ';';
} else if($bg['bg_type'] === 'Image' && !empty($bg['bg_img'])) {
    $image = wp_get_attachment_image_url($bg['bg_img'], 'large');
    $style = 'background-image: url(' . esc_url($image) . '); background-size: cover; background-position: center;';
}

// CTA style
$cta_style = '';
if(!empty($cta['cta_bg_color'])) {
    $cta_style .= 'background-color: ' . $cta['cta_bg_color'] . '; ';
}
if(!empty($cta['cta_text_color'])) {
    $cta_style .= 'color: ' . $cta['cta_text_color'] . '; ';
}


?>
<div class="<?php echo esc_attr($block_name); ?>-wrapper<?php echo esc_attr($is_editor); ?>" style="<?php echo esc_attr($style); ?>">
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>" >
        <div class="hero-content <?php echo esc_attr($block_align); ?><?php echo esc_attr($preview_class); ?>">
            <?php if($title): ?>
                <h2 class="<?php echo esc_attr($block_name); ?>-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            
            <?php if($subtitle): ?>
                <h3 class="<?php echo esc_attr($block_name); ?>-subtitle"><?php echo esc_html($subtitle); ?></h3>
            <?php endif; ?>
            
            <?php if($description): ?>
                <div class="<?php echo esc_attr($block_name); ?>-description">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
            
            <?php if(!empty($cta['cta_link']) && !empty($cta['cta_text'])): ?>
                <a href="<?php echo esc_url($cta['cta_link']); ?>" class="<?php echo esc_attr($block_name); ?>-cta-button" style="<?php echo esc_attr($cta_style); ?>">
                    <?php echo esc_html($cta['cta_text']); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

</div>

