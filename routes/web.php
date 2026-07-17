<?php
/**
 * Rotas da camada PÚBLICA e da área de MEMBROS (autenticada).
 * Rotas de admin ficam em admin.php, e a API do KwiZ em api.php.
 *
 * Formato sugerido: [método, caminho, Controller::class, 'metodo']
 */

return [
    // Pública — Tarefas 3.1 a 3.4
    ['GET', '/login', \App\Controllers\Auth\LoginController::class, 'index'],
    ['POST', '/login', \App\Controllers\Auth\LoginController::class, 'autenticar'],
    ['GET', '/logout', \App\Controllers\Auth\LoginController::class, 'logout'],
    
    // Ativação de Conta (SMS OTP)
    ['GET', '/ativar', \App\Controllers\Auth\ActivationController::class, 'index'],
    ['POST', '/ativar/verificar-identidade', \App\Controllers\Auth\ActivationController::class, 'verificarIdentidade'],
    ['GET', '/ativar/otp', \App\Controllers\Auth\ActivationController::class, 'otp'],
    ['POST', '/ativar/verificar-otp', \App\Controllers\Auth\ActivationController::class, 'verificarOtp'],
    ['GET', '/ativar/senha', \App\Controllers\Auth\ActivationController::class, 'senha'],
    ['POST', '/ativar/concluir', \App\Controllers\Auth\ActivationController::class, 'concluir'],

    ['GET', '/', \App\Controllers\Publica\HomeController::class, 'index'],
    ['GET', '/concurso-mwangole', \App\Controllers\Publica\ConcursoController::class, 'index'],
    ['GET', '/parceiros', \App\Controllers\Publica\ContactoController::class, 'parceiros'],
    ['GET', '/contacto', \App\Controllers\Publica\ContactoController::class, 'index'],
    ['POST', '/contacto', \App\Controllers\Publica\ContactoController::class, 'enviar'],
    ['GET', '/eventos', \App\Controllers\Publica\HomeController::class, 'eventos'],
    ['GET', '/inscricao', \App\Controllers\Publica\HomeController::class, 'inscricao'],
    ['GET', '/membros', \App\Controllers\Publica\ListaMembrosController::class, 'index'],
    ['GET', '/membro/{id}', \App\Controllers\Publica\PerfilMembroController::class, 'show'],

    // Membros — Tarefas 3.6 a 3.9 (exige sessão autenticada)
    ['GET', '/membros/perfil', \App\Controllers\Membros\PerfilController::class, 'index'],
    ['GET', '/membros/card', \App\Controllers\Membros\CardController::class, 'index'],
    ['GET', '/membros/relatorios', \App\Controllers\Membros\RelatoriosController::class, 'index'],
    ['GET', '/membros/resenhas', \App\Controllers\Membros\ResenhasController::class, 'index'],
    ['POST', '/membros/resenhas', \App\Controllers\Membros\ResenhasController::class, 'criar'],
];
