<?php

namespace App\Controllers\Membros;

/**
 * Card de membro — Tarefas 2.5 + 3.6
 *
 * Aberto por QR code do passe ou acessado via área de membros.
 *
 * ── Estado actual ──
 * Controller: carrega a view. Sem lógica de dados (ainda).
 * View: dados exemplares inline (placeholder). Toda a marcação
 *       e estilos prontos — só espera os dados reais da BD.
 *
 * ── Para ficar completo ──
 * Dados do membro:     Tarefa 2.1 (Anicélio)
 * Autenticação:        Tarefa 3.5 (Anicélio)
 * Presenças/leituras:  Tarefa 2.2
 * Troféus:             Tarefa 2.7 (Solendo)
 * Resenhas:            Tarefa 2.8
 */
class CardController
{
    public function index(): void
    {
        // Placeholder: enquanto não há auth + BD, a view tem dados exemplares
        // Quando backend estiver pronto, substituir por:
        //   $membro = (new MembroService())->buscarPorId($_SESSION['membro_id']);
        //   $view->membro = $membro;

        require __DIR__ . '/../../Views/membros/card.php';
    }
}
