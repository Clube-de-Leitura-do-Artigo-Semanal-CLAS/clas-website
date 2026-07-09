<?php
/**
 * Converte docs/CLASID.xlsx  ->  docs/membros.json
 *
 * COMO USAR:
 *   1. Coloca o ficheiro CLASID.xlsx em  docs/CLASID.xlsx
 *   2. Corre:  php scripts/gerar_membros_json.php
 *   3. O ficheiro docs/membros.json é criado/atualizado automaticamente.
 *
 * Precisa da biblioteca PhpSpreadsheet:
 *   composer require phpoffice/phpspreadsheet
 *
 * -------------------------------------------------------------------------
 * O CLASID.xlsx tem 2 colunas: "ID CLAS" e "Nome completo".
 * Linhas com nome "Reservado" (IDs guardados sem membro) são ignoradas.
 * Os campos de atividade (leituras, debates, troféus...) ficam a zero —
 * virão do KwiZ e da base de dados mais tarde, não do Excel.
 * -------------------------------------------------------------------------
 */

require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Nomes EXATOS das colunas no Excel (1ª linha)
$COL_ID   = 'ID CLAS';
$COL_NOME = 'Nome completo';

$ENTRADA = __DIR__ . '/../docs/CLASID.xlsx';
$SAIDA   = __DIR__ . '/../docs/membros.json';

if (!file_exists($ENTRADA)) {
    fwrite(STDERR, "ERRO: não encontrei docs/CLASID.xlsx\n");
    fwrite(STDERR, "Coloca o ficheiro em docs/CLASID.xlsx e corre outra vez.\n");
    exit(1);
}

$planilha = IOFactory::load($ENTRADA);
$folha = $planilha->getActiveSheet();
$linhas = $folha->toArray(null, true, true, true);

// Descobrir as letras das colunas a partir dos cabeçalhos (1ª linha)
$cabecalhos = array_shift($linhas);
$letraId = null; $letraNome = null;
foreach ($cabecalhos as $letra => $titulo) {
    $t = trim((string)$titulo);
    if ($t === $COL_ID)   $letraId = $letra;
    if ($t === $COL_NOME) $letraNome = $letra;
}
if ($letraId === null || $letraNome === null) {
    fwrite(STDERR, "ERRO: não encontrei as colunas '$COL_ID' e/ou '$COL_NOME'.\n");
    fwrite(STDERR, "Colunas encontradas: " . implode(', ', array_map('trim', $cabecalhos)) . "\n");
    exit(1);
}

// "Ana Ferreira" -> "AF"  (primeiro + último nome)
function iniciais(string $nome): string {
    $partes = array_values(array_filter(preg_split('/\s+/', trim($nome))));
    if (empty($partes)) return '?';
    $primeira = mb_substr($partes[0], 0, 1);
    $ultima = count($partes) > 1 ? mb_substr(end($partes), 0, 1) : '';
    return mb_strtoupper($primeira . $ultima);
}

$membros = [];
$indice = 1;
$ignorados = 0;
foreach ($linhas as $linha) {
    $id   = trim((string)($linha[$letraId] ?? ''));
    $nome = trim((string)($linha[$letraNome] ?? ''));

    // saltar vazios e IDs reservados (ainda sem membro)
    if ($nome === '' || mb_strtolower($nome) === 'reservado') {
        $ignorados++;
        continue;
    }

    $membros[(string)$indice] = [
        'processo'     => $id !== '' ? $id : 'CLAS' . str_pad((string)$indice, 4, '0', STR_PAD_LEFT),
        'nome'         => $nome,
        'iniciais'     => iniciais($nome),
        'estado'       => 'ativo',   // recalculado pela app; default aqui
        'leituras'     => 0,         // virão do KwiZ/BD
        'debates'      => 0,
        'eventos'      => 0,
        'ultimo'       => '',
        'membro_desde' => '',
        'objetivo'     => '',
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
echo "  (" . $ignorados . " linhas ignoradas: reservadas ou vazias)\n";
