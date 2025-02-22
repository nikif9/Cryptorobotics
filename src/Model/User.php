<?php
declare(strict_types=1);

namespace App\Model;

/**
 * User
 *
 * Модель для работы с данными пользователя в БД.
 *
 * @package App\Model
 */
class User {
    /**
     * PDO-соединение с БД.
     *
     * @var \PDO
     */
    protected \PDO $pdo;

    /**
     * Конструктор модели.
     *
     * Устанавливает соединение с базой данных.
     *
     * @param array $dbConfig Конфигурация подключения к БД.
     * @throws \RuntimeException Если соединение не удалось установить.
     */
    public function __construct(array $dbConfig) {
        try {
            $this->pdo = new \PDO(
                $dbConfig['dsn'],
                $dbConfig['user'],
                $dbConfig['password']
            );
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \RuntimeException("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Ищет пользователя по email.
     *
     * @param string $email Email пользователя.
     * @return array|false Массив с данными пользователя, если найден, иначе false.
     */
    public function findByEmail(string $email) {
        $stmt = $this->pdo->prepare("SELECT id, email FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Регистрирует нового пользователя.
     *
     * @param string $email    Email пользователя.
     * @param string $password Пароль пользователя.
     * @return bool True, если регистрация прошла успешно, иначе false.
     */
    public function register(string $email, string $password): bool {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        return $stmt->execute([
            'email'    => $email,
            'password' => $hashedPassword
        ]);
    }
}
