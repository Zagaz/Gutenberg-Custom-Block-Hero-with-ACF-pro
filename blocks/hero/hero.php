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

// Create class attribute allowing for custom "className" and "align" values
$classes = 'hero-block';
if( !empty($block['className']) ) {
    $classes .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $classes .= ' align' . $block['align'];
}

// Load field values
$title = get_field('hero_title');
$subtitle = get_field('hero_subtitle');
$description = get_field('hero_description');
$bg = get_field('bg');
$cta = get_field('cta');

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

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>" style="<?php echo esc_attr($style); ?>">
    <div class="hero-content">
        <?php if($title): ?>
            <h2 class="hero-title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        
        <?php if($subtitle): ?>
            <h3 class="hero-subtitle"><?php echo esc_html($subtitle); ?></h3>
        <?php endif; ?>
        
        <?php if($description): ?>
            <div class="hero-description">
                <?php echo wp_kses_post($description); ?>
            </div>
        <?php endif; ?>
        
        <?php if(!empty($cta['cta_link']) && !empty($cta['cta_text'])): ?>
            <a href="<?php echo esc_url($cta['cta_link']); ?>" class="hero-cta-button" style="<?php echo esc_attr($cta_style); ?>">
                <?php echo esc_html($cta['cta_text']); ?>
            </a>
        <?php endif; ?>
    </div>
</div>
