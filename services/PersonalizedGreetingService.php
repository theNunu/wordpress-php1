<?php

class PersonalizedGreetingService
{

    public static function greet($data)
    {
        // Número por defecto si no viene
        $phone = !empty($data['phoneNumber'])
            ? $data['phoneNumber']
            : '0999999999';

        wp_send_json([
            "status" => "ok",
            "1 mensaje" => "tu nombre es {$data['firstName']}, y tu apellido es {$data['lastName']} ,tu edad es de {$data['age']} años",
            "telefono_usado" => $phone
        ]);

    }
}