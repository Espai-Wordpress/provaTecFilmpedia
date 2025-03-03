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
        get_stylesheet_uri(),
        array( 'twenty-twenty-five-style' ),
        wp_get_theme()->get( 'Version' )
    );
}

// Hook per carregar els estils
add_action( 'wp_enqueue_scripts', 'provatecfilmpedia_child_enqueue_styles' );


// CPT Recomanacions
function cptui_register_my_cpts() {
    /**
     * Post Type: recomanacions.
     */

    $labels = [
        "name"                     => esc_html__( "recomanacions", "provatecfilmpedia" ),
        "singular_name"            => esc_html__( "recomanació", "provatecfilmpedia" ),
        "menu_name"                => esc_html__( "Recomanacions", "provatecfilmpedia" ),
        "all_items"                => esc_html__( "Totes les recomanacions", "provatecfilmpedia" ),
        "add_new"                  => esc_html__( "Afegir nova", "provatecfilmpedia" ),
        "add_new_item"             => esc_html__( "Afegir nova recomanació", "provatecfilmpedia" ),
        "edit_item"                => esc_html__( "Edita recomanació", "provatecfilmpedia" ),
        "new_item"                 => esc_html__( "Nova recomanació", "provatecfilmpedia" ),
        "view_item"                => esc_html__( "Veure recomanació", "provatecfilmpedia" ),
        "view_items"               => esc_html__( "Veures recomanacions", "provatecfilmpedia" ),
        "search_items"             => esc_html__( "Cercar recomanació", "provatecfilmpedia" ),
        "not_found"                => esc_html__( "No s'han trobat recomanacions", "provatecfilmpedia" ),
        "not_found_in_trash"       => esc_html__( "No s'han trobat recomanacions a la paperera", "provatecfilmpedia" ),
        "parent"                   => esc_html__( "Recomanació pare:", "provatecfilmpedia" ),
        "featured_image"           => esc_html__( "Imatge destacada de la recomanació", "provatecfilmpedia" ),
        "set_featured_image"       => esc_html__( "Estableix imatge destacada de la recomanació", "provatecfilmpedia" ),
        "remove_featured_image"    => esc_html__( "Elimina imatge destacada de la recomanació", "provatecfilmpedia" ),
        "use_featured_image"       => esc_html__( "Utilitza com a imatge destacada de la recomanació", "provatecfilmpedia" ),
        "archives"                 => esc_html__( "Arxius de recomanació", "provatecfilmpedia" ),
        "insert_into_item"         => esc_html__( "Insereix a la recomanació", "provatecfilmpedia" ),
        "uploaded_to_this_item"    => esc_html__( "Pujat a la recomanació", "provatecfilmpedia" ),
        "filter_items_list"        => esc_html__( "Filtra la llista de recomanacions", "provatecfilmpedia" ),
        "items_list_navigation"    => esc_html__( "Navegació per la llista de recomanacions", "provatecfilmpedia" ),
        "items_list"               => esc_html__( "Llista de recomanacions", "provatecfilmpedia" ),
        "attributes"               => esc_html__( "Atributs de recomanació", "provatecfilmpedia" ),
        "name_admin_bar"           => esc_html__( "recomanació", "provatecfilmpedia" ),
        "item_published"           => esc_html__( "Recomanació publicada", "provatecfilmpedia" ),
        "item_published_privately" => esc_html__( "Recomanació publicada privadament", "provatecfilmpedia" ),
        "item_reverted_to_draft"   => esc_html__( "Recomanació convertida a esborrany", "provatecfilmpedia" ),
        "item_trashed"             => esc_html__( "Recomanació enviada a la paperera", "provatecfilmpedia" ),
        "item_scheduled"           => esc_html__( "Recomanació agendada", "provatecfilmpedia" ),
        "item_updated"             => esc_html__( "Recomanació actualitzada", "provatecfilmpedia" ),
        "parent_item_colon"        => esc_html__( "Recomanació pare:", "provatecfilmpedia" ),
    ];

    $args = [
        "label"                 => esc_html__( "recomanacions", "provatecfilmpedia" ),
        "labels"                => $labels,
        "description"           => "Recomanacions de recursos audio visuals",
        "public"                => true,
        "publicly_queryable"    => true,
        "show_ui"               => true,
        "show_in_rest"          => true,
        "rest_base"             => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace"        => "wp/v2",
        "has_archive"           => true,
        "show_in_menu"          => true,
        "show_in_nav_menus"     => true,
        "delete_with_user"      => false,
        "exclude_from_search"   => false,
        "capability_type"       => "post",
        "map_meta_cap"          => true,
        "hierarchical"          => false,
        "can_export"            => false,
        "rewrite"               => ["slug" => "recomanacio", "with_front" => true],
        "query_var"             => true,
        "menu_icon"             => "dashicons-pressthis",
        "show_in_graphql"       => false,
    ];

    register_post_type( "recomanacio", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );


// Taxonomia Temes i Àmbits
function cptui_register_my_taxes() {
    /**
     * Taxonomy: temes.
     */

    $labels = [
        "name"                       => esc_html__( "temes", "provatecfilmpedia" ),
        "singular_name"              => esc_html__( "tema", "provatecfilmpedia" ),
        "menu_name"                  => esc_html__( "Tema", "provatecfilmpedia" ),
        "all_items"                  => esc_html__( "Tots els temes", "provatecfilmpedia" ),
        "edit_item"                  => esc_html__( "Edita tema", "provatecfilmpedia" ),
        "view_item"                  => esc_html__( "Veure tema", "provatecfilmpedia" ),
        "update_item"                => esc_html__( "Actualitza el nom del tema", "provatecfilmpedia" ),
        "add_new_item"               => esc_html__( "Afegir nou tema", "provatecfilmpedia" ),
        "new_item_name"              => esc_html__( "Nou nom de tema", "provatecfilmpedia" ),
        "parent_item"                => esc_html__( "Tema pare", "provatecfilmpedia" ),
        "parent_item_colon"          => esc_html__( "Tema pare:", "provatecfilmpedia" ),
        "search_items"               => esc_html__( "Cercar temes", "provatecfilmpedia" ),
        "popular_items"              => esc_html__( "Temes populars", "provatecfilmpedia" ),
        "separate_items_with_commas" => esc_html__( "Separar els temes entre comes", "provatecfilmpedia" ),
        "add_or_remove_items"        => esc_html__( "Afegir o eliminar temes", "provatecfilmpedia" ),
        "choose_from_most_used"      => esc_html__( "Triar entre els temes més utilitzats", "provatecfilmpedia" ),
        "not_found"                  => esc_html__( "Tema no trobat", "provatecfilmpedia" ),
        "no_terms"                   => esc_html__( "Sense tema", "provatecfilmpedia" ),
        "items_list_navigation"      => esc_html__( "Navegació per la llista de temes", "provatecfilmpedia" ),
        "items_list"                 => esc_html__( "Llista de temes", "provatecfilmpedia" ),
        "back_to_items"              => esc_html__( "Tornar a temes", "provatecfilmpedia" ),
        "name_field_description"     => esc_html__( "El 'nom' és com apareix al lloc web", "provatecfilmpedia" ),
        "parent_field_description"   => esc_html__( "Assigna un 'nom-pare' per generar la jerarquia", "provatecfilmpedia" ),
        "slug_field_description"     => esc_html__( "Assigna un 'slug' per generar la ruta del tema", "provatecfilmpedia" ),
        "desc_field_description"     => esc_html__( "Assigna una descripció", "provatecfilmpedia" ),
    ];

    $args = [
        "label"                 => esc_html__( "temes", "provatecfilmpedia" ),
        "labels"                => $labels,
        "public"                => true,
        "publicly_queryable"    => true,
        "hierarchical"          => true,
        "show_ui"               => true,
        "show_in_menu"          => true,
        "show_in_nav_menus"     => true,
        "query_var"             => true,
        "rewrite"               => ['slug' => 'tema', 'with_front' => true],
        "show_admin_column"     => false,
        "show_in_rest"          => true,
        "show_tagcloud"         => false,
        "rest_base"             => "tema",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace"        => "wp/v2",
        "show_in_quick_edit"    => false,
        "sort"                  => false,
        "show_in_graphql"       => false,
    ];
    register_taxonomy( "tema", ["recomanacio"], $args );

    /**
     * Taxonomy: àmbits.
     */

    $labels = [
        "name"                       => esc_html__( "àmbits", "provatecfilmpedia" ),
        "singular_name"              => esc_html__( "àmbit", "provatecfilmpedia" ),
        "menu_name"                  => esc_html__( "Àmbit", "provatecfilmpedia" ),
        "all_items"                  => esc_html__( "Tots els àmbits", "provatecfilmpedia" ),
        "edit_item"                  => esc_html__( "Edita àmbit", "provatecfilmpedia" ),
        "view_item"                  => esc_html__( "Veure àmbit", "provatecfilmpedia" ),
        "update_item"                => esc_html__( "Actualitza el nom de l'àmbit", "provatecfilmpedia" ),
        "add_new_item"               => esc_html__( "Afegir nou àmbit", "provatecfilmpedia" ),
        "new_item_name"              => esc_html__( "Nou nom d'àmbit", "provatecfilmpedia" ),
        "parent_item"                => esc_html__( "Àmbit pare", "provatecfilmpedia" ),
        "parent_item_colon"          => esc_html__( "Àmbit pare:", "provatecfilmpedia" ),
        "search_items"               => esc_html__( "Cercar àmbits", "provatecfilmpedia" ),
        "popular_items"              => esc_html__( "Àmbits populars", "provatecfilmpedia" ),
        "separate_items_with_commas" => esc_html__( "Separar els pambits entre comes", "provatecfilmpedia" ),
        "add_or_remove_items"        => esc_html__( "Afegir o eliminar àmbits", "provatecfilmpedia" ),
        "choose_from_most_used"      => esc_html__( "Triar entre els àmbits més utilitzats", "provatecfilmpedia" ),
        "not_found"                  => esc_html__( "Àmbit no trobat", "provatecfilmpedia" ),
        "no_terms"                   => esc_html__( "Sense àmbits", "provatecfilmpedia" ),
        "items_list_navigation"      => esc_html__( "Navegació per la llista d'àmbits", "provatecfilmpedia" ),
        "items_list"                 => esc_html__( "Llista d'àmbits", "provatecfilmpedia" ),
        "back_to_items"              => esc_html__( "Tornar a àmbits", "provatecfilmpedia" ),
        "name_field_description"     => esc_html__( "El 'nom' és com apareix al lloc web", "provatecfilmpedia" ),
        "parent_field_description"   => esc_html__( "Assigna un 'nom-pare' per generar la jerarquia", "provatecfilmpedia" ),
        "slug_field_description"     => esc_html__( "Assigna un 'slug' per generar la ruta del tema", "provatecfilmpedia" ),
        "desc_field_description"     => esc_html__( "Assigna una descripció", "provatecfilmpedia" ),
    ];

    $args = [
        "label"                 => esc_html__( "àmbits", "provatecfilmpedia" ),
        "labels"                => $labels,
        "public"                => true,
        "publicly_queryable"    => true,
        "hierarchical"          => true,
        "show_ui"               => true,
        "show_in_menu"          => true,
        "show_in_nav_menus"     => true,
        "query_var"             => true,
        "rewrite"               => ['slug' => 'ambit', 'with_front' => true, 'hierarchical' => true],
        "show_admin_column"     => false,
        "show_in_rest"          => true,
        "show_tagcloud"         => false,
        "rest_base"             => "ambit",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace"        => "wp/v2",
        "show_in_quick_edit"    => false,
        "sort"                  => false,
        "show_in_graphql"       => false,
    ];
    register_taxonomy( "ambit", ["recomanacio"], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
