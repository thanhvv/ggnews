<?php
/*
Plugin Name: Simple News
Version: 1.0
Plugin URI: https://www.thanhvv.com
Description: List of News.
Author: Võ Văn Th
Text Domain: simple-news
Domain Path: /translation
Author URI: https://www.thanhvv.com
*/

// Load the plugin's text domain
function hjemmesider_news_init() {
	load_plugin_textdomain('simple-news', false, dirname(plugin_basename(__FILE__)) . '/translation');
}
add_action('plugins_loaded', 'hjemmesider_news_init');

// News Posttype
add_action( 'init', 'hjemmesider_news_create_posttype' );
	function hjemmesider_news_create_posttype() {
    register_post_type('news',
    	array(
	    	'labels' => array('name' => __('News', 'simple-news'),
	    	'singular_name' => __('News', 'simple-news')),
	    	'public' => true,
	    	'publicly_queryable' => true,
	    	'menu_icon' => 'dashicons-calendar-alt',
	    	'taxonomies' => array('category'),
	    	'has_archive' => true,
	    	'supports' => array(
	    		'title',
	    		'editor',
	    		'excerpt',
	    		'thumbnail',
	    		'comments'
	    	),
	    	'show_in_rest' => true,
	    	'rewrite' => array('slug' => 'news'),
    	)
    );
	}

function hjemmesider_news_function() {
	hjemmesider_news_create_posttype();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'hjemmesider_news_function' );

// Images
if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
	add_image_size('news_plugin_small', 700, 700, true);
	add_image_size('news_plugin_full', 9999);
}

// Change author
function simple_news_allowAuthorEditing()
{
  add_post_type_support( 'news', 'author' );
}
add_action('init','simple_news_allowAuthorEditing');

// Files
require_once ('files/admin.php');
require_once ('files/functions.php');
require_once ('files/shortcode.php');
require_once ('files/widget.php');

// CSS file
$options = get_option( 'simple_news_settings' );

if ( 1 == ! isset($options['simple_news_checkbox_css'] )) {
	add_action('wp_enqueue_scripts', 'hjemmesider_news_register_plugin_styles');
    function hjemmesider_news_register_plugin_styles() {
    	wp_register_style('news', plugins_url('simple-news/css/news-min.css'));
    	wp_enqueue_style('news');
    }
}

// Shotcode in widget
add_filter('widget_text', 'do_shortcode');
