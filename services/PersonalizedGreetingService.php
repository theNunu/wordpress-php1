<?php

class PersonalizedGreetingService
{

    public static function greet()
    {
        wp_send_json([
            // "status" => "ok",
            "1 mensaje" => "waza"
        ]);

    }
}