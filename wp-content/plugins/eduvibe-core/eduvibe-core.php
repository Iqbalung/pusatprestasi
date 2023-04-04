<?php
/**
 * Plugin Name: EduVibe Core
 * Description: This plugin contains all necessary custom post types, functionalities, widgets and custom Elementor widget for EduVibe Theme.
 * Version:     1.0.0
 * Author:      DevsVibe
 * Author URI:  https://devsvibe.com/
 * Text Domain: eduvibe-core
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( ! defined( 'EDUVIBE_PLUGIN_DIR' ) ) define( 'EDUVIBE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
if ( ! defined( 'EDUVIBE_CORE_URL' ) ) define( 'EDUVIBE_CORE_URL', plugins_url( '/', __FILE__ ) );
if ( ! defined( 'EDUVIBE_ASSETS_URL' ) ) define( 'EDUVIBE_ASSETS_URL', EDUVIBE_CORE_URL . 'assets/' );
if ( ! defined( 'EDUVIBE_CORE_VERSION' ) ) define( 'EDUVIBE_CORE_VERSION', '1.0.0' );

/**
 * Main eduVibe Core Class
 *
 * The init class that runs the eduVibe Core plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.0.0
 */
final class EduVibe_Core {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.1.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'eduvibe-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) :
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		endif;

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) :
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		endif;

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) :
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		endif;

 		// Custom Elementor Widegt Category
		add_action( 'elementor/init', array( $this, 'eduvibe_custom_elementor_category' ) );

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plugin.php' );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) :
			unset( $_GET['activate'] );
		endif;

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'eduvibe-core' ),
			'<strong>' . esc_html__( 'EduVibe Core', 'eduvibe-core' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'eduvibe-core' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function eduvibe_custom_elementor_category(){
        \Elementor\Plugin::instance()->elements_manager->add_category(
            'eduvibe_elementor_widgets',
            array(
                'title' => esc_html__( 'EduVibe', 'eduvibe-core' ),
            ),
            1
        );
        \Elementor\Plugin::instance()->elements_manager->add_category(
            'eduvibe_hf_elementor_widgets',
            array(
                'title' => esc_html__( 'EduVibe Header Footer Elements', 'eduvibe-core' ),
            ),
            1
        );
    }

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) :
			unset( $_GET['activate'] );
		endif;

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'eduvibe-core' ),
			'<strong>' . esc_html__( 'EduVibe Core', 'eduvibe-core' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'eduvibe-core' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) :
			unset( $_GET['activate'] );
		endif;

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'eduvibe-core' ),
			'<strong>' . esc_html__( 'EduVibe Core', 'eduvibe-core' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'eduvibe-core' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

// Instantiate EduVibe_Core.
new EduVibe_Core();