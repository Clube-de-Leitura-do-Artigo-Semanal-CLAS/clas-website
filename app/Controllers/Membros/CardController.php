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
        http_response_code(404);
        echo '<h1 style="font-family: Playfair Display,serif;text-align:center;padding:4rem 1rem;">Página não encontrada</h1>';
    }
}
