# Services

Lógica de negócio isolada dos Controllers. Aqui é onde vive a parte mais
sensível do projeto — trata com cuidado.

- `EstadoMembroService.php` (2.2)
  Implementa a máquina de estados definida no documento de visão:

  | Janela sem atividade | Estado    |
  |-----------------------|-----------|
  | 0–45 dias             | Ativo     |
  | 45–60 dias            | Em risco  |
  | 60 dias–3 meses       | Inativo   |
  | 3+ meses              | Fantasma  |

  Reativação é automática: uma participação em qualquer uma das 3 frentes
  (debate, evento, kwiz) volta o estado para "Ativo" imediatamente.
  NÃO precisa de ação da coordenadora nem da receção.

- `QrCodeService.php` (2.5) — gera o QR code de cada membro e resolve a
  leitura de volta para o card certo

- `KwizIntegrationService.php` (2.6) — recebe os relatórios de turma que o
  KwiZ envia via API (ver routes/api.php) e regista como atividade do
  membro para efeitos de EstadoMembroService

- `TrofeuService.php` (2.7) — regras automáticas: melhor resultado num
  Kwiz, presença em todos os debates de um período. Lista final ainda em
  aberto com a equipa — ver docs/CLAS_Site_Visao_Colaborativa.pdf

Se mexeres em EstadoMembroService.php, testa manualmente os limites
exatos (dia 45, dia 60, dia 90) — são a lógica mais fácil de partir com
um erro de "off by one".
