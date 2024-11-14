<?php

/*
 * This is the Freemius license manager for WP Full Pay
 */

if ( ! function_exists( 'wpfs_fs' ) ) {
    // Create a helper function for easy SDK access.
    function wpfs_fs() {
        global $wpfs_fs;

        if ( ! isset( $wpfs_fs ) ) {
            if ( ! defined( 'WP_FS__PRODUCT_2752_MULTISITE' ) ) {
                define( 'WP_FS__PRODUCT_2752_MULTISITE', true );
            }

            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $wpfs_fs = fs_dynamic_init( array(
                'id'                  => '2752',
                'slug'                => 'wp-full-stripe-free',
                'premium_slug'        => 'wp-full-stripe',
                'type'                => 'plugin',
                'public_key'          => 'pk_7c2ed6cc45348be58a5c4ed3b0a84',
                'is_premium'          => false,
                'has_premium_version' => false,
                'has_addons'          => true,
                'has_paid_plans'      => true,
                'menu'                => array(
                    'slug'           => 'wpfs-transactions',
                    'contact'        => false,
                    'support'        => false,
                ),
            ) );
        }
        return $wpfs_fs;
    }

    // Init Freemius.
    wpfs_fs();
    // Signal that SDK was initiated.
    do_action( 'wpfs_fs_loaded' );

    function wpfs_fs_settings_url() {
        return admin_url( 'admin.php?page=wpfs-settings-stripe' );
    }

    wpfs_fs()->add_filter('connect_url', 'wpfs_fs_settings_url');
    wpfs_fs()->add_filter('after_skip_url', 'wpfs_fs_settings_url');
    wpfs_fs()->add_filter('after_connect_url', 'wpfs_fs_settings_url');
    wpfs_fs()->add_filter('after_pending_connect_url', 'wpfs_fs_settings_url');
    wpfs_fs()->add_filter('show_deactivation_subscription_cancellation', '__return_false');
}


class MM_WPFS_LicenseManager extends MM_WPFS_LicenseManager_Root {
    public static $instance;

    private function __construct() {
    }

    public static function getInstance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new MM_WPFS_LicenseManager();
        }

        return self::$instance;
    }

    public function initPluginUpdater() {
    }

    public function getLicenseOptionDefaults() {
        //-- No options used by Freemius
        return array();
    }

    public function setLicenseOptionDefaultsIfEmpty(& $options) {
        //-- No options used by Freemius
        return;
    }

    public function activateLicenseIfNeeded() {
        //-- No need to activate license in Freemius
    }
}
