<?php
/*
Plugin Name: WordPress and Angular JS
Plugin URI: https://storehubs.com
Description: This plugin is used to teach how to add angular js applications to wordpress with short code
License:GPL3
Tested up to: 1.0.0
Version:1.0.0
Author: Samuel Antwi
Author URI: http://localhost
*/

/*function activation_angularwp(){

}

function deactivation_angularwp(){

}

register_activation_hook(__FILE__,"activation_angularwp");
register_deactivation_hook(__FILE__,"deactivation_angularwp");*/

if(!is_admin()){

     function angularwp_start(){

         require_once plugin_dir_path(__FILE__)."core/angularwp.php";
         $ngwp = new Angularwp();

     }

     angularwp_start();
}
?>