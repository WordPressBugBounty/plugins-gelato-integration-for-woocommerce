<?php

if (!defined('ABSPATH')) {
    exit;
}

class GelatoShippingApiClient
{
    private $url;
    private $storeDomain;

    public function __construct($url, $storeDomain)
    {
        $this->url = $url;
        $this->storeDomain = $storeDomain;
    }

    public function calculate_gelato_shipping_flat_rates(array $rateRequestDto): array
    {
        $response = wp_remote_post(
            $this->url . GelatoApiClientFactory::API_FLAT_RATE_SHIPPING_URL,
            [
                'timeout' => 60,
                'headers' => $this->buildHeaders(),
                'body' => json_encode($rateRequestDto),
            ]
        );

        if (wp_remote_retrieve_response_code($response) == 200) {
            return json_decode(wp_remote_retrieve_body($response), true);
        }

        return [];
    }

    public function calculate_gelato_shipping_live_rates(array $rateRequestDto): array
    {
        $response = wp_remote_post(
            $this->url . GelatoApiClientFactory::API_LIVE_RATE_SHIPPING_URL,
            [
                'timeout' => 60,
                'headers' => $this->buildHeaders(),
                'body' => json_encode($rateRequestDto),
            ]
        );

        if (wp_remote_retrieve_response_code($response) == 200) {
            return json_decode(wp_remote_retrieve_body($response), true);
        }

        return [];
    }

    private function buildHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'x-wc-webhook-source' => $this->storeDomain,
            'x-gelato-app-handle' => GelatoConfig::APP_HANDLE,
        ];
    }
}
