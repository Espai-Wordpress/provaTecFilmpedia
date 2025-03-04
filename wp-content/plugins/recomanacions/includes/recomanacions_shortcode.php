<?php

function recomanacions_shortcode() {
    ob_start();
    ?>

    <div>Vista de les recomanacions</div>

<?php
return ob_get_clean();
}

add_shortcode( 'recomanacions', 'recomanacions_shortcode' );
