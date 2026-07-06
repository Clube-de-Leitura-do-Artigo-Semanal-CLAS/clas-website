<?php

namespace App\Controllers\Publica;

/**
 * Home pública + secções de topo — Tarefas 3.1 e 3.3.
 * Hero, sobre nós, destaques, galeria, leitores/melhores leitores,
 * próximos eventos, Clásia embutida, botão "Try o Kwiz" (link externo,
 * ver config/links_externos.php).
 */
class HomeController
{
    public function index(): void
    {
        // TODO: buscar destaques, galeria, próximos eventos, melhores leitores
        require __DIR__ . '/../../Views/publica/home.php';
    }

    public function sobre(): void
    {
        require __DIR__ . '/../../Views/publica/sobre.php';
    }

    public function eventos(): void
    {
        require __DIR__ . '/../../Views/publica/eventos.php';
    }

    public function inscricao(): void
    {
        // Formulário de inscrição — decidir se fica aqui ou redireciona
        // para o fluxo do WhatsApp/Clásia já existente.
        require __DIR__ . '/../../Views/publica/inscricao.php';
    }
}
