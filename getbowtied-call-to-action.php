<?php

/**
 * Plugin Name:       GetBowtied Call-To-Action
 * Plugin URI:        https://github.com/getbowtied/getbowtied-call-to-action
 * Description:       Getbowtied call-to-action buttons.
 * Version:           1.1.0
 * Author:            GetBowtied
 * Author URI:        https://getbowtied.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       getbowtied-call-to-action
 * Domain Path:       /languages
 *
 * @link              https://getbowtied.com/
 * @since             1.0.0
 * @package           Getbowtied_Call_To_Action
 */

if ( ! defined( 'WPINC' ) ) { die(); }

if( !function_exists('wp_get_current_user') ) {
    include( ABSPATH . 'wp-includes/pluggable.php' );
}

define( 'GETBOWTIED_CALL_TO_ACTION_VERSION', '1.0.0' );

require_once plugin_dir_path( __FILE__ ) . 'includes/updater/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/getbowtied/getbowtied-call-to-action/master/includes/updater/assets/plugin.json',
	__FILE__,
	'getbowtied-call-to-action'
);

session_start();

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Getbowtied_Call_To_Action
 * @subpackage Getbowtied_Call_To_Action/includes
 * @author     GetBowtied <vanesa@getbowtied.com>
 */
class Getbowtied_Call_To_Action {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Getbowtied_Call_To_Action_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'GETBOWTIED_CALL_TO_ACTION_VERSION' ) ) {
			$this->version = GETBOWTIED_CALL_TO_ACTION_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'getbowtied-call-to-action';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Getbowtied_Call_To_Action_Loader. Orchestrates the hooks of the plugin.
	 * - Getbowtied_Call_To_Action_i18n. Defines internationalization functionality.
	 * - Getbowtied_Call_To_Action_Admin. Defines all hooks for the admin area.
	 * - Getbowtied_Call_To_Action_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-getbowtied-call-to-action-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-getbowtied-call-to-action-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'admin/class-getbowtied-call-to-action-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'public/class-getbowtied-call-to-action-public.php';

		$this->loader = new Getbowtied_Call_To_Action_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Getbowtied_Call_To_Action_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Getbowtied_Call_To_Action_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Getbowtied_Call_To_Action_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Getbowtied_Call_To_Action_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Getbowtied_Call_To_Action_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

$plugin = new Getbowtied_Call_To_Action();
$plugin->run();
