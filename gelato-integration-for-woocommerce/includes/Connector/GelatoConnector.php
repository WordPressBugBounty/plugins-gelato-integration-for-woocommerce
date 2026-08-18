<?php

if (!defined('ABSPATH')) {
    exit;
}

class GelatoConnector
{
    public function getConnectUrl(): string
    {
        $params = [
            'domain' => trailingslashit(get_home_url()),
            'appHandle' => GelatoConfig::APP_HANDLE,
        ];

        return GelatoConfig::CONNECT_BASE_URL
            . '/stores/woocommerce/connect?'
            . http_build_query($params);
    }

    public function getDashboardUrl(): string
    {
        return GelatoConfig::DASHBOARD_URL;
    }

    public function isConnected(): bool
    {
        global $wpdb;

        $key = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}woocommerce_api_keys WHERE description LIKE '%%%s%' ORDER BY last_access LIMIT 1",
            $wpdb->esc_like(GelatoConfig::API_KEY_PREFIX)
        ));

        return !empty($key) && $key->permissions === 'read_write';
    }

    public function resetConnection()
    {
        global $wpdb;

        $wpdb->query($wpdb->prepare(
            "DELETE FROM {$wpdb->prefix}woocommerce_api_keys WHERE description LIKE '%%%s%'",
            $wpdb->esc_like(GelatoConfig::API_KEY_PREFIX)
        ));

        $webhooks = $wpdb->get_results($wpdb->prepare(
            "SELECT webhook_id FROM {$wpdb->prefix}wc_webhooks WHERE name LIKE '%%%s%'",
            $wpdb->esc_like(GelatoConfig::WEBHOOK_PREFIX)
        ));

        foreach ($webhooks as $webhookResult) {
            $webhook = wc_get_webhook($webhookResult->webhook_id);
            $webhook->delete(true);
        }

        WC_Cache_Helper::invalidate_cache_group('webhooks');
    }
}
