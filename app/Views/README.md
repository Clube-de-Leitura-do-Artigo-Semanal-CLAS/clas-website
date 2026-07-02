# Views

Templates PHP que geram o HTML final — usa PHP puro dentro de HTML
(sem template engine, para manter a stack simples).

- `publica/` — templates da camada pública
- `membros/` — templates da área autenticada
- `admin/` — templates do painel de gestão

Mantém lógica fora daqui: uma View só deve mostrar dados que já vêm
prontos do Controller, sem fazer cálculos nem chamadas à base de dados.
