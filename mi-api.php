<?php

require_once plugin_dir_path(__FILE__) . 'services/SignService.php';
require_once plugin_dir_path(__FILE__) . 'services/Saludar.php';
require_once plugin_dir_path(__FILE__) . 'services/PersonalizedGreetingService.php';

add_action('wp_ajax_nopriv_dpti_create_sign', 'dpti_create_sign');
add_action('wp_ajax_dpti_create_sign', 'dpti_create_sign');

function dpti_create_sign()
{

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

function dpti_mandar_saludo()
{
    $response = Saludar::mandarSaludo();

    wp_send_json($response);

}

//personalized greeting
add_action('wp_ajax_nopriv_greet_someone', 'greet_someone');
add_action('wp_ajax_greet_someone', 'greet_someone');

function greet_someone()
{

    $response = PersonalizedGreetingService::greet();

    wp_send_json($response);

}
//http://localhost/miwp/wp-admin/admin-ajax.php  -> LA RUTA POR DEFECTO A USAR EN POSTMAN