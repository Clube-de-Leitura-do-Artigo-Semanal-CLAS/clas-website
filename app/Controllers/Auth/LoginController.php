<?php

namespace App\Controllers\Auth;

class LoginController
{

    public function index(): void
    {
        require __DIR__ . '/../../Views/auth/login.php';
    }

    public function autenticar(): void
    {
        $identificador = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($identificador) || empty($password)) {
            echo "<h1>Erro: Preenche o email/ID e a senha.</h1>";
            echo "<a href='/login'>Voltar</a>";
            return;
        }

        $membro = \App\Models\Membro::obterPorEmailOuIdClas($identificador);

        if (!$membro || empty($membro->email)) {
            echo "<h1>Falha no login: Credenciais inválidas ou utilizador não encontrado.</h1>";
            echo "<a href='/login'>Voltar</a>";
            return;
        }

        $emailReal = $membro->email;

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
            'email' => $emailReal,
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

        if (!$userId || $membro->user_id !== $userId) {
            echo "<h1>Erro de integridade: O perfil não corresponde à conta de segurança. Contacta a administração.</h1>";
            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_id'] = $membro->id;
        $_SESSION['role'] = $membro->role;
        $_SESSION['nome'] = $membro->nome;
        $_SESSION['nome_passe'] = $membro->nome_passe;

        if (in_array($membro->role, ['admin', 'coordenadora', 'rececao'])) {
            header('Location: /admin/membros');
        } else {
            header('Location: /membros/perfil');
        }
        exit;
    }

    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: /');
        exit;
    }
}

