/*
Plugin Name: Search by Slug
Plugin URI: https://github.com/EugeneGbch/search-by-slug
Description: Allows you to search for posts/pages/post_types by slug inside /wp-admin area.
Version: 1.0.0
Author: Eugene Gb
Author URI: https://www.linkedin.com/in/eugene-g-493275259/
License: GPL2
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// Add search filter to modify search queries
add_filter( 'posts_search', 'search_by_slug', 10, 2 );

function search_by_slug( $search, $query ) {
    global $wpdb;
    // Check if search query starts with 'slug:'
    if ( ! is_admin() || ! isset( $query->query_vars['s'] ) || strpos( $query->query_vars['s'], 'slug:' ) !== 0 ) {
        return $search;
    }
    // Extract the slug from the search query
    $slug = substr( $query->query_vars['s'], 5 );
    // Modify the search query to search by slug
    $search = $wpdb->prepare( " AND {$wpdb->posts}.post_name LIKE %s ", '%' . $wpdb->esc_like( $slug ) . '%' );
    return $search;
}
?>
