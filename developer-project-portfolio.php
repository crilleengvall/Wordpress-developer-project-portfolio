<?php
/*
* Plugin Name: Developer project portfolio
* Plugin URI: https://crilleengvall.github.io/Wordpress-developer-project-portfolio/
* Description: Displays a project portfolio for visitors. Set customer, image, description, languages and platform for each project.
* Version: 0.2
* Author: Christian Engvall
* Author URI: http://www.christianengvall.se
* License: GPL3
* License URI: https://www.gnu.org/licenses/gpl-3.0.html
* Text Domain: developer-project-portfolio
* Domain Path: /languages

Developer project portfolio is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Developer project portfolio is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Developer project portfolio.  If not, see <https://www.gnu.org/licenses/gpl-3.0.html>.
*/
require_once( 'custom-post-types/project-custom-post-type.php' );

class DeveloperProjectPortfolio {

  public function __construct() {
      $this->register_hooks();
  }

  private function register_hooks() {
      $this->add_project_links_metabox();
      $this->enqueue_css();
      register_activation_hook(__FILE__, array('DeveloperProjectPortfolio', 'on_activate_plugin') );
      register_deactivation_hook( __FILE__, array('DeveloperProjectPortfolio', 'on_deactivate_plugin') );
      add_filter( 'template_include', array($this, 'include_single_template'), 1 );
      add_shortcode( 'dpp_projects', array($this, 'display_projects') );
      add_action( 'admin_init', array($this, 'setup_tiny_mce_plugin') );
      add_action( 'plugins_loaded', array($this, 'load_textdomain') );
  }

  static function on_activate_plugin() {
    dpp_setup_post_type();
    flush_rewrite_rules();
  }

  static function on_deactivate_plugin() {
      flush_rewrite_rules();
  }

  public function load_textdomain() {
    load_plugin_textdomain( 'developer-project-portfolio', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
  }

  private function enqueue_css() {
    add_action( 'admin_enqueue_scripts', array($this, 'add_admin_css') );
    add_action( 'wp_enqueue_scripts', array($this, 'add_public_css') );
  }

  private function add_project_links_metabox() {
      require_once( 'custom-post-types/project-links-metabox.php' );
  }

  public function add_admin_css() {
      wp_register_style('developer_project_portfolio_admin_css', plugins_url('/css/admin.css', __FILE__));
      wp_enqueue_style( 'developer_project_portfolio_admin_css' );
  }

  public function add_public_css() {
    wp_register_style('developer-project-portfolio-css', plugins_url('/css/developer-project-portfolio.css', __FILE__));
    wp_enqueue_style( 'developer-project-portfolio-css' );
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  }

  public function include_single_template($template_path) {
      if ( get_post_type() == 'dpp_project' && is_single() ) {
          if ( $theme_file = locate_template( array ( 'single-dpp_project.php' ) ) ) {
              $template_path = $theme_file;
          } else {
              $template_path = plugin_dir_path( __FILE__ ) . 'templates/single-dpp_project.php';
          }
      }
      return $template_path;
  }

  public function display_projects($attributes) {
    $projects = $this->get_project_by_customer_attribute($attributes);
    $template = dirname(__FILE__) . '/templates/projects-listing.php';
    if ( $list_theme_file = locate_template( array ( 'projects-listing.php' ) ) ) {
      $template = $$list_theme_file;
    }
    ob_start();
    set_query_var( 'projects', $projects );
    include($template);
    return ob_get_clean();
  }

  private function get_project_by_customer_attribute($attributes) {
    $posts_array = get_posts(array(
        'posts_per_page' => -1,
        'post_type' => 'dpp_project',
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'dpp_customers',
                'field' => 'term_id',
                'terms' => $attributes['customer-id'],
            ))));
            return $posts_array;
  }

  public function setup_tiny_mce_plugin() {
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
      add_filter( 'mce_buttons', array( $this, 'register_tinymce_button' ) );
      add_filter( 'mce_external_plugins', array( $this, 'add_tinymce_button' ) );
      add_filter( 'tiny_mce_before_init', array( $this, 'add_tinymce_project_categories' ) );
    }
  }

  public function register_tinymce_button( $buttons ) {
    array_push( $buttons, "button_dpp_project" );
    return $buttons;
  }

  function add_tinymce_button( $plugin_array ) {
    $plugin_array['dpp_project_script'] = plugins_url( '/editor/editor_plugin.js', __FILE__ ) ;
    return $plugin_array;
  }

  public function add_tinymce_project_categories( $settings ) {
    $terms = get_terms( array(
      'taxonomy' => 'dpp_customers',
      'hide_empty' => true,
      'orderby' => 'name',
      'order' => 'ASC'
    ));
    $settings_terms =  array();
    foreach ($terms as $key => $term) {
      array_push($settings_terms, $term->term_id . ':' . $term->name);
    }
    $settings['dpp_customers'] = implode(",", $settings_terms);
    $settings['dpp_menu_name'] = __('Insert projects by customer/category', 'developer-project-portfolio');
    return $settings;
  }

}

$developer_project_portfolio_plugin = new DeveloperProjectPortfolio();
