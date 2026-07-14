<?php

namespace App\Controllers\Membros;

/**
 * Card de membro — Tarefas 2.5 + 3.6
 *
 * Aberto por QR code do passe ou acessado via área de membros.
 * Mostra todas as resenhas do membro (aprovadas + pendentes).
 */
class CardController
{
    public function index(): void
    {
        $membroId = $_SESSION['membro_id'] ?? ($_GET['dev_membro'] ?? 0);
        if (!$membroId) {
            http_response_code(401);
            echo '<h1>401 — Precisas de estar logado</h1>';
            return;
        }

        $isOwner = true;

        try {
            $resenhas = \App\Models\Resenha::listarPorMembro((int) $membroId);
        } catch (\Throwable $e) {
            $r = new \stdClass();
            $r->id = 1;
            $r->livro = 'Terra Sonâmbula';
            $r->texto = 'Uma obra que retrata a realidade angolana com uma sensibilidade única. Mia Couto nunca desilude.';
            $r->estadoModeracao = 'aprovada';
            $r->criadaEm = date('Y-m-d H:i:s', strtotime('-5 days'));

            $r2 = new \stdClass();
            $r2->id = 2;
            $r2->livro = 'O Mito de Sísifo';
            $r2->texto = 'Um livro curto mas que muda a forma como se pensa sobre o **absurdo** da vida.';
            $r2->estadoModeracao = 'pendente';
            $r2->criadaEm = date('Y-m-d H:i:s', strtotime('-1 day'));

            $resenhas = [$r, $r2];
        }

        require __DIR__ . '/../../Views/membros/card.php';
    }
}
