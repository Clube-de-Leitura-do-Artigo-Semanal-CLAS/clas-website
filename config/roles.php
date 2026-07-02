<?php

/**
 * config/roles.php
 * Define os roles do site e o que cada um pode fazer.
 * Usado por app/Middleware/RoleMiddleware.php (tarefa 2.4).
 *
 * Ver secção 5 do documento de visão para a tabela completa.
 */

return [
    'visitante'    => ['ver_publica'],
    'membro'       => ['ver_card', 'ver_relatorios', 'ver_perfil', 'publicar_resenha'],
    'coordenadora' => ['marcar_presenca_debate'],
    'recepcao'     => ['marcar_presenca_evento'],
    'admin'        => ['gestao_completa'], // presenças, dados, estatísticas, estados, roles
];
