<meta name="robots" content="noindex">

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

chdir(dirname(__DIR__));

require_once __DIR__ . '/../core/bootstrap.php';
$data = require __DIR__ . '/../config/database.php';
$appConfig = require __DIR__ . '/../config/app.config.php';


try {

    $conn = App\db\DbFactory::create($data)->getConn();

    $router = new Router($conn);

    $router->loadRoutes($appConfig['routes']);

    $controller = $router->dispatch();

    $controller->display();

} catch (\PDOException $e) {
    echo $e->getMessage();
}








