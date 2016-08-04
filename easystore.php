<?php
/**
 * Plugin Name: Easystore
 * Plugin URI: http://www.londomloto/wordpress/easystore
 * Description: An easy ecommerce plugin that fit your requirements.
 * Version: 1.0.0
 * Author: Londomloto
 * Author URI: http://www.londomloto.com
 *
 * Text Domain: easystore
 * 
 * @package Easystore
 * @author londomloto <roso.sasongko@gmail.com>
 */

defined('ABSPATH') or exit();

if ( ! class_exists( 'Easystore' )) : 

final class Easystore {

    protected static $instance = NULL;

    private function define( $const, $value ) {
        if ( ! defined( $const )) {
            define( $const, $value );
        }
    }

    private function defines() {
        $this->define( 'ES_PLUGIN_FILE', __FILE__ );
    }

    private function includes() {
        if (is_admin()) {
            include_once( 'includes/admin/es-admin-class.php' );
        }
    }

    private function hooks() {
        add_action( 'init', array( $this, 'initialize' ) );
    }

    public function __construct() {
        $this->defines();
        $this->includes();
        $this->hooks();
    }

    public function initialize() {
        // TODO: setup localization
        $this->load_textdomain();
        esc_html_e('Hello World', 'easystore');
    }

    public function load_textdomain() {
        $locale = apply_filters( 'plugin_locale', get_locale(), 'easystore' );
        load_textdomain( 'easystore', WP_LANG_DIR.'/easystore/'.$locale.'.mo' );
        load_plugin_textdomain( 'easystore', FALSE, plugin_basename( dirname( __FILE__ ) ).'i18n/languages' );
    }
    
    public static function instance() {
        if ( ! self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}

endif;

$ES = new Easystore();