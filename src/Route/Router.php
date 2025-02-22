<?php
declare(strict_types=1);

namespace App\Route;

use App\Controller\RegistrationController;

/**
 * Router
 *
 * Определяет маршрутизацию входящих HTTP-запросов к соответствующим контроллерам.
 *
 * @package App\Route
 */
class Router {
    /**
     * Конфигурация приложения.
     *
     * @var array
     */
    protected array $config;

    /**
     * Конструктор роутера.
     *
     * @param array $config Конфигурационный массив.
     */
    public function __construct(array $config) {
        $this->config = $config;
    }

    /**
     * Маршрутизирует запрос.
     *
     * Если запрос соответствует маршруту регистрации, делегирует его RegistrationController.
     * В противном случае отображает форму или возвращает 404.
     *
     * @return void
     */
    public function route(): void {
        $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if ($uri === '/register' && $method === 'POST') {
            $controller = new RegistrationController($this->config);
            $controller->register();
        } elseif ($uri === '/' || $uri === '/form') {
            include __DIR__ . '/../../public/form.php';
        } else {
            http_response_code(404);
            echo '404 Not Found';
        }
    }
}
