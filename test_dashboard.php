<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $req = new Illuminate\Http\Request();
    $controller = $app->make(App\Http\Controllers\DashboardController::class);
    $view = $controller->index($req);
    echo $view->render();
} catch (\Throwable $e) {
    echo 'ERROR: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}
