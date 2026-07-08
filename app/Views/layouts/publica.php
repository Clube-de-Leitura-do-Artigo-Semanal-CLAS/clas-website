<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CLAS - Clube de leitura do artigo semanal </title>
<link rel="icon" href="assets/img/logo_clas2.png" type="image/png" />
<meta name="description" content="A maior plataforma angolana de livros, literatura e cultura. Descobre, lê e compra as melhores obras nacionais e internacionais." />
<meta name="keywords" content="livros Angola, literatura angolana, ebooks Angola, comprar livros, CLAS.AO" />
<meta property="og:title" content="CLAS.AO — Cultura, Leitura e Arte de Angola" />
<meta property="og:description" content="A maior plataforma angolana de livros, literatura e cultura." />
<meta property="og:type" content="website" />

<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          ink: '#1A1008',
          cream: '#FAF6F0',
          muted: '#7A6452'
        },
        fontFamily: {
          serif: ['"Playfair Display"', 'serif'],
          sans: ['Manrope', 'sans-serif']
        }
      }
    }
  }
</script>

<link rel="stylesheet" href="../../assets/css/main.css">
</head>
<body>

<div class="hero-bg">

  <header class="reveal reveal-0 relative z-30">
    <div class=" mx-auto px-6 md:px-10">
      <div class="flex items-center justify-between h-20 md:h-24">
        <a href="#" class="nav-logo">
          <img src="assets/img/logo_clas2.png" alt="CLAS" id="logo-img" />
        </a>
        <nav class="hidden lg:flex items-center gap-9 text-[13px] tracking-wide font-medium text-ink/80 lg:ml-24 xl:ml-32">
          <a href="#home" class="relative pb-1 text-ink after:content-[''] after:absolute after:left-0 after:-bottom-[2px] after:w-full after:h-[1px] after:bg-ink">HOME</a>
          <a href="#sobre" class="hover:text-ink transition-colors">SOBRE O CLAS</a>
          <a href="#equipa" class="hover:text-ink transition-colors">MEMBROS</a>
          <a href="#noticias" class="hover:text-ink transition-colors">EVENTOS</a>
          <a href="#galeria" class="hover:text-ink transition-colors">PARCEIROS</a>
          <a href="#contacto" class="hover:text-ink transition-colors">CONTACTE-NOS</a>
        </nav>

        <div class="header-actions flex items-center gap-3">
          <a href="#" class="btn btn-accent login hidden lg:inline-flex">LOGIN</a>
          <button id="menuBtn" aria-label="Abrir menu" class="lg:hidden flex flex-col justify-center items-center w-11 h-11 rounded-full border border-ink/15">
            <span class="block w-5 h-[1.5px] bg-ink mb-[5px]"></span>
            <span class="block w-5 h-[1.5px] bg-ink"></span>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobileMenu" class="lg:hidden hidden bg-cream border-t border-ink/10">
      <nav class="flex flex-col px-6 py-4 gap-4 text-sm font-medium tracking-wide">
        <a href="#home" class="py-1">HOME</a>
        <a href="#sobre" class="py-1">SOBRE O CLAS</a>
        <a href="#equipa" class="py-1">MEMBROS</a>
        <a href="#noticias" class="py-1">EVENTOS</a>
        <a href="#galeria" class="py-1">PARCEIROS</a>
        <a href="#contacto" class="py-1">CONTACTE-NOS</a>
        <a href="#" class="btn btn-accent">LOGIN</a>
      </nav>
    </div>
  </header>
  <main>
    <?= $content ?? '' ?>
  </main>
</div>

<main>
  <?= $content ?? '' ?>
</main>
<div class="papel-bg">
  <footer class="footer border-t border-ink/10">
    <div class="max-w-6xl mx-auto px-6 py-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
      <a href="#" class="nav-logo">
        <img src="assets/img/logo_clas2.png" alt="CLAS" id="logo-img" />
      </a>
      <p class=" paragrafo text-[13px] ">© 2026 Clube de Leitura do Artigo Semanal. Todos os direitos reservados.</p>
    </div>
  </footer>

</div>

<script>
  const menuBtn = document.getElementById('menuBtn');
  const mobileMenu = document.getElementById('mobileMenu');
  menuBtn?.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
</script>

</body>
</html>