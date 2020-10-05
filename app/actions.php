<?php

namespace App;

function website_favicon() { ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php asset('images/apple-touch-icon.png') ?>" >
    <link rel="icon" type="image/png" sizes="32x32" href="<?php asset('images/favicon-32x32.png') ?>" >
    <link rel="icon" type="image/png" sizes="16x16" href="<?php asset('images/favicon-16x16.png') ?>" >
<?php }
add_action('wp_head', 'website_favicon');