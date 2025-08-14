<?php

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
?>