<?php
/**
 * Define as roles do site e o que cada uma pode fazer.
 * Usado pelo RoleMiddleware para bloquear acesso a rotas admin.
 * Ver Tarefa 2.4 — Sistema de roles e permissões.
 */

return [
    'visitante'      => ['ver_publica'],
    'membro'         => ['ver_perfil', 'ver_card', 'publicar_resenha'],
    'coordenadora'   => ['marcar_presenca_debate'],
    'rececao'        => ['marcar_presenca_evento'],
    'admin'          => ['*'], // acesso total
];
