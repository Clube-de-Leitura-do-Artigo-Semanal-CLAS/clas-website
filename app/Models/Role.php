<?php

namespace App\Models;

/**
 * Constantes de Role para uso na aplicação.
 *
 * Os roles são geridos directamente na coluna `role` da tabela `membros`,
 * não em tabela separada. Esta classe serve apenas como referência
 * centralizada dos valores válidos.
 */
class Role
{
    const ADMIN           = 'admin';
    const MEMBRO          = 'membro';
    const COORD_LEITURA   = 'coord leitura';
    const RECEPCIONISTA   = 'recepcionista';

    public static function todos(): array
    {
        return [self::ADMIN, self::MEMBRO, self::COORD_LEITURA, self::RECEPCIONISTA];
    }
}
