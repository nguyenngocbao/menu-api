<?php

/**
 * @author Bao
 */
return [
    'debug' => env('debug'),
    
    'sub_domain'  => env('sub_domain'),
    'view_static' => env('view_static'),
    'version' => '1.0.0',
    'path_log'  => realpath(__DIR__ . '/../../') . '/logs/' . date('Y-m-d') . '.log',
    'path_view' => realpath(__DIR__ . '/../../') . '/app/views/',
    
    'profile_time_log' => 26,                                               //
    'path_profile_db'  => realpath(__DIR__ . '/../../') . '/logs/db.pro',
    
];
