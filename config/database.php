<?php

return [
    'driver' => 'pgsql',
    'host'   => getenv('DB_HOST') ?: 'localhost',
    'port'   => getenv('DB_PORT') ?: '5432',
    'name'   => getenv('DB_NAME') ?: 'postgres',
    'user'   => getenv('DB_USER') ?: 'postgres',
    'pass'   => getenv('DB_PASS') ?: '',
    'schema' => getenv('DB_SCHEMA') ?: 'public',
];
