<?php

/**
 * config/links_externos.php
 * Links para serviços fora deste site — nada disto é construído aqui,
 * é só apontado a partir daqui, para ter um único sítio a editar.
 */

return [
    // "Try o Kwiz" na home pública — demo isolada, não conta para
    // estatísticas reais. Trocar aqui se o quiz de demonstração mudar.
    'kwiz_demo' => $_ENV['KWIZ_DEMO_URL'] ?? 'https://kwiz.ao/demo',

    // Clásia — recomendações de leitura via WhatsApp
    'clasia_whatsapp' => $_ENV['CLASIA_WHATSAPP_URL'] ?? '',
];
