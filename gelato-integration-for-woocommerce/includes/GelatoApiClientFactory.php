<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class GelatoApiClientFactory
 */
class GelatoApiClientFactory
{
    const API_HOST = 'https://shipping-rates.ecommerce.ie.live.gelato.tech';
    const API_STATUS_URL = '/v1/woocommerce/connection-health';
    const API_FLAT_RATE_SHIPPING_URL = '/v1/woocommerce/shipping/flat-rates';
    const API_LIVE_RATE_SHIPPING_URL = '/v1/woocommerce/shipping/live-rates';

    public static function create(): GelatoShippingApiClient
    {
        return new GelatoShippingApiClient(self::API_HOST, get_option('home'));
    }
}
