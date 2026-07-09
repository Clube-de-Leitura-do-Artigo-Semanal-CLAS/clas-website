<?php

namespace App\Services;

/**
 * Fornece os dados dos membros a partir de docs/membros.json.
 *
 * AUTO-GERAÇÃO: se o membros.json não existir mas houver um
 * docs/CLASID.xlsx, o JSON é gerado automaticamente na primeira
 * vez que a página abre — não é preciso correr nenhum script à mão.
 *
 * PRIVACIDADE: nem o CLASID.xlsx nem o membros.json sobem para o
 * GitHub (estão no .gitignore). Cada máquina gera o seu localmente.
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

    public static function todos(): array
    {
        if (self::$cache !== null) {
            return self::$cache;
        }

        $json = self::caminhoJson();

        // Se o JSON não existe mas o Excel está presente, gera automaticamente.
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

    public static function buscar(string $id): ?array
    {
        $todos = self::todos();

        // Procura primeiro pelo nº de processo (ex: CLAS0042) — é o que os
        // links da lista usam. Como fallback, aceita também a chave numérica.
        foreach ($todos as $membro) {
            if (isset($membro['processo']) && $membro['processo'] === $id) {
                return $membro;
            }
        }

        return $todos[$id] ?? null;
    }

    /**
     * Lê docs/CLASID.xlsx e escreve docs/membros.json.
     * Usado pela auto-geração acima e pelo script CLI
     * scripts/gerar_membros_json.php (que chama este método).
     *
     * Precisa de phpoffice/phpspreadsheet. Se não estiver instalado,
     * falha em silêncio (a lista fica vazia até se instalar/gerar).
     */
    public static function gerarJsonDoExcel(): bool
    {
        $excel = self::caminhoExcel();
        if (!file_exists($excel)) {
            return false;
        }
        if (!class_exists(\PhpOffice\PhpSpreadsheet\IOFactory::class)) {
            // PhpSpreadsheet não instalado — não dá para gerar.
            return false;
        }

        $planilha = \PhpOffice\PhpSpreadsheet\IOFactory::load($excel);
        $linhas = $planilha->getActiveSheet()->toArray(null, true, true, true);

        // Descobrir colunas "ID CLAS" e "Nome completo" pela 1ª linha
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
                continue; // ignora vazios e IDs reservados
            }
            $membros[(string)$i] = [
                'processo'     => $id !== '' ? $id : 'CLAS' . str_pad((string)$i, 4, '0', STR_PAD_LEFT),
                'nome'         => $nome,
                'iniciais'     => self::iniciais($nome),
                'estado'       => 'ativo',
                'leituras'     => 0,
                'debates'      => 0,
                'eventos'      => 0,
                'ultimo'       => '',
                'membro_desde' => '',
                'objetivo'     => '',
                'trofeus'      => [],
                'historico'    => [],
                'resenhas'     => [],
            ];
            $i++;
        }

        file_put_contents(
            self::caminhoJson(),
            json_encode($membros, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
        return true;
    }

    /** "Ana Ferreira" -> "AF" (primeiro + último nome) */
    private static function iniciais(string $nome): string
    {
        $partes = array_values(array_filter(preg_split('/\s+/', trim($nome))));
        if (empty($partes)) return '?';
        $primeira = mb_substr($partes[0], 0, 1);
        $ultima = count($partes) > 1 ? mb_substr(end($partes), 0, 1) : '';
        return mb_strtoupper($primeira . $ultima);
    }
}
