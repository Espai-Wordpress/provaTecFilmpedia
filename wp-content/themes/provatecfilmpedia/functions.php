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

    // Afegir Google Fonts
    /*  wp_enqueue_style(
    'google-fonts',
    'https://fonts.googleapis.com/css2?family=ABeeZee&family=Inter:wght@100;300;400;700&family=DM+Sans:wght@400;500;700&display=swap',
    array(),
    null
    ); */
}
add_action( 'wp_enqueue_scripts', 'provatecfilmpedia_child_enqueue_styles' );

//Afegir control pels rangs
function provatecfilmpedia_child_enqueue_scripts() {
    wp_enqueue_script( 'wp_enqueue_scripts', get_stylesheet_directory_uri() . '/js/range-control.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'provatecfilmpedia_child_enqueue_scripts' );
