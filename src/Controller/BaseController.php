<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BaseController
 *
 * Базовый контроллер с общими методами для отправки JSON-ответов.
 *
 * @package App\Controller
 */
abstract class BaseController {
    /**
     * Отправляет JSON-ответ с указанным HTTP-статусом.
     *
     * @param mixed $data Данные для отправки.
     * @param int   $status HTTP-статус ответа.
     * @return void
     */
    protected function sendJson($data, int $status = 200): void {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
