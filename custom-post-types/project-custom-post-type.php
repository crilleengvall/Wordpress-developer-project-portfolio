<?php

function dpp_setup_post_type() {
    register_post_type('dpp_project',
        ['labels' => [
                'name'               => __( 'Projects' ),
                'singular_name'      => __( 'Project' ),
                'add_new'            => __( 'Add new' ),
                'add_new_item'       => __( 'Add new project' ),
                'edit_item'          => __( 'Edit project' ),
                'new_item'           => __( 'New project' ),
                'all_items'          => __( 'All projects' ),
                'view_item'          => __( 'View project' ),
                'search_items'       => __( 'Search for project' ),
                'not_found'          => __( 'No projects found' ),
                'not_found_in_trash' => __( 'No projects in trash' ),
                'featured_image'        => __( 'Project Image' ),
	              'set_featured_image'    => __( 'Set project image' ),
	              'remove_featured_image' => __( 'Remove project image' ),
	              'use_featured_image'    => __( 'Use as project image' ),
            ],
            'public' => true,
            'has_archive' => false,
            'menu_icon' => 'dashicons-portfolio',
            'supports' => ['thumbnail', 'title', 'editor'],
            'rewrite' => [
                'slug' => 'projects',
            ],
        ]
    );
}

add_action( 'init', 'dpp_setup_post_type');

function dpp_setup_post_type_taxonomies() {
    register_taxonomy(
        'dpp_languages',
        'dpp_project',
        array(
            'hierarchical' => false,
            'label' => 'Programming Languages',
            'query_var' => false,
            'public' => false,
            'show_ui' => true,
        )
    );
	register_taxonomy(
        'dpp_tools',
        'dpp_project',
        array(
            'hierarchical' => false,
            'label' => 'Tools & Technologies',
            'query_var' => false,
            'public' => false,
            'show_ui' => true,
        )
    );
	register_taxonomy(
        'dpp_platforms',
        'dpp_project',
        array(
            'hierarchical' => false,
            'label' => 'Platforms',
            'query_var' => false,
            'public' => false,
            'show_ui' => true,
        )
    );

    register_taxonomy(
          'dpp_customers',
          'dpp_project',
          array(
              'hierarchical' => true,
              'label' => 'Customer',
              'query_var' => false,
              'public' => false,
              'show_ui' => true,
          )
      );
}

add_action( 'init', 'dpp_setup_post_type_taxonomies');
