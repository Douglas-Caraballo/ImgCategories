<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

/*global $wpdb;
$tableName = $wpdb->prefix."termmeta";
$metaKey = "category-image-id";

$wpdb->query("DELETE FROM $tableName WHERE meta_key = $metaKey");

$query = "DELETE * FROM $tableName WHERE meta_key= $metaKey";

$wpdb -> query($query);*/

wp_cache_flush();