<?php

function LoadCustomScrip($hook){
    wp_register_style( 'imgcategories-style', plugin_dir_url(__FILE__).'admin/css/imgcategories.css');
    wp_enqueue_style('imgcategories-style');
}

add_action('admin_enqueue_scripts', 'LoadCustomScrip');