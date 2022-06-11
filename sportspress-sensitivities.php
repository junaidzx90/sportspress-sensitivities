<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.fiverr.com/junaidzx90
 * @since             1.0.0
 * @package           Sensitivities
 *
 * @wordpress-plugin
 * Plugin Name:       Sensitivities
 * Plugin URI:        https://www.fiverr.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Md Junayed
 * Author URI:        https://www.fiverr.com/junaidzx90
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sensitivities
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SENSITIVITY_VERSION', '1.0.0' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sensitivity.php';

add_action( "wp_head", function(){
	if(is_admin_bar_showing()){
		?>
		<style>
			.fancybox-container {
				top: 32px !important;
			}
		</style>
		<?php
	}
} );
	
function update_user_fields($userid){
	$fields = get_option("sensitivities_fields");
    if(!is_array($fields)){
        $fields = [];
    }

    $fields_1 = [];
    $fields_2 = [];
    $fields_3 = [];
    if(array_key_exists(0, $fields)){
        $fields_1 = $fields[0];
    }
    if(array_key_exists(1, $fields)){
        $fields_2 = $fields[1];
    }
    if(array_key_exists(2, $fields)){
        $fields_3 = $fields[2];
    }
	
    $data1 = get_user_meta($userid, 'sensitivity_one');
    if(is_array($data1) && array_key_exists(0, $data1)){
		$data1 = $data1[0];
		$data1Arr = [];
		if(sizeof($fields_1) > 0){
			foreach($data1 as $i1 => $val1){
				if(isset($fields_1[$i1])){
					$data1Arr[$i1] = $val1;
				}
			}
		}

	  	update_user_meta($userid, 'sensitivity_one', $data1Arr);
	}

    $data2 = get_user_meta($userid, 'sensitivity_two');
    if(is_array($data2) && array_key_exists(0, $data2)){
		$data2 = $data2[0];
		$data2Arr = [];
		if(sizeof($fields_2) > 0){
			foreach($data2 as $i2 => $val2){
				if(isset($fields_2[$i2])){
					$data2Arr[$i2] = $val2;
				}
			}
		}

    	update_user_meta($userid, 'sensitivity_two', $data2Arr);
	}

    $data3 = get_user_meta($userid, 'sensitivity_three');
    if(is_array($data3) && array_key_exists(0, $data3)){
		$data3 = $data3[0];
		$data3Arr = [];
		if(sizeof($fields_3) > 0){
			foreach($data3 as $i3 => $val3){
				if(isset($fields_3[$i3])){
					$data3Arr[$i3] = $val3;
				}
			}
		}

    	update_user_meta($userid, 'sensitivity_three', $data3Arr);
	}
}
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sensitivities() {

	$plugin = new Sensitivities();
	$plugin->run();

}
run_sensitivities();
