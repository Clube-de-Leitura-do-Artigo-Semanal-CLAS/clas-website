# app/

Todo o código PHP fica aqui, **fora** de `public/` — nada nesta pasta é
acessível diretamente por URL, só através do front controller
(`public/index.php`).

## Organização

```
Controllers/   -> recebem o pedido, chamam Services/Models, devolvem uma View
Models/        -> representam as tabelas da base de dados (Membro, Presenca, etc.)
Services/      -> lógica de negócio isolada (máquina de estados, troféus, QR, integração KwiZ)
Jobs/          -> tarefas que correm sozinhas, fora de um pedido HTTP (ex: cron diário)
Middleware/    -> código que corre antes do Controller (ex: verificar role)
Views/         -> templates PHP que geram o HTML
```

## Regra importante

**Os Controllers não devem ter lógica de negócio.** Se estás a escrever
um `if` que decide se um membro está "ativo" ou "fantasma", isso pertence a
`Services/EstadoMembroService.php`, não ao Controller. Isto mantém a lógica
sensível (as janelas de 45/60/90 dias, por exemplo) num único sítio,
testável, em vez de espalhada por vários ficheiros.

## Correspondência com o documento de visão

- `Controllers/Publica/` → camada Pública do documento de visão
- `Controllers/Membros/` → camada Membros
- `Controllers/Admin/` → camada Admin

Cada uma dessas pastas tem o seu próprio README com a lista de tarefas
correspondentes no GitHub Project.
