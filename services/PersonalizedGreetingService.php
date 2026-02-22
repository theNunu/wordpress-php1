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

    public static function greet2($data, $file = null)
    {
        //         public static function greet($data, $file = null)
        {
            $pdfInfo = null;

            // Solo si existe archivo y no hubo error
            if ($file && isset($file['error']) && $file['error'] === 0) {

                // Validar que sea PDF real
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $file['tmp_name']);
                finfo_close($finfo);

                if ($mimeType !== 'application/pdf') {
                    return [
                        "status" => "error",
                        "msg" => "El archivo debe ser un PDF valido"
                    ];
                }

                $fileName = sanitize_text_field($file['name']);
                $fileSizeBytes = $file['size'];
                $fileSizeKB = round($fileSizeBytes / 1024, 2);

                $pdfInfo = [
                    "nombre_archivo" => $fileName,
                    "peso_bytes" => $fileSizeBytes,
                    "peso_kb" => $fileSizeKB . " KB"
                ];
            }

            // Teléfono por defecto
            $phone = !empty($data['phoneNumber'])
                ? $data['phoneNumber']
                : '0999999999';

            return [
                "status" => "ok",
                "mensaje" => "Tu nombre es {$data['firstName']} {$data['lastName']} y tienes {$data['age']} años",
                "telefono_usado" => $phone,
                "pdf" => $pdfInfo ?? "No se subió ningún archivo"
            ];
        }
    }
}