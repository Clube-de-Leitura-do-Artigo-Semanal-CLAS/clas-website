# Como contribuir

## Fluxo de branches

Usamos três níveis:

```
main                 <- produção. Protegida. Só recebe merge vindo de develop.
 └── develop         <- integração. É aqui que juntamos o trabalho de todos antes de ir para produção.
      └── feature/*  <- uma branch por tarefa. É aqui que trabalhas no dia a dia.
```

### Regra simples

**Nunca trabalhes diretamente em `main` nem em `develop`.** Cria sempre uma branch nova a partir de `develop`:

```bash
git checkout develop
git pull
git checkout -b feature/numero-da-tarefa-nome-curto
```

Exemplos, seguindo a numeração do Project:

- `feature/2.1-modelo-membro`
- `feature/2.2-maquina-de-estados`
- `feature/3.6-area-membros-card`
- `feature/3.10-admin-presencas`

Quando terminares, abre um **Pull Request** de `feature/...` para `develop` (nunca direto para `main`). Alguém da equipa revê antes do merge.

Quando `develop` estiver estável e testado, fazemos merge de `develop` para `main` — isso é o que vai para o site ao vivo.

### Porquê este fluxo, e não só uma branch

Sem isto, um erro de alguém a meio de uma tarefa (ex: mexer na máquina de estados) pode partir o site que já está no ar para os membros. Com `develop` no meio, há sempre uma versão "produção" estável, protegida do trabalho em curso.

## Mensagens de commit

Formato:

```
<tipo>: <descrição curta em português>

[corpo opcional, só se precisar de mais contexto]
```

Tipos usados neste projeto: `feat` (funcionalidade nova), `fix` (correção), `docs` (documentação), `chore` (configuração/estrutura), `refactor`.

Exemplos:

```
feat: adiciona modelo Membro com estado ativo/em risco/inativo/fantasma
fix: corrige cálculo da janela de 45 dias na máquina de estados
docs: adiciona README explicando pasta app/Services
```

## Antes de abrir um Pull Request

- Confirma que o código corre localmente sem erros
- Se mexeste em `app/Services/EstadoMembroService.php`, revê se as janelas de tempo (45/60/90 dias) continuam corretas — é a lógica mais sensível do projeto
- Descreve no PR a que tarefa do Project corresponde (ex: "Resolve #2.4 — Sistema de roles e permissões")
