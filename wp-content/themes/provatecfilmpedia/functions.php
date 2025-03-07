<?php
// Registrar els estils del tema fill i el tema pare
function provatecfilmpedia_child_enqueue_styles() {
    // Registrar el full d'estils del tema pare
    wp_enqueue_style(
        'twenty-twenty-five-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );

    // Registrar el full d'estils del tema fill
    wp_enqueue_style(
        'provatecfilmpedia-child-style',
        /* get_stylesheet_uri(), */
        get_stylesheet_directory_uri() . '/css/styles.css',
        array( 'twenty-twenty-five-style' ),
        wp_get_theme()->get( 'Version' )
    );

    
}

// Hook per carregar els estils
add_action( 'wp_enqueue_scripts', 'provatecfilmpedia_child_enqueue_styles' );
