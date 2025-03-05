<?php
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
            // Recuperem totes les metadades i taxonomies una sola vegada
            $destacat        = get_post_meta( get_the_ID(), 'destacat', true );
            $titol           = get_post_meta( get_the_ID(), 'titol', true );
            $descripcio      = get_post_meta( get_the_ID(), 'descripcio', true );
            $imatge_fons_url = wp_get_attachment_url( get_post_meta( get_the_ID(), 'imatge_fons', true ) );
            $ludic           = get_post_meta( get_the_ID(), 'ludic', true );
            $cultural        = get_post_meta( get_the_ID(), 'cultural', true );
            $artistic        = get_post_meta( get_the_ID(), 'artistic', true );
            $educatiu        = get_post_meta( get_the_ID(), 'educatiu', true );
            $temes           = get_the_terms( get_the_ID(), 'tema' );
            $ambits          = get_the_terms( get_the_ID(), 'ambit' );
            $edat            = get_the_terms( get_the_ID(), 'edat' );
            $etiquetes       = get_the_terms( get_the_ID(), 'etiqueta' );

// Comprovem si el valor de 'destacat' és '1' (true) o '0' (false) i assignem directament als arrays
            if ( $destacat === '1' ): // Si 'destacat' és '1', el posem a l'array de destacats
                $destacats[] = array(
                    'titol'           => $titol,
                    'descripcio'      => $descripcio,
                    'imatge_fons_url' => $imatge_fons_url,
                    'ludic'           => $ludic,
                    'cultural'        => $cultural,
                    'artistic'        => $artistic,
                    'educatiu'        => $educatiu,
                    'temes'           => $temes,
                    'ambits'          => $ambits,
                    'edat'            => $edat,
                    'etiquetes'       => $etiquetes,
                );
            else: // Si no, el posem a l'array de no destacats
                $no_destacats[] = array(
                    'titol'           => $titol,
                    'descripcio'      => $descripcio,
                    'imatge_fons_url' => $imatge_fons_url,
                    'ludic'           => $ludic,
                    'cultural'        => $cultural,
                    'artistic'        => $artistic,
                    'educatiu'        => $educatiu,
                    'temes'           => $temes,
                    'ambits'          => $ambits,
                    'edat'            => $edat,
                    'etiquetes'       => $etiquetes,
                );
            endif;
        endwhile;

    endif;

    ?>
    <div class="container">

        <div class="destacats">
            <p>CPT Destacats</p>
            <?php

    foreach ( $destacats as $destacat ): ?>
                <div class="destacat">
                    <div class="titol">
                        <p><?php echo $destacat['titol']; ?></p>
                    </div>

                    <div class="descripcio">
                        <p><?php echo $destacat['descripcio']; ?></p>
                    </div>

                    <div class="imatge_fons">
                        <img src="<?php echo $destacat['imatge_fons_url']; ?>" alt="imatge de fons" width="400">
                    </div>

                    <div class="rangs">
                        <div class="rang-ludic">
                            <label for="ludic">Lúdic:</label>
                            <input type="range" id="ludic" value="<?php echo( $destacat['ludic'] ); ?>" disabled min="0" max="10">
                        </div>
                        <div class="rang-cultural">
                            <label for="cultural">Cultural:</label>
                            <input type="range" id="cultural" value="<?php echo( $destacat['cultural'] ); ?>" disabled min="0" max="10">
                        </div>
                        <div class="rang-artistic">
                            <label for="artistic">Artístic:</label>
                            <input type="range" id="artistic" value="<?php echo( $destacat['artistic'] ); ?>" disabled min="0" max="10">
                        </div>
                        <div class="rang-educatiu">
                            <label for="educatiu">Educatiu:</label>
                            <input type="range" id="educatiu" value="<?php echo( $destacat['educatiu'] ); ?>" disabled min="0" max="10">
                        </div>
                    </div>

                    <div class="taxonomies">
                        <?php

    foreach ( $destacat['temes'] as $taxonomy ): ?>
                            <div class="taxonomy-item"><?php echo esc_html( $taxonomy->name ); ?></div>
                        <?php endforeach; ?>

                        <?php

    foreach ( $destacat['ambits'] as $taxonomy ): ?>
                            <div class="taxonomy-item"><?php echo esc_html( $taxonomy->name ); ?></div>
                        <?php endforeach; ?>

                        <div class="taxonomy-item"><?php echo esc_html( $destacat['edat'][0]->name ); ?></div>

                        <?php

    foreach ( $destacat['etiquetes'] as $taxonomy ): ?>
                            <div class="taxonomy-item"><?php echo esc_html( $taxonomy->name ); ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="no_destacats">
            <p>CPT no destacats</p>
            <?php

    foreach ( $no_destacats as $no_destacat ): ?>
                <div class="no-destacat">
                    <div class="titol">
                        <p><?php echo $no_destacat['titol']; ?></p>
                    </div>

                    <div class="descripcio">
                        <p><?php echo $no_destacat['descripcio']; ?></p>
                    </div>

                    <div class="imatge_fons">
                        <img src="<?php echo $no_destacat['imatge_fons_url']; ?>" alt="imatge de fons" width="400">
                    </div>

                    <div class="rangs">
                        <div class="rang-ludic">
                            <label for="ludic">Lúdic:</label>
                            <input type="range" id="ludic" value="<?php echo( $destacat['ludic'] ); ?>" disabled min="0" max="10">
                        </div>
                        <div class="rang-cultural">
                            <label for="cultural">Cultural:</label>
                            <input type="range" id="cultural" value="<?php echo( $destacat['cultural'] ); ?>" disabled min="0" max="10">
                        </div>
                        <div class="rang-artistic">
                            <label for="artistic">Artístic:</label>
                            <input type="range" id="artistic" value="<?php echo( $destacat['artistic'] ); ?>" disabled min="0" max="10">
                        </div>
                        <div class="rang-educatiu">
                            <label for="educatiu">Educatiu:</label>
                            <input type="range" id="educatiu" value="<?php echo( $destacat['educatiu'] ); ?>" disabled min="0" max="10">
                        </div>
                    </div>


                    <div class="taxonomies">
                        <?php

    foreach ( $no_destacat['temes'] as $taxonomy ): ?>
                            <div class="taxonomy-item"><?php echo esc_html( $taxonomy->name ); ?></div>
                        <?php endforeach; ?>

                        <?php

    foreach ( $no_destacat['ambits'] as $taxonomy ): ?>
                            <div class="taxonomy-item"><?php echo esc_html( $taxonomy->name ); ?></div>
                        <?php endforeach; ?>

                        <div class="taxonomy-item"><?php echo esc_html( $no_destacat['edat'][0]->name ); ?></div>

                        <?php

    foreach ( $no_destacat['etiquetes'] as $taxonomy ): ?>
                            <div class="taxonomy-item"><?php echo esc_html( $taxonomy->name ); ?></div>
                        <?php endforeach; ?>
                    </div>
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
