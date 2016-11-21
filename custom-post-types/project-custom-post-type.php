<?php

function dpp_setup_post_type() {
    register_post_type('dpp_project',
        ['labels' => [
                'name' => __('Projects'),
                'singular_name' => __('Project'),
            ],
            'public' => true,
            'has_archive' => false,
            'menu_icon' => 'dashicons-portfolio',
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
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'languages',
                'with_front' => false
            )
        )
    );
	register_taxonomy(
        'dpp_tools',
        'dpp_project',
        array(
            'hierarchical' => false,
            'label' => 'Tools & Technologies',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'tools-technologies',
                'with_front' => false
            )
        )
    );
	register_taxonomy(
        'dpp_platforms',
        'dpp_project',
        array(
            'hierarchical' => false,
            'label' => 'Platforms',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'platform',
                'with_front' => false
            )
        )
    );

    register_taxonomy(
          'dpp_customers',
          'dpp_project',
          array(
              'hierarchical' => false,
              'label' => 'Customer',
              'query_var' => true,
              'rewrite' => array(
                  'slug' => 'platform',
                  'with_front' => false
              )
          )
      );
}
add_action( 'init', 'dpp_setup_post_type_taxonomies');
