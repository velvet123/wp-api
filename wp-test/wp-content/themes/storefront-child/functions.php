
<?php
function my_theme_enqueue_styles() {
    $parent_style = 'storefront-style'; // This is 'parent-style' for the Twenty Seventeen theme.
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );



add_filter('admin_post_thumbnail_html', 'add_featured_image_instruction');
function add_featured_image_instruction( $content ) {
return $content .= '<p      >Featured Image size:<br />
375 (w) X 250 (h) </p>';

}

