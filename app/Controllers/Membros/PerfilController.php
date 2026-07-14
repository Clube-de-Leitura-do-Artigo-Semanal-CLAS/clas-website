<?php

namespace App\Controllers\Membros;

use App\Services\Database;
use App\Services\MembroService;

/**
 * Perfil do membro autenticado — Tarefa 3.6.
 *
 * É para aqui que o login redireciona. Mostra o card do próprio membro,
 * com os dados dele vindos da base de dados.
 */
class PerfilController
{
    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Sem sessão: manda para o login
        if (empty($_SESSION['user_id'])) {
            header('Location: /login');
            return;
        }

        $membro = $this->membroAutenticado((int) $_SESSION['user_id']);

        if ($membro === null) {
            // Sessão válida mas o membro já não existe na BD
            session_destroy();
            header('Location: /login');
            return;
        }

        require __DIR__ . '/../../Views/membros/card.php';
    }

    /**
     * Busca o membro autenticado. O card espera um array com os mesmos
     * campos que o MembroService devolve na lista pública.
     */
    private function membroAutenticado(int $id): ?array
    {
        try {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare(
                "SELECT numero_processo,
                        COALESCE(NULLIF(nome_passe, ''), nome) AS nome_passe,
                        estado
                 FROM membros
                 WHERE id = :id
                 LIMIT 1"
            );
            $stmt->execute(['id' => $id]);
            $linha = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$linha) {
                return null;
            }

            // Reaproveita o MembroService para manter o formato consistente
            return MembroService::buscar($linha['numero_processo']);
        } catch (\Throwable $e) {
            error_log('PerfilController: ' . $e->getMessage());
            return null;
        }
    }
}
