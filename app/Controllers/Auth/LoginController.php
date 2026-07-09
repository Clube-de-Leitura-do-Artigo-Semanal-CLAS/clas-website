<?php

namespace App\Controllers\Auth;

class LoginController
{
    /**
     * Mostra a página HTML do login.
     */
    public function index(): void
    {
        require __DIR__ . '/../../Views/auth/login.php';
    }

    /**
     * Recebe os dados do formulário quando o utilizador clica em "Entrar".
     */
    public function autenticar(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            // Em vez de echo, num sistema real rediriamos de volta com uma mensagem de erro na sessão
            echo "<h1>Erro: Preenche o email e a senha.</h1>";
            echo "<a href='/login'>Voltar</a>";
            return;
        }

        $supabaseUrl = getenv('SUPABASE_URL');
        $anonKey = getenv('SUPABASE_ANON_KEY');

        $ch = curl_init($supabaseUrl . '/auth/v1/token?grant_type=password');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "apikey: {$anonKey}",
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'email' => $email,
            'password' => $password
        ]));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $dadosAuth = json_decode($response, true);

        if ($httpCode !== 200 || isset($dadosAuth['error'])) {
            $msg = $dadosAuth['error_description'] ?? 'Credenciais inválidas.';
            echo "<h1>Falha no login: {$msg}</h1>";
            echo "<a href='/login'>Voltar</a>";
            return;
        }

        $userId = $dadosAuth['user']['id'] ?? null;

        if (!$userId) {
            echo "<h1>Erro inesperado ao contactar o Supabase.</h1>";
            return;
        }

       
        $membro = \App\Models\Membro::obterPorUserId($userId);

        if (!$membro) {

            echo "<h1>Perfil não encontrado. O teu registo no CLAS ainda não está completo.</h1>";
            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_id'] = $membro->id;
        $_SESSION['role'] = $membro->role;
        $_SESSION['nome'] = $membro->nome;

        if (in_array($membro->role, ['admin', 'coordenadora', 'rececao'])) {
            header('Location: /admin/membros');
        } else {
            header('Location: /membros/perfil');
        }
        exit;
    }
}

