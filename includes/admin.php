<?php

# Customize WP Navbar
add_action('admin_bar_menu', function($wp_admin_bar) {
	$wp_admin_bar->remove_node('wp-logo');
	$wp_admin_bar->remove_node('comments');
	$wp_admin_bar->remove_node('customize');
}, 999);

# Customize WP Sidebar
add_action('admin_menu', function(){
	remove_menu_page('upload.php');
	remove_menu_page('edit-comments.php');
	remove_submenu_page('options-general.php', 'mailgun-lists');
	//remove_meta_box('pageparentdiv', 'page', 'normal');
});

# Editor style for TinyMCE
add_action('admin_init', function(){
	add_editor_style('/assets/css/editor-style.css');
});

# Disable Attachments plugin settings screen
add_filter('attachments_settings_screen', '__return_false');

# All post types in the recent posts
add_filter('dashboard_recent_posts_query_args', function($args){
	$args['post_type'] = 'any';
	return $args;
});