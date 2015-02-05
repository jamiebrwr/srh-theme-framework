<?php
/**
 * srh-framework Theme Customizer
 *
 * @package srh-framework
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function srh_framework_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'srh_framework_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function srh_framework_customize_preview_js() {
	wp_enqueue_script( 'srh_framework_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'srh_framework_customize_preview_js' );



/*-------------------------------------------------------------------------------------------
ycm_ambica Customizer Theme Settings and Options
-------------------------------------------------------------------------------------------*/

/**
 * The configuration options for the Shoestrap Customizer
 */
function shoestrap_customizer_config() {

	$args = array(

		// Change the logo image. (URL)
		// If omitted, the default theme info will be displayed.
		// A good size for the logo is 250x50.
		'logo_image'   => get_template_directory_uri() . '/images/customizer-logo.gif',

		// The color of active menu items, help bullets etc.
		'color_active' => '#27be62',

		// Color used for secondary elements and disable/inactive controls
		'color_light'  => '#33bd66',

		// Color used for button-set controls and other elements
		'color_select' => '#fff',

		// Color used on slider controls and image selects
		'color_accent' => '#FF5740',

		// The generic background color.
		// You should choose a dark color here as we're using white for the text color.
		'color_back'   => '#f1eddd',

		// If Kirki is embedded in your theme, then you can use this line to specify its location.
		// This will be used to properly enqueue the necessary stylesheets and scripts.
		// If you are using kirki as a plugin then please delete this line.
		'url_path'     => get_template_directory_uri() . '/kirki/',

		// If you want to take advantage of the backround control's 'output',
		// then you'll have to specify the ID of your stylesheet here.
		// The "ID" of your stylesheet is its "handle" on the wp_enqueue_style() function.
		// http://codex.wordpress.org/Function_Reference/wp_enqueue_style
		'stylesheet_id' => 'shoestrap',

	);

	return $args;

}
add_filter( 'kirki/config', 'shoestrap_customizer_config' );


/**
 * Remove pre-exising customizer settings
 */
function srh_framework_remove_pre_exising_section( $wp_customize ) {

	$wp_customize->remove_section('nav');
	//$wp_customize->remove_section('static_front_page');
	$wp_customize->remove_section('colors');

}
add_action( 'customize_register', 'srh_framework_remove_pre_exising_section' );


/**
 * Create the Custom Logo Section
 */
function srh_framework_logo_section( $wp_customize ) {

	// Create the "Custom Logo" section
	$wp_customize->add_section( 'srh_framework_logo_section', array(
		'title'    => __( 'Custom Logo', 'srh_framework' ),
		'priority' => 20
	) );

}
add_action( 'customize_register', 'srh_framework_logo_section' );

/**
 * Create the Custom Logo setting
 */
function srh_framework_logo_setting( $controls ) {

	$controls[] = array(
		'type'     => 'image',
		'setting'  => 'srh_framework_logo_setting',
		'label'    => __( 'Add a Custom Logo', 'srh_framework' ),
		'section'  => 'srh_framework_logo_section',
		'default'  => '',
		'priority' => 1,
	);

	return $controls;
}
add_filter( 'kirki/controls', 'srh_framework_logo_setting' );


/**
 * Create the Contact Details Section
 */
function srh_framework_contact_section( $wp_customize ) {
	$wp_customize->add_section( 'srh_framework_contact_section', array(
		'title'    => __( 'Contact Details', 'srh_framework' ),
		'priority' => 25
	) );

}
add_action( 'customize_register', 'srh_framework_contact_section' );

function srh_framework_contact_setting( $controls ) {

	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'srh_framework_street',
		'label'    => __( 'Street Address', 'srh_framework' ),
		'section'  => 'srh_framework_contact_section',
		'default'  => __( '123 Sesame St.', 'srh_framework' ),
		'priority' => 1,
	);

	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'srh_framework_city',
		'label'    => __( 'City', 'srh_framework' ),
		'section'  => 'srh_framework_contact_section',
		'default'  => __( 'Hollywood', 'srh_framework' ),
		'priority' => 1,
	);

	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'srh_framework_state',
		'label'    => __( 'State', 'srh_framework' ),
		'section'  => 'srh_framework_contact_section',
		'default'  => __( 'CA', 'srh_framework' ),
		'priority' => 1,
	);

	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'srh_framework_zipcode',
		'label'    => __( 'Zip Code', 'srh_framework' ),
		'section'  => 'srh_framework_contact_section',
		'default'  => __( '90069', 'srh_framework' ),
		'priority' => 1,
	);

	$controls[] = array(
		'type'     => 'text',
		'setting'  => 'srh_framework_phone',
		'label'    => __( 'Phone Number', 'srh_framework' ),
		'section'  => 'srh_framework_contact_section',
		'default'  => __( '(555) 555-5555', 'srh_framework' ),
		'priority' => 1,
	);

	$controls[] = array(
		'type'     => 'checkbox',
		'setting'  => 'srh_framework_gmap',
		'label'    => __( 'Add Google Maps to Contact template.', 'srh_framework' ),
		'section'  => 'srh_framework_contact_section',
		'default'  => 0,
		'priority' => 1,
	);


	return $controls;
}

add_filter( 'kirki/controls', 'srh_framework_contact_setting' );

/**
 * Homepage Sliders Section
 */
function srh_framework_homepage_sliders_section( $wp_customize ) {
	$wp_customize->add_section( 'srh_framework_homepage_sliders_section', array(
		'title'    => __( 'Theme Sliders', 'srh_framework' ),
		'priority' => 30
	) );

}
add_action( 'customize_register', 'srh_framework_homepage_sliders_section' );

function srh_framework_homepage_sliders_setting( $controls ) {

	$controls[] = array(
		'type'     => 'checkbox',
		'setting'  => 'srh_framework_primary_slider',
		'label'    => __( 'Enable Primary Homepage Slider', 'srh_framework' ),
		'section'  => 'srh_framework_homepage_sliders_section',
		'default'  => 0,
		'priority' => 1,
	);

	$controls[] = array(
		'type'     => 'checkbox',
		'setting'  => 'srh_framework_secondary_slider',
		'label'    => __( 'Enable Homepage Products Slider', 'srh_framework' ),
		'section'  => 'srh_framework_homepage_sliders_section',
		'default'  => 0,
		'priority' => 1,
	);
/*
	$controls[] = array(
		'type'     => 'checkbox',
		'setting'  => 'srh_framework_cafe_slider',
		'label'    => __( 'Enable Cafe Page Slider', 'srh_framework' ),
		'section'  => 'srh_framework_homepage_sliders_section',
		'default'  => 0,
		'priority' => 1,
	);
*/

	$controls[] = array(
		'type'     => 'select',
		'setting'  => 'post_to_use_for_slides',
		'label'    => __( 'Chat Cafe Slider', 'srh_framework' ),
		'section'  => 'srh_framework_homepage_sliders_section',
		'default'  => 'chat-cafe',
		'priority' => 1,
		'choices'  => $vals,
	);



	return $controls;
}




add_filter( 'kirki/controls', 'srh_framework_homepage_sliders_setting' );






/* -------------------------------------------------------------------------------------------*
 * REGISTER: Social Icon Links
 * -------------------------------------------------------------------------------------------*/
function srh_framework_social_icon_link_settings( $wp_customize ) {
	/**
	 * SECTION: Create the "Social Icon Links" section
	 * -----------------------------------------------------------------------*/
	$wp_customize->add_section( 'srh_framework_social_icon_link_section', array(
		'title'    => __( 'Social Links', 'srh_framework' ),
		'priority' => 31
	) );

	/**
	 * SETTINGS: Social Links
	 * -----------------------------------------------------------------------*/
	// Register the Twiiter setting
	$wp_customize->add_setting( 'twitter_link', array(
		'default'        => '#',
		'type'           => 'theme_mod',
		'capability'     => 'edit_theme_options',
	) );
	// Register the Facebook setting
	$wp_customize->add_setting( 'facebook_link', array(
		'default'        => '#',
		'type'           => 'theme_mod',
		'capability'     => 'edit_theme_options',
	) );
	// Register the Google+ setting
	$wp_customize->add_setting( 'google_plus_link', array(
		'default'        => '#',
		'type'           => 'theme_mod',
		'capability'     => 'edit_theme_options',
	) );
	// Register the Pinterest setting
	$wp_customize->add_setting( 'pinterest_link', array(
		'default'        => '#',
		'type'           => 'theme_mod',
		'capability'     => 'edit_theme_options',
	) );
	// Register the Linkedin setting
	$wp_customize->add_setting( 'linkedin_link', array(
		'default'        => '#',
		'type'           => 'theme_mod',
		'capability'     => 'edit_theme_options',
	) );
	// Register the Instagram setting
	$wp_customize->add_setting( 'instagram_link', array(
		'default'        => '#',
		'type'           => 'theme_mod',
		'capability'     => 'edit_theme_options',
	) );

	/**
	 * CONTROLS: Social Links
	 * -----------------------------------------------------------------------*/
	// Add the Twitter Username control
	$wp_customize->add_control( 'twitter_link', array(
		'label'       => __( 'Twitter Username', 'srh_framework' ),
		'section'     => 'srh_framework_social_icon_link_section',
		'settings'    => 'twitter_link',
		'type'        => 'text',
		'priority'    => 1
    ) );
    // Add the Facebook Username control
	$wp_customize->add_control( 'facebook_link', array(
		'label'       => __( 'Facebook Username', 'srh_framework' ),
		'section'     => 'srh_framework_social_icon_link_section',
		'settings'    => 'facebook_link',
		'type'        => 'text',
		'priority'    => 1
    ) );
    // Add the Instagram Username control
	$wp_customize->add_control( 'instagram_link', array(
		'label'       => __( 'Instagram Username', 'srh_framework' ),
		'section'     => 'srh_framework_social_icon_link_section',
		'settings'    => 'instagram_link',
		'type'        => 'text',
		'priority'    => 1
    ) );
    $wp_customize->add_control( 'google_plus_link', array(
		'label'       => __( 'Google+ Username', 'srh_framework' ),
		'section'     => 'srh_framework_social_icon_link_section',
		'settings'    => 'google_plus_link',
		'type'        => 'text',
		'priority'    => 1
    ) );
    // Add the Pinterest Username control
	$wp_customize->add_control( 'pinterest_link', array(
		'label'       => __( 'Pinterest Username', 'srh_framework' ),
		'section'     => 'srh_framework_social_icon_link_section',
		'settings'    => 'pinterest_link',
		'type'        => 'text',
		'priority'    => 1
    ) );
    // Add the Linkedin Username control
	$wp_customize->add_control( 'linkedin_link', array(
		'label'       => __( 'Linkedin Username', 'srh_framework' ),
		'section'     => 'srh_framework_social_icon_link_section',
		'settings'    => 'linkedin_link',
		'type'        => 'text',
		'priority'    => 1
    ) );
}
add_action( 'customize_register', 'srh_framework_social_icon_link_settings' );


/* -------------------------------------------------------------------------------------------*
 * REGISTER: Google Analytics
 * -------------------------------------------------------------------------------------------*/
function srh_framework_google_analytics_section( $wp_customize ) {

	// Create the "My Section" section
	$wp_customize->add_section( 'srh_framework_google_analytics_section', array(
		'title'    => __( 'Google Analytics', 'srh_framework' ),
		'priority' => 32,
		'subtitle' => __( 'Google Analytics Tracking Code', 'srh_framework' ),
		'description' => __( 'Paste your Google Analytics tracking code below.', 'srh_framework' ),
	) );

}
add_action( 'customize_register', 'srh_framework_google_analytics_section' );

	/**
	 * SETTINGS: Google Analytics
	 * -----------------------------------------------------------------------*/
	function srh_framework_google_analytics_setting( $controls ) {

		$controls[] = array(
				'type'     => 'textarea',
				'setting'  => 'google_analytics_tracking_code',
				'label'    => __( 'Google Analytics Tracking Code', 'srh_framework' ),
				'section'  => 'srh_framework_google_analytics_section',
				'default'  => '',
				'priority' => 32,

			);

			return $controls;
		}
	add_filter( 'kirki/controls', 'srh_framework_google_analytics_setting' );


















