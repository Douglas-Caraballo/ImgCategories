<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

global $wpdb;
$tableName = $wpdb->prefix."termmeta";
$metaKey = "category-image-id";

$termMetaRecords = $wpdb-> get_results($wpdb->prepare(
    "SELECT term_id FROM $tableName WHERE meta_key = %s",$metaKey)
);
foreach($termMetaRecords as $termMeta){
    delete_term_meta( $termMeta->term_id, $metaKey);
}

add_shortcode( 'imgcategories', '__return_false');

wp_cache_flush();