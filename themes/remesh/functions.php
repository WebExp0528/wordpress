<?php

/**
 * This file bootstraps your Stem app.  Whatever you'd normally do in a functions.php file you can do in the "onSetup"
 * callback down at the bottom of the file.
 *
 * If you are using composer for whatever, make sure you uncomment out the require_once line below too.
 */


/**
 * Must include this for trellis deploys.
 */
if (!class_exists(\Stem\Core\Context::class)) {
    return;
}

if (file_exists(dirname(__FILE__).'/vendor/autoload.php')) {
    require_once dirname(__FILE__).'/vendor/autoload.php';
}

/**
 * Create the context for this theme.
 *
 */
$context=\Stem\Core\Context::initialize(dirname(__FILE__));

/**
 * Setup functions
 */
$context->onSetup(function() use ($context) {
    // Here we do any setup
    add_filter('upload_mimes', function($mimes){
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    });

    add_action('admin_bar_menu', function($wp_admin_bar){
        $wp_admin_bar->remove_menu('customize');
        $wp_admin_bar->remove_menu('comments');
        $wp_admin_bar->remove_menu('wp-logo');
    }, 999);

    if (function_exists('stem_content_register')) {
	    stem_content_register();
    }

    // Disable SRCSET
	add_filter('wp_get_attachment_image_attributes', function($attr) {
		if (isset($attr['sizes'])) {
			unset($attr['sizes']);
		}

		if (isset($attr['srcset'])) {
			unset($attr['srcset']);
		}

		return $attr;
	}, PHP_INT_MAX);

	// Override the calculated image sources
	add_filter('wp_calculate_image_srcset', '__return_empty_array', PHP_INT_MAX);

	// Remove the reponsive stuff from the content
	remove_filter( 'the_content', 'wp_make_content_images_responsive' );

	if (is_admin()) {
		add_action( 'pre_get_posts', function($wp_query) {
			$wp_query->set('update_post_meta_cache', false);
		});
	}

	add_filter('pre_site_transient_update_core', function() {
		global $wp_version;
		return(object) array(
			'last_checked'=> time(),
			'version_checked'=> $wp_version,
			'updates' => array()
		);
	});

	PressBits\MediaLibrary\ScalableVectorGraphicsDisplay::enable();

	if (function_exists('acf_add_options_page')) {
		acf_add_options_page([
			'page_title' 	=> 'Remesh Settings',
			'menu_title'	=> 'Remesh',
			'menu_slug' 	=> 'remesh-settings',
			'capability'	=> 'edit_posts'
		]);

		acf_add_options_sub_page([
			'page_title' 	=> 'Remesh Footer Settings',
			'menu_title'	=> 'Footer',
			'parent_slug'	=> 'remesh-settings',
		]);

		acf_add_options_sub_page([
			'page_title' 	=> 'Remesh Bio List Settings',
			'menu_title'	=> 'Bio List',
			'parent_slug'	=> 'remesh-settings',
		]);

		acf_add_options_sub_page([
			'page_title' 	=> 'Announcement Bar Settings',
			'menu_title'	=> 'Announcement',
			'parent_slug'	=> 'remesh-settings',
		]);
	}

});