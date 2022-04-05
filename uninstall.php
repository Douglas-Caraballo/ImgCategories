<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

global $wpdb;
$tableName = $wpdb->prefix."termmeta";
$metaKey = "category-image-id";

$termMetaRecords = $wpdb-> get_results(
    "SELECT term_id FROM $tableName WHERE meta_key = $metaKey",ARRAY_A
);
foreach($termMetaRecords as $termMeta){
    delete_term_meta( $termMeta->term_id, $metaKey);
}
/*
$wpdb->query("DELETE FROM $tableName WHERE meta_key = $metaKey");

$query = "DELETE * FROM $tableName WHERE meta_key= $metaKey";

$wpdb -> query($query);*/

wp_cache_flush();