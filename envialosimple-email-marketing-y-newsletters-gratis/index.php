<?php
    /*
        Plugin Name: EnvíaloSimple: Email Marketing y Newsletters
        Plugin URI: https://envialosimple.com/wordpress-newsletter-plugin
        Description: El plugin de EnvialoSimple te permitirá crear y enviar Newsletters de calidad profesional, en minutos y directamente desde tu Wordpress.
        Version: 2.4.3
        Author: EnvialoSimple
        Author URI: https://envialosimple.com
        License: GPLv2 or later
        Language: es_AR
        Text Domain: envialosimple
        Domain Path: /lang
    */
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    define( 'ES_PLUGIN_URL_BASE', plugins_url('', __FILE__ ) );

    include_once(dirname(__FILE__).'/functions/index.php');
    include_once(dirname(__FILE__).'/lang/index.php');
    include_once(dirname(__FILE__).'/api/index.php');
    include_once(dirname(__FILE__).'/assets.php');
    include_once(dirname(__FILE__).'/pages/index.php');
    include_once(dirname(__FILE__).'/hooks/index.php');
    include_once(dirname(__FILE__).'/menu.php');
    
    function load_my_plugin_textdomain() {
        load_plugin_textdomain( 'envialosimple', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
    }
    add_action( 'plugins_loaded', 'load_my_plugin_textdomain' );
?>