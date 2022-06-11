<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Sensitivities
 * @subpackage Sensitivities/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sensitivities
 * @subpackage Sensitivities/admin
 * @author     Md sensitivities <admin@easeare.com>
 */
class Sensitivity_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version; 

		add_shortcode( 'sensitivities', [$this, "sensitivities_views"] );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sensitivity-admin.css', array(), $this->version, 'all' );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sensitivity-admin.js', array(), $this->version, true );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function public_enqueue_scripts() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sensitivity-public.css', array(), $this->version, 'all' );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sensitivity-public.js', array(), $this->version, true );
	}


	function sensitivity_menupage(){
		add_menu_page( "Sensitivity", "Sensitivity", "manage_options", "sensitivity", [$this, "sensitivity_menupage_view"], "dashicons-align-full-width", 45 );
	}

	function sensitivity_menupage_view(){
		require_once plugin_dir_path( __FILE__ )."partials/admin-sensitivity.php";
	}

	function sensitivity_player_template($data){
		$sensitivity = array(
			'sensitivity' => array(
				'title' => __( 'Sensitivity', 'sportspress' ),
				'option' => 'sportspress_player_show_sensitivity',
				'action' => [$this,'sportspress_player_show_sensitivity'],
				'default' => 'yes',
			),
		);
		return array_merge($data, $sensitivity);
	}

	function sportspress_player_show_sensitivity(){
		require_once plugin_dir_path( __FILE__ )."partials/sensitivities-view.php";
	}

	function sensitivities_views(){
		ob_start();
		require_once plugin_dir_path( __FILE__ )."partials/sensitivities-view.php";
		return ob_get_clean();
	}

	// Woocommerce menuitem
	function junu_one_more_link( $menu_links ){
		// we will hook "sensitivity" later
		$new = array( 'sensitivity' => 'Sensitivities' );
	
		// array_slice() is good when you want to add an element between the other ones
		$menu_links = array_slice( $menu_links, 0, 1, true ) 
		+ $new 
		+ array_slice( $menu_links, 1, NULL, true );

		return $menu_links;
	}

	function junu_hook_endpoint( $url, $endpoint, $value, $permalink ){
		if( $endpoint === 'sensitivity' ) {
	 
			// ok, here is the place for your custom URL, it could be external
			$url = site_url().'/my-account/sensitivity';
	 
		}
		return $url;
	}

	function junu_add_endpoint() {
		add_rewrite_endpoint( 'sensitivity', EP_PAGES );
	}

	function junu_my_account_endpoint_content() {
		require_once plugin_dir_path( __FILE__ )."partials/user-sensitivity.php";
	}
}