<?php

function LoadCustomScrip($hook){
    wp_register_style( 'imgcategories-style', plugin_dir_url(__FILE__).'admin/css/imgcategories.css');
    wp_enqueue_style('imgcategories-style');
}
function LoadCustomScritsFront(){
    wp_register_style('imgcategories-style-public',plugin_dir_url(__FILE__) . 'public/css/styles-widgets.css', false);
    wp_enqueue_style('imgcategories-style-public');
}
add_action('admin_enqueue_scripts', 'LoadCustomScrip');
add_action('wp_enqueue_scripts', 'LoadCustomScritsFront');