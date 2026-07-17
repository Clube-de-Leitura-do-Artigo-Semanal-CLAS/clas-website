<?php

namespace App\Models;

class Membro
{
    public int $id;
    public ?string $user_id;      
    public string $numero_processo;
    public string $qr_code;
    public string $estado; 
    public ?string $objetivos_entrada;
    public string $nome;
    public ?string $nome_passe;
    public string $role; 
    public string $email;
    public ?string $telefone;
    public ?string $telefone_alternativo;
    public ?string $data_nascimento;
    public ?string $motivo_entrada;
    public ?string $como_conheceu_clas;
    public ?string $data_inscricao;
    public string $criado_em;

    public static function obterTodosPaginado(
        int $pagina = 1,
        int $porPagina = 10,
        string $termoPesquisa = '',
        string $filtroRole = '',
        string $filtroEstado = '',
        string $sortColuna = 'id',
        string $sortDir = 'desc'
    ): array {
        $pdo = \App\Services\Database::getInstance();
        $offset = ($pagina - 1) * $porPagina;

        $colunasPermitidas = ['id', 'nome', 'numero_processo', 'email', 'criado_em'];
        $dirsPermitidas    = ['asc', 'desc'];

        $sortColuna = in_array($sortColuna, $colunasPermitidas) ? $sortColuna : 'id';
        $sortDir    = in_array(strtolower($sortDir), $dirsPermitidas) ? strtoupper($sortDir) : 'DESC';

        $condicoes = [];
        $params    = [];

        if (!empty($termoPesquisa)) {
            $condicoes[] = "(nome ILIKE :search OR email ILIKE :search OR numero_processo ILIKE :search)";
            $params[':search'] = '%' . $termoPesquisa . '%';
        }

        if (!empty($filtroRole)) {
            $condicoes[] = "role = :role";
            $params[':role'] = $filtroRole;
        }

        if (!empty($filtroEstado)) {
            $condicoes[] = "estado = :estado";
            $params[':estado'] = $filtroEstado;
        }

        $whereClause = !empty($condicoes) ? 'WHERE ' . implode(' AND ', $condicoes) : '';

        // --- Query de contagem ---
        $stmtTotal = $pdo->prepare("SELECT COUNT(*) FROM membros {$whereClause}");
        foreach ($params as $key => $val) {
            $stmtTotal->bindValue($key, $val);
        }
        $stmtTotal->execute();
        $total = (int) $stmtTotal->fetchColumn();

        $sql  = "SELECT * FROM membros {$whereClause} ORDER BY {$sortColuna} {$sortDir} LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->bindValue(':limit',  $porPagina, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset,    \PDO::PARAM_INT);
        $stmt->execute();

        $dados = $stmt->fetchAll(\PDO::FETCH_CLASS, self::class);

        return [
            'dados' => $dados,
            'total' => $total,
        ];
    }


    public static function atualizarRole(int $id, string $novaRole): bool
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("UPDATE membros SET role = :role WHERE id = :id");
        $stmt->bindValue(':role', $novaRole);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function obterPorUserId(string $userId): ?Membro
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM membros WHERE user_id = :user_id");
        $stmt->bindValue(':user_id', $userId);
        $stmt->execute();
        
        $membro = $stmt->fetchObject(self::class);
        return $membro ?: null;
    }

    public static function obterPorId(int $id): ?Membro
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM membros WHERE id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        
        $membro = $stmt->fetchObject(self::class);
        return $membro ?: null;
    }

    public static function atualizarInline(int $id, array $dados): bool
    {
        if (empty($dados)) return true;

        $pdo = \App\Services\Database::getInstance();
        $campos = [];
        $params = [];

        // Whitelist de campos que podem ser editados desta forma (idade removida, não é coluna)
        $camposPermitidos = ['nome', 'email', 'telefone', 'telefone_alternativo', 'data_nascimento', 'numero_processo', 'role', 'estado', 'nome_passe', 'objetivos_entrada', 'como_conheceu_clas', 'motivo_entrada'];

        foreach ($dados as $campo => $valor) {
            if (in_array($campo, $camposPermitidos)) {
                $campos[] = "{$campo} = :{$campo}";
                $params[":{$campo}"] = $valor === '' ? null : $valor;
            }
        }

        if (empty($campos)) return false;

        $setSql = implode(', ', $campos);
        $params[':id'] = $id;

        $stmt = $pdo->prepare("UPDATE membros SET {$setSql} WHERE id = :id");
        foreach ($params as $chave => $valor) {
            $stmt->bindValue($chave, $valor);
        }

        return $stmt->execute();
    }
    public static function obterPorEmailOuIdClas(string $identificador): ?Membro
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM membros WHERE email = :identificador OR numero_processo = :identificador LIMIT 1");
        $stmt->bindValue(':identificador', $identificador);
        $stmt->execute();
        
        $membro = $stmt->fetchObject(self::class);
        return $membro ?: null;
    }

    public static function vincularUsuarioAuth(int $id, string $uuid): bool
    {
        $pdo = \App\Services\Database::getInstance();
        $stmt = $pdo->prepare("UPDATE membros SET user_id = :uuid WHERE id = :id");
        $stmt->bindValue(':uuid', $uuid);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
