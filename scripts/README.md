# scripts/

## gerar_membros_json.php

Converte `docs/CLASID.xlsx` → `docs/membros.json` (o ficheiro que a
página de membros lê).

### Como usar
1. Coloca o teu ficheiro em `docs/CLASID.xlsx`
2. Corre: `php scripts/gerar_membros_json.php`
3. Pronto — `docs/membros.json` é gerado.

### Primeira vez? Instala a dependência
```
composer require phpoffice/phpspreadsheet
```

### Se as colunas do teu Excel tiverem outros nomes
Abre `gerar_membros_json.php` e ajusta o array `$MAPA` no topo — à
esquerda o campo do site, à direita o nome EXATO da coluna no Excel.

### Nota
Os campos de atividade (leituras, debates, eventos, troféus) ficam a
zero/vazios — esses dados virão do KwiZ e da base de dados mais tarde,
não do Excel. O Excel só fornece identidade (nome, processo, data).
