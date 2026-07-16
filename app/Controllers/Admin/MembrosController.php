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
        $estadosValidos = ['ativo', 'em_risco', 'inativo', 'adormecido'];
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
            $estadosValidos = ['ativo', 'em_risco', 'inativo', 'adormecido'];
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
            echo json_encode(['sucesso' => false, 'erro' => $e->getMessage()]);
        }
    }

    public function show(string $id): void
    {
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
}
