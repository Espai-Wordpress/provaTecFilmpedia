<?php
function render_recommendation( $post_data ) {
    ob_start();
    ?>
  <div class="card__background">
    <div class="card__background-image">
      <img src="<?php echo esc_url( $post_data['imatge_fons_url'] ); ?>" alt="imatge de fons" width="400">
    </div>
    <div class="card__background-overlay"></div>
  </div>

  <div class="card__content">

    <span class="card__tag">Recomanació</span>
    <div class="card__title">
      <h2><?php echo esc_html( $post_data['titol'] ); ?></h2>
    </div>
    <div class="card__description">
      <p><?php echo esc_html( $post_data['descripcio'] ); ?></p>
    </div>

    <div class="card__ranges">
      <h3 class="card__ranges-title">Valoració</h3>
      <div class="card__ranges-block">
        <div class="card__range card__ranges--ludic">
          <label class="card__range-label" for="ludic">Lúdic:</label>
          <input class="card__range-input" type="range" id="ludic" value="<?php echo esc_html( $post_data['ludic'] ); ?>" disabled min="0" max="10">
        </div>
        <div class="card__range card__ranges--cultural">
          <label class="card__range-label" for="cultural">Cultural:</label>
          <input class="card__range-input" type="range" id="cultural" value="<?php echo esc_html( $post_data['cultural'] ); ?>" disabled min="0" max="10">
        </div>
        <div class="card__range card__ranges--artistic">
          <label class="card__range-label" for="artistic">Artístic:</label>
          <input class="card__range-input" type="range" id="artistic" value="<?php echo esc_html( $post_data['artistic'] ); ?>" disabled min="0" max="10">
        </div>
        <div class="card__range card__range--educatiu">
          <label class="card__range-label" for="educatiu">Educatiu:</label>
          <input class="card__range-input" type="range" id="educatiu" value="<?php echo esc_html( $post_data['educatiu'] ); ?>" disabled min="0" max="10">
        </div>
      </div>
    </div>

    <div class="card__taxonomies">
      <div class="card__taxonomies-temes">
        <?php foreach ( $post_data['temes'] as $tema ): ?>
          <p class="card__taxonomy card__taxonomy--tema"><?php echo esc_html( $tema ); ?></p>
        <?php endforeach; ?>
      </div>

      <div class="card__taxonomies-ambits">
        <?php foreach ( $post_data['ambits'] as $ambit ): ?>
          <p class="card__taxonomy card__taxonomy--ambit"><?php echo esc_html( $ambit ); ?></p>
        <?php endforeach; ?>
      </div>

      <div class="card__taxonomies-edat">
        <p class="card__taxonomy card__taxonomy--edat"><?php echo esc_html( $post_data['edat'] ); ?></p>
      </div>

      <div class="card__taxonomies-etiquetes">
        <?php foreach ( $post_data['etiquetes'] as $etiqueta ): ?>
          <p class="card__taxonomy card__taxonomy--etiqueta"><?php echo esc_html( $etiqueta ); ?></p>
        <?php endforeach; ?>
      </div>
    </div>
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

            if ( $post_data['destacat'] === true ) {
                $destacats[] = $post_data;
            } else {
                $no_destacats[] = $post_data;
            }

        endwhile;
    endif;

    ?>
  <div class="recommendations">
    <div class="recommendations__destacats">
      <?php

    foreach ( $destacats as $destacat ): ?>
        <div class="recommendations__card recommendations__card--destacat">
          <?php echo render_recommendation( $destacat ); ?>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="recommendations__no-destacats">
      <?php

    foreach ( $no_destacats as $no_destacat ): ?>
        <div class="recommendations__card recommendations__card--no-destacat">
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
