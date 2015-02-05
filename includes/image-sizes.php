<?php
/**
 * Feature Images (Post Thumbnails)
 *
 * Register theme image sizes
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
add_theme_support('post-thumbnails');

// Set default thumbnail size
set_post_thumbnail_size(100, 100, true);

// Custom thumbnail sizes
add_image_size('SIZE_NAME', 110, 110, true);
