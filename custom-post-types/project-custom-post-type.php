<?php

function dpp_setup_post_type() {
    register_post_type('dpp_project',
        ['labels' => [
                'name'               => __( 'Projects', 'developer-project-portfolio' ),
                'singular_name'      => __( 'Project', 'developer-project-portfolio' ),
                'add_new'            => __( 'Add new', 'developer-project-portfolio' ),
                'add_new_item'       => __( 'Add new project', 'developer-project-portfolio' ),
                'edit_item'          => __( 'Edit project', 'developer-project-portfolio' ),
                'new_item'           => __( 'New project', 'developer-project-portfolio' ),
                'all_items'          => __( 'All projects', 'developer-project-portfolio' ),
                'view_item'          => __( 'View project', 'developer-project-portfolio' ),
                'search_items'       => __( 'Search for project', 'developer-project-portfolio' ),
                'not_found'          => __( 'No projects found', 'developer-project-portfolio' ),
                'not_found_in_trash' => __( 'No projects in trash', 'developer-project-portfolio' ),
                'featured_image'        => __( 'Project Image', 'developer-project-portfolio' ),
	              'set_featured_image'    => __( 'Set project image', 'developer-project-portfolio' ),
	              'remove_featured_image' => __( 'Remove project image', 'developer-project-portfolio' ),
	              'use_featured_image'    => __( 'Use as project image', 'developer-project-portfolio' ),
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
        'dpp_customers',
        'dpp_project',
        array(
            'hierarchical' => true,
            'label' => __( 'Customer/Category', 'developer-project-portfolio' ),
            'query_var' => false,
            'public' => false,
            'show_ui' => true,
        )
    );

    register_taxonomy(
        'dpp_languages',
        'dpp_project',
        array(
            'hierarchical' => false,
            'label' => __( 'Programming Languages', 'developer-project-portfolio' ),
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
            'label' => __( 'Tools & Technologies', 'developer-project-portfolio' ),
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
            'label' => __( 'Platforms', 'developer-project-portfolio' ),
            'query_var' => false,
            'public' => false,
            'show_ui' => true,
        )
    );
}

add_action( 'init', 'dpp_setup_post_type_taxonomies');
