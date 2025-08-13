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


// Background video settings
// Safely get YouTube settings with fallbacks
$yt_url       = isset($bg["bg_yt"]['video_link']) ? $bg["bg_yt"]['video_link'] : 'https://www.youtube.com/watch?v=-niUBSx3PKQ';
$is_autoplay  = isset($bg["bg_yt"]["autoplay"]) ? $bg["bg_yt"]["autoplay"] : true;
$is_loop      = isset($bg["bg_yt"]["loop"]) ? $bg["bg_yt"]["loop"] : true;
$is_muted     = isset($bg["bg_yt"]["mute"]) ? $bg["bg_yt"]["mute"] : true;

// Extract YouTube video ID
$youtube_id = '';
if(isset($bg['bg_type']) && $bg['bg_type'] === 'YouTube' && !empty($yt_url)) {
    // Extract YouTube ID using regex pattern for various YouTube URL formats
    preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $yt_url, $matches);
    $youtube_id = isset($matches[1]) ? $matches[1] : '';
}


// Background style
$style = '';
$text_color_var = '';
if($bg['bg_type'] === 'Color' && !empty($bg['bg_color'])) {
    $style = 'background-color: ' . $bg['bg_color'] . ';';
    // Add CSS variable for text color calculation
    $text_color_var = '--text-color: ' . calculate_contrast_color($bg['bg_color']) . ';';
    $style .= $text_color_var;
} else if($bg['bg_type'] === 'Image' && !empty($bg['bg_img'])) {
    $image = wp_get_attachment_image_url($bg['bg_img'], 'large');
    $style = 'background-image: url(' . esc_url($image) . '); background-size: cover; background-position: center;';
    // Default text color for images
    $style .= '--text-color: #ffffff;';
} else if(isset($bg['bg_type']) && $bg['bg_type'] === 'YouTube' && !empty($youtube_id)) {
    // Set a dark background color as fallback
    $style = 'background-color: #000000; position: relative; overflow: hidden;';
    // Default text color for video backgrounds
    $style .= '--text-color: #ffffff;';
    // Add a data attribute for potential JS enhancement
    $youtube_data = ' data-youtube-id="' . esc_attr($youtube_id) . '"';
}



// CTA style
$cta_style = '';
if(!empty($cta['cta_bg_color'])) {
    $cta_style .= 'background-color: ' . $cta['cta_bg_color'] . '; ';
}
if(!empty($cta['cta_text_color'])) {
    $cta_style .= 'color: ' . $cta['cta_text_color'] . '; ';
}


// Initialize youtube_data variable if not set
$youtube_data = isset($youtube_data) ? $youtube_data : '';

// Add minimal inline styles for YouTube background if needed
$youtube_inline_styles = '';
if(isset($bg['bg_type']) && $bg['bg_type'] === 'YouTube' && !empty($youtube_id)) {
    // Check if we're in the editor
    $is_admin_editor = is_admin();
    
    $youtube_inline_styles = '
        <style>
            .youtube-background {
                position: absolute;
                top: 0;
                left: 0;
                right: 0; 
                bottom: 0;
                width: 100%;
                height: 100%;
                z-index: 1; /* Just behind content but still visible */
                pointer-events: none;
                overflow: hidden;
            }
            .video-foreground {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
            }
            .video-foreground iframe {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 100vw; /* Full viewport width */
                height: 56.25vw; /* Maintain 16:9 aspect ratio */
                min-height: 100%; /* Ensure it covers the full height */
                object-fit: cover; /* Fill the container completely */
                max-width: none;
            }
            .acf-hero-wrapper {
                position: relative;
                overflow: hidden;
                min-height: 400px;
            }
            .hero-content {
                position: relative;
                z-index: 2; /* Just above video */
            }
            
            /* WordPress editor specific tweaks */
            .is-editor .youtube-background iframe,
            .wp-admin .youtube-background iframe,
            .block-editor-block-list__layout .youtube-background iframe {
                min-width: 300% !important;
                min-height: 300% !important;
            }
        </style>
    ';
}
echo $youtube_inline_styles;
?>
<div class="<?php echo esc_attr($block_name); ?>-wrapper<?php echo esc_attr($is_editor); ?>"<?php echo $youtube_data; ?> style="<?php echo esc_attr($style); ?>">
    <?php if(isset($bg['bg_type']) && $bg['bg_type'] === 'YouTube' && !empty($youtube_id)): ?>
    <div class="youtube-background">
        <div class="video-foreground">
            <iframe 
                src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>?rel=0&showinfo=0&autoplay=<?php echo $is_autoplay ? '1' : '0'; ?>&loop=<?php echo $is_loop ? '1' : '0'; ?>&mute=<?php echo $is_muted ? '1' : '0'; ?>&controls=0&disablekb=1&playlist=<?php echo esc_attr($youtube_id); ?>&enablejsapi=1&widgetid=1&modestbranding=1&playsinline=1"
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
        </div>
    </div>
    <?php endif; ?>
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

