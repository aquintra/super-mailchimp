<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://anderskristo.me
 * @since             1.0.0
 * @package           Super_Mailchimp
 *
 * @wordpress-plugin
 * Plugin Name:       Super Mailchimp Signup
 * Plugin URI:        https://anderskristo.me/plugins/super-mailchimp-signup
 * Description:       This plugin uses Mailchimp to display a Signup Form
 * Version:           1.2.6
 * Author:            Anders Kristoffersson
 * Author URI:        https://anderskristo.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       super-mailchimp
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
define( 'SUPER_MAILCHIMP_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-super-mailchimp-activator.php
 */
function activate_super_mailchimp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-super-mailchimp-activator.php';
	Super_Mailchimp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-super-mailchimp-deactivator.php
 */
function deactivate_super_mailchimp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-super-mailchimp-deactivator.php';
	Super_Mailchimp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_super_mailchimp' );
register_deactivation_hook( __FILE__, 'deactivate_super_mailchimp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-super-mailchimp.php';

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/aquintra/super-mailchimp',
	__FILE__,
	'super-mailchimp'
);

//Optional: If you're using a private repository, specify the access token like this:
$myUpdateChecker->setAuthentication('592c6838e9a2be78af3b3f7cbe1858de87d58444');
//Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_super_mailchimp() {

	$plugin = new Super_Mailchimp();
    $plugin->run();
    
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-super-mailchimp-api.php';

}
run_super_mailchimp();
