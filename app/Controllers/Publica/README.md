# Controllers/Publica

Camada pública do site — visitantes, sem login.
Corresponde às tarefas 3.1 a 3.4 do Project.

Controllers a criar aqui:

- `HomeController.php` — home, sobre nós, ação de inscrição, destaques, galeria (3.1)
- `LeitoresController.php` — lista de leitores e melhores leitores (3.2)
- `ConcursoController.php` — Concurso literário MwangoLê (3.3)
  (nota: "Try o Kwiz" não é um Controller — é um link direto para o KwiZ,
  ver config/links_externos.php)
- `ParceirosController.php` — secção Parceiros + Contacte-nos (3.4)

A Clásia (recomendações via WhatsApp) também é só um link embutido, não
lógica própria — ver config/links_externos.php.
