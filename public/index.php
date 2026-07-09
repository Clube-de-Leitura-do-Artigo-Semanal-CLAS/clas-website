<?php
/**
 * Front controller — TODOS os pedidos ao site passam por aqui.
 * Não adicionem lógica de negócio neste ficheiro; ele só arranca
 * o autoload, monta as rotas e manda o Router despachar o pedido.
 */

// Autoload simples das classes App\... (sem depender do Composer estar
// instalado — o projeto é PHP puro, o autoload devia funcionar sempre).
spl_autoload_register(function (string $classe) {
    $prefixo = 'App\\';
    if (!str_starts_with($classe, $prefixo)) {
        return;
    }
    $caminhoRelativo = str_replace('\\', '/', substr($classe, strlen($prefixo)));
    $ficheiro = __DIR__ . '/../app/' . $caminhoRelativo . '.php';
    if (file_exists($ficheiro)) {
        require $ficheiro;
    }
});

// Se um dia a equipa adicionar alguma biblioteca via Composer, isto
// carrega-a também — mas não é obrigatório existir (ver acima).
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';
}

// Carrega o bootstrap que inicializa as variáveis de ambiente (.env)
require_once __DIR__ . '/../app/bootstrap.php';

// A sessão será gerida pelas rotas que precisarem (ex: RoleMiddleware e LoginController)

// Monta as rotas (pública + membros, admin, api) e despacha o pedido atual
$router = new \App\Core\Router();
$router->carregar(__DIR__ . '/../routes/web.php');
$router->carregar(__DIR__ . '/../routes/admin.php');
$router->carregar(__DIR__ . '/../routes/api.php');
$router->despachar($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
