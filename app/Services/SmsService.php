<?php

namespace App\Services;

class SmsService
{

    public static function enviarOTP(string $telefone, string $otp): bool
    {

        $telefoneLimpo = preg_replace('/[^0-9]/', '', $telefone);

        $apiKey = getenv('TELCO_SMS_API_KEY');
        $mensagem = "O teu codigo CLAS de activacao é: {$otp}. Não o partilhes com ninguém.";

        $url = 'https://www.telcosms.co.ao/api/v2/send_message';

        $payload = json_encode([
            "message" => [
                "api_key_app"  => $apiKey,
                "phone_number" => $telefoneLimpo,
                "message_body" => $mensagem
            ]
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode === 200 || $httpCode === 201;
    }
}
