# Website do CLAS

Repositório do site do **CLAS — Clube de Leitura do Artigo Semanal**.

📄 Documento de visão completo: `docs/CLAS_Site_Visao_Colaborativa.pdf`
📋 Tarefas e progresso: [GitHub Project "Website do CLAS"](https://github.com/orgs/Clube-de-Leitura-do-Artigo-Semanal-CLAS/projects/2)

## Stack

- **Frontend:** HTML + CSS + JavaScript puro (sem framework, sem build step)
- **Backend:** PHP puro (sem framework — ver `app/` para a organização)
- **Base de dados:** a definir em `config/database.php`

## Estrutura do projeto

```
public/     -> única pasta exposta ao browser (document root do servidor)
app/        -> todo o código PHP (controllers, models, services), NÃO acessível via URL
config/     -> configurações (base de dados, roles, links externos)
database/   -> migrations e seeds
routes/     -> definição de rotas (públicas, membros, admin, api)
cron/       -> scripts para correr via crontab (ex: recalcular estado dos membros)
docs/       -> documento de visão e diagramas de referência
```

Cada subpasta tem o seu próprio `README.md` a explicar o que lá vai e a que tarefa do Project corresponde. **Lê o README da pasta antes de começares a trabalhar nela.**

## Como começar

1. Clona o repositório
2. Copia `.env.example` para `.env` e preenche os dados da tua base de dados local
3. Aponta o *document root* do teu servidor local (Apache/Nginx/`php -S`) para a pasta `public/`
4. Vê `CONTRIBUTING.md` para o fluxo de branches e commits

## Branches

Ver `CONTRIBUTING.md` para o fluxo completo. Resumo:

- `main` — produção, só recebe merge de `develop` já testado
- `develop` — integração, é para onde vão os *pull requests* de cada tarefa
- `feature/<nome-da-tarefa>` — uma branch por tarefa do Project, a partir de `develop`

## Dúvidas

Este repositório acompanha o documento de visão partilhado com a equipa. Qualquer decisão que mude o que está lá descrito (regras de estado, roles, troféus, etc.) deve ser discutida antes de ser implementada — o código deve seguir a visão acordada, não o contrário.
