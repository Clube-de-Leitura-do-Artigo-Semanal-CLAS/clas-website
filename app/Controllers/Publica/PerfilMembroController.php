<?php

namespace App\Controllers\Publica;

use App\Services\MembroService;

/**
 * Perfil público de um membro — Tarefa 3.6
 */
class PerfilMembroController
{
    public function show(string $id): void
    {
        $membro = MembroService::buscar($id);

        if (!$membro) {
            http_response_code(404);
            echo '<h1 style="font-family: Playfair Display,serif;text-align:center;padding:4rem 1rem;">Membro não encontrado</h1>';
            return;
        }

        require __DIR__ . '/../../Views/membros/card.php';
    }
}