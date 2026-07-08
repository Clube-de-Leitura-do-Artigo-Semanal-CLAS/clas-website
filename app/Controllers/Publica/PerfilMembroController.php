<?php

namespace App\Controllers\Publica;

use App\Services\MembroExemploService;

/**
 * Perfil público de um membro — Tarefa 3.6
 */
class PerfilMembroController
{
    public function show(string $id): void
    {
        $membro = MembroExemploService::buscar($id);

        if (!$membro) {
            http_response_code(404);
            echo '<h1 style="font-family: Playfair Display,serif;text-align:center;padding:4rem 1rem;">Membro n\u00e3o encontrado</h1>';
            return;
        }

        require __DIR__ . '/../../Views/membros/card.php';
    }
}