<?php

namespace App\Controllers\Publica;

/**
 * Concurso literário MwangoLê — Tarefa 3.3.
 */
class ConcursoController
{
    public function index(): void
    {
        require __DIR__ . '/../../Views/publica/concurso.php';
    }
}
