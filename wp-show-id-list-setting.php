<?php
/*
Plugin Name: WP Show ID List
Description: WP Show ID List can check ID of posts and pages
Author: minoji
Version: 0.1.2
Text Domain: wp-show-id-list
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

add_action( 'plugins_loaded', 'wp_show_id_list_textdomain' );
function wp_show_id_list_textdomain() {
	load_plugin_textdomain( 'wp-show-id-list', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

// Add menu on admin panel.
function show_id_list() {
	add_menu_page(
		__('ID List', 'wp-show-id-list'),
		__('ID List', 'wp-show-id-list'),
		'manage_options',
		'show_id_list',
		'show_id_list_data'
	);
}
add_action( 'admin_menu', 'show_id_list' );

function show_id_list_data() {
	include 'wp-show-id-list.php';
}


// Show ID on edit panel(Posts).
function add_show_id_title_on_posts( $columns ) {
	$columns['id'] = 'ID';
	return $columns;
}
function add_show_id_data_on_posts( $column_name, $post_id ) {
	if ( 'id' === $column_name ) {
		echo esc_attr( get_the_ID( $post_id ) );
	}
}
add_filter( 'manage_posts_columns', 'add_show_id_title_on_posts' );
add_filter( 'manage_posts_custom_column', 'add_show_id_data_on_posts', 10, 2 );


// Show ID on edit panel(Pages).
function add_show_id_title_on_pages( $columns ) {
	$columns['id'] = 'ID';
	return $columns;
}
function add_show_id_data_on_pages( $column_name, $page_id ) {
	if ( 'id' === $column_name ) {
		echo esc_attr( get_the_ID( $page_id ) );
	}
}
add_filter( 'manage_pages_columns', 'add_show_id_title_on_pages' );
add_filter( 'manage_pages_custom_column', 'add_show_id_data_on_pages', 10, 2 );


// Show ID on edit panel(Categories).
function add_show_id_title_on_categories( $columns ) {
	$columns['id'] = 'ID';
	return $columns;
}
function add_show_id_data_on_categories( $string, $column_name, $category_id ) {
	if ('id' == $column_name){
		echo $category_id;
	}
}
add_filter( 'manage_edit-category_columns', 'add_show_id_title_on_categories' );
add_action('manage_category_custom_column', 'add_show_id_data_on_categories', 10, 3);
