<?php

namespace App\Controllers\Publica;

/**
 * Perfil público de um membro — Tarefa 3.6
 *
 * ── Estado actual ──
 * Controller: carrega a view com dados exemplares.
 * View: marcação e estilos prontos — espera dados reais da BD.
 *
 * ── Para ficar completo ──
 * Dados do membro:     Tarefa 2.1 (Anicélio)
 * Presenças/leituras:  Tarefa 2.2
 * Troféus:             Tarefa 2.7 (Solendo)
 * Resenhas:            Tarefa 2.8
 */
class PerfilMembroController
{
    public function show(string $id): void
    {
        // Placeholder: $id será usado para buscar o membro na BD
        // Quando backend estiver pronto:
        //   $membro = (new MembroService())->buscarPorProcesso($id);
        //   require __DIR__ . '/../../Views/membros/card.php';

        require __DIR__ . '/../../Views/membros/card.php';
    }
}
