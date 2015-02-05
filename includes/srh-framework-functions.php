<?php
/**
 * Social Sharing
 *
 * Add social sharing profile links from the backend administration menu.
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
function srh_framework_social_sharing(){ ?>
		<div class="social_sharing_link_wrapper">
			<ul>
				<?php if(get_theme_mod('twitter_link','') != "") { ?>
					<li class="twitter"><a href="https://twitter.com/<?php echo get_theme_mod('twitter_link',''); ?>">Twitter</a></li>
				<?php } ?>
				<?php if(get_theme_mod('facebook_link','') != "") { ?>
					<li class="facebook"><a href="https://www.facebook.com/<?php echo get_theme_mod('facebook_link',''); ?>">Facebook</a></li>
				<?php } ?>
				<?php if(get_theme_mod('google_plus_link','') != "") { ?>
					<li class="google"><a href="https://plus.google.com/u/0/+<?php echo get_theme_mod('google_plus_link',''); ?>">Google</a></a></li>
				<?php } ?>
				<?php if(get_theme_mod('pinterest_link','') != "") { ?>
					<li class="pinterest"><a href="http://www.pinterest.com/<?php echo get_theme_mod('pinterest_link',''); ?>">Pinterest</a></li>
				<?php } ?>
				<?php if(get_theme_mod('linkedin_link','') != "") { ?>
					<li class="linkedin"><a href="https://linkedin.com/<?php echo get_theme_mod('linkedin_link',''); ?>">Linkedin</a></li>
				<?php } ?>
				<?php if(get_theme_mod('instagram_link','') != "") { ?>
					<li class="instagram"><a href="https://linkedin.com/<?php echo get_theme_mod('linkedin_link',''); ?>">Linkedin</a></li>
				<?php } ?>
			</ul>
			<div class="clear"></div>
		</div><!--//footer_social-->
<?php }


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


// Protect the srh_framework_wp_developer_role Role
include plugin_dir_path( __FILE__ ) . 'classes/class.protected-roles.php';




