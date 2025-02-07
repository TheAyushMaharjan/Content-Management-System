<?php

return [
    // 'paths' => ['api/*', 'admin/*', '/blogSetup/frontDisplay'],  
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:5173'],  // React app usually runs on port 3000
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
