<?php

class UsuarioController {

    public static function crear($request) {

        // Validar que existan
        if (!isset($_POST['nombre']) || !isset($_POST['email'])) {
            return new WP_REST_Response([
                'status' => 'error',
                'message' => 'Campos obligatorios'
            ], 400);
        }

        // Sanitizar
        $nui   = sanitize_text_field($_POST['nombre']);
        $email = sanitize_email($_POST['email']);

        if (empty($nui) || empty($email)) {
            return new WP_REST_Response([
                'status' => 'error',
                'message' => 'Datos inválidos'
            ], 400);
        }

        return new WP_REST_Response([
            'status' => 'ok',
            'nui' => $nui,
            'email' => $email
        ], 200);
    }
}