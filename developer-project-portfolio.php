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
      register_activation_hook(__FILE__, array($this, 'on_activate_plugin') );
      register_deactivation_hook(__FILE__, array($this, 'on_deactivate_plugin') );
  }

  public function on_activate_plugin() {
      flush_rewrite_rules();
  }

  public function on_deactivate_plugin() {
      flush_rewrite_rules();
  }
}

$developer_project_portfolio_plugin = new DeveloperProjectPortfolio();
