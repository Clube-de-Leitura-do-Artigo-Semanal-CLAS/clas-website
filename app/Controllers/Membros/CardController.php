<?php

namespace App\Controllers\Membros;

/**
 * Card de membro — aberto por QR code do passe (ver Tarefa 2.5).
 * Mostra: número de processo, estado, histórico literário (livros,
 * eventos, troféus, badges). Ver Tarefa 3.6.
 */
class CardController
{
    public function index(): void
    {
        require __DIR__ . '/../../Views/membros/card.php';
    }
}
