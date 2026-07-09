<?php
/**
 * Gera docs/membros.json a partir de docs/CLASID.xlsx.
 *
 * NOTA: já não precisas de correr isto à mão — a app gera o JSON
 * automaticamente na primeira vez que a página de membros abre
 * (ver App\Services\MembroExemploService::todos()).
 *
 * Este script existe para os casos em que queres forçar a
 * regeneração (ex: atualizaste o CLASID.xlsx e queres o JSON já).
 *
 * Uso:  php scripts/gerar_membros_json.php
 * Precisa de:  composer require phpoffice/phpspreadsheet
 */

require __DIR__ . '/../vendor/autoload.php';

// autoload simples das classes App\... (mesmo do public/index.php)
spl_autoload_register(function (string $classe) {
    if (!str_starts_with($classe, 'App\\')) return;
    $f = __DIR__ . '/../app/' . str_replace('\\', '/', substr($classe, 4)) . '.php';
    if (file_exists($f)) require $f;
});

use App\Services\MembroExemploService;

if (MembroExemploService::gerarJsonDoExcel()) {
    $total = count(MembroExemploService::todos());
    echo "✓ docs/membros.json gerado com {$total} membros.\n";
} else {
    fwrite(STDERR, "ERRO: não deu para gerar. Confirma que:\n");
    fwrite(STDERR, "  - docs/CLASID.xlsx existe\n");
    fwrite(STDERR, "  - phpoffice/phpspreadsheet está instalado (composer require phpoffice/phpspreadsheet)\n");
    exit(1);
}
