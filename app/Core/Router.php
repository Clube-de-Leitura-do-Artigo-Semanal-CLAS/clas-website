<?php

namespace App\Core;

use App\Middleware\RoleMiddleware;

/**
 * O Router — a peça que faltava desde o início do projeto.
 *
 * Lê os arrays devolvidos por routes/web.php, routes/admin.php e
 * routes/api.php, encontra a linha que combina com o pedido atual
 * (método + caminho) e chama o Controller certo.
 *
 * Formato de cada rota (ver routes/*.php):
 *   ['GET', '/membros/card', CardController::class, 'index']
 *   ['GET', '/admin/membros/{id}', MembrosController::class, 'show']
 *   ['GET', '/admin/presencas', PresencasController::class, 'index', ['admin','coordenadora','rececao']]
 *
 * O 5º elemento (opcional) é a lista de roles permitidas nessa rota.
 * Se vier preenchido, o Router chama o RoleMiddleware antes de despachar.
 */
class Router
{
    /** @var array<int, array> */
    private array $rotas = [];

    /**
     * Carrega um ficheiro de rotas (ex: routes/web.php) e junta-o
     * à lista interna. Pode ser chamado várias vezes.
     */
    public function carregar(string $ficheiroDeRotas): void
    {
        $rotasDoFicheiro = require $ficheiroDeRotas;
        foreach ($rotasDoFicheiro as $rota) {
            $this->rotas[] = $rota;
        }
    }

    /**
     * Despacha o pedido atual para o Controller certo.
     * Chamado uma única vez, a partir de public/index.php.
     */
    public function despachar(string $uriPedido, string $metodoPedido): void
    {
        $uri = $this->limparUri($uriPedido);
        $metodo = strtoupper($metodoPedido);

        foreach ($this->rotas as $rota) {
            [$metodoRota, $caminhoRota, $controllerClasse, $acao] = $rota;
            $rolesPermitidas = $rota[4] ?? null;

            if ($metodo !== strtoupper($metodoRota)) {
                continue;
            }

            $parametros = $this->combinar($caminhoRota, $uri);
            if ($parametros === null) {
                continue;
            }

            if ($rolesPermitidas !== null && !$this->autorizado($rolesPermitidas)) {
                $this->responder403();
                return;
            }

            $this->chamarController($controllerClasse, $acao, $parametros);
            return;
        }

        $this->responder404();
    }

    /**
     * Compara um caminho de rota (que pode ter {parametros}) com o
     * URI real do pedido. Devolve os parâmetros extraídos, ou null
     * se não corresponder.
     *
     * Exemplo: '/admin/membros/{id}' contra '/admin/membros/42'
     *          -> ['id' => '42']
     */
    private function combinar(string $caminhoRota, string $uri): ?array
    {
        $nomesParametros = [];
        $padrao = preg_replace_callback(
            '#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#',
            function ($m) use (&$nomesParametros) {
                $nomesParametros[] = $m[1];
                return '([^/]+)';
            },
            $caminhoRota
        );
        $padrao = '#^' . $padrao . '$#';

        if (!preg_match($padrao, $uri, $valores)) {
            return null;
        }

        array_shift($valores); // remove o match completo, sobram só os grupos
        return array_combine($nomesParametros, $valores);
    }

    private function chamarController(string $controllerClasse, string $acao, array $parametros): void
    {
        if (!class_exists($controllerClasse)) {
            $this->responder500("Controller não encontrado: {$controllerClasse}");
            return;
        }

        $controller = new $controllerClasse();

        if (!method_exists($controller, $acao)) {
            $this->responder500("Ação não encontrada: {$controllerClasse}::{$acao}()");
            return;
        }

        // Chama o método passando os parâmetros extraídos do URI
        // (ex: 'id' de /admin/membros/{id}) na ordem em que aparecem.
        $controller->$acao(...array_values($parametros));
    }

    /**
     * Verifica se o utilizador atual tem uma das roles permitidas.
     * Usa o RoleMiddleware já existente em app/Middleware.
     */
    private function autorizado(array $rolesPermitidas): bool
    {
        $middleware = new RoleMiddleware();
        foreach ($rolesPermitidas as $role) {
            if ($middleware->handle($role)) {
                return true;
            }
        }
        return false;
    }

    private function limparUri(string $uri): string
    {
        $caminho = parse_url($uri, PHP_URL_PATH) ?? '/';
        // remove barra final (exceto na home '/'), para '/sobre/' == '/sobre'
        if ($caminho !== '/' && str_ends_with($caminho, '/')) {
            $caminho = rtrim($caminho, '/');
        }
        return $caminho;
    }

    private function responder404(): void
    {
        http_response_code(404);
        $vistaPersonalizada = __DIR__ . '/../Views/publica/404.php';
        if (file_exists($vistaPersonalizada)) {
            require $vistaPersonalizada;
        } else {
            echo '<h1>404 — Página não encontrada</h1>';
        }
    }

    private function responder403(): void
    {
        http_response_code(403);
        echo '<h1>403 — Não tens permissão para aceder a esta página</h1>';
    }

    private function responder500(string $mensagem): void
    {
        http_response_code(500);
        if (getenv('APP_ENV') === 'local') {
            echo '<h1>500 — Erro interno</h1><p>' . htmlspecialchars($mensagem) . '</p>';
        } else {
            echo '<h1>500 — Erro interno</h1>';
        }
    }
}
