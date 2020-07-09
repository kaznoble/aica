<?php
class Angularwp{

 public function __construct(){

     $this->dependancies();
     $this->define_angularwp_hooks();

 }

 public function dependancies(){

    require_once plugin_dir_path(__FILE__)."/html.php";
    $this->anhtml = new AddAngularhtml();
 }

 public function define_angularwp_hooks(){
    add_action("wp_enqueue_angularjs_scripts", $this->active_plugin_scripts());
    add_shortcode("ngwp", array($this->anhtml,"add_angularwp_html"));
 }

 public function active_plugin_scripts(){
    /*wp_enqueue_style( "angularwp_css", plugins_url()."/aicaangular/css/style.css" );*/
    wp_enqueue_script( "angularwp_js", plugins_url()."/aicaangular/js/angular.min.js", array(), null, true);
    wp_enqueue_script( "angularwp_route_js", plugins_url()."/aicaangular/js/angular-route.min.js", array(), null, true);
	wp_enqueue_script( "angularwp_sanitize", "https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.7.8/angular-sanitize.min.js", array(), null, true);
    wp_enqueue_script( "angularwp_app_js", plugins_url()."/aicaangular/js/app.js", array(), null, true);
    wp_enqueue_script( "angularwp_startCtrl_js", plugins_url()."/aicaangular/js/controller/startCtrl.js", array(), null, true);
 }
}
?>