<?php

namespace App\Controllers\Membros;

/**
 * Publicação e listagem de resenhas de livros lidos — Tarefa 3.8.
 * Moderação: livre vs. aprovação — decisão em aberto, ver documento
 * de visão secção 6. Até lá, assumir 'pendente' por defeito.
 */
class ResenhasController
{
    public function index(): void
    {
        require __DIR__ . '/../../Views/membros/resenhas.php';
    }

    public function criar(): void
    {
        // TODO: validar input, gravar com estadoModeracao = 'pendente'
    }
}
