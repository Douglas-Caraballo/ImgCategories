<?php
require_once(WPIC_RUTA."admin/controler/AddImg.php");
class Init extends AddImg{
    public function InicialPlugin(){
        add_action('category_add_form_fields', array($this,'add_category_img'), 10, 2);
        add_action('created_category', array($this,'save_category_img'), 10, 2);
        add_action('category_edit_form_fields', array($this,'update_category_img'), 10, 2);
        add_action('edited_category', array($this,'updated_category_img'),10 ,2);
        add_action('admin_enqueue_scripts', array($this,'load_media'));
        add_action('admin_footer', array($this, 'add_scrip'));
    }
}