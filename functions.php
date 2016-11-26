<?php

# Add script and style
add_action('wp_enqueue_scripts', function(){
	if (is_admin()) return;
	wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/css/style.css');
	wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/script.js', ['jquery'], false, true);
});

# Basic site config (custom post types, image sizes)
include(get_template_directory() . '/includes/init.php');

# User customizations (custom fields, weather checker)
include(get_template_directory() . '/includes/user.php');

# Configure admin stuff (menus, edit pages, etc)
include(get_template_directory() . '/includes/admin.php');

# Set projects page to be home page
add_action('pre_get_posts', function($wp_query){
    if (is_admin()) return;

	if ($wp_query->get('page_id') == get_option('page_on_front')) {
		$wp_query->set('post_type', 'project');
		$wp_query->set('page_id', '');
		$wp_query->is_page = 0;
		$wp_query->is_singular = 0;
		$wp_query->is_post_type_archive = 1;
		$wp_query->is_archive = 1;
	}
});

# Configure Attachments
add_filter('attachments_default_instance', '__return_false');
add_action('attachments_register', function($attachments){
	$attachments->register('attachments', [
		'label'				=> 'Images',
		'post_type'			=> ['project', 'page'],
		//'position'		=> 'side',    //normal, side or advanced
		'priority'			=> 'default', //high, default, low, core
		'filetype'			=> null,      //image|video|text|audio|application
		//'note'			=> 'Attach files here!',
		'append'			=> true,
		'button_text'		=> __( 'Attach', 'attachments' ),
		'modal_text'		=> __( 'Attach', 'attachments' ),
		'router'			=> 'browse',   //browse|upload
		'post_parent'		=> false,      // whether Attachments should set 'Uploaded to' (if not already set)
		'fields'			=> [
			[
				'name'		=> 'title',
				'type'		=> 'text',
				'label'		=> __('Title', 'attachments'),
				'default'	=> 'title',
			],
			[
				'name'		=> 'link',
				'type'		=> 'text',
				'label'		=> __('Link', 'attachments'),
				'default'	=> 'link',
			],
		],
	]);
});

function dd($content) {
	echo '<pre>';
	print_r($content);
	exit;
}