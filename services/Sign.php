<?php

class Sign
{
    //NO LE HAGAS CASO A ESTO

    public static function createSign($postData, $file)
    {

        // =========================
        // 1️⃣ VALIDAR MIME REAL
        // =========================
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if ($mimeType !== 'application/pdf') {
            return [
                "status" => "error",
                "msg" => "El archivo debe ser un PDF válido"
            ];
        }

        // =========================
        // 2️⃣ VALIDAR NOMBRE
        // =========================
        $fileName = strtoupper($file['name']); // Para evitar problemas de mayúsculas

        if (
            strpos($fileName, 'CONTRATO') === false &&
            strpos($fileName, 'NEGADA') === false
        ) {
            return [
                "status" => "error",
                "msg" => "El nombre del archivo debe contener la palabra CONTRATO o NEGADA"
            ];
        }



        return [
            "status" => "ok",
            "la info" => $postData
            // "msg" => "Registro procesado correctamente",
            // "data" => [
            //     "nui" => $nui,
            //     "email" => $email
            // ]
        ];
    }
}