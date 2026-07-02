<?php

namespace App\Models;

/**
 * Associação entre um utilizador e uma role (visitante, membro,
 * coordenadora, receção, admin). Ver config/roles.php para as permissões.
 */
class Role
{
    public int $id;
    public int $utilizadorId;
    public string $nome;
}
