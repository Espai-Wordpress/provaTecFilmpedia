<?php
function recomanacions_shortcode() {
    ob_start();

    $args = array(
        'post_type'      => 'recomanacions',
        'posts_per_page' => -1,
    );
    $query = new WP_Query( $args );

    $destacats    = array();
    $no_destacats = array();

    if ( $query->have_posts() ):

        while ( $query->have_posts() ): $query->the_post();
            $destacat = get_post_meta( get_the_ID(), 'destacat', true );

            if ( $destacat === 'true' ):
                $destacats[] = array(
                    'titol'      => get_the_title(),
                    'descripcio' => get_post_meta( get_the_ID(), 'descripcio', true ),
                    'imatge'     => get_post_meta( get_the_ID(), 'imatge', true ),
                    'ludic'      => get_post_meta( get_the_ID(), 'ludic', true ),
                    'cultural'   => get_post_meta( get_the_ID(), 'cultural', true ),
                    'artistic'   => get_post_meta( get_the_ID(), 'artistic', true ),
                    'educatiu'   => get_post_meta( get_the_ID(), 'educatiu', true ),
                    'temes'      => get_the_terms( get_the_ID(), 'temes' ),
                    'ambits'     => get_the_terms( get_the_ID(), 'ambits' ),
                    'edat'       => get_the_terms( get_the_ID(), 'edats' ),
                    'etiquetes'  => get_the_terms( get_the_ID(), 'etiquetes' ),
                );
            else:
                $no_destacats[] = array(
                    'titol'      => get_the_title(),
                    'descripcio' => get_post_meta( get_the_ID(), 'descripcio', true ),
                    'imatge'     => get_post_meta( get_the_ID(), 'imatge', true ),
                    'ludic'      => get_post_meta( get_the_ID(), 'ludic', true ),
                    'cultural'   => get_post_meta( get_the_ID(), 'cultural', true ),
                    'artistic'   => get_post_meta( get_the_ID(), 'artistic', true ),
                    'educatiu'   => get_post_meta( get_the_ID(), 'educatiu', true ),
                    'temes'      => get_the_terms( get_the_ID(), 'temes' ),
                    'ambits'     => get_the_terms( get_the_ID(), 'ambits' ),
                    'edat'       => get_the_terms( get_the_ID(), 'edats' ),
                    'etiquetes'  => get_the_terms( get_the_ID(), 'etiquetes' ),
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

                    <div class="imatge">
                        <img src="<?php echo esc_url( $destacat['imatge'] ); ?>" alt="imatge de fons">
                    </div>

                    <div class="rangs">
                        <div class="rang-ludic">
                            <p>Lúdic: <?php echo $destacat['ludic']; ?></p>
                        </div>
                        <div class="rang-cultural">
                            <p>Cultural: <?php echo $destacat['cultural']; ?></p>
                        </div>
                        <div class="rang-artistic">
                            <p>Artístic: <?php echo $destacat['artistic']; ?></p>
                        </div>
                        <div class="rang-educatiu">
                            <p>Educatiu: <?php echo $destacat['educatiu']; ?></p>
                        </div>
                    </div>

                    <div class="taxonomies">
                        <p>Temes:</p>
                        <?php
foreach ( $destacat['temes'] as $taxonomy ): ?>
                            <div class="taxonomy-item"><?php echo esc_html( $taxonomy->name ); ?></div>
                        <?php endforeach; ?>

                        <p>Ambits:</p>
                        <?php
foreach ( $destacat['ambits'] as $taxonomy ): ?>
                            <div class="taxonomy-item"><?php echo esc_html( $taxonomy->name ); ?></div>
                        <?php endforeach; ?>

                        <p>Edat:</p>
                        <div class="taxonomy-item"><?php echo esc_html( $destacat['edat'][0]->name ); ?></div>

                        <p>Etiquetes:</p>
                        <?php
foreach ( $destacat['etiquetes'] as $taxonomy ): ?>
                            <div class="taxonomy-item"><?php echo esc_html( $taxonomy->name ); ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="no_destacats">
            <p>No destacats</p>
            <?php
foreach ( $no_destacats as $no_destacat ): ?>
                <div class="no-destacat">
                    <div class="titol">
                        <p><?php echo $no_destacat['titol']; ?></p>
                    </div>

                    <div class="descripcio">
                        <p><?php echo $no_destacat['descripcio']; ?></p>
                    </div>

                    <div class="imatge">
                        <img src="<?php echo esc_url( $no_destacat['imatge'] ); ?>" alt="imatge de fons">
                    </div>

                    <div class="rangs">
                        <div class="rang-ludic">
                            <p>Lúdic: <?php echo $no_destacat['ludic']; ?></p>
                        </div>
                        <div class="rang-cultural">
                            <p>Cultural: <?php echo $no_destacat['cultural']; ?></p>
                        </div>
                        <div class="rang-artistic">
                            <p>Artístic: <?php echo $no_destacat['artistic']; ?></p>
                        </div>
                        <div class="rang-educatiu">
                            <p>Educatiu: <?php echo $no_destacat['educatiu']; ?></p>
                        </div>
                    </div>

                    <div class="taxonomies">
                        <p>Temes:</p>
                        <?php
foreach ( $no_destacat['temes'] as $taxonomy ): ?>
                            <div class="taxonomy-item"><?php echo esc_html( $taxonomy->name ); ?></div>
                        <?php endforeach; ?>

                        <p>Ambits:</p>
                        <?php
foreach ( $no_destacat['ambits'] as $taxonomy ): ?>
                            <div class="taxonomy-item"><?php echo esc_html( $taxonomy->name ); ?></div>
                        <?php endforeach; ?>

                        <p>Edat:</p>
                        <div class="taxonomy-item"><?php echo esc_html( $no_destacat['edat'][0]->name ); ?></div>

                        <p>Etiquetes:</p>
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

add_shortcode( 'recomanacions', 'recomanacions_shortcode' );
?>
