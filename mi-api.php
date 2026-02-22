<?php
// /*
// Plugin Name: Mi API Estructurada
// Version: 1.0
// */

// require_once plugin_dir_path(__FILE__) . 'controllers/UsuarioController.php';
// // require_once plugin_dir_path(__FILE__) . 'wp-content/plugins/mi-api/controllers/UsuarioController.php';

// add_action('rest_api_init', function () {

//     register_rest_route('miapi/v1', '/crear', [
//         'methods'  => 'POST',
//         'callback' => ['UsuarioController', 'crear'],
//         'permission_callback' => '__return_true'
//     ]);

// });

/*
Plugin Name: DPTI API
Version: 1.0
*/

require_once plugin_dir_path(__FILE__) . 'services/SignService.php';

add_action('wp_ajax_nopriv_dpti_create_sign', 'dpti_create_sign');
add_action('wp_ajax_dpti_create_sign', 'dpti_create_sign');

function dpti_create_sign() {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        wp_send_json([
            "status" => "error",
            "msg" => "Metodo no permitido"
        ], 405);
    }

    // Validar que existan campos obligatorios
    $required = ['nui', 'givenName', 'surname1', 'email'];

    foreach ($required as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            wp_send_json([
                "status" => "error",
                "msg" => "El campo {$field} es obligatorio"
            ], 400);
        }
    }

    // Delegar lógica al service
    $response = SignService::create($_POST);

    wp_send_json($response);
}

add_action('wp_ajax_nopriv_dpti_mandar_saludo', 'dpti_mandar_saludo');
add_action('wp_ajax_dpti_mandar_saludo', 'dpti_mandar_saludo');

function dpti_mandar_saludo(){
     wp_send_json([
        "status" =>  "ok",
        "1 mensaje"=> "wazaaaa"
     ]);

}