<?php

namespace App\Controllers\Publica;

/**
 * Secção Parceiros + Contacte-nos — Tarefa 3.4.
 */
class ContactoController
{
    public function parceiros(): void
    {
        require __DIR__ . '/../../Views/publica/parceiros.php';
    }

    public function index(): void
    {
        require __DIR__ . '/../../Views/publica/contacto.php';
    }

    public function enviar(): void
    {
        // TODO: validar e guardar/enviar mensagem de contacto
    }
}
