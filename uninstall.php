<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

/**
 * Elimina los datos del plugin
 */

global $wpdb;
$table = $wpdb -> prefix."termmeta";
$meta = 'category-image-id';

$sqlDeleteTermmeta = "DELETE FROM $table WHERE meta_key = $meta";
$wpdb -> query($sqlDeleteTermmeta);
