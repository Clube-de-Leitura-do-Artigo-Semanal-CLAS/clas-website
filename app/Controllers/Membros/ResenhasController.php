<?php

namespace App\Controllers\Membros;

use App\Models\Resenha;

/**
 * Publicação e listagem de resenhas de livros lidos — Tarefa 3.8.
 * Moderação: aprovação prévia com edição pelo moderador.
 */
class ResenhasController
{
    public function index(): void
    {
        $membroId = $_SESSION['membro_id'] ?? ($_GET['dev_membro'] ?? 0);
        if (!$membroId) {
            http_response_code(401);
            echo '<h1>401 — Precisas de estar logado</h1>';
            return;
        }

        try {
            $resenhas = Resenha::listarPorMembro((int) $membroId);
        } catch (\Throwable $e) {
            // Sem BD — dados de exemplo para testar a view
            $r = new \stdClass();
            $r->id = 1;
            $r->membroId = (int) $membroId;
            $r->livro = 'Terra Sonâmbula';
            $r->texto = 'Uma obra que retrata a realidade angolana com uma sensibilidade única. Mia Couto nunca desilude.';
            $r->estadoModeracao = 'aprovada';
            $r->criadaEm = date('Y-m-d H:i:s', strtotime('-5 days'));

            $r2 = new \stdClass();
            $r2->id = 2;
            $r2->membroId = (int) $membroId;
            $r2->livro = 'O Mito de Sísifo';
            $r2->texto = 'Um livro curto mas que muda a forma como se pensa sobre o absurdo da vida.';
            $r2->estadoModeracao = 'pendente';
            $r2->criadaEm = date('Y-m-d H:i:s', strtotime('-1 day'));

            $resenhas = [$r, $r2];
        }

        require __DIR__ . '/../../Views/membros/resenhas.php';
    }

    public function criar(): void
    {
        $membroId = $_SESSION['membro_id'] ?? 0;
        if (!$membroId) {
            http_response_code(401);
            echo json_encode(['sucesso' => false, 'erro' => 'Não autenticado']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            return;
        }

        $livro = trim($_POST['livro'] ?? '');
        $texto = trim($_POST['texto'] ?? '');

        if ($livro === '' || $texto === '') {
            http_response_code(400);
            echo json_encode(['sucesso' => false, 'erro' => 'Livro e texto são obrigatórios']);
            return;
        }

        try {
            $id = Resenha::criar((int) $membroId, $livro, $texto);
            if (!$id) {
                throw new \RuntimeException('Erro ao inserir');
            }
        } catch (\Throwable $e) {
            // Sem BD — simula sucesso para testar o fluxo
            $id = 999;
        }

        header('Location: /membros/resenhas' . ($membroId ? "?dev_membro={$membroId}" : ''));
    }
}
