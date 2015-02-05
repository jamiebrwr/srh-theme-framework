<?php
/**
 * Filter global $wp_roles object
 *
 * Filters the list of roles in the global $wp_roles object.
 * Fetches and filters the list of user roles. Restricting and
 * allowing the current to only add, edit or delete up-to
 * their current capabilities.
 *
 * @global object $wp_roles list or registered roles.
 * @return array filtered $wp_roles object
 *
 */
function srh_framework_filter_role_list( $all_roles ) {
    $user = wp_get_current_user();
    foreach ( $all_roles as $name => $role ) {
	    if ( !current_user_can( 'srh_framework_custom_capability' ) ) {
            //unset($all_roles['srh_framework_wp_developer']);
        }
    }
    return $all_roles;
}
add_filter('editable_roles', 'srh_framework_filter_role_list');

/**
 * Filter global $wp_roles object
 *
 * change the default image by using the following
 * code in your functions.php file:
 *
 */
function srh_framework_custom_column_image( $image ) {
    if ( !has_post_thumbnail() )
        return trailingslashit( get_stylesheet_directory_uri() ) . 'images/no-featured-image';
}
add_filter( 'featured_image_column_default_image', 'srh_framework_custom_column_image' );

/**
 *
 * Customized Read More
 *
 */
function srh_framework_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('read more…', 'your-text-domain') . '</a>';
}
add_filter( 'excerpt_more', 'srh_framework_excerpt_more' );

/**
 *
 * Customized Excerpt Length
 *
 */
function srh_framework_excerpt_length( $length ) {
	//if( is_page_template( 'template-blog.php' ) ) : return 40; endif;
	return 40;
}
add_filter( 'excerpt_length', 'srh_framework_excerpt_length', 999 );
