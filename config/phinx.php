<?php

if (!defined('APP_PATH')) {
    require_once __DIR__.'/../boot.php';
}

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/../database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/../database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_environment' => 'default',
        'default' => [
            'adapter' => 'sqlite',
            'name' => 'database/i18n',
            'suffix' => '.db'
        ]
    ],
    'version_order' => 'creation'
];
