<?php
/*
    Plugin Name: Img Categories
    Plugin URI:
    Description: Plugin con la finalidad de poder agregar imagenes a las categorias del wordpress
    Version: 1.0
    Author: Douglas Caraballo
    Author URI: https://github.com/Douglas-Caraballo
    License:
*/

defined('ABSPATH') or die("Bye bye");

//Ruta principal del plugin
define('WPIC_RUTA', plugin_dir_path(__FILE__));

//activacion del plugin
require_once(WPIC_RUTA.'admin/controler/init.php');
require_once('functions.php');
require_once(WPIC_RUTA.'includes/shortcodes.php');
require_once(WPIC_RUTA.'includes/widgets/widget-category-img.php');

$imageCategory = new Init();
$imageCategory -> InicialPlugin();