<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\User;
use Exception;

/**
 * RegistrationController
 *
 * Обрабатывает запрос на регистрацию пользователя.
 *
 * @package App\Controller
 */
class RegistrationController extends BaseController {
    /**
     * Конфигурация приложения, включая параметры подключения к БД.
     *
     * @var array
     */
    protected array $config;

    /**
     * Конструктор контроллера.
     *
     * @param array $config Конфигурационный массив.
     */
    public function __construct(array $config) {
        $this->config = $config;
    }

    /**
     * Обрабатывает регистрацию пользователя.
     *
     * Выполняет валидацию данных, проверяет наличие пользователя и добавляет нового в БД.
     *
     * @return void
     */
    public function register(): void {
        try {
            $email            = isset($_POST['email']) ? trim((string)$_POST['email']) : '';
            $password         = isset($_POST['password']) ? (string)$_POST['password'] : '';
            $confirm_password = isset($_POST['confirm_password']) ? (string)$_POST['confirm_password'] : '';

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->sendJson(['success' => false, 'message' => 'Некорректный email', 'error' => 'invalid_email'], 400);
            }
            if ($password !== $confirm_password) {
                $this->sendJson(['success' => false, 'message' => 'Пароли не совпадают', 'error' => 'password_mismatch'], 400);
            }

            $userModel = new User($this->config['db']);

            if ($userModel->findByEmail($email)) {
                $this->sendJson(['success' => false, 'message' => 'Пользователь с таким email уже существует', 'error' => 'user_exists'], 409);
            }

            if ($userModel->register($email, $password)) {
                $this->sendJson(['success' => true, 'message' => 'Регистрация прошла успешно']);
            } else {
                $this->sendJson(['success' => false, 'message' => 'Ошибка регистрации'], 500);
            }
        } catch (Exception $e) {
            $this->sendJson(['success' => false, 'message' => 'Внутренняя ошибка сервера'], 500);
        }
    }
}
