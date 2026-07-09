<?php

namespace App\Controllers\Auth;

class ActivationController
{
    /**
     * PASSO 1: O ecrã inicial de ativação agora vive num Modal dentro da página de Login.
     * Esta rota GET pode ser apagada ou redirecionar para /login se for acedida.
     */
    public function index(): void
    {
        header('Location: /login');
        exit;
    }

    /**
     * PASSO 1 (Processamento AJAX)
     */
    public function verificarIdentidade(): void
    {
        header('Content-Type: application/json');
        try {
        $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        $identificador = $input['identificador'] ?? '';

        if (empty($identificador)) {
            echo json_encode(['sucesso' => false, 'erro' => 'Por favor, preenche o Email ou ID CLAS.']);
            return;
        }

        $membro = \App\Models\Membro::obterPorEmailOuIdClas($identificador);

        if (!$membro) {
            echo json_encode(['sucesso' => false, 'erro' => 'Não encontrámos nenhum membro com este Email ou ID CLAS.']);
            return;
        }

        if ($membro->user_id) {
            echo json_encode(['sucesso' => false, 'erro' => 'Esta conta já se encontra ativada. Faz login normalmente.']);
            return;
        }

        if (empty($membro->telefone)) {
            echo json_encode(['sucesso' => false, 'erro' => 'O teu registo não tem número de telefone associado. Contacta a administração.']);
            return;
        }

        // Gerar OTP de 6 dígitos
        $otp = (string) random_int(100000, 999999);

        // Enviar via Telco SMS
        $enviado = \App\Services\SmsService::enviarOTP($membro->telefone, $otp);

        if (!$enviado) {
            echo json_encode(['sucesso' => false, 'erro' => 'Falha ao enviar SMS. Tenta novamente mais tarde.']);
            return;
        }

        // Guardar estado na sessão
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        $_SESSION['ativacao'] = [
            'membro_id' => $membro->id,
            'email' => $membro->email,
            'telefone' => $membro->telefone,
            'otp' => $otp,
            'verificado' => false
        ];

        echo json_encode([
            'sucesso' => true,
            'telefoneOculto' => substr($membro->telefone, -4)
        ]);
        exit;
        } catch (\Throwable $e) {
            echo json_encode(['sucesso' => false, 'erro' => '[Passo 1] ' . $e->getMessage()]);
        }
    }

    /**
     * PASSO 2: GET antigo. Apagado/redirecionado.
     */
    public function otp(): void
    {
        header('Location: /login');
    }

    /**
     * PASSO 2 (Processamento AJAX)
     */
    public function verificarOtp(): void
    {
        header('Content-Type: application/json');
        try {
            if (session_status() === PHP_SESSION_NONE) session_start();
            
            if (!isset($_SESSION['ativacao'])) {
                echo json_encode(['sucesso' => false, 'erro' => 'Sessão expirada. Recomeça a ativação.']);
                return;
            }

            $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $otpSubmetido = trim($input['otp'] ?? '');
            $otpCorreto = $_SESSION['ativacao']['otp'];

            if ($otpSubmetido !== $otpCorreto) {
                echo json_encode(['sucesso' => false, 'erro' => 'Código inválido ou expirado.']);
                return;
            }

            $_SESSION['ativacao']['verificado'] = true;
            echo json_encode(['sucesso' => true]);
        } catch (\Throwable $e) {
            echo json_encode(['sucesso' => false, 'erro' => '[Passo 2] ' . $e->getMessage()]);
        }
    }

    /**
     * PASSO 3: GET antigo.
     */
    public function senha(): void
    {
        header('Location: /login');
    }

    /**
     * PASSO 3 (Processamento AJAX)
     */
    public function concluir(): void
    {
        header('Content-Type: application/json');
        try {
            if (session_status() === PHP_SESSION_NONE) session_start();
            
            if (!isset($_SESSION['ativacao']) || !$_SESSION['ativacao']['verificado']) {
                echo json_encode(['sucesso' => false, 'erro' => 'Sessão expirada ou não verificada.']);
                return;
            }

            $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $senha1 = $input['senha'] ?? '';
            $senha2 = $input['confirmar_senha'] ?? '';

            if (strlen($senha1) < 6) {
                echo json_encode(['sucesso' => false, 'erro' => 'A palavra-passe deve ter pelo menos 6 caracteres.']);
                return;
            }

            if ($senha1 !== $senha2) {
                echo json_encode(['sucesso' => false, 'erro' => 'As palavras-passe não coincidem.']);
                return;
            }

            $email = $_SESSION['ativacao']['email'];
            $idMembro = $_SESSION['ativacao']['membro_id'];

            $uuid = \App\Services\SupabaseAuth::criarUtilizador($email, $senha1);

            if (!$uuid) {
                echo json_encode(['sucesso' => false, 'erro' => 'Erro ao registar a conta de segurança no Supabase.']);
                return;
            }

            $vinculado = \App\Models\Membro::vincularUsuarioAuth($idMembro, $uuid);

            if (!$vinculado) {
                echo json_encode(['sucesso' => false, 'erro' => 'Conta criada, mas falhou ao ligar ao teu perfil. Contacta o suporte.']);
                return;
            }

            unset($_SESSION['ativacao']);

            echo json_encode(['sucesso' => true, 'mensagem' => 'Ativação concluída! Podes fazer login agora.']);
        } catch (\Throwable $e) {
            echo json_encode(['sucesso' => false, 'erro' => '[Passo 3] ' . $e->getMessage()]);
        }
    }
}

