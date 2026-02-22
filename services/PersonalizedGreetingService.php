<?php

class PersonalizedGreetingService
{

    public static function greet($data)
    {
        wp_send_json([
            "status" => "ok",
            "1 mensaje" => "tu nombre es {$data['firstName']} ,tu edad es de {$data['age']} años"
        ]);

    }
}