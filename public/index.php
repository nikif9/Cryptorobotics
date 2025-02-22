<?php
declare(strict_types=1);

/**
 * Front Controller
 *
 * Точка входа в приложение, загружает автозагрузчик и делегирует обработку запроса роутеру.
 *
 * @package App\Public
 */
require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../config/config.php';

use App\Route\Router;

$router = new Router($config);
$router->route();
