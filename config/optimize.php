<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Performance Optimization Settings
    |--------------------------------------------------------------------------
    |
    | This configuration file contains settings for various performance
    | optimizations including caching, compression, and asset optimization.
    |
    */

    'cache' => [
        'enabled' => env('CACHE_OPTIMIZATION_ENABLED', true),
        'default_ttl' => env('CACHE_DEFAULT_TTL', 3600),
        'response_cache_ttl' => env('RESPONSE_CACHE_TTL', 1800),
        'query_cache_ttl' => env('QUERY_CACHE_TTL', 900),
    ],

    'compression' => [
        'enabled' => env('COMPRESSION_ENABLED', true),
        'level' => env('COMPRESSION_LEVEL', 6),
        'min_size' => env('COMPRESSION_MIN_SIZE', 1024),
    ],

    'assets' => [
        'minify_css' => env('MINIFY_CSS', true),
        'minify_js' => env('MINIFY_JS', true),
        'combine_assets' => env('COMBINE_ASSETS', true),
        'cdn_enabled' => env('CDN_ENABLED', false),
        'cdn_url' => env('CDN_URL'),
    ],

    'database' => [
        'query_cache' => env('DB_QUERY_CACHE', true),
        'connection_pooling' => env('DB_CONNECTION_POOLING', true),
        'lazy_loading' => env('DB_LAZY_LOADING', true),
    ],

    'redis' => [
        'persistent_connections' => env('REDIS_PERSISTENT', true),
        'compression' => env('REDIS_COMPRESSION', true),
        'serialization' => env('REDIS_SERIALIZATION', 'php'),
    ],

];
