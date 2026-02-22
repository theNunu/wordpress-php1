<?php

class SignService {
    //NO LE HAGAS CASO A ESTO

    public static function create($postData) {

        // Sanitizar
        $nui        = sanitize_text_field($postData['nui']);
        $givenName  = sanitize_text_field($postData['givenName']);
        $secondName = sanitize_text_field($postData['secondName'] ?? '');
        $surname1   = sanitize_text_field($postData['surname1']);
        $surname2   = sanitize_text_field($postData['surname2'] ?? '');
        $province   = sanitize_text_field($postData['province'] ?? '');
        $city       = sanitize_text_field($postData['city'] ?? '');
        $country    = sanitize_text_field($postData['country'] ?? '');
        $address    = sanitize_text_field($postData['address'] ?? '');
        $email      = sanitize_email($postData['email']);
        $phone      = sanitize_text_field($postData['phoneNumber'] ?? '');
        $reason     = sanitize_text_field($postData['reason'] ?? '');

        // Validación extra
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                "status" => "error",
                "msg" => "Email inválido"
            ];
        }

        // Aquí iría lógica real:
        // - Guardar en DB con $wpdb
        // - Consumir API externa
        // - Generar token
        // etc.

        return [
            "status" => "ok",
            "msg" => "Registro procesado correctamente",
            "data" => [
                "nui" => $nui,
                "email" => $email
            ]
        ];
    }
}