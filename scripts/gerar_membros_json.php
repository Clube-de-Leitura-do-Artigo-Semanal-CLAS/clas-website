<?php
/**
 * Converte docs/CLASID.xlsx  ->  docs/membros.json
 *
 * COMO USAR:
 *   1. Coloca o ficheiro CLASID.xlsx em  docs/CLASID.xlsx
 *   2. Corre:  php scripts/gerar_membros_json.php
 *   3. O ficheiro docs/membros.json é criado/atualizado automaticamente.
 *
 * Precisa da biblioteca PhpSpreadsheet. Se ainda não estiver instalada:
 *   composer require phpoffice/phpspreadsheet
 *
 * -------------------------------------------------------------------------
 * MAPEAMENTO DE COLUNAS
 * Ajusta o array $MAPA abaixo para bater com os nomes EXATOS das colunas
 * do teu Excel (primeira linha). À esquerda o campo do site, à direita o
 * nome da coluna no CLASID.xlsx. Se uma coluna não existir, mete null e o
 * script usa um valor por defeito.
 * -------------------------------------------------------------------------
 */

require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$MAPA = [
    'processo'     => 'ID',            // ex: coluna "ID" ou "Nº Processo"
    'nome'         => 'Nome',          // coluna "Nome"
    'membro_desde' => 'Data',          // coluna com a data de inscrição (opcional)
    'objetivo'     => 'Objetivo',      // opcional
];

$ENTRADA = __DIR__ . '/../docs/CLASID.xlsx';
$SAIDA   = __DIR__ . '/../docs/membros.json';

if (!file_exists($ENTRADA)) {
    fwrite(STDERR, "ERRO: não encontrei docs/CLASID.xlsx\n");
    fwrite(STDERR, "Coloca o ficheiro em docs/CLASID.xlsx e corre outra vez.\n");
    exit(1);
}

$planilha = IOFactory::load($ENTRADA);
$folha = $planilha->getActiveSheet();
$linhas = $folha->toArray(null, true, true, true); // A, B, C... como chaves

// 1ª linha = cabeçalhos. Descobrir que letra de coluna corresponde a cada nome.
$cabecalhos = array_shift($linhas);
$colDe = []; // nome_da_coluna => letra
foreach ($cabecalhos as $letra => $titulo) {
    if ($titulo !== null && trim((string)$titulo) !== '') {
        $colDe[trim((string)$titulo)] = $letra;
    }
}

// Função para gerar iniciais a partir do nome ("Ana Ferreira" -> "AF")
function iniciais(string $nome): string {
    $partes = preg_split('/\s+/', trim($nome));
    $partes = array_filter($partes);
    if (empty($partes)) return '?';
    $primeira = mb_substr($partes[0], 0, 1);
    $ultima = count($partes) > 1 ? mb_substr(end($partes), 0, 1) : '';
    return mb_strtoupper($primeira . $ultima);
}

function valor(array $linha, array $colDe, array $MAPA, string $campo, string $default = '') {
    $nomeColuna = $MAPA[$campo] ?? null;
    if ($nomeColuna === null || !isset($colDe[$nomeColuna])) {
        return $default;
    }
    $letra = $colDe[$nomeColuna];
    $v = $linha[$letra] ?? null;
    return ($v === null || trim((string)$v) === '') ? $default : trim((string)$v);
}

$membros = [];
$indice = 1;
foreach ($linhas as $linha) {
    $nome = valor($linha, $colDe, $MAPA, 'nome');
    if ($nome === '') {
        continue; // salta linhas vazias
    }

    $membros[(string)$indice] = [
        'processo'     => valor($linha, $colDe, $MAPA, 'processo', 'CLAS-' . str_pad((string)$indice, 4, '0', STR_PAD_LEFT)),
        'nome'         => $nome,
        'iniciais'     => iniciais($nome),
        'estado'       => 'ativo',   // será recalculado pela app; default aqui
        'leituras'     => 0,         // virá do KwiZ/BD mais tarde
        'debates'      => 0,
        'eventos'      => 0,
        'ultimo'       => '',        // último artigo lido
        'membro_desde' => valor($linha, $colDe, $MAPA, 'membro_desde', ''),
        'objetivo'     => valor($linha, $colDe, $MAPA, 'objetivo', ''),
        'trofeus'      => [],
        'historico'    => [],
        'resenhas'     => [],
    ];
    $indice++;
}

file_put_contents(
    $SAIDA,
    json_encode($membros, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
);

echo "✓ Gerado docs/membros.json com " . count($membros) . " membros.\n";
echo "  Colunas encontradas no Excel: " . implode(', ', array_keys($colDe)) . "\n";
