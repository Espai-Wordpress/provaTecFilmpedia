<?php

function recomanacions_shortcode() {
    ob_start();
    ?>

<div>Hola</div>

<?php
return ob_get_clean();
}

add_shortcode( 'recomanacions', 'recomanacions_shortcode' );

/* wp_query() */
