<?php

return [
    'namespaces' => explode(',', env('APOLLO_NAMESPACES', 'application')),
    'cluster' => env('APOLLO_CLUSTER', 'default'),
    'save_dir' => realpath(storage_path('apollo')),
    'config_server' => env('APOLLO_CONFIG_SERVER', 'http://localhost:8070'),
    'app_id' => env('APOLLO_APP_ID'),
    'timeout_interval' => 70
];