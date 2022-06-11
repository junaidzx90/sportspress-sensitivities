<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Sensitivities
 * @subpackage Sensitivities/includes
 */

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
 * @package    Sensitivities
 * @subpackage Sensitivities/includes
 * @author     Md Junayed <admin@easeare.com>
 */
class Sensitivities {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Sensitivity_Loader    $loader    Maintains and registers all hooks for the plugin.
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
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'SENSITIVITY_VERSION' ) ) {
			$this->version = SENSITIVITY_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'sensitivities';

		$this->load_dependencies();
		$this->define_sensitivities_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Sensitivity_Loader. Orchestrates the hooks of the plugin.
	 * - Sensitivity_i18n. Defines internationalization functionality.
	 * - Sensitivity_Admin. Defines all hooks for the admin area.
	 * - Sensitivity_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sensitivity-loader.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'view/class-sensitivity-admin.php';
	
		$this->loader = new Sensitivity_Loader();

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_sensitivities_hooks() {

		$plugin_admin = new Sensitivity_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'admin_enqueue_scripts', 99 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_admin, 'public_enqueue_scripts', 99 );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'sensitivity_menupage', 99 );
		$this->loader->add_filter( 'sportspress_after_player_template', $plugin_admin, 'sensitivity_player_template');

		// Woocommerce menu link
		$this->loader->add_filter ( 'woocommerce_account_menu_items', $plugin_admin, 'junu_one_more_link' );
		$this->loader->add_filter( 'woocommerce_get_endpoint_url', $plugin_admin, 'junu_hook_endpoint', 10, 4 );
		$this->loader->add_action( 'init', $plugin_admin, 'junu_add_endpoint' );
		$this->loader->add_action( 'woocommerce_account_sensitivity_endpoint', $plugin_admin, 'junu_my_account_endpoint_content' );
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
	 * @return    Sensitivity_Loader    Orchestrates the hooks of the plugin.
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
