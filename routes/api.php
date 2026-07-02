<?php

/**
 * routes/api.php
 * Endpoints chamados por sistemas externos — não por browsers.
 *
 * Rota principal (tarefa 2.6):
 *   POST /api/kwiz/relatorios
 *   Recebe os relatórios de turma enviados pelo KwiZ.
 *   Autenticação via KWIZ_API_TOKEN (ver .env.example).
 *   Chama Services/KwizIntegrationService.php.
 */
