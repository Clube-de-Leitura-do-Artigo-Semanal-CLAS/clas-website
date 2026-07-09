# Como contribuir

## Pôr o projeto a correr (primeira vez)

O CLAS é PHP puro. Precisas de **PHP 8.1+** e do **Composer**. Segue os passos do teu sistema.

### 1. Instalar o Composer (se ainda não tiveres)

**Linux / Mac:**
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
sudo mv composer.phar /usr/local/bin/composer
rm composer-setup.php
```

**Windows:**
Baixa e corre o instalador oficial: https://getcomposer.org/Composer-Setup.exe
(ele deteta o PHP sozinho). Depois **fecha e reabre** o terminal.

Confirma: `composer --version`

### 2. Instalar as extensões do PHP necessárias

O projeto lê ficheiros Excel (lista de membros), o que precisa de algumas extensões.

**Linux (Ubuntu/Debian) — ajusta o número à tua versão de PHP (ex: 8.3):**
```bash
sudo apt update
sudo apt install php8.3-dom php8.3-gd php8.3-mbstring php8.3-xml php8.3-zip php8.3-curl php8.3-pgsql
```

**Mac (Homebrew):** já vêm incluídas no `brew install php`.

**Windows:** abre o `php.ini` e tira o `;` do início destas linhas:
`extension=gd`, `extension=mbstring`, `extension=zip`, `extension=curl`, `extension=fileinfo`.
(No XAMPP costumam já vir ativas.)

### 3. Clonar e instalar dependências

```bash
git clone https://github.com/Clube-de-Leitura-do-Artigo-Semanal-CLAS/clas-website.git
cd clas-website
composer install
```

### 4. Criar o ficheiro de ambiente

**Linux / Mac:**
```bash
cp .env.example .env
```

**Windows (PowerShell):**
```powershell
copy .env.example .env
```

### 5. Arrancar o servidor local

```bash
php -S localhost:8000 -t public
```

Abre `http://localhost:8000` no browser.
Se a porta 8000 estiver ocupada, usa outra (ex: `php -S localhost:8080 -t public`).

> **Importante:** o `-t public` é obrigatório. A pasta `public/` é o único ponto de entrada
> do site (onde está o `index.php`). Se apontares o servidor para a raiz do projeto,
> nada funciona.

### 6. (Só para a página de Membros) colocar o Excel

A lista de membros lê de `docs/CLASID.xlsx`, que **não está no Git** (tem nomes reais).
Pede o ficheiro a um coordenador e coloca-o em `docs/CLASID.xlsx`.
A app gera o resto sozinha na primeira vez que abres `/membros` — não precisas de correr nada.

Se a lista vier vazia, força a geração uma vez:
```bash
php scripts/gerar_membros_json.php
```

### Já tens o projeto? Só atualizar

```bash
git checkout integracao/juntar-prs-frontend
git pull origin integracao/juntar-prs-frontend
composer install
```

---


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
