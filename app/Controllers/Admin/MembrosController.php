<?php

namespace App\Controllers\Admin;

class MembrosController
{
    public function index(): void
    {
        $paginaAtual = max(1, (int)($_GET['page'] ?? 1));

        $porPagina = (int)($_GET['limit'] ?? 10);
        if (!in_array($porPagina, [10, 20, 50])) $porPagina = 10;

        $termoPesquisa = trim($_GET['search'] ?? '');

        $rolesValidas   = ['membro', 'coordenadora', 'rececao', 'admin'];
        // Valores exactos do ENUM estado_membro na base de dados Postgres
        $estadosValidos = ['ativo', 'em risco', 'fantasma', 'inativo'];
        $filtroRole   = in_array($_GET['role']   ?? '', $rolesValidas)   ? $_GET['role']   : '';
        $filtroEstado = in_array($_GET['estado'] ?? '', $estadosValidos) ? $_GET['estado'] : '';

        $colunasPermitidas = ['id', 'nome', 'numero_processo', 'email', 'criado_em'];
        $sortColuna = in_array($_GET['sort'] ?? '', $colunasPermitidas) ? $_GET['sort'] : 'id';
        $sortDir    = strtolower($_GET['dir'] ?? 'desc') === 'asc' ? 'asc' : 'desc';

        $resultado    = \App\Models\Membro::obterTodosPaginado($paginaAtual, $porPagina, $termoPesquisa, $filtroRole, $filtroEstado, $sortColuna, $sortDir);
        $membros      = $resultado['dados'];
        $totalMembros = $resultado['total'];
        $totalPaginas = max(1, (int)ceil($totalMembros / $porPagina));

        require __DIR__ . '/../../Views/admin/membros.php';
    }


    public function getDados(): void
    {
        header('Content-Type: application/json');
        try {
            $paginaAtual = max(1, (int)($_GET['page'] ?? 1));

            $porPagina = (int)($_GET['limit'] ?? 10);
            if (!in_array($porPagina, [10, 20, 50])) $porPagina = 10;

            $termoPesquisa = trim($_GET['search'] ?? '');

            $rolesValidas   = ['membro', 'coordenadora', 'rececao', 'admin'];
            // Valores exactos do ENUM estado_membro na base de dados Postgres
            $estadosValidos = ['ativo', 'em risco', 'fantasma', 'inativo'];
            $filtroRole   = in_array($_GET['role']   ?? '', $rolesValidas)   ? $_GET['role']   : '';
            $filtroEstado = in_array($_GET['estado'] ?? '', $estadosValidos) ? $_GET['estado'] : '';

            $colunasPermitidas = ['id', 'nome', 'numero_processo', 'email', 'criado_em'];
            $sortColuna = in_array($_GET['sort'] ?? '', $colunasPermitidas) ? $_GET['sort'] : 'id';
            $sortDir    = strtolower($_GET['dir'] ?? 'desc') === 'asc' ? 'asc' : 'desc';

            $resultado    = \App\Models\Membro::obterTodosPaginado($paginaAtual, $porPagina, $termoPesquisa, $filtroRole, $filtroEstado, $sortColuna, $sortDir);
            $totalPaginas = max(1, (int)ceil($resultado['total'] / $porPagina));

            $dados = array_map(fn($m) => (array)$m, $resultado['dados']);

            echo json_encode([
                'sucesso'      => true,
                'membros'      => $dados,
                'total'        => $resultado['total'],
                'paginaAtual'  => $paginaAtual,
                'totalPaginas' => $totalPaginas,
            ]);
        } catch (\Throwable $e) {
            http_response_code(500);
            // Nunca expor erros internos ou SQL ao utilizador
            error_log('[MembrosController::getDados] ' . $e->getMessage());
            echo json_encode(['sucesso' => false, 'erro' => 'Ocorreu um erro interno. Por favor tenta novamente.']);
        }
    }

    public function show(string $id): void
    {
        $idMembro = (int) $id;
        if ($idMembro <= 0) {
            header('Location: /admin/membros');
            exit;
        }

        $membro = \App\Models\Membro::obterPorId($idMembro);

        if (!$membro) {
            header('Location: /admin/membros?erro=nao_encontrado');
            exit;
        }

        require __DIR__ . '/../../Views/admin/membro_detalhe.php';
    }

    public function updateRole(): void
    {
        // Lê os dados JSON enviados no corpo do pedido
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['id']) || !isset($input['role'])) {
            http_response_code(400);
            echo json_encode(['sucesso' => false, 'erro' => 'Dados inválidos.']);
            return;
        }

        $id = (int) $input['id'];
        $role = $input['role'];

        // Validar se a role faz parte dos roles permitidos
        $rolesPermitidas = \App\Models\Role::todos();
        if (!in_array($role, $rolesPermitidas)) {
            http_response_code(400);
            echo json_encode(['sucesso' => false, 'erro' => 'Role inválida.']);
            return;
        }

        $sucesso = \App\Models\Membro::atualizarRole($id, $role);

        if ($sucesso) {
            echo json_encode(['sucesso' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['sucesso' => false, 'erro' => 'Erro ao atualizar na base de dados.']);
        }
    }

    public function updateInline(): void
    {
        header('Content-Type: application/json');
        
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['id'])) {
            http_response_code(400);
            echo json_encode(['sucesso' => false, 'erro' => 'ID não fornecido.']);
            return;
        }

        $id = (int) $input['id'];
        unset($input['id']); // Remove o ID dos dados a atualizar

        if (empty($input)) {
            echo json_encode(['sucesso' => true, 'mensagem' => 'Nenhum dado para atualizar.']);
            return;
        }

        try {
            $sucesso = \App\Models\Membro::atualizarInline($id, $input);
            if ($sucesso) {
                echo json_encode(['sucesso' => true]);
            } else {
                http_response_code(500);
                echo json_encode(['sucesso' => false, 'erro' => 'Erro ao atualizar na base de dados.']);
            }
        } catch (\Throwable $e) {
            http_response_code(500);
            error_log('[MembrosController::updateInline] ' . $e->getMessage());
            echo json_encode(['sucesso' => false, 'erro' => 'Ocorreu um erro interno.']);
        }
    }
}
