<?php

function acfblock_register_acf_blocks() {
    register_block_type( __DIR__ . '/blocks/testimonial' );
}

add_action( 'init', 'acfblock_register_acf_blocks' );
