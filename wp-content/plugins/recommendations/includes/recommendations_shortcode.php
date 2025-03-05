<?php
function render_recommendation( $post_data ) {
    ob_start();
    ?>
  <div class="titol">
    <p><?php echo esc_html( $post_data['titol'] ); ?></p>
  </div>
  <div class="descripcio">
    <p><?php echo esc_html( $post_data['descripcio'] ); ?></p>
  </div>
  <div class="imatge_fons">
    <img src="<?php echo esc_url( $post_data['imatge_fons_url'] ); ?>" alt="imatge de fons" width="400">
  </div>

  <div class="taxonomies">
    <?php
foreach ( $post_data['temes'] as $tema ): ?>
      <div class="taxonomy-item"><?php echo esc_html( $tema ); ?></div>
    <?php endforeach; ?>
    <?php
foreach ( $post_data['ambits'] as $ambit ): ?>
      <div class="taxonomy-item"><?php echo esc_html( $ambit ); ?></div>
    <?php endforeach; ?>
    <div class="taxonomy-item"><?php echo esc_html( $post_data['edat'] ); ?></div>
    <?php
foreach ( $post_data['etiquetes'] as $etiqueta ): ?>
      <div class="taxonomy-item"><?php echo esc_html( $etiqueta ); ?></div>
    <?php endforeach; ?>
  </div>
<?php
return ob_get_clean();
}

function recommendations_shortcode() {
    ob_start();

    $args = array(
        'post_type'      => 'recomanacio',
        'posts_per_page' => -1,
    );
    $query = new WP_Query( $args );

    $destacats    = array();
    $no_destacats = array();

    if ( $query->have_posts() ):

        while ( $query->have_posts() ): $query->the_post();

            // Creem els posts abans d'afegir-los a l'array
            $post_data = array(
                'titol'           => get_field( 'titol' ),
                'descripcio'      => get_field( 'descripcio' ),
                'imatge_fons_url' => get_field( 'imatge_fons' ),
                'ludic'           => get_field( 'ludic' ),
                'cultural'        => get_field( 'cultural' ),
                'artistic'        => get_field( 'artistic' ),
                'educatiu'        => get_field( 'educatiu' ),
                'destacat'        => get_field( 'destacat' ),
                'temes'           => array_map( fn( $id ) => get_term( $id )->name, get_field( 'tema' ) ),
                'ambits'          => array_map( fn( $id ) => get_term( $id )->name, get_field( 'ambit' ) ),
                'edat'            => get_term( get_field( 'edat' ) )->name,
                'etiquetes'       => array_map( fn( $id ) => get_term( $id )->name, get_field( 'etiquetes' ) ),
            );

// Assignació als arrays segons si és destacat o no
            if ( $post_data['destacat'] === true ) {
                $destacats[] = $post_data;
            } else {
                $no_destacats[] = $post_data;
            }

        endwhile;
    endif;

    ?>
  <div class="container">
    <div class="destacats">
      <?php foreach ( $destacats as $destacat ): ?>
        <div class="destacat">
          <?php echo render_recommendation( $destacat ); ?>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="no-destacats">
      <?php foreach ( $no_destacats as $no_destacat ): ?>
        <div class="no-destacat">
          <?php echo render_recommendation( $no_destacat ); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

<?php
wp_reset_postdata();
    return ob_get_clean();
}

add_shortcode( 'recommendations', 'recommendations_shortcode' );
?>
