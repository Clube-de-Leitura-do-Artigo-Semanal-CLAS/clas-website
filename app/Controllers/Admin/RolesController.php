<?php

namespace App\Controllers\Admin;

/**
 * Atribuição de roles (coordenadora, receção, admin) — parte da Tarefa 2.4 / 3.12.
 * Só o admin pode atribuir roles a outros utilizadores.
 */
class RolesController
{
    public function atribuir(): void
    {
        // TODO: validar que quem chama é admin, gravar nova Role
    }
}
