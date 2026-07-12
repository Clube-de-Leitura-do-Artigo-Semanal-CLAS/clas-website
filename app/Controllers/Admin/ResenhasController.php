<?php

namespace App\Controllers\Admin;

use App\Models\Resenha;

/**
 * Moderação de resenhas — Tarefa 2.8.
 * Acesso: admin ou moderador. Lista pendentes, permite editar texto
 * antes de aprovar ou rejeitar.
 */
class ResenhasController
{
    public function pendentes(): void
    {
        $resenhas = Resenha::listarPendentes();
        require __DIR__ . '/../../Views/admin/resenhas_pendentes.php';
    }

    public function moderar(string $id): void
    {
        $resenha = Resenha::buscar((int) $id);
        if (!$resenha) {
            http_response_code(404);
            echo '<h1>Resenha não encontrada</h1>';
            return;
        }
        require __DIR__ . '/../../Views/admin/resenha_moderar.php';
    }

    public function salvarModeracao(string $id): void
    {
        $resenha = Resenha::buscar((int) $id);
        if (!$resenha) {
            http_response_code(404);
            echo json_encode(['sucesso' => false, 'erro' => 'Resenha não encontrada']);
            return;
        }

        $livro = trim($_POST['livro'] ?? '');
        $autor = trim($_POST['autor'] ?? '');
        $texto = trim($_POST['texto'] ?? '');
        $accao = $_POST['accao'] ?? ''; // 'aprovar' | 'rejeitar'

        if ($texto === '') {
            http_response_code(400);
            echo json_encode(['sucesso' => false, 'erro' => 'Texto não pode ficar vazio']);
            return;
        }

        Resenha::editarLivroAutor((int) $id, $livro, $autor);
        Resenha::editarTexto((int) $id, $texto);

        if ($accao === 'aprovar') {
            Resenha::aprovar((int) $id);
        } else {
            Resenha::rejeitar((int) $id);
        }

        header('Location: /admin/resenhas');
    }
}
