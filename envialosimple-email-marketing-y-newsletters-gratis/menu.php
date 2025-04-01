<?php
// Hook the 'admin_menu' action hook, run the function named 'mfp_Add_My_Admin_Link()'
add_action( 'admin_menu', 'es_add_item_menu' );

// Add a new top level menu link to the ACP
function es_add_item_menu() {
    global $lang;

    add_menu_page(
        __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis"), // Title of the page
        __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis"), // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'es-plugin',
        'es_plugin_page_home',
        plugin_dir_url( __FILE__ ).'assets/img/logo.svg'
    );

    add_submenu_page('es-plugin', __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Bienvenido","envialosimple-email-marketing-y-newsletters-gratis"), __("Bienvenido","envialosimple-email-marketing-y-newsletters-gratis"), 'manage_options','es-plugin', 'es_plugin_page_home');
    add_submenu_page('es-plugin', __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Configuración","envialosimple-email-marketing-y-newsletters-gratis"), __("Configuración","envialosimple-email-marketing-y-newsletters-gratis"), 'manage_options','es-plugin-config', 'es_plugin_page_config');
    
    $apiKey = get_option('es_config_apikey');

    if(!empty($apiKey)) {
        //campaigns
        add_submenu_page('es-plugin', __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Campañas","envialosimple-email-marketing-y-newsletters-gratis"), __("Campañas","envialosimple-email-marketing-y-newsletters-gratis"), 'manage_options','es-plugin-campaigns', 'es_plugin_page_campaigns');
        add_submenu_page('es-plugin-campaigns', __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Campañas","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Crear","envialosimple-email-marketing-y-newsletters-gratis"), __("Crear","envialosimple-email-marketing-y-newsletters-gratis"), 'manage_options','es-plugin-campaigns-create', 'es_plugin_page_campaigns_create');
        add_submenu_page('es-plugin-campaigns', __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Campañas","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Editar","envialosimple-email-marketing-y-newsletters-gratis"), __("Editar","envialosimple-email-marketing-y-newsletters-gratis"), 'manage_options','es-plugin-campaigns-edit', 'es_plugin_page_campaigns_edit');
        
        //mailLists
        add_submenu_page('es-plugin', __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Listas de contactos","envialosimple-email-marketing-y-newsletters-gratis"), __("Listas de contactos","envialosimple-email-marketing-y-newsletters-gratis"), 'manage_options','es-plugin-maillists', 'es_plugin_page_maillists');
        add_submenu_page('es-plugin-maillists', __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Listas de contactos","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Crear","envialosimple-email-marketing-y-newsletters-gratis"), __("Crear","envialosimple-email-marketing-y-newsletters-gratis"), 'manage_options','es-plugin-maillists-create', 'es_plugin_page_maillists_create');
        add_submenu_page('es-plugin-maillists', __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Listas de contactos","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Editar","envialosimple-email-marketing-y-newsletters-gratis"), __("Editar","envialosimple-email-marketing-y-newsletters-gratis"), 'manage_options','es-plugin-maillists-edit', 'es_plugin_page_maillists_edit');
        
        //contacts
        add_submenu_page('es-plugin', __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Contactos","envialosimple-email-marketing-y-newsletters-gratis"), __("Contactos","envialosimple-email-marketing-y-newsletters-gratis"), 'manage_options','es-plugin-contacts', 'es_plugin_page_contacts');
        add_submenu_page('es-plugin-contacts', __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Contactos","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Crear","envialosimple-email-marketing-y-newsletters-gratis"), __("Crear","envialosimple-email-marketing-y-newsletters-gratis"), 'manage_options','es-plugin-contacts-create', 'es_plugin_page_contacts_create');
        add_submenu_page('es-plugin-contacts', __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Contactos","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Editar","envialosimple-email-marketing-y-newsletters-gratis"), __("Editar","envialosimple-email-marketing-y-newsletters-gratis"), 'manage_options','es-plugin-contacts-edit', 'es_plugin_page_contacts_edit');
        
        //contact form 7
        if(is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
            add_submenu_page('es-plugin', __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Vincular Formularios","envialosimple-email-marketing-y-newsletters-gratis"), __("Vincular Formularios","envialosimple-email-marketing-y-newsletters-gratis"), 'manage_options','es-plugin-contactform7', 'es_plugin_page_contactform7');
            add_submenu_page('es-plugin-contactform7', __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Vincular Formularios","envialosimple-email-marketing-y-newsletters-gratis"), __("Vincular Formularios","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Crear","envialosimple-email-marketing-y-newsletters-gratis"), 'manage_options','es-plugin-contactform7-create', 'es_plugin_page_contactform7_create');
            add_submenu_page('es-plugin-contactform7', __("ES marketing","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Vincular Formularios","envialosimple-email-marketing-y-newsletters-gratis"), __("Vincular Formularios","envialosimple-email-marketing-y-newsletters-gratis")." - ".__("Editar","envialosimple-email-marketing-y-newsletters-gratis"), 'manage_options','es-plugin-contactform7-edit', 'es_plugin_page_contactform7_edit');
        }
    }
}