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
