# clas-website

Website do CLAS (Clube de Leitura do Artigo Semanal) — três camadas de acesso:
pública, membros e admin.

> Antes de mexer em código, lê o documento de visão em `docs/CLAS_Site_Visao_Colaborativa.pdf`.
> Ele explica o "porquê" de cada coisa aqui dentro.

## Stack

- PHP puro (sem framework) — MVC simples
- MySQL
- HTML/CSS/JS no frontend, sem build step

## Estrutura

```
public/       -> única pasta exposta ao browser (document root do servidor aponta aqui)
app/          -> todo o código PHP, fora do alcance direto de URLs
  Controllers/ -> um subpasta por camada: Publica, Membros, Admin
  Models/      -> uma classe por tabela
  Services/    -> lógica de negócio (ex: cálculo de estado do membro)
  Jobs/        -> tarefas que correm por cron
  Middleware/  -> verificações antes das rotas (ex: role)
  Views/       -> templates PHP
config/        -> configuração (BD, roles, links externos)
database/      -> migrations e seeds
routes/        -> mapeamento URL -> Controller
cron/          -> scripts chamados pelo crontab do servidor
docs/          -> documento de visão + diagramas
```

## Branches

- `main` — produção. Protegida, só recebe merge via Pull Request.
- `develop` — integração. É para aqui que todas as features vão primeiro.
- `feature/<nome-curto>` — uma branch por tarefa do GitHub Project.
  Exemplo: tarefa "2.2 — Implementar máquina de estados" -> branch `feature/2.2-maquina-estados`

Fluxo: cria a tua branch a partir de `develop`, faz o teu trabalho, abre PR para `develop`.
Quando `develop` estiver estável, fazemos merge para `main`.

## Como correr localmente

Precisas de **PHP 8.1+** e do **Composer**.

```bash
git clone https://github.com/Clube-de-Leitura-do-Artigo-Semanal-CLAS/clas-website.git
cd clas-website
composer install
cp .env.example .env          # no Windows: copy .env.example .env
php -S localhost:8000 -t public
```

Depois abre `http://localhost:8000`. O `-t public` é obrigatório — a pasta
`public/` é o único ponto de entrada do site.

> **Setup detalhado** (instalar Composer, extensões de PHP por sistema
> operativo, obter o `CLASID.xlsx` para a página de membros): ver
> [`CONTRIBUTING.md`](CONTRIBUTING.md).

## Tarefas

Todas as tarefas estão organizadas no GitHub Project "Website do CLAS", agrupadas
por Fase e Área. Esta estrutura de pastas reflete diretamente essas tarefas —
cada Controller/Service tem o número da tarefa correspondente no comentário do topo.
