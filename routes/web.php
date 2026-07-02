<?php

/**
 * routes/web.php
 * Rotas da camada Pública e da camada Membros (autenticada).
 * Rotas de Admin ficam em routes/admin.php, separadas para deixar claro
 * onde é preciso aplicar o RoleMiddleware.
 *
 * TODO: preencher à medida que os Controllers forem sendo criados.
 * Exemplo do formato esperado (ajustar ao router escolhido):
 *
 *   GET  /                      -> Publica\HomeController@index
 *   GET  /sobre                 -> Publica\HomeController@sobre
 *   GET  /concurso-mwangole     -> Publica\ConcursoController@index
 *   GET  /parceiros             -> Publica\ParceirosController@index
 *
 *   GET  /membros/card          -> Membros\CardController@show
 *   GET  /membros/perfil        -> Membros\PerfilController@show
 *   GET  /membros/relatorios    -> Membros\RelatoriosController@index
 *   GET  /membros/resenhas      -> Membros\ResenhasController@index
 *   POST /membros/resenhas      -> Membros\ResenhasController@store
 */
