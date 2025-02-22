# Форма авторизации с PSR-4 автозагрузкой (Pure PHP)

## Установка

1. **Установите зависимости с помощью Composer:**
   ```bash
   composer install 
   ```
2. **Создайте базу данных в postgre с этой таблицой**
  ```sql
  CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
  );
  ```
3. **Настойте config/config.php**
  ```php 
    'db' => [
        'dsn'      => 'pgsql:host=localhost;port=5432;dbname=mydatabase;',
        'user'     => 'postgres',
        'password' => 'root',
    ],
    ```
4. **Запустите встроенный PHP-сервер:**
   ```bash
   php -S localhost:8000 -t public
   ```

Теперь сайт доступен по адресу: [http://localhost:8000](http://localhost:8000)