<?php

add_action('init', function(){

	# Enable Header Menu
	register_nav_menu('header-menu', __('Header Menu'));
	register_nav_menu('about-menu', __('About Menu'));
	
	# Register Custom Post Type for Projects
	register_post_type('project', [
		'labels' => [
			'name'					=> __('Projects'),
			'singular_name'			=> __('Project'),
			'menu_name'				=> _x('Projects', 'admin menu'),
			'name_admin_bar'		=> _x('Project', 'add new on admin bar'),
			'add_new'				=> _x('Add New', 'book'),
			'add_new_item'			=> __('Add New Project'),
			'new_item'				=> __('New Project'),
			'edit_item'				=> __('Edit Project'),
			'view_item'				=> __('View Project'),
			'all_items'				=> __('All Projects'),
			'search_items'			=> __('Search Projects'),
			'parent_item_colon'		=> __('Parent Projects:'),
			'not_found'				=> __('No projects found.'),
			'not_found_in_trash'	=> __('No projects found in Trash.'),
		],
		'supports'			=> ['title', 'editor', 'thumbnail'],
		'public'			=> true,
		'has_archive'		=> true,
		'menu_position'		=> 20,
		'menu_icon'			=> 'dashicons-admin-page',
		'hierarchical'		=> true,
		'rewrite'			=> ['slug' => 'projects'],
	]);	
	
	# Add Thumbnails to Projects
	add_theme_support('post-thumbnails', ['project']);
	
	# Retina Images: define width as 2x column width
	add_image_size('one-third', 720, 9999);
	add_image_size('two-thirds', 1500, 9999);
	add_filter('image_size_names_choose', function($sizes){
	    return array_merge($sizes, array(
			'one-third' => __('1/3 Page Width'),
			'two-thirds' => __('2/3 Page Width'),
	    ));
	});
	 
	# Create a Taxonomy for Project Types
	register_taxonomy('type', 'project', [
		'hierarchical'          => false,
		'labels'                => [
			'name'                       => _x('Types', 'taxonomy general name'),
			'singular_name'              => _x('Type', 'taxonomy singular name'),
			'search_items'               => __('Search Types' ),
			'popular_items'              => __('Popular Types' ),
			'all_items'                  => __('All Types'),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __('Edit Type'),
			'update_item'                => __('Update Type'),
			'add_new_item'               => __('Add New Type'),
			'new_item_name'              => __('New Type Name'),
			'separate_items_with_commas' => __('Separate types with commas'),
			'add_or_remove_items'        => __('Add or remove types'),
			'choose_from_most_used'      => __('Choose from the most used types'),
			'not_found'                  => __('No types found.' ),
			'menu_name'                  => __('Types' ),
		],
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => ['slug' => 'type'],
	]);

});