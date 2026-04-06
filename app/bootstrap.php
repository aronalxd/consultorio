<?php
declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

spl_autoload_register(static function (string $class): void {
    $directories = [
        app_path('core'),
        app_path('models'),
        app_path('controllers'),
    ];

    foreach ($directories as $directory) {
        $file = $directory . '/' . $class . '.php';

        if (is_file($file)) {
            require_once $file;
            return;
        }
    }
});

Session::start();
