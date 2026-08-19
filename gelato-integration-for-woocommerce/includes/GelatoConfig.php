<?php

if (!defined('ABSPATH')) {
    exit;
}

class GelatoConfig
{
    const API_KEY_PREFIX = 'Gelato';
    const WEBHOOK_PREFIX = 'Gelato';
    const APP_HANDLE = 'gelato';
    const TEXT_DOMAIN = 'gelato-integration-for-woocommerce';
    const MENU_TITLE = 'Gelato';
    const MENU_SLUG = 'gelato-main-menu';
    const PLUGIN_SLUG = 'gelato-integration-for-woocommerce/gelato-integration-for-woocommerce.php';
    const SHIPPING_METHOD_ID = 'gelato_shipping';

    const CONNECT_BASE_URL = 'https://dashboard.gelato.com';
    const DASHBOARD_URL = 'https://dashboard.gelato.com';

    const RESET_ACTION = 'gelato_reset_connection';
    const REST_RESET_ROUTE = 'gelato_reset';
}
