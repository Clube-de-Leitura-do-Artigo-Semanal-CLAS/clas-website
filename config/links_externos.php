<?php
/**
 * Links para serviços externos ao CLAS — NÃO construir estas funcionalidades
 * aqui dentro, é só apontar para onde já existem.
 *
 * - kwiz_demo: usado no botão "Try o Kwiz" da home pública.
 *   Se um dia o admin precisar de trocar isto pelo painel (ex: mudar para o
 *   quiz do concurso MwangoLê), migrar para uma tabela de configurações na BD.
 * - clasia_whatsapp: link direto para a conversa com a Clásia.
 */

return [
    'kwiz_demo'       => 'https://kwiz.ao/demo', // TODO: confirmar URL definitivo
    'kwiz_site'        => 'https://kwiz.ao',
    'clasia_whatsapp'  => 'https://wa.me/000000000', // TODO: número real
];
