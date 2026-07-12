<?php

namespace App\Services;

/**
 * Fornece os dados dos membros para a camada pública.
 *
 * PROVISÓRIO: por agora lê de docs/membros.json (gerado do CLASID.xlsx).
 * Quando a tabela `membros` do Supabase estiver populada, trocar apenas o
 * método todos() para consultar a BD — o resto do código não muda, porque
 * já usa os mesmos nomes de campos da tabela (nome_passe, numero_processo,
 * estado, leituras...).
 *
 * VER TAREFA: "Migrar lista de membros do JSON para a base de dados".
 *
 * PRIVACIDADE: a view pública mostra apenas o `nome_passe` (nome curto de
 * exibição), nunca o nome completo do membro.
 */
class MembroExemploService
{
    private static ?array $cache = null;

    private static function caminhoJson(): string
    {
        return __DIR__ . '/../../docs/membros.json';
    }

    private static function caminhoExcel(): string
    {
        return __DIR__ . '/../../docs/CLASID.xlsx';
    }

    /**
     * Devolve todos os membros.
     *
     * PARA MIGRAR PARA A BD: substituir o corpo deste método por algo como
     *
     *   $pdo = Database::getInstance();
     *   $stmt = $pdo->query("SELECT numero_processo, nome_passe, estado,
     *                               leituras, debates, eventos
     *                        FROM membros ORDER BY numero_processo");
     *   return $stmt->fetchAll(\PDO::FETCH_ASSOC);
     *
     * O resto da aplicação continua a funcionar sem alterações.
     */
    public static function todos(): array
    {
        if (self::$cache !== null) {
            return self::$cache;
        }

        $json = self::caminhoJson();

        if (!file_exists($json) && file_exists(self::caminhoExcel())) {
            self::gerarJsonDoExcel();
        }

        if (!file_exists($json)) {
            self::$cache = [];
            return self::$cache;
        }

        $dados = json_decode(file_get_contents($json), true);
        self::$cache = is_array($dados) ? $dados : [];
        return self::$cache;
    }

    /** Procura por número de processo (ex: CLAS0042). */
    public static function buscar(string $id): ?array
    {
        foreach (self::todos() as $membro) {
            if (($membro['numero_processo'] ?? null) === $id) {
                return $membro;
            }
        }
        return self::todos()[$id] ?? null;
    }

    /**
     * Lê docs/CLASID.xlsx e escreve docs/membros.json.
     * Gera o nome_passe (primeiro + último nome) a partir do nome completo:
     * o nome completo NÃO é guardado, só o nome de exibição.
     */
    public static function gerarJsonDoExcel(): bool
    {
        $excel = self::caminhoExcel();
        if (!file_exists($excel)) {
            return false;
        }
        if (!class_exists(\PhpOffice\PhpSpreadsheet\IOFactory::class)) {
            return false;
        }

        $planilha = \PhpOffice\PhpSpreadsheet\IOFactory::load($excel);
        $linhas = $planilha->getActiveSheet()->toArray(null, true, true, true);

        $cabecalhos = array_shift($linhas);
        $letraId = null; $letraNome = null;
        foreach ($cabecalhos as $letra => $titulo) {
            $t = trim((string)$titulo);
            if ($t === 'ID CLAS')       $letraId = $letra;
            if ($t === 'Nome completo') $letraNome = $letra;
        }
        if ($letraId === null || $letraNome === null) {
            return false;
        }

        $membros = [];
        $i = 1;
        foreach ($linhas as $linha) {
            $id   = trim((string)($linha[$letraId] ?? ''));
            $nome = trim((string)($linha[$letraNome] ?? ''));
            if ($nome === '' || mb_strtolower($nome) === 'reservado') {
                continue;
            }
            $membros[(string)$i] = [
                'numero_processo' => $id !== '' ? $id : 'CLAS' . str_pad((string)$i, 4, '0', STR_PAD_LEFT),
                'nome_passe'      => self::nomePasse($nome),
                'iniciais'        => self::iniciais($nome),
                'estado'          => 'ativo',
                'leituras'        => 0,
                'debates'         => 0,
                'eventos'         => 0,
                'ultimo'          => '',
                'membro_desde'    => '',
                'objetivo'        => '',
                'trofeus'         => [],
                'historico'       => [],
                'resenhas'        => [],
            ];
            $i++;
        }

        file_put_contents(
            self::caminhoJson(),
            json_encode($membros, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
        return true;
    }

    /** "Romão Gando Domingos" -> "Romão Domingos" (nome de exibição público). */
    private static function nomePasse(string $nomeCompleto): string
    {
        $partes = array_values(array_filter(preg_split('/\s+/', trim($nomeCompleto))));
        if (count($partes) <= 2) {
            return implode(' ', $partes);
        }
        return $partes[0] . ' ' . end($partes);
    }

    /** "Ana Ferreira" -> "AF" */
    private static function iniciais(string $nome): string
    {
        $partes = array_values(array_filter(preg_split('/\s+/', trim($nome))));
        if (empty($partes)) return '?';
        $primeira = mb_substr($partes[0], 0, 1);
        $ultima = count($partes) > 1 ? mb_substr(end($partes), 0, 1) : '';
        return mb_strtoupper($primeira . $ultima);
    }
}
