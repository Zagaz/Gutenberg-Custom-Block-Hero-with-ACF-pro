<?php
//You shall not pass!
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Check if ACF Pro is installed and active
add_action('admin_notices', function() {
	include_once(ABSPATH . 'wp-admin/includes/plugin.php');
	$acf_plugin = 'advanced-custom-fields-pro/acf.php';
	if (!is_plugin_active($acf_plugin)) {
		echo '<div class="notice notice-error is-dismissible"><p><strong>ACF Pro is required:</strong> Please install and activate the Advanced Custom Fields Pro plugin for the Hero Block to work.</p></div>';
	}
});


