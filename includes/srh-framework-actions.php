<?php
/**
 * Remove Admin Pages
 *
 * Removes Admin pages from the backend administration menu.
 *
 * @since 3.9.1
 * @access (for functions: only use if private)
 *
 * @see Function/method/class relied on
 * @link URL
 * @global type $varname Short description.
 *
 * @param  type $var Description.
 * @param  type $var Optional. Description.
 * @return type Description.
 */
function srh_framework_remove_menu_pages() {

    /* admin_menu hook function/callback */
    add_action('admin_init', 'srh_check_username');

    function srh_check_username() {

        /* Retrieve the current user object (WP_User) */
        $user = wp_get_current_user();

        if( $user && isset( $user->user_login ) && 'jamie' !== $user->user_login ) {
            /* Hide other users menus */
            /* Top level core menu items */
            remove_menu_page('link-manager.php');
            remove_menu_page('srh-tricks');
            //remove_menu_page('edit.php?post_type=slide');
            remove_menu_page('edit.php?post_type=portfolio');
            //remove_menu_page('edit-comments.php');
            remove_menu_page('edit.php?post_type=feedback');
            remove_menu_page('tools.php');
            //remove_menu_page('plugins.php');
            //remove_menu_page('options-general.php');
            remove_menu_page('update-core.php');
            /* Top level plugin menu items */
            remove_menu_page('edit.php?post_type=logos');
            remove_menu_page('viva_plugins');
            remove_menu_page('easy-content-types');
            remove_menu_page('ot-settings');
            remove_menu_page('pb_backupbuddy_getting_started');
            remove_menu_page('wp_stream');
            remove_menu_page( 'jetpack'  );
            remove_menu_page( 'edit.php?post_type=gallery'  );
            remove_menu_page( 'edit.php?post_type=services'  );
            remove_menu_page( 'wpcf7'  );

            /* Sub Menus */
            remove_submenu_page( 'themes.php', 'theme-editor.php'  );
            //remove_submenu_page( 'themes.php', 'widgets.php'  );
            remove_submenu_page( 'themes.php', 'customize.php'  );
            remove_submenu_page( 'themes.php', 'editcss'  );
            remove_submenu_page( 'themes.php', 'themes.php'  );
            remove_submenu_page( 'themes.php', 'ot-theme-options'  );
            remove_submenu_page( 'index.php', 'update-core.php'  );
            remove_submenu_page( 'plugins.php', 'plugin-editor.php'  );
            remove_submenu_page( 'woothemes', 'woo-meta-manager'  );
            remove_submenu_page( 'woothemes', 'woo-hook-manager'  );
            remove_submenu_page( 'woothemes', 'woo-layout-manager'  );
//            remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
            remove_submenu_page( 'edit.php', 'ce-post-column-editor'  );
            remove_submenu_page( 'edit.php?post_type=page', 'ce-page-column-editor'  );
			remove_submenu_page( 'edit.php?post_type=feature', 'ce-feature-column-editor');
			remove_submenu_page( 'edit.php?post_type=products', 'ce-products-column-editor');
			remove_submenu_page( 'edit.php?post_type=slides', 'ce-slides-column-editor');
			remove_submenu_page( 'tools.php', 'admin-color-schemer'  );


            remove_submenu_page( 'gf_edit_forms', 'gf_settings'  );
            remove_submenu_page( 'gf_edit_forms', 'gf_export'  );
            remove_submenu_page( 'gf_edit_forms', 'gf_update'  );
            remove_submenu_page( 'gf_edit_forms', 'gf_addons'  );
            remove_submenu_page( 'gf_edit_forms', 'gf_help'  );

            remove_submenu_page( 'edit.php', 'ce-post-column-editor'  );
            remove_submenu_page( 'edit.php', 'ce-post-column-editor'  );
            remove_submenu_page( 'themes.php', 'radium_demo_installer'  );
            remove_submenu_page( 'themes.php', 'tgmpa-install-plugins'  );
            remove_submenu_page( 'themes.php', 'custom-background'  );
            remove_submenu_page( 'edit.php?post_type=fdm-menu', 'food-and-drink-menu-settings'  );
            remove_submenu_page( 'options-general.php', 'siteorigin_panels'  );
            remove_submenu_page( 'options-general.php', 'add-to-any.php'  );
            remove_submenu_page( 'themes.php', 'themecheck'  );
			remove_submenu_page( 'cleverness-to-do-list', 'cleverness-to-do-list-settings'  );

            /**
			 * Remove "Breadcrumb NavXT Settings" plugins settings menu item.
			 */
            remove_submenu_page( 'options-general.php', 'breadcrumb-navxt'  );

            remove_submenu_page( 'edit.php?post_type=page', 'ce-page-column-editor'  );
			//remove_submenu_page( 'edit.php?post_type=projects', 'ce-projects-column-editor');
			remove_submenu_page( 'edit.php?post_type=testimonial', 'ce-testimonial-column-editor');
        } else {
            /* hide admin menus from user_login 'jamie' */
            remove_menu_page('link-manager.php');
            //remove_menu_page('edit.php?post_type=slide');
            remove_menu_page('edit.php?post_type=portfolio');
            remove_menu_page('edit.php?post_type=feedback');
            remove_menu_page('tools.php');
            /* Sub Menus */
            //remove_submenu_page( 'plugins.php', 'plugin-editor.php'  );
            remove_submenu_page( 'edit.php', 'ce-post-column-editor'  );
            remove_submenu_page( 'woothemes', 'woo-meta-manager'  );
            remove_submenu_page( 'woothemes', 'woo-hook-manager'  );
            remove_submenu_page( 'woothemes', 'woo-layout-manager'  );
            remove_submenu_page( 'edit.php?post_type=page', 'easy-content-types'  );
            remove_submenu_page( 'edit.php?post_type=page', 'ce-page-column-editor'  );
        }
    }
}
add_action( 'admin_menu', 'srh_framework_remove_menu_pages' );

/**
 * Remove Dashboard Metaboxes
 *
 * Removes metaboxes from the Dashboard.
 *
 */
global $user;
$user = wp_get_current_user();
if ( is_admin() && $user && isset( $user->user_login ) && 'jamie' !== $user->user_login ) :
	function srh_framework_remove_dashboard_widgets(){
	    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   		// Right Now
	    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); 	// Recent Comments
	    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  	// Incoming Links
	    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   			// Plugins
	    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  		// Quick Press
	    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  		// Recent Drafts
	    remove_meta_box('dashboard_primary', 'dashboard', 'side');   			// WordPress blog
	    remove_meta_box('dashboard_secondary', 'dashboard', 'side');   			// Dashboard Secondary

	    // Plugins
	    remove_meta_box('pb_backupbuddy_stats', 'dashboard', 'normal');   		// Backupbuddy Stats
	    remove_meta_box('dashboard_stream_activity', 'dashboard', 'normal');   	// Stream Activity
	    remove_meta_box('cleverness_todo', '', 'normal');   					// Cleverness Todo
	}
	add_action( 'wp_dashboard_setup', 'srh_framework_remove_dashboard_widgets' );
endif;

/**
 * Protect Plugins
 *
 * Removes Plugins from the plugins admin screen.
 *
 */
function srh_framework_protect_plugin() {
  global $wp_list_table;
  $hidearr = array(
		'stream/stream.php',
		'cleverness-to-do-list/cleverness-to-do-list.php',
		'what-the-file/what-the-file.php',
		'theme-check/theme-check.php',
		'backupbuddy/backupbuddy.php','srh/srh.php',
		'SRH-Management/srh-management.php',
		'user-switching/user-switching.php',
		'easy-content-types/easy-content-types.php',
		'column-editor/column-editor.php',
		'ecpt-bonus-fields/ecpt-bonus-fields.php',
		'WPShapere/wpshapere.php'
	);
  $myplugins = $wp_list_table->items;
  foreach ($myplugins as $key => $val) {
	if (in_array($key,$hidearr)) {
	  unset($wp_list_table->items[$key]);
	}
  }
}
add_action('pre_current_active_plugins', 'srh_framework_protect_plugin');