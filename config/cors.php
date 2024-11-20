<?php

return [
    'paths' => ['api/*'], // Define as rotas que terão CORS aplicadas
    'allowed_methods' => ['*'], // Permite todos os métodos HTTP (GET, POST, etc.)
    'allowed_origins' => ['*'], // Permite qualquer origem
    'allowed_headers' => ['*'], // Permite qualquer cabeçalho
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
