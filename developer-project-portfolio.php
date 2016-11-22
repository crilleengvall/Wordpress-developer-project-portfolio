<?php
/*
* Plugin Name: Developer project portfolio
* Plugin URI: http://www.christianengvall.se
* Description: Displays a project portfolio for visitors. Set customer, image, description, languages and platform for each project.
* Version: 0.1
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

class DeveloperProjectPortfolio {

  public function __construct() {
      $this->register_hooks();
  }

  private function register_hooks() {
      $this->add_custom_post_type();
      $this->add_project_links_metabox();
      $this->enqueue_css();
      register_activation_hook(__FILE__, array($this, 'on_activate_plugin') );
      register_deactivation_hook( __FILE__, array($this, 'on_deactivate_plugin') );
      add_filter( 'template_include', array($this, 'include_single_template'), 1 );
  }

  public function on_activate_plugin() {
      flush_rewrite_rules();
  }

  public function on_deactivate_plugin() {
      flush_rewrite_rules();
  }

  private function enqueue_css() {
    add_action( 'admin_enqueue_scripts', array($this, 'add_admin_css') );
    add_action( 'wp_enqueue_scripts', array($this, 'add_public_css') );
  }

  private function add_custom_post_type() {
      require_once( 'custom-post-types/project-custom-post-type.php' );
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
}

$developer_project_portfolio_plugin = new DeveloperProjectPortfolio();
