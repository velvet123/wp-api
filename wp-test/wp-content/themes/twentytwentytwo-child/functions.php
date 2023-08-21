
<?php
function my_theme_enqueue_styles() {
    $parent_style = 'twentytwentytwo-style'; // This is 'parent-style' for the Twenty Seventeen theme.
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );



add_action( 'wp_enqueue_scripts', 'menu_scripts' );
function menu_scripts() {
wp_enqueue_script( 'responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/script.js', array( 'jquery' ), '1.0.0' );
wp_enqueue_script(
    'custom-script',
    get_stylesheet_directory_uri() . '/js/script.js',
    array( 'jquery' )
);
        }



// code for custom post type for api //

/**
 * Register a book post type, with REST API support
 *
 * Based on example at: https://codex.wordpress.org/Function_Reference/register_post_type
 */
add_action( 'init', 'my_book_cpt' );
function my_book_cpt() {
  $labels = array(
    'name'               => _x( 'Books', 'post type general name', 'your-plugin-textdomain' ),
    'singular_name'      => _x( 'Book', 'post type singular name', 'your-plugin-textdomain' ),
    'menu_name'          => _x( 'Books', 'admin menu', 'your-plugin-textdomain' ),
    'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'your-plugin-textdomain' ),
    'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
    'add_new_item'       => __( 'Add New Book', 'your-plugin-textdomain' ),
    'new_item'           => __( 'New Book', 'your-plugin-textdomain' ),
    'edit_item'          => __( 'Edit Book', 'your-plugin-textdomain' ),
    'view_item'          => __( 'View Book', 'your-plugin-textdomain' ),
    'all_items'          => __( 'All Books', 'your-plugin-textdomain' ),
    'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),
    'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),
    'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),
    'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
  );

  $args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'book' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'show_in_rest'       => true,
    'rest_base'          => 'books',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  );

  register_post_type( 'book', $args );
}

function my_plugin_rest_route_for_post( $route, $post ) {
    if ( $post->post_type === 'book' ) {
        $route = '/wp/v2/books/' . $post->ID;
    }

    return $route;
}
add_filter( 'rest_route_for_post', 'my_plugin_rest_route_for_post', 10, 2 );





//custom taxonomy for book custom post type//

/**
 * Register a genre post type, with REST API support
 *
 * Based on example at: https://codex.wordpress.org/Function_Reference/register_taxonomy
 */
add_action( 'init', 'my_book_taxonomy', 30 );
function my_book_taxonomy() {

  $labels = array(
    'name'              => _x( 'Genres', 'taxonomy general name' ),
    'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Genres' ),
    'all_items'         => __( 'All Genres' ),
    'parent_item'       => __( 'Parent Genre' ),
    'parent_item_colon' => __( 'Parent Genre:' ),
    'edit_item'         => __( 'Edit Genre' ),
    'update_item'       => __( 'Update Genre' ),
    'add_new_item'      => __( 'Add New Genre' ),
    'new_item_name'     => __( 'New Genre Name' ),
    'menu_name'         => __( 'Genre' ),
  );

  $args = array(
    'hierarchical'          => true,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'genre' ),
    'show_in_rest'          => true,
    'rest_base'             => 'genre',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
  );

  register_taxonomy( 'genre', array( 'book' ), $args );

}











// News custom post type//

/*Custom Post type start*/
function cw_post_type_news() {
  $supports = array(
  'title', // post title
  'editor', // post content
  'author', // post author
  'thumbnail', // featured images
  'excerpt', // post excerpt
  'custom-fields', // custom fields
  'comments', // post comments
  'revisions', // post revisions
  'post-formats', // post formats
  );
  $labels = array(
  'name' => _x('news', 'plural'),
  'singular_name' => _x('news', 'singular'),
  'menu_name' => _x('news', 'admin menu'),
  'name_admin_bar' => _x('news', 'admin bar'),
  'add_new' => _x('Add New', 'add new'),
  'add_new_item' => __('Add New news'),
  'new_item' => __('New news'),
  'edit_item' => __('Edit news'),
  'view_item' => __('View news'),
  'all_items' => __('All news'),
  'search_items' => __('Search news'),
  'not_found' => __('No news found.'),
  );
  $args = array(
  'supports' => $supports,
  'labels' => $labels,
  'public' => true,
  'query_var' => true,
  'rewrite' => array('slug' => 'news'),
  'has_archive' => true,
  'hierarchical' => false,
  );
  register_post_type('news', $args);
  }
  add_action('init', 'cw_post_type_news');
  /*Custom Post type end*/


// custom taxonomy code for news custom post type//



add_action('init', 'register_custom_taxonomy');
 
function register_custom_taxonomy()
{
    $labels = array(
        'name'              => _x('Locations', 'taxonomy general name'),
'singular_name'     => _x('Location','taxonomy singular name'),
'search_items'      => __('Search Location'),
'all_items'         => __('All Location'),
'parent_item'       => __('Parent Location'),
'parent_item_colon' => __('Parent Location:'),
'edit_item'         => __('Edit Location'),
'update_item'       => __('Update Location'),
'add_new_item'      => __('Add New Location'),
'new_item_name'     => __('New Location Name'),
'menu_name'         => __('Locations'),
);
 
$args = array(
'hierarchical'      => true, // make it hierarchical (like categories)
'labels'            => $labels,
'show_ui'           => true,
'show_admin_column' => true,
'query_var'         => true,
'show_in_rest' => true,
'rewrite'    => array('slug' => 'location'),
);
 
register_taxonomy('locations', 'news', $args); // Register Taxonomy
}
