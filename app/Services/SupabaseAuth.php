<?php

namespace App\Services;

class SupabaseAuth
{
    /**
     * Regista um novo utilizador na tabela auth.users do Supabase.
     * Retorna o UUID gerado, ou null em caso de erro.
     */
    public static function criarUtilizador(string $email, string $password): ?string
    {
        $supabaseUrl = getenv('SUPABASE_URL');
        // Para CRIAR utilizadores sem necessitar de confirmação de email (por padrão),
        // costuma-se usar o endpoint de /signup, mas dependendo das configurações do Supabase
        // pode ser necessário usar a SERVICE_ROLE key na API de Admin (admin/users).
        // Aqui usaremos o endpoint público signup, que no painel deve ter a confirmação de email desativada.
        
        $anonKey = getenv('SUPABASE_ANON_KEY');
        $url = $supabaseUrl . '/auth/v1/signup';

        $payload = json_encode([
            'email' => $email,
            'password' => $password
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "apikey: {$anonKey}",
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $dados = json_decode($response, true);

        if ($httpCode !== 200 || isset($dados['error'])) {
            error_log('[SupabaseAuth] Falha a criar: ' . ($dados['error_description'] ?? $dados['msg'] ?? ''));
            return null;
        }

        return $dados['user']['id'] ?? $dados['id'] ?? null;
    }
}
