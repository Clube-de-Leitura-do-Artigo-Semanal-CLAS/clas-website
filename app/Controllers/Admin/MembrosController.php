<?php

namespace App\Controllers\Admin;

class MembrosController
{
    public function index(): void
    {
        $paginaAtual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($paginaAtual < 1) {
            $paginaAtual = 1;
        }
        
        $porPagina = 10;
        
        // Vai buscar os membros e o total à BD
        $resultado = \App\Models\Membro::obterTodosPaginado($paginaAtual, $porPagina);
        $membros = $resultado['dados'];
        $totalMembros = $resultado['total'];
        
        // Calcular o número total de páginas
        $totalPaginas = ceil($totalMembros / $porPagina);

        require __DIR__ . '/../../Views/admin/membros.php';
    }

    public function show(string $id): void
    {
        require __DIR__ . '/../../Views/admin/membro_detalhe.php';
    }

    /**
     * Endpoint para atualizar a role de um membro via AJAX (JSON).
     */
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
