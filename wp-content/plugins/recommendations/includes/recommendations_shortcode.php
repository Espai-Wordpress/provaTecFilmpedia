<?php
function render_recommendation( $post_data ) {
    ob_start();
    ?>
  <div class="card-background">
    <div class="card-background__image">
      <img src="<?php echo esc_url( $post_data['imatge_fons_url'] ); ?>" alt="imatge de fons" width="400">
    </div>
    <div class="card-background__image-destacada">
      <img src="<?php echo esc_url( $post_data['imatge_fons_destacada_url'] ); ?>" alt="imatge de fons destacada" width="400">
    </div>
    <div class="card-background__overlay"></div>
  </div>
  <div class="card-content">
    <span class="card-content__tag">Recomanació</span>
    <h2 class="card-content__title"><?php echo esc_html( $post_data['titol'] ); ?></h2>
    <div class="card-content__description">
      <p><?php echo esc_html( $post_data['descripcio'] ); ?></p>
    </div>

    <div class="card-content__ranges">
      <h3 class="card-content__ranges-title">Valoració</h3>
      <div class="card-content__ranges-container">
        <div class="card-content__range-block range-block">
          <label class="range-block__label" for="ludic">Lúdic</label>
          <input class="range-block__input range-block__input--ludic" type="range" id="ludic" value="<?php echo esc_html( $post_data['ludic'] ); ?>" disabled>
        </div>
        <div class="card-content__range-block range-block">
          <label class="range-block__label" for="cultural">Cultural</label>
          <input class="range-block__input range-bloc__input--cultural" type="range" id="cultural" value="<?php echo esc_html( $post_data['cultural'] ); ?>">
        </div>
        <div class="card-content__range-block range-block">
          <label class="range-block__label" for="artistic">Artístic</label>
          <input class="range-block__input range-block__input--artistic" type="range" id="artistic" value="<?php echo esc_html( $post_data['artistic'] ); ?>" disabled>
        </div>
        <div class="card-content__range-block range-block">
          <label class="range-block__label" for="educatiu">Educatiu</label>
          <input class="range-block__input range-block__input--educatiu" type="range" id="educatiu" value="<?php echo esc_html( $post_data['educatiu'] ); ?>" disabled>
        </div>
      </div>
    </div>

    <div class="card-content__taxonomies">
      <div class="card-content__taxonomies-edats card-content__taxonomy">
        <p class="card-content__taxonomy-item card-content__taxonomy--edat"><?php echo esc_html( $post_data['edat'] ); ?></p>
      </div>
      <div class="card-content__taxonomies-etiquetes card-content__taxonomy">
        <?php

    foreach ( $post_data['etiquetes'] as $etiqueta ): ?>
          <p class="card-content__taxonomy-item card-content__taxonomy--etiqueta">#<?php echo esc_html( $etiqueta ); ?></p>
        <?php endforeach; ?>
      </div>
      <div class="card-content__taxonomies-temes card-content__taxonomy">
        <h3 class="card-content__taxonomy-title">Temes</h3>
        <?php

    foreach ( $post_data['temes'] as $tema ): ?>
          <p class="card-content__taxonomy-item card-content__taxonomy--tema"><?php echo esc_html( $tema ); ?></p>
        <?php endforeach; ?>
      </div>
      <div class="card-content__taxonomies-ambits card-content__taxonomy">
        <h3 class="card-content__taxonomiy-title">Àmbits</h3>
        <?php

    foreach ( $post_data['ambits'] as $ambit ): ?>
          <p class="card-content__taxonomy-item card-content__taxonomy--ambit"><?php echo esc_html( $ambit ); ?></p>
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
                'titol'                     => get_field( 'titol' ),
                'descripcio'                => get_field( 'descripcio' ),
                'imatge_fons_url'           => get_field( 'imatge_fons' ),
                'imatge_fons_destacada_url' => get_field( 'imatge_fons_destacada' ),
                'ludic'                     => get_field( 'ludic' ),
                'cultural'                  => get_field( 'cultural' ),
                'artistic'                  => get_field( 'artistic' ),
                'educatiu'                  => get_field( 'educatiu' ),
                'destacat'                  => get_field( 'destacat' ),
                'temes'                     => array_map( fn( $id ) => get_term( $id )->name, get_field( 'tema' ) ),
                'ambits'                    => array_map( fn( $id ) => get_term( $id )->name, get_field( 'ambit' ) ),
                'edat'                      => get_term( get_field( 'edat' ) )->name,
                'etiquetes'                 => array_map( fn( $id ) => get_term( $id )->name, get_field( 'etiquetes' ) ),
            );

            // Substituir `null`, `[]` i `''` per 'sense dades'
            $post_data = array_map( function ( $valor ) {
                return ( $valor === null || $valor === '' || ( is_array( $valor ) && empty( $valor ) ) ) ? 'Sense dades' : $valor;
            }, $post_data );

            $no_destacats[] = $post_data;

            if ( $post_data['destacat'] === true ) {
                $destacats[] = $post_data;
            }

        endwhile;
    endif;

    ?>
  <div class="recommendations__container">
    <div class="recommendations__container-top top">
      <div class="top-tag">
        <span class="top-tag__text">Recomanacions</span>
      </div>
      <p class="top-text">Films que et recomanem per tractar el tema</p>
    </div>

    <div class="recommendations__container-destacats">
      <?php

    foreach ( $destacats as $destacat ): ?>
        <div id="destacat" class="card card--destacat">
          <?php echo render_recommendation( $destacat ); ?>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="recommendations__container-no-destacats">
      <?php

    foreach ( $no_destacats as $no_destacat ): ?>
        <div id="no-destacat" class="card card--no-destacat">
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
