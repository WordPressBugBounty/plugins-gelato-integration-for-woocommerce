<?php

/**
 * Plugin Name: Gelato Integration for WooCommerce
 * Plugin URI: https://
 * Description: This plugin helps to connect your WooCommerce store with Gelato .
 * Version: 1.3.1
 * Author: Gelato
 * Author URI: https://gelato.com
 * License: GPLv2 or later
 * Text Domain: gelato-integration-for-woocommerce
 */

define('GELATO_VERSION', '1.3.1');
define('GELATO_MINIMUM_WP_VERSION', '4.0');

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

if (!defined('GELATO_PLUGIN_DIR')) {
    define('GELATO_PLUGIN_DIR', plugin_dir_path(__FILE__));
}

class GelatoPlugin
{
    public function __construct()
    {
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function init()
    {
        if (!class_exists('WC_Integration')) {
            return;
        }

        require_once 'includes/GelatoMain.php';
        require_once 'includes/Pages/GelatoPageFactory.php';
        require_once 'includes/Pages/GelatoPage.php';
        require_once 'includes/Pages/GelatoMainPage.php';
        require_once 'includes/Pages/GelatoStatusPage.php';
        require_once 'includes/StatusChecker/GelatoStatusChecker.php';
        require_once 'includes/GelatoApiClientFactory.php';
        require_once 'includes/GelatoShipping.php';
        require_once 'includes/GelatoShippingApiClient.php';
        require_once 'includes/Connector/GelatoConnector.php';

        GelatoMain::init();
        GelatoShipping::init();
    }

    public static function get_asset_path()
    {
        return trailingslashit(plugin_dir_url(__FILE__)) . 'assets/';
    }
}

new GelatoPlugin();
