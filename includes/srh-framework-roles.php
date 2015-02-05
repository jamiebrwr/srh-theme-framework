<?php
/**
 * Clone Admin Role Capabilities
 *
 * @link jamie.brwr@gmail.com
 */
function srh_framework_clone_role() {
    global $wp_roles;
    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();

    $admin = $wp_roles->get_role('administrator');
    //Adding a 'srh_framework_wp_developer_role' with all admin caps
    $wp_roles->add_role('srh_framework_wp_developer_role', 'WP Developer', $admin->capabilities);
}
add_action('init', 'srh_framework_clone_role');

/**
 * Add custom capability for srh_framework_wp_developer_role()
 *
 * Call the function when your plugin/theme is activated.
 */
function srh_set_capabilities() {

    // Get the role object.
    $wp_developer = get_role( 'srh_framework_wp_developer_role' );

	// A list of capabilities to remove from Administrators.
    $caps = array(
        'srh_framework_custom_capability',
    );

    foreach ( $caps as $cap ) {

        // Remove the capability.
        $wp_developer->add_cap( $cap );
    }
}
add_action( 'init', 'srh_set_capabilities' );

/**
 * Remnoves srh_framework_remove_role
 *
 * Remnoves the srh_framework_remove_role after assiging.
 *
 */
function srh_framework_remove_role() {
    global $wp_roles;
    //remove_role( 'srh_framework_wp_developer_role' );
}
add_action('init', 'srh_framework_remove_role');